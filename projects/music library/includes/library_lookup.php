<?php

$return_array = array();

//get the tracks from the data.txt file
$tracks = array();
$tracksFile = file("../data.txt");
foreach ($tracksFile as $line) {
    $track = explode("\t", $line);
    array_push($tracks, $track);
}
$trackFields = array(
    "Title", "Artist", "Album", "Year",
    "Rating", "Num Ratings", "Tags");

//get search param
$searchFields = $_GET["searchFields"];
$formInputs = $_GET["formInputs"];
$sort = $_GET["sort"];
$param = array_combine($searchFields, $formInputs);
//sanitize search param
$paramS = sanitizeArray($param);
//print(json_encode($formInputs));
//look for matches
foreach ($tracks as $track) {
    $match = is_Match($track, $paramS, $trackFields);
    if ($match) {
        array_push($return_array, $track);
    }
}

//sorting functions
function cmpTitle($a, $b) {    
    return strcmp($a[0], $b[0]);
}
function cmpArtist($a, $b) {    
    return strcmp($a[1], $b[1]);
}
function cmpAlbum($a, $b) {    
    return strcmp($a[2], $b[2]);
}
function cmpYear($a, $b) {    
    return $a[3]<$b[3];
}
function cmpRating($a, $b) {    
    return $a[4]<$b[4];
}
function cmpNumRatings($a, $b) {    
    return $a[5]<$b[5];
}
function cmpTags($a, $b) {    
    return strcmp($a[6], $b[6]);
}
//sort by the given field
usort($return_array, "cmp".$sort);

//Encode the return array in json format and print it
print(json_encode($return_array));

function is_Match($track, $paramS, $trackFields) {
    $match = TRUE;
    $trackC = array_combine($trackFields, $track);
    foreach ($paramS as $field => $query) {
        if (!empty($query)) {
            switch ($field) {
                case "Title":
                case "Artist":
                case "Album":
                    $val = $trackC[$field];
                    //query matches first part of field
                    if (!(strlen($query) <= strlen($val) && strcasecmp(substr($val, 0, strlen($query)), $query) == 0)) {
                        $match = FALSE;
                    }
                    break;

                case "Year":
                    $val = $trackC[$field];
                    if (!(strcasecmp($val, $query) == 0)) {
                        $match = FALSE;
                    }
                    break;

                case "Rating":
                    $val = $trackC[$field];
                    $cond = $paramS["Condition"];
                    if (strcasecmp($cond, "gt") == 0) {
                        $match = ($val > $query) ? $match : FALSE;
                    } else if (strcasecmp($cond, "eq") == 0) {
                        $match = ($val == $query) ? $match : FALSE;
                    } else if (strcasecmp($cond, "lt") == 0) {
                        $match = ($val < $query) ? $match : FALSE;
                    }
                    break;

                case "Tags":
                    $trackTags = $trackC[$field];
                    foreach ($query as $tag) {
                        if (!($tag === '')) {
                            if (!is_array($trackTags)) {
                                $trackTags = explode(";", $trackTags);
                                $trackTags = sanitizeArray($trackTags);
//                            print(json_encode($trackTags));
                            }
                            if (!in_array($tag, $trackTags)) {
                                $match = FALSE;
                            }
                        }
                    }
                    break;

                default:
                    break;
            }
        }
    }
    return $match;
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

////Check to see if a net id was passed in
//if( isset( $_GET[ "netid" ] ) ){
//	$netid = $_GET["netid"];
//	
//	//Check to see if the netid is in the array of directory entries
//	if( !empty( $directory_entries[ $netid ] ) ) {
//		//Yes, so set the return array to the directory entry
//		$return_array = $directory_entries[ $netid ];
//	} else {
//		//Return an informative error
//		$return_array = array();
//		$return_array["error"] = "NetID not found";
//	}
//}else{
//	//Return an informative error
//	$return_array = array();
//	$return_array["error"] = "No NetID given";
//}

