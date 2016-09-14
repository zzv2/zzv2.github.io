<?php
include 'header.php';
require_auth();

$times = array("11:00 PM", "10:45 PM", "10:30 PM", "10:15 PM", "10:00 PM", "9:45 PM", "9:30 PM", "9:15 PM", "9:00 PM", "8:45 PM", "8:30 PM", "8:15 PM", "8:00 PM", "7:45 PM", "7:30 PM", "7:15 PM", "7:00 PM", "6:45 PM", "6:30 PM", "6:15 PM", "6:00 PM", "5:45 PM", "5:30 PM", "5:15 PM", "5:00 PM", "4:45 PM", "4:30 PM", "4:15 PM", "4:00 PM", "3:45 PM", "3:30 PM", "3:15 PM", "3:00 PM", "2:45 PM", "2:30 PM", "2:15 PM", "2:00 PM", "1:45 PM", "1:30 PM", "1:15 PM", "1:00 PM", "12:45 PM", "12:30 PM", "12:15 PM", "12:00 PM", "11:45 AM", "11:30 AM", "11:15 AM", "11:00 AM", "10:45 AM", "10:30 AM", "10:15 AM", "10:00 AM", "9:45 AM", "9:30 AM", "9:15 AM", "9:00 AM", "8:45 AM", "8:30 AM", "8:15 AM", "8:00 AM", "7:45 AM", "7:30 AM", "7:15 AM", "7:00 AM", "6:45 AM", "6:30 AM", "6:15 AM", "6:00 AM");
$times = array_reverse($times);

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$q = "SELECT `date`, `6:00 AM`, `6:15 AM`, `6:30 AM`, `6:45 AM`, `7:00 AM`, `7:15 AM`, `7:30 AM`, `7:45 AM`, `8:00 AM`, `8:15 AM`, `8:30 AM`, `8:45 AM`, `9:00 AM`, `9:15 AM`, `9:30 AM`, `9:45 AM`, `10:00 AM`, `10:15 AM`, `10:30 AM`, `10:45 AM`, `11:00 AM`, `11:15 AM`, `11:30 AM`, `11:45 AM`, `12:00 PM`, `12:15 PM`, `12:30 PM`, `12:45 PM`, `1:00 PM`, `1:15 PM`, `1:30 PM`, `1:45 PM`, `2:00 PM`, `2:15 PM`, `2:30 PM`, `2:45 PM`, `3:00 PM`, `3:15 PM`, `3:30 PM`, `3:45 PM`, `4:00 PM`, `4:15 PM`, `4:30 PM`, `4:45 PM`, `5:00 PM`, `5:15 PM`, `5:30 PM`, `5:45 PM`, `6:00 PM`, `6:15 PM`, `6:30 PM`, `6:45 PM`, `7:00 PM`, `7:15 PM`, `7:30 PM`, `7:45 PM`, `8:00 PM`, `8:15 PM`, `8:30 PM`, `8:45 PM`, `9:00 PM`, `9:15 PM`, `9:30 PM`, `9:45 PM`, `10:00 PM`, `10:15 PM`, `10:30 PM`, `10:45 PM`, `11:00 PM` FROM availability WHERE provider_id=".$user['id'];
$result = $db->query($q);
$events = array();

while($row = $result->fetch_assoc()) {
	// add events for days
	$date = $row['date'];

	$stime = "";
	$etime = "";
	$s = false;

	$time_new = array_slice($row, 1);
	foreach($time_new as $t=>$i) {
		if($i == 1) {
			// If start of distinct event
			if(!$s) {
				$s = true;
				$stime = $t;
			} else {
				$etime = $t;
			}
		} else {
			// Event boundary
			$etime = $t;
			if($s) {
	 			array_push($events, array("start" => $stime, "end" => $etime, "date" => $date));
			}
			$s = false;
		}
	}
	if ($s) {
		array_push($events, array("start" => $stime, "end" => $etime, "date" => $date));
	}
}
?>
<div class="content-fixed" id="info">
	<div class="row">
		<h1>Schedule</h1>
		<div class="content-fixed">
			<p>Update your availability below. Click to add a new appointment slot and double-click to remove an appointment slot.</p>
		</div>
		<div id="calendar"></div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var events = JSON.parse('<?php echo json_encode($events); ?>');
		events.forEach(function(v) {
			console.log(v);
			var myEvent = {
				title:"Available",
				allDay: false,
				start: moment(v.date + " " + v.start, "YYYY-MM-DD hh:mm A"),
				end: moment(v.date + " " + v.end, "YYYY-MM-DD hh:mm A")
			};
			console.log(myEvent);
			$('#calendar').fullCalendar('renderEvent', myEvent);
		})
	});
	
	
</script>
<?php
include 'footer.php';
?>
