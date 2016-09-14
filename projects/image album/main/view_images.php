<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>

        <title>View Images</title>
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
        <div class="container">
            <?php
            loginForm();
            $session_user = '';
            $session_admin = '';
            if (isset($_SESSION['user'])) {
                $session_user = $_SESSION['user'];
                $session_admin = ($session_user['admin'] === '1');
            }
            
            require_once '../includes/config.php';

            //Establish a database connection
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, 3306);


            //Was there an error connecting to the database?
            if ($mysqli->errno) {
                //The page isn't worth much without a db connection so display the error and quit
                print($mysqli->error);
                exit();
            }

            $image_id = filter_input(INPUT_GET, 'image_id', FILTER_SANITIZE_NUMBER_INT);
            if ($image_id) {
                //get the image info
                $sql = "SELECT * FROM image WHERE image_id=$image_id";
                $result = $mysqli->query($sql);

                //If no result, print the error
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }

                if ($result->num_rows < 1) {
                    print("No Image #$image_id");
                } else {


                    $row = $result->fetch_assoc();

                    $editLink = '';
                    if ($session_admin) {
                        $editLink = " <a class='edit_link' href='add_image.php?image_id=$image_id'>Edit</a>";
                    }
                    echo "<h1>Image #{$row['image_id']}:$editLink</h1>";
                    
                    //If no result, print the error
                    if (!$result) {
                        print($mysqli->error);
                        exit();
                    }

                    printImage($row, 0);
                }
            } else {

                echo "<h1>All Images</h1>";

                //print all image squares
                $sql = "SELECT * FROM image";
                $result = $mysqli->query($sql);

                //If no result, print the error
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }


                while ($row = $result->fetch_assoc()) {
                    printImage($row, 0);
                }
                if (isset($session_admin) && $session_admin) {
                    printImage('add', 0);
                }
            }
            ?>
        </div>
    </body>
</html>
