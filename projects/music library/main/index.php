<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="navbar">
            <?php
            include '../includes/generateNavbar.php';
            printMenu($hrefs);
            ?>
        </div>
        <div class="container">
            <div class="search">
                <h2>Search</h2>
                <h3>
                    Welcome to my music library! With this database, you can filter your music by
                    mood with tags to find a perfect song for any time of day.  You can also search 
                    by Title, Artist, Album, Year, Rating or a combination. Simply change a search 
                    parameter to get a list of matching tracks!
                </h3>
                <?php include '../includes/searchForm.php'; ?>
            </div>
            <div class="results">
                <h2>Results</h2>
                <?php include '../includes/generateResults.php'; ?>
                
            </div>
        </div>

        <script src="../js/library.js" type="text/javascript"></script>
    </body>
</html>
