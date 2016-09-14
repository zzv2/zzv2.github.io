<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <title>P3 Photo Albums</title>
    </head>
    <body>
        <div class="container">
            <h1>
                P3 - Image Album
            </h1>
            <ul class="menu">                
                <?php
                include '../includes/functions.php';
                printMenu($icons, $hrefs);
                ?>
            </ul>
            <?php
            
                loginForm();
                
                
//            require_once '../includes/config.php';
//
//
//            //Establish a database connection
//            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, 3306);
//
//
//            //Was there an error connecting to the database?
//            if ($mysqli->errno) {
//                //The page isn't worth much without a db connection so display the error and quit
//                print($mysqli->error);
//                exit();
//            }
//
//
//            $sql = "SELECT * FROM `album`";
//
//
//            //Finish off the SQL statement
//            $sql .= ';';
//
//            //echo $sql;
//            //Get the data
//            $result = $mysqli->query($sql);
//
//            //If no result, print the error
//            if (!$result) {
//                print($mysqli->error);
//                exit();
//            }
//
//
//            //print result
//            require_once "../includes/settings.php";
//            $html_safe_sql = htmlentities($sql);
//            print( "<p>Showing all ablums using the SQL query <br>$html_safe_sql</p>");
//            print("<table>");
//            print("<thead><tr>");
//            foreach ($tablefields['album'] as $field) {
//                $field_term = $field['term'];
//                $field_heading = $field['heading'];
//                //Make the header a link for sorting
//                print("<th><a href='?sort=$field_term'>$field_heading</a></th>");
//            }
//            print("<th><a href='?sort=view'>view</a></th>");
////Add empty header cell for the "modify" row
//            print( '<th></th>');
//            print("</tr></thead>");
//
//            $imgtext = '';
////Loop through the $result rows fetching each one as an associative array
//            while ($row = $result->fetch_assoc()) {
//                //start the HTML table row
//                print("<tr>");
//                foreach ($row as $key => $value) {
//                    print( "<td class='$key'>{$value}</td>\n");
//                    //print url for ablum viewing
//                }
//                //build vewing id
//                $album_id = $row['album_id'];
//                $href = "view_images.php?album_id=$album_id";
//                print("<td><a href='$href' title='$href'>View</a></td>");
//                print("</tr>");
//            }
//
//            print("</table>");
//
//
//
////        $libraryPath = 'img/image_library/';
////        $album = 'space-fantasy-wallpaper-set-84/';
////        $URL = '011.jpg';
            ?>
        </div>
    </body>
</html>
