<?php
include '../config.php';
include '../includes/functions.php';
include '../includes/notify.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(get_session_user() != -1) {
	// TODO: validate inputs using filter validate,

	// TODO: escape inputs
	$customer_id = get_session_user();
	$provider_id = $_POST['provider'];
	$hours = $_POST['hours'];
	$comments = $_POST['comments'];
	$token = $_POST['token'];

	// address
	$address_line1 = $_POST['address_line1'];
	$address_line2 = $_POST['address_line2'];
	$address_city = $_POST['address_city'];
	$address_state = $_POST['address_state'];
	$address_zipcode = $_POST['address_zipcode'];

	// calculate start and end time
	$stime = strtotime($_POST['start']);
	$etime = strtotime($stime . ' + ' + $hours + ' hour');

	$start_time = date("Y-m-d H:i:s", $stime);
	$end_time = date("Y-m-d H:i:s", $etime);

	// create address
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT INTO addresses (line_1, line_2, city, state, zipcode) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $address_line1, $address_line2, $address_city, $address_state, $address_zipcode);
	if(!$stmt->execute()) {
		print "address";
		header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
		return;
	}
	$address_id = $stmt->insert_id;

	// create request
	$stmt->prepare("INSERT INTO requests (customer_id, provider_id, address_id, start_time, end_time, comments, payment_token, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("iiisssss", $customer_id, $provider_id, $address_id, $start_time, $end_time, $comments, $token, uniqid());
	if(!$stmt->execute()) {
		header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
		return;
	}

	// TODO: trigger email notification
	$user = get_user();
	notify_request_client($user['email']);
	return;
}

header($_SERVER["SERVER_PROTOCOL"]." 401 Not Authorized");

?>