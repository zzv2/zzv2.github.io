<?php
require "../Services/Twilio.php";

$site_url = SITE_URL;

function send_sms($number, $text) {
	$client = new Services_Twilio(TWILIO_SID, TWILIO_TOKEN);
	$sms = $client->account->messages->sendMessage(TWILIO_NUMBER, $number, $text);
} 

function notify_register($email, $name) {
	// Send new user registration email welcome
	$text = "Hello $name,\n";
	$text .= "\nThanks for registering for an account with Ma-Maria. You will use this email address to login to your account.\n";
	$text .= "\nThanks,\n";
	$text .= "The Ma-Maria team";

	if(MAIL_ENABLED) {
		mail($email, 'Ma-Maria - Registration', $text);
	}
}

function notify_request_client($email) {
	// Send new request info to client
	$link = SITE_URL.'requests.php';

	$text = "Hello,\n";
	$text .= "\nYou requested an appointment. You can manage your appointment below:\n";
	$text .= "\n<a href='$link'>Manage</a>\n";
	$text .= "\nThanks,\n";
	$text .= "The Ma-Maria team";

	if(MAIL_ENABLED) {
		mail($email, 'Ma-Maria - Request', $text);
	}
}

function notify_request_provider($email, $number) {
	// Send new request info to provider
	$link = SITE_URL.'requests.php';

	$text = "Hello,\n";
	$text .= "\nYou received an appointment request. You can manage your appointments below:\n";
	$text .= "\n<a href='$link'>Manage</a>\n";
	$text .= "\nThanks,\n";
	$text .= "The Ma-Maria team";

	if(MAIL_ENABLED) {
		mail($email, 'Ma-Maria - Request', $text);
	}
	
	if(TWILIO_ENABLED) {
		send_sms($number, $text);
	}
}

function notify_confirm_client($email) {
	$link = SITE_URL.'requests.php';

	$text = "Hello,\n";
	$text .= "\nYour appointment request was approved. To view, click the link below:\n";
	$text .= "\n<a href='$link'>Manage</a>\n";
	$text .= "\nThanks,\n";
	$text .= "The Ma-Maria team";

	if(MAIL_ENABLED) {
		mail($email, 'Ma-Maria - Request Accepted', $text);
	}
	if(TWILIO_ENABLED) {
		send_sms($number, $text);
	}
}

function notify_reject_client($email) {
	$link = SITE_URL.'requests.php';

	$text = "Hello,\n";
	$text .= "\nYour appointment request was denied. To view, click the link below:\n";
	$text .= "\n<a href='$link'>Manage</a>\n";
	$text .= "\nThanks,\n";
	$text .= "The Ma-Maria team";

	if(MAIL_ENABLED) {
		mail($email, 'Ma-Maria - Request Denied', $text);
	}
}


?>