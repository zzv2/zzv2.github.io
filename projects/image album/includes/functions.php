<?php
//session_start();
require_once 'settings.php';

function searchForm() {
    $currentPage = basename($_SERVER['PHP_SELF']);

    $searchterm = filter_input(INPUT_GET, 'searchterm', FILTER_SANITIZE_STRING);

    if (empty($searchterm)) {
        echo "<p>Please enter a keyword and choose the fields that you want to search across.";
    }

    if (
            empty($_GET['search_album']) &&
            empty($_GET['search_image']) &&
            empty($_GET['$searchterm'])) {

        $_GET['search_image'] = array('URL', 'caption');
        $_GET['search_album'] = array('title', 'description');
    }

    printSearch($searchterm);

    require_once '../includes/config.php';

//Establish a database connection
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, 3306);


//Was there an error connecting to the database?
    if ($mysqli->errno) {
//The page isn't worth much without a db connection so display the error and quit
        print($mysqli->error);
        exit();
    }

//search for matching albums
    if (!empty($searchterm)) {
        $sql = "SELECT album.*, image.URL FROM album "
                . "LEFT JOIN image ON album.cover_image_id = image.image_id ";

        //take each checked field and build sql for search
        $searches = array();
        if (!empty($_GET['search_album'])) {
            $sql .= "WHERE ";
            if (in_array("title", $_GET['search_album'])) {
                $searches[] = "album.title REGEXP '$searchterm'";
            }
            if (in_array("description", $_GET['search_album'])) {
                $searches[] = "album.description REGEXP '$searchterm'";
            }
            $sql .= implode(" OR ", $searches);
            $sql .= ";";
        } else {
            //disp no albums
            $sql = "SELECT album.*, image.URL FROM album "
                    . "LEFT JOIN image ON album.cover_image_id = image.image_id "
                    . "WHERE FALSE;";
        }

//        print("<p>$sql</p>");
//        var_dump($searches);
    } else {
//if searchterm is empty
//disp no albums
        $sql = "SELECT album.*, image.URL FROM album "
                . "LEFT JOIN image ON album.cover_image_id = image.image_id "
                . "WHERE FALSE;";
    }

    $result = $mysqli->query($sql);

//If no result, print the error
    if (!$result) {
        print($mysqli->error);
        exit();
    }

    if ($result->num_rows < 1) {
        print("<p>No Results for Albums</p>");
    } else {

        while ($row = $result->fetch_assoc()) {

//            $editLink = '';
//            if ($session_admin) {
//                $editLink = " <a class='edit_link' href='add_image.php?image_id=$image_id'>Edit</a>";
//            }
//            echo "<h1>Image #{$row['image_id']}:$editLink</h1>";
            if (!$result) {
                print($mysqli->error);
                exit();
            }

            printAlbum($row);
        }
    }

//search for matching images
    if (!empty($searchterm)) {
        $sql = "SELECT * FROM image ";
        //take each checked field and build sql for search
        $searches = array();
        $sql .= "WHERE ";
        if (!empty($_GET['search_image'])) {
            if (in_array("URL", $_GET['search_image'])) {
                $searches[] = "URL REGEXP '$searchterm'";
            }
            if (in_array("caption", $_GET['search_image'])) {
                $searches[] = "caption REGEXP '$searchterm'";
            }
        } else {
            $sql .= "FALSE ";
        }
        $sql .= implode(" OR ", $searches);
//        var_dump($searches);
    } else {
//if searchterm is empty
//disp no images
        $sql = "SELECT * FROM image WHERE FALSE;";
    }

    $sql .= ";";
//    print("<p>$sql</p>");

    $result = $mysqli->query($sql);

//If no result, print the error
    if (!$result) {
        print($mysqli->error);
        exit();
    }

    if ($result->num_rows < 1) {
        print("<p>No Results for Images</p>");
    } else {

        while ($row = $result->fetch_assoc()) {

//            $editLink = '';
//            if ($session_admin) {
//                $editLink = " <a class='edit_link' href='add_image.php?image_id=$image_id'>Edit</a>";
//            }
//            echo "<h1>Image #{$row['image_id']}:$editLink</h1>";
            if (!$result) {
                print($mysqli->error);
                exit();
            }

            printImage($row, 0);
        }
    }
}

function printSearch($searchterm) {
    ?>
    <h1>Search</h1>
    <div class="search">
        <form id="searchform" name="searchform" action="" method="get">
            <table>
                <tbody>
    <!--                    <tr>
                        <td>
                            <label for="searchterm">
                                Search:</label>
                        </td>
                    </tr>-->
                    <tr class="spaceUnder">
                        <td>
                            <?php
                            echo "<input type='text' name='searchterm' id='searchterm' value='$searchterm'>";
                            ?>                            
                        </td>
                        <td>
                            <label for="searchbutton">
                                <input value="Search" type="submit" id="searchbutton">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Album Fields:
                        </td>
                        <td>
                            Image Fields:
                        </td>
                    </tr>
                    <tr>
                        <?php
                        if (isset($_GET['search_album'])) {
                            echo "<td>\n";
                            $checked = in_array("title", $_GET['search_album']) ? 'checked' : '';
                            echo "<label>Title<input type='checkbox' name='search_album[]' value='title' $checked></label>\n";
                            $checked = in_array("description", $_GET['search_album']) ? 'checked' : '';
                            echo "<label>Description<input type='checkbox' name='search_album[]' value='description' $checked></label>\n";
                            echo "</td>";
                        } else {
                            ?>
                            <td>
                                <label>Title<input type="checkbox" name="search_album[]" value="title"></label>
                                <label>Description<input type="checkbox" name="search_album[]" value="description"></label>
                            </td>

                            <?php
                        }
                        if (isset($_GET['search_image'])) {
                            echo "<td>";
                            $checked = in_array("URL", $_GET['search_image']) ? 'checked' : '';
                            echo "<label>URL<input type = 'checkbox' name = 'search_image[]' value = 'URL' $checked></label>\n";
                            $checked = in_array("caption", $_GET['search_image']) ? 'checked' : '';
                            echo "<label>Caption<input type = 'checkbox' name = 'search_image[]' value = 'caption' $checked></label>\n";
                            echo "</td>";
                        } else {
                            ?>
                            <td>
                                <label>URL<input type="checkbox" name="search_image[]" value="URL"></label>
                                <label>Caption<input type="checkbox" name="search_image[]" value="caption"></label>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php
}

function printImage($row, $album_id) {
    echo "<div class='photo_wrap'>\n";

    if ($row === 'add') {
        $size = '200';
        if ($album_id != 0) {
            echo "<a href='add_image.php?album_id=$album_id'>\n";
        } else {
            echo "<a href='add_image.php'>\n";
        }
        echo "<img class='photo' alt='' src='../img/icons/appbar.add.png' width=$size height=$size></a>\n";
        echo "<span class='image_caption'>Add Image</span>\n";
        echo "</div>\n";
    } else {
        $URL = $row['URL'];
        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage === 'search.php' || $currentPage === 'view_images.php') {
            echo "<span class='image_URL'>URL: $URL</span>\n";
        }

        echo "<a href='view_images.php?image_id={$row['image_id']}'>\n";
        $URL = str_replace("uploads/", "thumbnails/", IMG_LIBRARY . $row['URL']);
        echo "<img class='photo' alt='' src='{$URL}'></a>\n";
        if (!($currentPage === 'view_albums.php')) {
            echo "<span class='image_caption'>{$row['caption']}</span>\n";
        }
        echo "</div>\n";
    }
}

function printAlbum($row) {
    $size = '200';
    if ($row === 'add') {
        //print the add icon
        echo "<div class='album_wrapper'>\n";
        echo "<a href='add_album.php'>\n";
        echo "<img class='album_img' alt='' src='../img/icons/appbar.add.png' width=$size height=$size></a><br>\n";
        echo "<span class='album_title'>Add Album</span>\n";
        echo "</div>\n";
    } else {
        //use the table data to generate album div
        $defaultCover = '../img/default_cover_image.png';
        echo "<div class='album_wrapper'>\n";
        echo "<a href='view_albums.php?album_id={$row['album_id']}' title='{$row['album_id']}'>\n";
        if ($row['URL'] == NULL) {
            echo "<img class='album_img' alt='' src='{$defaultCover}' width=$size height=$size></a><br>\n";
        } else {
            $URL = str_replace("uploads/", "thumbnails/", IMG_LIBRARY . $row['URL']);
            echo "<img class='album_img' alt='' src='{$URL}' width=$size height=$size></a><br>\n";
        }
        echo "<span class='album_title'>{$row['title']}</span>\n";
        echo "</div>\n";
    }
}

function printLoginForm() {
    ?>
    <div class="login">
        <h2>
            Admin Login:
        </h2>
        <form id="loginform" name="loginform" action="" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label for="username">
                                Username</label>
                        </td>
                        <td>
                            <label for="password">
                                Password</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="username" id="username" tabindex="1">
                        </td>
                        <td>
                            <input type="password" name="password" id="password" tabindex="2">
                        </td>
                        <td>
                            <label for="loginbutton">
                                <input value="Log In" tabindex="3" type="submit" id="loginbutton">
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

                                                                                                                                                                                                    <!--<span>Log in</span>-->
        <!--        <form action="login.php" method="post">
                    Username: <input type="text" name="username"> <br>
                    Password: <input type="password" name="password"> <br> <br>
                    <input type="submit" value="Submit">
                </form>-->

    </div>
    <?php
}

function printLogoutForm() {
    ?>

    <form action="" method="post">
        <input type="submit" id="logout" name="logout" value="Logout">
    </form>
    <?php
}

function loginForm() {
    $logout = filter_input(INPUT_POST, 'logout', FILTER_SANITIZE_STRING);
    if ($logout) {
        session_destroy();
        session_start();
    }

    if (isset($_SESSION['user'])) {
        $session_user = $_SESSION['user'];

        $session_username = $session_user['username'];
        $session_hashpassword = $session_user['hashpassword'];
//        printLogoutForm();
//        echo "<p>Session\n"
//        . "username: $session_username,\n"
//        . "hashpassword: $session_hashpassword</p>\n";
    }

    $currentPage = basename($_SERVER['PHP_SELF']);

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password)) {
        if (!empty($session_username) && !empty($session_hashpassword)) {
            login($session_username, $session_hashpassword);
        } else {
            if ($currentPage === 'index.php') {
                printLoginForm();
            }
        }
    } else {
        //hash the entered password for comparison with the db
        $hashed_password = hash("sha256", $password);

        login($username, $hashed_password);
    }
}

function login($username, $hashed_password) {
    require_once '../includes/config.php';
//    require_once 'config.php';
//    define('DB_HOST', 'localhost');
//    define('DB_USER', 'zzv2sp15');
//    define('DB_PASSWORD', '1234567890');
//    define('DB_NAME', 'info230_SP15_zzv2sp15');

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


//echo "<p>Hashed password: $hashed_password</p>";
//Check for a record that matches the POSTed credentials
    $query = "SELECT * 
					FROM users
					WHERE
						username = '$username'
						AND hashpassword = '$hashed_password'";

//    echo "<p>$query</p>";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;

        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage === 'login.php' && isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        echo "<div class='logout'>";
        $adminStr = ($row['admin'] === '1') ? ' (Admin)' : '';
        echo "<p>Welcome back, {$row['name']}!$adminStr</p>";
        printLogoutForm();
        echo "</div>";
    } else {
        echo "<p>$mysqli->error</p>";
        ?>
        <p>You did not login successfully.</p>
        <p>Invalid username/password.</p>
        <?php
        printLoginForm();
    }

    $mysqli->close();
}

//prints form for add/edit for the given table
function printAddEditForm($table, $id, $db_values) {
    require_once 'settings.php';

//Start a form that submits to this same page
    print "<div class='add-edit'>\n";
    print "<form method='post'>\n";

//The fields
    require 'settings.php';

    $fields = $tablefields[$table];
    foreach ($fields as $field) {
        $term = $field['term'];
        $field_heading = $field['heading'];
        if (!empty($db_values)) {
            $field_value = $db_values[$term];
        } else {
            $field_value = '';
        }
        $type = $field['type'];

//unless the field is hidden, show an label for it
//and print the input field
        $required = true;
        if (!($type === 'hidden')) {
            print("<label for='$term'>$field_heading</label>\n");
            if ($required) {
                print("<span class='required-asterisk'>*</span>\n");
            }
        }
        if ($type === 'textarea') {
            print "<textarea type='$type' maxlength='255' name='$term' id='$term'>$field_value</textarea>\n";
        } else {
            print("<input type='$type' name='$term' id='$term' value='$field_value'>\n");
        }
        print("<br>");
    }

//Submit / Save
    $name = 'save_' . $table;
    print("<input type='submit' name='$name' value='Save'>\n");
    print "</form>\n";
    print "</div>\n";    
}

//prints single menu item for homepage
function printMenuItem($name, $icon, $href) {
    echo '<li class="menu">';
    echo '<div class="flip-container">';
    echo '<div class="flipper">';
    echo '<div class="front" >';
    echo "<img src='$icon' alt='$name'/>";
    echo '</div>';
    echo "<a href='$href'>";
    echo '<div class="back">';
    echo "<h2>$name</h2>";
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    echo '</li>';
}

//prints entire homepage menu
function printMenu($icons, $hrefs) {
    //gets page url and only prints menu item if its not the current page
    $currentPage = basename($_SERVER['PHP_SELF']);
    foreach ($icons as $name => $icon) {
        $href = $hrefs[$name];
        if ($href != $currentPage) {
            printMenuItem($name, $icon, $href);
        }
    }
}

//prints single menu item for sidebar menu
function printFixedMenuItem($name, $icon, $href) {
    echo '<li>';
    echo '<div class="inner-flip-container">';
    echo '<div class="inner-flipper">';
    echo '<div class="inner-front">';
    echo "<img src='$icon' alt='$name'/>";
    echo '</div>';
    echo "<a href='$href'>";
    echo '<div class="inner-back">';
    echo "<h2>$name</h2>";
    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    echo '</li>';
}

//prints entire sidebar menu
function printFixedMenu($icons, $hrefs) {
    //gets page url and only prints menu item if its not the current page
    $currentPage = basename($_SERVER['PHP_SELF']);
    foreach ($icons as $name => $icon) {
        $href = $hrefs[$name];
        if ($href != $currentPage) {
            printFixedMenuItem($name, $icon, $href);
        }
    }
}
?>