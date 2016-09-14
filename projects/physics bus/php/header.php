<div class= "header_container">
    <?php include 'search.php'; ?>
    <div class="titlebar">
        <img class= "logo" width= "100" height= "100" src= "../images/logo.png" alt="">
        <h1><?php echo $page_title ?></h1>
        <div class="searchbar">
    <!--<img src="../images/search_icon.png" alt=""/>-->
            <form>
                <input type="text" id="st-search-input" class="st-search-input" />
            </form>
            <!--<form id="search" action="results.php" method="GET">-->
                <!--<input id="searchbox" name="q" type="search" maxlength="50" placeholder="Search...">-->
                <!--<input id="search_submit" value="Submit" type="submit">-->
            <!--</form>-->
        </div>
    </div>
    <div class= "navbar">
        <ul>
            <li> <a href= "index.php"> Home </a></li>
            <li> <a href= "about.php"> About </a>
                <ul>
                    <li><a href= "about.php"> History</a></li>
                    <li><a href= "aboutsub.php"> People</a></li>
                    <li> <a href= "physics_bus_mission.php"> Mission </a></li>
                </ul>
            </li>
            <li> <a href= "contact.php"> Contact </a></li>
            <li> <a href= "donate.php"> Donate </a> </li>
            <li> <a href= "gallery.php"> Gallery </a></li>
            <li> <a href= "tours.php"> Tours </a></li>
        </ul>
    </div>
</div>