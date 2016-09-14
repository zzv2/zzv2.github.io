<?php

$trackFields = array(
    "Title", "Artist", "Album", "Year",
    "Rating", "Num Ratings", "Tags");
echo "<label for='Sort'>Sort by:</label>";
echo "<select name='Sort' id='Sort'>\n";
foreach ($trackFields as $value) {
    echo "<option value='$value'>$value</option>\n";
}
echo "</select>\n";
echo "<table id='tracks'>\n";
echo "<tr id='header'>\n";
foreach ($trackFields as $value) {
    echo "<th>$value</th>\n";
}
echo "</tr>\n";
echo "</table>\n";