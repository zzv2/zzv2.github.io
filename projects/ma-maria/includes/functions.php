<?php
// Session helpers
function get_session_user() {
	if(isset($_SESSION['user'])) {
		// make sure the user is who they say they are
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	  	$stmt = $db->prepare("SELECT password FROM customers WHERE id = ?");		
		if(isset($_SESSION['type']) && $_SESSION['type'] == "provider") {
		  	$stmt = $db->prepare("SELECT password FROM providers WHERE id = ?");		
		}
		$stmt->bind_param("s", $_SESSION['user']);
		
		if(!$stmt->execute()) {
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}
	    $stmt->store_result();
	    $stmt->bind_result($password);
	    if($stmt->num_rows > 0) {
	    	$stmt->fetch();
	    	$secret = hash('sha256', $_SESSION['user'].$password);
	    	if($secret == $_SESSION['token']) {
	    		return $_SESSION['user'];
	    	}
	    } else {
	    	return -1;
	    }
	}
	return -1;
}

function get_user() {
	if(get_session_user() != -1) {
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		if(isset($_SESSION['type']) && $_SESSION['type'] == "provider") {
		  	$result = $db->query("SELECT * from providers WHERE id=".get_session_user()." LIMIT 1");		
		} else {
			$result = $db->query("SELECT * from customers WHERE id=".get_session_user()." LIMIT 1");
		}

		$user = $result->fetch_assoc();
		$user['type'] = $_SESSION['type'];

		if(isset($_SESSION['type']) && $_SESSION['type'] == "provider") {
			$ad_result = $db->query("SELECT * from addresses WHERE id=".$user['address_id']." LIMIT 1");
			$address = $ad_result->fetch_assoc();
			$user['address-line1'] = $address['line_1'];
			$user['address-line2'] = $address['line_2'];
			$user['city'] = $address['city'];
			$user['state'] = $address['state'];
			$user['zipcode'] = $address['zipcode'];
		}

		return $user;
	}
	return array();
}

function require_auth() {
	if(get_session_user() === -1) {
		header("Location: index.php");
	}
}

?>