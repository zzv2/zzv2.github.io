<?php

//image library path
$imgPath = "../img/image_library/";

//array of page titles and corresp icon paths
$icons = array(
    'Home' => '../img/icons/home.empty.png',
    'Albums' => '../img/icons/appbar.book.png',
    'Images' => '../img/icons/appbar.image.multiple.png',
//    'Users' => '../img/icons/appbar.user.png',
    'Search' => '../img/icons/appbar.magnify.png',
);

//array of page titles and corresp links
$hrefs = array(
    'Home' => 'index.php',
    'Albums' => 'view_albums.php',
    'Images' => 'view_images.php',
//    'Users' => 'view_users.php',
    'Search' => 'search.php'
);

//Array of fields used for each table
$tablefields = array(
    'image' => array(
        array(
            'term' => 'image_id',
            'heading' => 'Image ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'owner_id',
            'heading' => 'Owner ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'date_taken',
            'heading' => 'Date Taken',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'hidden',
        ),
        array(
            'term' => 'URL',
            'heading' => 'URL',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'hidden',
        ),
        array(
            'term' => 'caption',
            'heading' => 'Caption',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'textarea',
        ),
        
    ),
    'album' => array(
        array(
            'term' => 'album_id',
            'heading' => 'Album ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'title',
            'heading' => 'Title',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'text',
        ),
        array(
            'term' => 'owner_id',
            'heading' => 'Owner ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'cover_image_id',
            'heading' => 'Cover Image ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'description',
            'heading' => 'Description',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'textarea',
        ),
        array(
            'term' => 'date_created',
            'heading' => 'Date Created',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'hidden',
        ),
        array(
            'term' => 'date_last_modified',
            'heading' => 'Date Last Modified',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'hidden',
        ),
    ),
    'user' => array(
        array(
            'term' => 'user_id',
            'heading' => 'User ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'username',
            'heading' => 'Username',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'text',
        ),
        array(
            'term' => 'hashpassword',
            'heading' => 'Hashed Password',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'hidden',
        ),
        array(
            'term' => 'name',
            'heading' => 'Name',
            'filter' => FILTER_SANITIZE_STRING,
            'type' => 'text',
        ),
        array(
            'term' => 'admin',
            'heading' => 'Admin',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),        
    ),
    'relations' => array(
        array(
            'term' => 'relation_id',
            'heading' => 'Relation ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'image_id',
            'heading' => 'Image ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
        array(
            'term' => 'album_id',
            'heading' => 'Album ID',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'type' => 'hidden',
        ),
    )
);
?>
