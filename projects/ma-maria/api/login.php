<?php
include '../config.php';
include '../functions.php';

// TODO: check login creds, redirect to home
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['type'])) {
	$stmt = $db->prepare("SELECT salt FROM customers WHERE email = ?");		
	if($_POST['type'] == 'provider') {
		$stmt = $db->prepare("SELECT salt FROM providers WHERE email = ?");		
	}
	$stmt->bind_param("s", $_POST['email']);
	if(!$stmt->execute()) {
		header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
		return;
	}
    $stmt->store_result();
    $stmt->bind_result($user_salt);
    $stmt->fetch();

    $stmt = $db->prepare("SELECT id, name, phone, email, picture, password FROM customers WHERE password = ?");		
	if($_POST['type'] == 'provider') {
	    $stmt = $db->prepare("SELECT id, name, phone, email, picture, password FROM providers WHERE password = ?");		
	}
	$stmt->bind_param("s", hash('sha256', $user_salt.$_POST['password']));
	if(!$stmt->execute()) {
		header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
		return;
	}
    $stmt->store_result();
    $stmt->bind_result($user_id, $user_name, $user_phone, $user_email, $user_pic, $user_pass);
    if($stmt->num_rows > 0) {
    	$stmt->fetch();
    } else {
    	header($_SERVER["SERVER_PROTOCOL"]." 401 Not Authorized");
    	return;
    }

	$_SESSION['user'] = $user_id;
	$_SESSION['name'] = $user_name;
	$_SESSION['phone'] = $user_phone;
	$_SESSION['phone'] = $user_phone;
	$_SESSION['pic'] = $user_pic;
	$_SESSION['type'] = "user";
	if($_POST['type'] == 'provider') {
		$_SESSION['type'] = "provider";
	}
	$crypt = hash('sha256', $user_salt.$_POST['password']);
	$_SESSION['token'] = hash('sha256', $user_id.$crypt);
	print json_encode(array("name" => $user_name, "phone" => $user_phone));
	return;
}
header($_SERVER["SERVER_PROTOCOL"]." 401 Not Authorized");

?>