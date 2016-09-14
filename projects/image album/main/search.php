<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>

        <title>Search Images</title>
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
            searchForm();
            ?>
        </div>
    </body>
</html>
