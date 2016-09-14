<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add User</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
    //Display the POST data for debugging
    //echo '<pre>' . print_r( $_POST, true ) . '</pre>';
    //Get the $fields variable, which is in a separate file in order to share with index.php
    require_once "../includes/settings.php";

    //Try to get the user_id from a URL parameter
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    if (empty($user_id)) {
        //Try to get it from the POST data (form submission)
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    }

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
    if (!empty($_POST['save_user'])) {
        //Try to retrieve values from the POST data
        //Initialize an array to hold field values found in the $_POST data
        $field_values = array();

        require_once '../includes/settings.php';

        //Loop through the expected fields
        foreach ($tablefields['user'] as $field) {
            $field_name = $field['term'];
            $filter = $field['filter'];

            //Does this term exist in the POST data submitted by the add/edit user form?
            if (!empty($_POST[$field_name])) {
                //Get the value for this term from the POST data
                $field_value = filter_input(INPUT_POST, $field_name, $filter);

                //Add the search clause
                $field_values[$field_name] = $field_value;
            }
        }

        //Is this a new user being added?
        if (empty($user_id)) {
            //add 
//            if (empty($field_values['title']) || empty($field_values['year'])) {
//                $message .= '<p>User not added. Title and Year are required.';
//            } else {
            //debugging
            //echo '<pre>' . print_r( $field_values, true ) . '</pre>';
            //Get an array of the field names that have data
            $field_name_array = array_keys($field_values);

            //Comma delimited list of fields
            //equivalent to $field_list = "title, year, length";
            $field_list = implode(',', $field_name_array);

            //comma delimited list of values - need quotes around values
            $value_list = implode("','", $field_values);

            //Build the SQL for adding a user - later we'll improve security and quoting
            $sql = "INSERT INTO user ( $field_list ) VALUES ( '$value_list' );";
//            }
        } else {
            //update
            $update_fields = array();
//            if (empty($field_values['title']) || empty($field_values['year'])) {
//                $message .= '<p>User not updated. Title and Year are required.';
//            } else {
            foreach ($field_values as $field_name => $field_value) {
                $update_fields[] = "$field_name = '$field_value'";
            }
            $sets = implode(', ', $update_fields);

            //Build the SQL for adding a user - later we'll improve security and quoting
            $sql = "UPDATE user SET $sets WHERE user_id=$user_id";
        }
//        }
        //Anything to save?
        if (!empty($sql)) {
            if ($mysqli->query($sql)) {
                $message .= '<p>User Saved.</p>';

                //Was this an "add"?
                if (empty($user_id)) {
                    //Get the primary key of the newly added user
                    $user_id = $mysqli->insert_id;
                }
            } else {
                $message .= "<p>Error saving user.</p><p>$mysqli->error</p>";
            }
        }
    }

    $db_values = array();
    //Anything to load?
    if (isset($_POST['user_id']) || isset($_GET['user_id'])) {
        //Load values from the db
        if (empty($user_id)) {
            $user_id = 0;
        }
        $sql_load = "SELECT * FROM user WHERE user_id=$user_id";
        $result = $mysqli->query($sql_load);
        if ($result && mysqli_num_rows($result) > 0) {
            $db_values = $result->fetch_assoc();
        } else {
            $message .= "<p>Couldn't load user $user_id from the database.</p><p>$mysqli->error</p>";
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

        <div class="container">
            <?php
            loginForm();
            if (isset($_POST['user_id']) || isset($_GET['user_id'])) {
                $action = 'Edit';
            } else {
                $action = 'Add';
            }

            print "<h1>User - $action</h1>";
            print $message;

            if (!empty($sql)) {
                $html_safe_sql = htmlentities($sql);
                print( "<p>SQL query <br>$html_safe_sql</p>");
            }

            require_once '../includes/functions.php';
            printAddEditForm('user', $user_id, $db_values);
            ?>
        </div>
    </body>
</html>
