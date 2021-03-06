<?php

include '../config.php';
include '../includes/functions.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// get addresses of providers 
// TODO: availible at the selected time from the db
$result = $db->query("SELECT providers.id, providers.name, providers.picture, stringaddr.address, AVG(reviews.rating) AS avg_rating FROM providers LEFT JOIN stringaddr ON providers.address_id = stringaddr.id LEFT JOIN reviews ON providers.id = reviews.provider_id GROUP BY providers.id");

$provider_origins = array();
$provider_ids = array();
$provider_names = array();

$data = array();
while ($row = $result->fetch_assoc()) {
    if(!empty($row['address'])) {
        $data[] = $row;
    }
}

if ($_POST) {
    $userAddr = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $data_arr = geoDistMatrix($data, $userAddr);

    // if able to decode the address
    if ($data_arr) {
        printResults($data_arr);

        // if unable to decode the address
    } else {
        echo "Invalid Input Address.";
    }
}

function geoDistMatrix($data, $dest) {

    foreach ($data as $key => $row) {
        $provider_ratings[] = $row['avg_rating'];
        $provider_ids[] = $row['id'];
        $provider_origins[] = $row['address'];
        $provider_names[] = $row['name'];
        $provider_pictures[] = $row['picture'];
    }

    $origString = implode("|", $provider_origins);
    $origString = urlencode($origString);
    $dest = urlencode($dest);
    $API_KEY = "AIzaSyCb1-9GkukqOGLXWs0YLIJeOAqtjUHuDFE";

// ********** Source: https://www.codeofaninja.com/2014/06/google-maps-geocoding-example-php.html **********
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origString&destinations=$dest&key=$API_KEY";

    // get the json response
    $resp_json = file_get_contents($url);

    // decode the json
    $resp = json_decode($resp_json, true);

    $dists = array();
    // response status will be 'OK', if able to geocode given address 
    if ($resp['status'] = 'OK') {
        $count = 0;
        foreach ($resp['rows'] as $d) {
            // if there is a distance returned from Google API,
            // store it in the correct place in the dists array
            if (isset($d['elements'][0]['distance'])) {
                $dists[$count] = $d['elements'][0]['distance']['value'];
            } else {
                $dists[$count] = NULL;
            }
            $count++;
        }
    }

    array_multisort($dists, $provider_origins, $data);
    array_multisort($dists, $provider_ids, $data);
    array_multisort($dists, $provider_names, $data);
    array_multisort($dists, $provider_pictures, $data);

    $dataSorted = array();
    foreach ($data as $key => $value) {
        $row = array();
        $row['id'] = $provider_ids[$key];
        $row['address'] = $provider_origins[$key];
        $row['picture'] = $provider_pictures[$key];
        $row['dist'] = floatval($dists[$key])*0.000621371; // convert m to mi
        $row['name'] = $provider_names[$key];
        $row['avg_rating'] = $provider_ratings[$key];
        $dataSorted[] = $row;
    }

    return $dataSorted;
}

function printResults($data) {
    echo "<div class='results'>\n";

    for ($i = 0; $i < 3; $i++) {
        $row = $data[$i];
        printCard($row['id'], $row['name'], $row['picture'], $row['avg_rating'], $row['dist']);
    }

    echo "</div>\n";
}

function printCard($id, $name, $imgsrc, $rating, $dist) {
    $rating = round($rating);
    $dist = round($dist, 2);
    
    $ratingStr = '';
    for ($i = 0; $i < $rating; $i++) {
        $ratingStr .= "<i class='fa fa-star'></i>";
    }
    $ratingStr .= "\n";

    //$imgsrc = "http://placehold.it/270x270&text=$name"; // for testing or for providers with no uploaded picture

    echo <<< EOT
<div class="result">
    <div class="card">
        <div class="row">
            <img class="avatar" src="$imgsrc"></img>
        </div>
        <div class="row name">
            $name ($dist mi)
        </div>
        <div class="row rating">
            $ratingStr
        </div>
        <div class="row select-row">
            <button class="btn select" data-id="$id">Select</button>
        </div>
    </div>
</div>

EOT;
}
?>