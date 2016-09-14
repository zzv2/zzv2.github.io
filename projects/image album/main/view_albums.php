<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>

        <title>View Albums</title>
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

            $album_id = filter_input(INPUT_GET, 'album_id', FILTER_SANITIZE_NUMBER_INT);
            if ($album_id) {
                //if there is a specifed album, get the album info
                $sql = "SELECT * FROM `album` WHERE album_id=$album_id";
                $result = $mysqli->query($sql);

                //If no result, print the error
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }

                $albumInfo = $result->fetch_assoc();

                $editLink = '';
                if ($session_admin) {
                    $editLink = " <a class='edit_link' href='add_album.php?album_id=$album_id'>Edit</a>";
                }
                echo "<h1>{$albumInfo['title']}$editLink</h1>\n";
                echo "<h2>Description:</h2>\n";
                echo "<p>{$albumInfo['description']}</p>\n";
                
                //get the images from the specific album
                $sql = "SELECT image.* "
                        . "FROM relations LEFT JOIN image "
                        . "ON relations.image_id = image.image_id "
                        . "WHERE relations.album_id=$album_id;";
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
                    printImage('add', $album_id);
                }
            } else {
                print("<h1>All Albums</h1>\n");

                //print all album squares
                $sql = "SELECT album.*, image.URL FROM album LEFT JOIN image ON album.cover_image_id = image.image_id;";
                $result = $mysqli->query($sql);

                //If no result, print the error
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }


                while ($row = $result->fetch_assoc()) {
                    printAlbum($row);
                }
                if (isset($session_admin) && $session_admin) {
                    printAlbum('add');
                }
            }
            ?>
        </div>
    </body>
</html>
