<?php
include '../config.php';
include '../includes/functions.php';
include '../includes/notify.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user = get_user();
// Address
if($_POST['address-line1']) {
	if($_POST['address-line1'] == "" || $_POST['city'] == "" || $_POST['state'] == "" || $_POST['zipcode'] == "") {
		header('Location: ../account.php?m=6');
		return;
	}
	$line1 = htmlspecialchars($_POST['address-line1']);
	$line2 = htmlspecialchars($_POST['address-line2']);
	$city = htmlspecialchars($_POST['city']);
	$state = htmlspecialchars($_POST['state']);
	$zip = htmlspecialchars($_POST['zipcode']);

	$result = $db->query("INSERT INTO `addresses`(`line_1`, `line_2`, `city`, `state`, `zipcode`) VALUES ('$line1', '$line2', '$city', '$state', '$zip')");
	$user_id = $user['id'];
	$aid = $db->insert_id;
	$result = $db->query("UPDATE providers SET address_id=$aid WHERE id=$user_id");
		
}

// password change
if($_POST['password'] && $_POST['password2']) {
	if($_POST['password'] == $_POST['password2']) {
		$stmt = $db->prepare("SELECT salt FROM customers WHERE email = ?");		
		if($user['type'] == 'provider') {
			$stmt = $db->prepare("SELECT salt FROM providers WHERE email = ?");		
		}
		$stmt->bind_param("s", $user['email']);
		if(!$stmt->execute()) {
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}
	    $stmt->store_result();
	    $stmt->bind_result($user_salt);
	    $stmt->fetch();

		$join_stmt = $db->prepare("UPDATE customers SET password = ? WHERE id = ?");
		if($_SESSION['type'] == 'provider') {
			$join_stmt = $db->prepare("UPDATE providers SET password = ? WHERE id = ?");
		}
		$crypt = hash('sha256', $user_salt.$_POST['password']);
		$join_stmt->bind_param("si", $crypt, get_session_user());
		if(!$join_stmt->execute()) {
			header('Location: ../account.php?m=4');
			return;
		}
		$join_stmt->close();
		$_SESSION['token'] = hash('sha256', get_session_user().$crypt);
	} else {
		header('Location: ../account.php?m=5');	
	}
} 

// Upload image
if(!empty($_FILES['file']) && $_FILES['file']['name'] != "") {
	
	if ($_FILES["file"]["size"] > 10000000) {
    	header('Location: ../account.php?m=2');
    	return;
	}
	$image_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $valid = getimagesize($_FILES["file"]["tmp_name"]);
    if($valid !== false) {
    	$image_name = $_FILES["file"]["name"];
    	$image_path = "uploads/".uniqid().".".$image_extension;

    	move_uploaded_file($_FILES["file"]["tmp_name"], "../".$image_path);
    	
		$join_stmt = $db->prepare("UPDATE customers SET picture = ? WHERE id = ?");
    	if($_SESSION['type'] == 'provider') {
			$join_stmt = $db->prepare("UPDATE providers SET picture = ? WHERE id = ?");
		}
		
		$join_stmt->bind_param("si", $image_path, get_session_user());
		if(!$join_stmt->execute()) {
			header('Location: ../account.php?m=4');
			return;
		}
		$join_stmt->close();
		$_SESSION['pic'] = $image_path;
    } else {
    	header('Location: ../account.php?m=3');
		return;
    }
}
// handle rest of data
if($_POST['name']) {
	$join_stmt = $db->prepare("UPDATE customers SET name = ? WHERE id = ?");
	if($_SESSION['type'] == 'provider') {
		$join_stmt = $db->prepare("UPDATE providers SET name = ? WHERE id = ?");
	}

	$join_stmt->bind_param("si", htmlspecialchars($_POST['name']), get_session_user());
	if(!$join_stmt->execute()) {
		header('Location: ../account.php?m=4');
		return;
	}
	$join_stmt->close();
	$_SESSION['name'] = htmlspecialchars($_POST['name']);
} 


if($_POST['phone']) {
	$join_stmt = $db->prepare("UPDATE customers SET phone = ? WHERE id = ?");
	if($_SESSION['type'] == 'provider') {
		$join_stmt = $db->prepare("UPDATE providers SET phone = ? WHERE id = ?");
	}

	$join_stmt->bind_param("si", htmlspecialchars($_POST['phone']), get_session_user());
	if(!$join_stmt->execute()) {
		header('Location: ../account.php?m=4');
		return;
	}
	$join_stmt->close();
} 

header('Location: ../account.php?m=1');

?>