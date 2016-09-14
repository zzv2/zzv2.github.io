<?php

// TODO: implement API for availability updates
// code to handle schedule updates
// check user id
// check for method (add, delete)
// insert into database

include '../config.php';
include '../includes/functions.php';

$times = array("11:00 PM", "10:45 PM", "10:30 PM", "10:15 PM", "10:00 PM", "9:45 PM", "9:30 PM", "9:15 PM", "9:00 PM", "8:45 PM", "8:30 PM", "8:15 PM", "8:00 PM", "7:45 PM", "7:30 PM", "7:15 PM", "7:00 PM", "6:45 PM", "6:30 PM", "6:15 PM", "6:00 PM", "5:45 PM", "5:30 PM", "5:15 PM", "5:00 PM", "4:45 PM", "4:30 PM", "4:15 PM", "4:00 PM", "3:45 PM", "3:30 PM", "3:15 PM", "3:00 PM", "2:45 PM", "2:30 PM", "2:15 PM", "2:00 PM", "1:45 PM", "1:30 PM", "1:15 PM", "1:00 PM", "12:45 PM", "12:30 PM", "12:15 PM", "12:00 PM", "11:45 AM", "11:30 AM", "11:15 AM", "11:00 AM", "10:45 AM", "10:30 AM", "10:15 AM", "10:00 AM", "9:45 AM", "9:30 AM", "9:15 AM", "9:00 AM", "8:45 AM", "8:30 AM", "8:15 AM", "8:00 AM", "7:45 AM", "7:30 AM", "7:15 AM", "7:00 AM", "6:45 AM", "6:30 AM", "6:15 AM", "6:00 AM");

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(get_session_user() != -1 && isset($_POST['start']) && isset($_POST['end'])) {
	
	$user = get_user();
	if($user['type'] != 'provider') {
		header($_SERVER["SERVER_PROTOCOL"]." 401 Not Authorized");
    	return;
	}


	$curr_date = date("Y-m-d", strtotime($_POST['start']));
	$start = strtotime($_POST['start']);
	$end = strtotime($_POST['end']);
	
	if($_POST['remove'] == "true") {
		// Need to update existing entry
		$q = "SELECT `11:00 PM`, `10:45 PM`, `10:30 PM`, `10:15 PM`, `10:00 PM`, `9:45 PM`, `9:30 PM`, `9:15 PM`, `9:00 PM`, `8:45 PM`, `8:30 PM`, `8:15 PM`, `8:00 PM`, `7:45 PM`, `7:30 PM`, `7:15 PM`, `7:00 PM`, `6:45 PM`, `6:30 PM`, `6:15 PM`, `6:00 PM`, `5:45 PM`, `5:30 PM`, `5:15 PM`, `5:00 PM`, `4:45 PM`, `4:30 PM`, `4:15 PM`, `4:00 PM`, `3:45 PM`, `3:30 PM`, `3:15 PM`, `3:00 PM`, `2:45 PM`, `2:30 PM`, `2:15 PM`, `2:00 PM`, `1:45 PM`, `1:30 PM`, `1:15 PM`, `1:00 PM`, `12:45 PM`, `12:30 PM`, `12:15 PM`, `12:00 PM`, `11:45 AM`, `11:30 AM`, `11:15 AM`, `11:00 AM`, `10:45 AM`, `10:30 AM`, `10:15 AM`, `10:00 AM`, `9:45 AM`, `9:30 AM`, `9:15 AM`, `9:00 AM`, `8:45 AM`, `8:30 AM`, `8:15 AM`, `8:00 AM`, `7:45 AM`, `7:30 AM`, `7:15 AM`, `7:00 AM`, `6:45 AM`, `6:30 AM`, `6:15 AM`, `6:00 AM` FROM availability WHERE date='".$curr_date."' AND provider_id=".$user['id'];
		$result = $db->query($q);
		$time_enabled = $result->fetch_row();
		$u_str = "";
		foreach ($times as $time) {
			$now = strtotime($curr_date.' '.$time);
			if ($now >= $start && $now < $end) {
			   $time_enabled[] = 0;
			   print $time;
			   $u_str .= "`$time`=0,";
			}
		}
		print $u_str;
		$u_str = rtrim($u_str, ",");
		$result = $db->query("UPDATE availability SET $u_str WHERE `date`='".$curr_date."'");
		if (!$result) {
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}
		return;
	}

	$q = "SELECT `11:00 PM`, `10:45 PM`, `10:30 PM`, `10:15 PM`, `10:00 PM`, `9:45 PM`, `9:30 PM`, `9:15 PM`, `9:00 PM`, `8:45 PM`, `8:30 PM`, `8:15 PM`, `8:00 PM`, `7:45 PM`, `7:30 PM`, `7:15 PM`, `7:00 PM`, `6:45 PM`, `6:30 PM`, `6:15 PM`, `6:00 PM`, `5:45 PM`, `5:30 PM`, `5:15 PM`, `5:00 PM`, `4:45 PM`, `4:30 PM`, `4:15 PM`, `4:00 PM`, `3:45 PM`, `3:30 PM`, `3:15 PM`, `3:00 PM`, `2:45 PM`, `2:30 PM`, `2:15 PM`, `2:00 PM`, `1:45 PM`, `1:30 PM`, `1:15 PM`, `1:00 PM`, `12:45 PM`, `12:30 PM`, `12:15 PM`, `12:00 PM`, `11:45 AM`, `11:30 AM`, `11:15 AM`, `11:00 AM`, `10:45 AM`, `10:30 AM`, `10:15 AM`, `10:00 AM`, `9:45 AM`, `9:30 AM`, `9:15 AM`, `9:00 AM`, `8:45 AM`, `8:30 AM`, `8:15 AM`, `8:00 AM`, `7:45 AM`, `7:30 AM`, `7:15 AM`, `7:00 AM`, `6:45 AM`, `6:30 AM`, `6:15 AM`, `6:00 AM` FROM availability WHERE date='".$curr_date."' AND provider_id=".$user['id'];
	$result = $db->query($q);
	if($result->num_rows == 0) { 

		// Doesn't exist

		$time_enabled = array();
		foreach ($times as $time) {
			$now = strtotime($curr_date.' '.$time);
			if ($now >= $start && $now < $end) {
			   $time_enabled[] = 1;
			} else {
			   $time_enabled[] = 0;
			}
		}
		$tmp = implode($time_enabled, '", "');
		$t_string = '"'.$tmp.'"';
		print $t_string;
		$result = $db->query("INSERT INTO availability (`provider_id`, `date`, `11:00 PM`, `10:45 PM`, `10:30 PM`, `10:15 PM`, `10:00 PM`, `9:45 PM`, `9:30 PM`, `9:15 PM`, `9:00 PM`, `8:45 PM`, `8:30 PM`, `8:15 PM`, `8:00 PM`, `7:45 PM`, `7:30 PM`, `7:15 PM`, `7:00 PM`, `6:45 PM`, `6:30 PM`, `6:15 PM`, `6:00 PM`, `5:45 PM`, `5:30 PM`, `5:15 PM`, `5:00 PM`, `4:45 PM`, `4:30 PM`, `4:15 PM`, `4:00 PM`, `3:45 PM`, `3:30 PM`, `3:15 PM`, `3:00 PM`, `2:45 PM`, `2:30 PM`, `2:15 PM`, `2:00 PM`, `1:45 PM`, `1:30 PM`, `1:15 PM`, `1:00 PM`, `12:45 PM`, `12:30 PM`, `12:15 PM`, `12:00 PM`, `11:45 AM`, `11:30 AM`, `11:15 AM`, `11:00 AM`, `10:45 AM`, `10:30 AM`, `10:15 AM`, `10:00 AM`, `9:45 AM`, `9:30 AM`, `9:15 AM`, `9:00 AM`, `8:45 AM`, `8:30 AM`, `8:15 AM`, `8:00 AM`, `7:45 AM`, `7:30 AM`, `7:15 AM`, `7:00 AM`, `6:45 AM`, `6:30 AM`, `6:15 AM`, `6:00 AM`) VALUES ({$user['id']}, '$curr_date', $t_string)");
		if (!$result) {
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}

	} else {
		// Need to update existing entry
		$time_enabled = $result->fetch_row();
		$u_str = "";
		foreach ($times as $time) {
			$now = strtotime($curr_date.' '.$time);
			if ($now >= $start && $now < $end) {
			   $time_enabled[] = 1;
			   print $time;
			   $u_str .= "`$time`=1,";
			}
		}
		print $u_str;
		$u_str = rtrim($u_str, ",");
		$result = $db->query("UPDATE availability SET $u_str WHERE `date`='".$curr_date."'");
		if (!$result) {
			header($_SERVER["SERVER_PROTOCOL"]." 500 Server Error");
			return;
		}
	}	
	return;
}
header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
return;

?>