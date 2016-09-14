<?php

//array of page titles and corresp links
$hrefs = array(
    'Home' => 'index.php',
    'Add Tracks' => 'add.php'
);

//prints single menu item for homepage
function printMenuItem($name, $href, $current) {
    if($current == 1) {
        echo "<li class='currentPage'>";
    } else {
        echo "<li>";
    }
    echo "<a href='$href'>";
    echo "<h2>$name</h2>";
    echo "</a>";
    echo "</li>\n";
}

//prints entire homepage menu
function printMenu($hrefs) {
    //gets page url and prints menu item
    //if its not the current page the li has a different class
    $currentPage = basename($_SERVER['PHP_SELF']);
    echo "<ul>\n";
    foreach ($hrefs as $name => $href) {
        if ($href != $currentPage) {
            printMenuItem($name, $href, 0);
        } else {
            printMenuItem($name, $href, 1);
        }
    }
    echo "</ul>\n";
}