<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Tracks</title>
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
            <h3>
                You can add a track to the database by submitting the following form.
                To add tags, increase NumTags and fill in the following inputs.
            </h3>
            <?php
            $success = FALSE;
            $inputs = array(
                "Title" => "input type='text' maxlength='50' autofocus",
                "Artist" => "input type='text' maxlength='50'",
                "Album" => "input type='text' maxlength='50'",
                "Year" => "input type='number' min='1900' max='2019'",
                "NumTags" => "input type='number' min='0' max='10'",
                "Tags" => "",
                "Rating" => "input type='number' min='0' max='10'",
                "Add" => "input type='submit'"
            );
            $requiredInputs = array(
                "Title", "Artist", "Album", "Year",
                "Rating"
            );

            $errors = array();
            $inputSanitized = array();
            $headermessage = '';
            $trackTXT = '';
            $trackTags = array();

            if (isset($_POST['Add'])) {
                //sanitize input
                foreach ($inputs as $varname => $value) {
                    if (!($varname === "Tags")) {
                        $inputSanitized[$varname] = trim(htmlspecialchars($_POST[$varname]));
                    }
                }
                $NumTags = $inputSanitized["NumTags"];
                for ($i = 0; $i < $NumTags; $i++) {
                    $inputSanitized["Tags" . $i] = trim(htmlspecialchars($_POST["Tags" . $i]));
                }

//                $inputSanitized = sanitizeArray($_POST);
                //check for empty input
                foreach ($inputSanitized as $field => $value) {
                    if (in_array($field, $requiredInputs) && empty($value)) {
                        $errors[$field] = "Enter the $field of the track.";
                    }
                }

                //check for empty tags
                for ($i = 0; $i < $NumTags; $i++) {
                    $value = $inputSanitized["Tags" . $i];
                    if (empty($value)) {
                        $errors["Tags" . $i] = "Enter Tag " . ($i + 1) . " of the track or decrease NumTags.";
                    }
                }

                //check for invalid inputs
                $field = "Year";
                if (!empty($inputSanitized[$field]) && !preg_match("/(19[0-9][0-9]|20[0-1][0-9])/", $inputSanitized[$field])) {
                    $errors[$field] = "$field must be between 1900-2019.";
                }
                $field = "NumTags";
                if (!empty($inputSanitized[$field]) && !preg_match("/([0-9]|10)/", $inputSanitized[$field])) {
                    $errors[$field] = "$field must be between 0-10.";
                }

                if (count($errors) == 0) {
                    //create track text to save in file
                    $NumTags = $inputSanitized["NumTags"];
                    $tagString = "";
                    for ($i = 0; $i < $NumTags; $i++) {
                        $value = $inputSanitized["Tags" . $i];
                        $trackTags[$i] = $value;
                    }
                    $tagString = implode(";", $trackTags);

                    $track1 = array(
                        "Title" => $inputSanitized["Title"],
                        "Artist" => $inputSanitized["Artist"],
                        "Album" => $inputSanitized["Album"],
                        "Year" => $inputSanitized["Year"],
                        "Rating" => $inputSanitized["Rating"],
                        "Num Ratings" => "1",
                        "Tags" => $tagString);
                    $trackTXT = implode("\t", $track1) . "\n";

                    //check for duplicate tracks
                    $tracksFile = file("../data.txt");
                    if (in_array($trackTXT, $tracksFile)) {
                        $errors["Duplicate"] = "There is already a track with the same attributes.";
                    }
                }

                if (count($errors) == 0) {
                    $success = TRUE;
                    $headermessage = "<h3>Thanks for submitting!</h3>";
                } else {
                    $headermessage = "<h3>Please correct form errors</h3>";
                }
            }

            function sanitizeArray($array) {
                $temp = array();
                foreach ($array as $key => $value) {
                    $key = trim(htmlspecialchars($key));
                    if (is_array($value)) {
                        $value = sanitizeArray($value);
                    } else {
                        $value = trim(htmlspecialchars($value));
                    }
                    $temp[$key] = $value;
                }
                return $temp;
            }

            if (!isset($_POST['Add'])) {

                echo "<form action='add.php' method='post'>";
                foreach ($inputs as $name => $attri) {
                    if ($name != "Tags") {
                        $requiredString = "";
                        if (in_array($name, $requiredInputs)) {
                            $requiredString = "<span class='required-asterisk'>*</span>";
                        }
                        echo "$name:$requiredString<$attri class='inputFields' name='$name' id='$name'><br>";
                    } else {
                        echo "$name:";
                        for ($i = 0; $i <= 10; $i++) {
                            $display = " style='display: none'";
                            echo "<input class='tagFields' type='text' maxlength='20'$display name='$name$i' id='$name$i'>";
                        }
                        echo "<br>";
                    }
                }
                echo "</form>";
            } elseif (!$success) {
                echo "<div class='errordiv'>\n";
                echo $headermessage;
                foreach ($errors as $field => $msg) {
                    echo "<p class='error'>$msg</p>\n";
                }
                echo "</div>\n";

                echo "<form action='add.php' method='post'>\n";
                foreach ($inputs as $name => $attri) {
                    if ($name != "Tags") {
                        $val = $inputSanitized[$name];
                        $requiredString = "";
                        if (in_array($name, $requiredInputs)) {
                            $requiredString = "<span class='required-asterisk'>*</span>";
                        }
                        echo "$name:$requiredString<$attri class='inputFields' name='$name' id='$name' value='$val'><br>\n";
                    } else {
                        echo "$name:";
                        for ($i = 0; $i <= 10; $i++) {
                            $display = " style='display: none'";
                            $addVal = '';
                            if (!empty($inputSanitized[$name . $i])) {
                                $val = $inputSanitized[$name . $i];
                                $addVal = " value='$val'";
                            }
                            echo "<input class='tagFields' type='text' maxlength='20'$display name='$name$i' id='$name$i'$addVal>\n";
                        }
                        echo "<br>";
                    }
                }
                echo "</form>";
            } else {
                //add new tags to tags.txt file
                $tagsFile = file("../tags.txt");
                $fileid1 = fopen("../tags.txt", 'a+');
                foreach ($trackTags as $line) {
                    $line = strtolower($line);
                    if (!in_array($line . "\r\n", $tagsFile)) {
                        fwrite($fileid1, $line . "\r\n");
                    }
                }
                fclose($fileid1);

                //add track to data.txt file
                $fileid = fopen("../data.txt", 'a+');
                fwrite($fileid, $trackTXT);
                fclose($fileid);
                //add new tags to tags.txt file
                echo "<p>Thank you, for submitting your track.</p>\n";
                echo "<p id='response'>";
                foreach ($inputSanitized as $field => $value) {
                    if (!($field === "Add" || $field === "NumTags")) {
                        echo "$field: $value<br>";
                    }
                }
                echo "</p>";
            }
            $errors = array();
            $inputSanitized = array();
            $headermessage = '';
//            $success = FALSE;
//            $trackTXT ='';
            ?>
        </div>

        <script src="../js/add.js" type="text/javascript"></script>
    </body>
</html>
