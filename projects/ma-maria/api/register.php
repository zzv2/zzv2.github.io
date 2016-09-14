<?php
include '../config.php';
include '../includes/functions.php';
include '../includes/notify.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(isset($_POST['name']) && isset($_POST['type']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
	
	

	// verify data and create new user
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['password'] == $_POST['password2']) {
		$stmt = $db->stmt_init();
		$stmt->prepare("INSERT INTO customers (name, email, salt, password) VALUES (? , ?, ?, ?)");
		if($_POST['type'] == 'provider') {
			$stmt->prepare("INSERT INTO providers (name, email, salt, password) VALUES (? , ?, ?, ?)");
		}
		$salt = uniqid();
		$crypt = hash('sha256', $salt.$_POST['password']);
	    $stmt->bind_param("ssss", htmlspecialchars($_POST['name']), $_POST['email'], $salt, $crypt);

	    if(!$stmt->execute()) {
	    	print_r($stmt->errno);
	    	if($stmt->errno == 1062) {
	    		header($_SERVER["SERVER_PROTOCOL"]." 409 Conflict");
				return;
	    	}
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}
		$user_id = $stmt->insert_id;

		$_SESSION['user'] = $user_id;
		$_SESSION['name'] = htmlspecialchars($_POST['name']);
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['phone'] = '';
		$_SESSION['type'] = "user";
		$_SESSION['pic'] = 'uploads/default.png';
		if($_POST['type'] == 'provider') {
			$_SESSION['type'] = "provider";
		}
		$_SESSION['token'] = hash('sha256', $user_id.$crypt);
		notify_register($_SESSION['email'], $_SESSION['name']);
	    $stmt->close();
		$db->close();
		return;
	} else {
		header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
	}
}
header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");

?>