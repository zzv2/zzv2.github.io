<?php

//echo "Logout";
session_start();
session_destroy(); //destroy the session
//echo "<p>test1</p>\n";
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>