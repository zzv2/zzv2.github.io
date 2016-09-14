<?php

$inputs = array(
    "Title" => "input type='text' maxlength='50' autofocus",
    "Artist" => "input type='text' maxlength='50'",
    "Album" => "input type='text' maxlength='50'",
    "Year" => "input type='number' value='' min='1900' max='2015'",
    
    "Condition" => "select name='Condition' id='Condition'>\n"
    . "<option value='gt'>Greater than</option>\n"
    . "<option value='eq'>Equal to</option>\n"
    . "<option value='lt'>Less than</option>\n"
    . "</select>",
    
    "Rating" => "input type='number' min='0' max='10' value=''",
    "Tags" => ""
//    "Search" => "input type='submit'"
);

echo "<form action='submits_by_jquery_instead.txt' method='get'>\n";
foreach ($inputs as $name => $attri) {
    if ($name == "Tags") {
        $tags = file("../tags.txt");
        echo "Tags:<br>\n";
        foreach ($tags as $tagName) {
            $tagName = trim(htmlspecialchars($tagName));
            echo "<label><input class='tagSearch' type='checkbox' name='tag' value='$tagName'>$tagName</label>\n";    
        }
        echo "<br>\n";
    } elseif ($name == "Condition") {
        echo "$name:<$attri\n";
    } else {
        echo "$name:<$attri class='inputFields' name='$name' id='$name'><br>\n";
    }
}
echo "</form>\n";
?>