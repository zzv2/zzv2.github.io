<?php
session_start();

$message = '';

if (!empty($_POST['clearphotos'])) {
    $_SESSION['photos'] = array();

    //Delete the files from the images directory
//    $files = glob('../img/uploads/*'); // get all file names
//    foreach ($files as $file) { // iterate files
//        if (is_file($file))
//            unlink($file); // delete file
//    }
    //Delete the files from the thumbnails directory
//    $files = glob('../img/thumbnails/*'); // get all file names
//    foreach ($files as $file) { // iterate files
//        if (is_file($file))
//            unlink($file); // delete file
//    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Image</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
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

        <div class="container  add_edit">
            <?php
            loginForm();
            if (isset($_POST['image_id']) || isset($_GET['image_id'])) {
                $action = 'Edit';
            } else {
                $action = 'Add';
            }

            print "<h1>Image - $action</h1>";
            print $message;

            if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] === '1') {



                if (!empty($sql)) {
                    $html_safe_sql = htmlentities($sql);
                    print( "<p>SQL query <br>$html_safe_sql</p>");
                }
            } else {
                print("<p>Only Admins have access to this page.\n"
                        . "Redirecting you back to home/login page...</p>");
                header("refresh:2; url=index.php");
            }
            
            //Display the POST data for debugging
            //echo '<pre>' . print_r( $_POST, true ) . '</pre>';
            //Get the $fields variable, which is in a separate file in order to share with index.php
            require_once "../includes/settings.php";

            //Try to get the image_id from a URL parameter
            $image_id = filter_input(INPUT_GET, 'image_id', FILTER_SANITIZE_NUMBER_INT);
            if (empty($image_id)) {
                //Try to get it from the POST data (form submission)
                $image_id = filter_input(INPUT_POST, 'image_id', FILTER_SANITIZE_NUMBER_INT);
            }

            $album_id = filter_input(INPUT_GET, 'album_id', FILTER_SANITIZE_NUMBER_INT);

            if ($album_id) {
                $_SESSION['photos'] = array();
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

            $db_values = array();
            //Anything to load?
            if (isset($_POST['image_id']) || isset($_GET['image_id'])) {
                //Load values from the db
                if (empty($image_id)) {
                    $image_id = 0;
                }
                $sql_load = "SELECT * FROM image WHERE image_id=$image_id";
                $result = $mysqli->query($sql_load);
                if ($result && mysqli_num_rows($result) > 0) {
                    $db_values = $result->fetch_assoc();
                } else {
                    $message .= "<p>Couldn't load image $image_id from the database.</p><p>$mysqli->error</p>";
                }
            }


            //Was the "Upload Photos" button clicked?
            require_once '../includes/functions.php';
            if ($action === 'Edit') {
                printAddEditForm('image', $image_id, $db_values);
            } else {
                //Check to see if files were uploaded using the "multiple file" form
                if (!isset($_FILES['newphotos'])) {
                    ?>
                    <form action="add_image.php" method="post" enctype="multipart/form-data">
                        <p>
                            <label for="new-photos">Multiple photo upload: </label><br>
                            <input id="new-photos" type="file" name="newphotos[]" multiple><br>
                            <?php
                            print("<input type='hidden' name='album_id' value='$album_id'><br>\n");
                            ?>
                            <input type="submit" value="Upload photo(s)"><br>
                        </p>
                    </form>
                    <form action="add_image.php" method="post">
                        <p><input type="submit" name="clearphotos" value="Clear photo(s)"></p>
                    </form>

                    <?php
                } else {
                    ?>
                    <form action="add_image.php" method="post">
                        <p><input type="submit" name="clearphotos" value="Clear photo(s)"></p>
                    </form>

                    <?php
                    require_once '../includes/resize.php';
                    $newPhotos = $_FILES['newphotos'];
                    $photos = array();
                    for ($i = 0; $i < count($newPhotos['name']); $i++) {
                        $originalName = $newPhotos['name'][$i];
                        if ($newPhotos['error'][$i] == 0) {
                            $tempName = $newPhotos['tmp_name'][$i];

                            //Debugging
//                        echo "Moving $tempName to ../img/uploads/$originalName";
                            move_uploaded_file($tempName, "../img/uploads/$originalName");

//                            $_SESSION['photos'][] = $originalName;
                            $photos[] = $originalName;

                            print("<p>The file $originalName was uploaded successfully.</p>");
                            save_thumbnail("../img/uploads/$originalName", "../img/thumbnails/$originalName", 200);
                        } else {
                            print("<p>The file $originalName was not uploaded.</p>");
                        }
                    }


                    $album_id = filter_input(INPUT_POST, 'album_id', FILTER_SANITIZE_NUMBER_INT);
//                    var_dump($_SESSION['photos']);
//                    foreach ($_SESSION['photos'] as $photo) {
                    foreach ($photos as $photo) {
                        $URL = "$photo";
                        $imagesize = getimagesize(IMG_LIBRARY . $URL);
                        $size = "Actual size: $imagesize[3]";
                        $date_taken = '';
                        $exif_data = exif_read_data(IMG_LIBRARY . $URL);
//                    echo '<pre style="display:none;">Exif data: ' . print_r($exif_data, true) . '</pre>';
                        if (!empty($exif_data['DateTimeOriginal'])) {
                            $date_taken = $exif_data['DateTimeOriginal'];
                        }
                        //print("<img src='$file' alt='$photo' title='$photo $size $taken'><br />\n");
                        $file_url = urlencode($photo);
//                    print("<a href='view_images.php?image=$image_id'><img src='$file' alt='$photo' title='$photo $size $date_taken'></a><br />\n");
                        $field_values['image_id'] = NULL;
                        $owner_id = '1'; //default for now
                        $field_values['owner_id'] = $owner_id;
                        $field_values['date_taken'] = $date_taken;
                        $field_values['URL'] = $URL;
                        $field_values['caption'] = "$photo $size $date_taken";
                        //set thumbnail to show

                        printImage($field_values, 0);
//                        $field_values['URL'] = $URL;
                        //add image to album
                        //check for empty

                        $field_name_array = array_keys($field_values);

                        //Comma delimited list of fields
                        //equivalent to $field_list = "title, year, length";
                        $field_list = implode(',', $field_name_array);

                        //comma delimited list of values - need quotes around values
                        $value_list = implode("','", $field_values);

                        //Build the SQL for adding a image - later we'll improve security and quoting
                        $sql = "INSERT INTO image ( $field_list ) VALUES ( '$value_list' );";

                        if ($mysqli->query($sql)) {
                            //add to a specific album
                            //Get the primary key of the newly added image
                            $image_id = $mysqli->insert_id;

                            $sql_relation = "INSERT INTO relations (`relation_id`, `image_id`, `album_id`) VALUES (NULL, $image_id, $album_id);";
                            if ($mysqli->query($sql_relation)) {
                                $message .= "<p>$photo Saved into album $album_id.</p>";
                            } else {
                                $message .= "<p>Error saving $photo.</p><p>$mysqli->error</p>";
                            }
                        } else {
                            $message .= "<p>Error saving image.</p><p>$mysqli->error</p>";
                        }
                    }
                    print $message;
                }
//                print("<h1>Uploaded photos</h1>\n");
                //Debugging: This formats the $_FILES array nicely but hides it from view
                //so you can see it in the inspector or HTML source
//                echo '<pre style="display:none;">FILES: ' . print_r($_FILES, true) . '</pre>';
//                echo '<pre style="display:none">SESSION: ' . print_r($_SESSION, true) . '</pre>';
            }

            //Was the "Save" button clicked?
            if (!empty($_POST['save_image'])) {
                //Try to retrieve values from the POST data
                //Initialize an array to hold field values found in the $_POST data
                $field_values = array();

                require_once '../includes/settings.php';

                //Loop through the expected fields
                foreach ($tablefields['image'] as $field) {
                    $field_name = $field['term'];
                    $filter = $field['filter'];

                    //Does this term exist in the POST data submitted by the add/edit image form?
                    if (!empty($_POST[$field_name])) {
                        //Get the value for this term from the POST data
                        $field_value = filter_input(INPUT_POST, $field_name, $filter);

                        //Add the search clause
                        $field_values[$field_name] = $field_value;
                    }
                }

                //Is this a new image being added?
                if (empty($image_id)) {
                    //add
                    //check for empty

                    $field_name_array = array_keys($field_values);

                    //Comma delimited list of fields
                    //equivalent to $field_list = "title, year, length";
                    $field_list = implode(',', $field_name_array);

                    //comma delimited list of values - need quotes around values
                    $value_list = implode("','", $field_values);

                    //Build the SQL for adding a image - later we'll improve security and quoting
                    $sql = "INSERT INTO image ( $field_list ) VALUES ( '$value_list' );";
//            }
                } else {
                    //update
                    $update_fields = array();
//            if (empty($field_values['title']) || empty($field_values['year'])) {
//                $message .= '<p>Image not updated. Title and Year are required.';
//            } else {
                    foreach ($field_values as $field_name => $field_value) {
                        $update_fields[] = "$field_name = '$field_value'";
                    }
                    $sets = implode(', ', $update_fields);

                    $sql = "UPDATE image SET $sets WHERE image_id=$image_id";
                }
//        }
                //Anything to save?
                if (!empty($sql)) {
                    if ($mysqli->query($sql)) {

                        //Was this an "add" to a specific album?
                        if (empty($image_id)) {
                            //Get the primary key of the newly added image
                            $image_id = $mysqli->insert_id;

                            if (!empty($album_id)) {
                                $sql_relation = "INSERT INTO relations (`relation_id`, `image_id`, `album_id`) VALUES (NULL, $image_id, $album_id);";
                                if ($mysqli->query($sql_relation)) {
                                    $message .= '<p>Image Saved.</p>';
                                    header("refresh:2; url=view_albums.php?album_id=$album_id");
                                } else {
                                    $message .= "<p>Error saving image.</p><p>$mysqli->error</p>";
                                }
                            }
                        } else {
                            $message .= '<p>Image Saved.</p>';
                        }
                        header("refresh:0; url=view_images.php?image_id=$image_id");
                    } else {
                        $message .= "<p>Error saving image.</p><p>$mysqli->error</p>";
                    }
                }
            }
            ?>



        </div>
    </body>
</html>
