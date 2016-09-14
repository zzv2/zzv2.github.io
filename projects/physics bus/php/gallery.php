<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gallery</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lightbox/css/lightbox.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Raleway:700%7CJulius+Sans+One' rel='stylesheet' type='text/css'>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../lightbox/js/lightbox.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        $page_title = "Gallery";

        include 'header.php';
        ?>

        <div class="container">
            <?php

            //*************************************************************************************
            function lightbox_display($dir_to_search, $rel) {
                $image_dir = $dir_to_search;
                $dir_to_search = scandir($dir_to_search);
                $image_exts = array('gif', 'jpg', 'jpeg', 'png', 'JPG');
                $excluded_filename = '_t';
                foreach ($dir_to_search as $image_file) {
                    $dot = strrpos($image_file, '.');
                    $filename = substr($image_file, 0, $dot);
                    $filetype = substr($image_file, $dot + 1);
                    $thumbnail_file = strrpos($filename, $excluded_filename);
                    if ((!$thumbnail_file) and array_search($filetype, $image_exts) !== false) {
                        echo "<a class='gallerylinks' href='" . $image_dir . $image_file . "' rel='" . $rel . "'>
<img src='" . $image_dir . $filename . "_t." . $filetype . "' alt='" . $filename . "' width='200' height='160' title=''/>
</a>" . "\n";
                    }
                }
            }

            //*************************************************************************************
            //** Source: http://www.fatbellyman.com/webstuff/lightbox_gallery/ ********************

            lightbox_display('../images/gallery/', 'lightbox[gallery]');
            ?>


        </div>
        <?php include 'footer.php'; ?>

    </body>
</html>
