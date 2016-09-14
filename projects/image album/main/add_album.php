<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Album</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    //Try to get the album_id from a URL parameter
    $album_id = filter_input(INPUT_GET, 'album_id', FILTER_SANITIZE_NUMBER_INT);
    if (empty($album_id)) {
        //Try to get it from the POST data (form submission)
        $album_id = filter_input(INPUT_POST, 'album_id', FILTER_SANITIZE_NUMBER_INT);
    }



    //Display the POST data for debugging
    //echo '<pre>' . print_r( $_POST, true ) . '</pre>';
    //Get the $fields variable, which is in a separate file in order to share with index.php
    require_once "../includes/settings.php";


    $message = '';
    //Get the connection info for the DB. 
    require_once '../includes/config.php';

    //Establish a database connection
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->errno) {
        print "<p>$mysqli->error</p>";
        exit();
    }

    //Was the "Save" button clicked?
    if (!empty($_POST['save_album']) || !empty($_POST['delete'])) {
        //Try to retrieve values from the POST data
        //Initialize an array to hold field values found in the $_POST data
        $field_values = array();

        require_once '../includes/settings.php';

        //Loop through the expected fields
        foreach ($tablefields['album'] as $field) {
            $field_name = $field['term'];
            $filter = $field['filter'];

            //Does this term exist in the POST data submitted by the add/edit album form?
            if (!empty($_POST[$field_name])) {
                //Get the value for this term from the POST data
                $field_value = filter_input(INPUT_POST, $field_name, $filter);

                //Add the search clause
                if (empty($field_value)) {
                    $field_values[$field_name] = 'NULL';
                } else {
                    $field_values[$field_name] = $field_value;
                }
            }
        }

        $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_STRING);
        //was delete button pressed?
        if ($delete) {
            $album_id = filter_input(INPUT_POST, 'album_id', FILTER_SANITIZE_NUMBER_INT);
            $sql = "DELETE FROM album WHERE album_id=$album_id";
        }

        //Is this a new album being added?
        elseif (empty($album_id)) {
            //add
            //check for empty fields
            //generate date_last_modified and date_created
            $date = date("Y-m-d H:i:s");
            $field_values['date_created'] = $date;
            $field_values['date_last_modified'] = $date;



            //Get an array of the field names that have data
            $field_name_array = array_keys($field_values);

            //Comma delimited list of fields
            //equivalent to $field_list = "title, year, length";
            $field_list = implode(',', $field_name_array);

            //comma delimited list of values - need quotes around values
            $value_list = implode("','", $field_values);

            //Build the SQL for adding a album
            $sql = "INSERT INTO album ( $field_list ) VALUES ( '$value_list' );";
//            }
        } else {
            //update
            $update_fields = array();

            $date = date("Y-m-d H:i:s");
//            $field_values['date_created'] = $date;
            $field_values['date_last_modified'] = $date;

            foreach ($field_values as $field_name => $field_value) {
                $update_fields[] = "$field_name = '$field_value'";
            }



            $sets = implode(', ', $update_fields);

            //Build the SQL for adding a album
            $sql = "UPDATE album SET $sets WHERE album_id=$album_id";
        }
//        }
        //Anything to query?
        if (!empty($sql)) {
//            $message .= "<p>$sql</p>\n";                
            if ($mysqli->query($sql)) {
                if ($delete) {

                    //delete all relations
                    $sql = "DELETE FROM relations WHERE album_id=$album_id";
                    if ($mysqli->query($sql)) {
                        $message .= "<p>Album Deleted.</p>\n";
                        header("refresh:2; url=view_albums.php");
                    }
                } else {
                    $message .= "<p>Album Saved.</p>\n";
                    header("refresh:2; url=view_albums.php?album_id=$album_id");
                }


                //Was this an "add"?
                if (empty($album_id)) {
                    //Get the primary key of the newly added album
                    $album_id = $mysqli->insert_id;
                    $_GET['album_id'] = $album_id;
                }
            } else {
                $message .= "<p>Error changing album.</p><p>$mysqli->error</p>";
            }
        }
    }

    if ((isset($_POST['album_id']) || isset($_GET['album_id'])) && !empty($album_id)) {
        $action = 'Edit';
    } else {
        $action = 'Add';
    }

    $db_values = array();
    //Anything to load?
    if ((isset($_POST['album_id']) || isset($_GET['album_id'])) && !empty($album_id)) {
        //Load values from the db
        if (empty($album_id)) {
            $album_id = 0;
        }
        $sql_load = "SELECT * FROM album WHERE album_id=$album_id";
        $result = $mysqli->query($sql_load);
        if ($result && mysqli_num_rows($result) > 0) {
            $db_values = $result->fetch_assoc();
        } else {
            $message .= "<p>Couldn't load album $album_id from the database.</p><p>$mysqli->error</p>";
        }
    }
    ?>

    <body>
        <div id="fixedMenuBar">
            <div class="flip-container" >
                <div class="flipper">
                    <div class="front" >
                        <img src="../img/icons/list.png" alt="Menu"/>
                    </div>
                    <div class="back">
                        <ul>
                            <li>
                                <div class="flip-container" >
                                    <div class="flipper">
                                        <div class="front" >
                                        </div>
                                        <div class="back">
                                            <h2>Menu</h2>
                                        </div>
                                    </div>
                                </div>
                            </li>
<?php
include '../includes/functions.php';
printFixedMenu($icons, $hrefs);
?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container add_edit">
<?php
loginForm();
if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] === '1') {

    print "<h1>Album - $action</h1>";
    print "<form method='post'>\n";
    print "<input type='hidden' name='album_id' value='$album_id'>\n";
    print "<input type='submit' id='delete' name='delete' value='Delete'>\n";
    print "</form>";


    print $message;

    if (!empty($sql)) {
        $html_safe_sql = htmlentities($sql);
//                print( "<p>SQL query <br>$html_safe_sql</p>");
    }

    require_once '../includes/functions.php';
    printAddEditForm('album', $album_id, $db_values);
} else {
    print("<p>Only Admins have access to this page.\n"
            . "Redirecting you back to home/login page...</p>");
    header("refresh:2; url=index.php");
}
?>
        </div>
    </body>
</html>