<?php
include 'header.php';
require_auth();

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user = get_user();

function update_status($token, $status) {
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$q = "UPDATE requests SET status=".$status." WHERE token='".$token."'";
	$result = $db->query($q);

	$user = get_user();
	if($user['type'] == "provider") {
		$result = $db->query("SELECT * from requests INNER JOIN customers on customer_id=customers.id WHERE token='".$token."'");
	} else {
		$result = $db->query("SELECT * from requests INNER JOIN providers on provider_id=providers.id WHERE token='".$token."'");
	}
	$row = $result->fetch_assoc();
	return $row;
}

function get_status_text($status) {
	if($status == 1) {
		return "Pending";
	} else if($status == 2) {
		return "Accepted";
	} else if($status == 3) {
		return "Rejected";
	} else if($status == 4) {
		return "Canceled";
	} else if($status == 5) {
		return "Completed";
	} else if($status == 6) {
		return "Paid";
	}
}

if(isset($_GET['token']) && isset($_GET['action'])) {
	if($_GET['action'] == 'accept') {
		$row = update_status($_GET['token'], 2);
		$_SESSION['message_status'] = 2;
	} else if($_GET['action'] == 'deny') {
		$row = update_status($_GET['token'], 3);
		$_SESSION['message_status'] = 3;
	} else if($_GET['action'] == 'completed') {
		$row = update_status($_GET['token'], 5);
		$_SESSION['message_status'] = 5;
	} else if($_GET['action'] == 'cancel') {
		$row = update_status($_GET['token'], 4);
		$_SESSION['message_status'] = 4;
	} else if($_GET['action'] == 'pay') {
		$row = update_status($_GET['token'], 6);
		$_SESSION['message_status'] = 6;
	}
	$_SESSION['message'] = $row;
	header("Location: requests.php");
	exit();
}

?>
<div class="content-fixed" id="info">
	<div class="row">
		<?php
		if(isset($_SESSION['message_status'])) {
			$row = $_SESSION['message'];
			if($_SESSION['message_status'] == 2) {
		?>
				<div class="alert">Accepted request for <?php echo $row['name']; ?> on <?php echo date( 'M d, Y g:iA', strtotime($row['start_time'])); ?></div>
		<?php
			} else if($_SESSION['message_status'] == 3) {
		?>
				<div class="alert error">Denied request for <?php echo $row['name']; ?> on <?php echo date( 'M d, Y g:iA', strtotime($row['start_time'])); ?></div>
		<?php
			} else if($_SESSION['message_status'] == 5) {
		?>
				<div class="alert">Completed request for <?php echo $row['name']; ?> on <?php echo date( 'M d, Y g:iA', strtotime($row['start_time'])); ?></div>
		<?php
			} else if($_SESSION['message_status'] == 4) {
		?>
				<div class="alert error">Cancelled request for <?php echo $row['name']; ?> on <?php echo date( 'M d, Y g:iA', strtotime($row['start_time'])); ?></div>
		<?php
			} else if($_SESSION['message_status'] == 6) {
		?>
				<div class="alert">Confirmed service for <?php echo $row['name']; ?> on <?php echo date( 'M d, Y g:iA', strtotime($row['start_time'])); ?></div>
		<?php
			} 
			unset($_SESSION['message_status']);
		}

		if($user['type'] == "provider") {
			$result = $db->query("SELECT * from requests INNER JOIN customers on customer_id=customers.id WHERE provider_id=".get_session_user()." ORDER BY status");
		} else {
			$result = $db->query("SELECT * from requests INNER JOIN providers on provider_id=providers.id WHERE customer_id=".get_session_user()." ORDER BY status");
		}
		?>
		<h1>Requests</h1>
		<div class="content-fixed">
			<p>Here's an overview of your past and pending requests.</p>
			<table border=1>
				<thead>
					<tr>
						<td colspan=5>Requests</td>
					</tr>
				</thead>
				<tbody>
				<?php
				while($row = $result->fetch_assoc()) {
					$phpdate = strtotime( $row['start_time'] );
					$human_date = date( 'M d, Y g:iA', $phpdate );

					echo "<tr class='request-row'>";
					// Image
					echo "<td style='width: 10%;'><img class='user-pic' src='{$row['picture']}'></img></td>";
					// Name and date
					echo "<td style='width: 25%'><div class='row'><span class='name'>{$row['name']}</span></div><div class='row'>{$human_date}</div></td>";
					// Comments/address
					echo "<td style='width: 35%;'>{$row['comments']}</td>";
					// Status
					echo "<td style='width: 10%;'>".get_status_text($row['status'])."</td>";
					// Buttons for cancel and accept/deny/pay
					echo "<td class='options' style='width: 20%;'><div class='row hover-hide'>";
					if($user['type'] == 'provider') {
						if($row['status'] == 1) {
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=accept'>Accept</a></div>";
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=deny'>Deny</a></div>";
						} else if($row['status'] == 2) {
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=completed'>Mark as completed</a></div>";
						}
					} else {
						if($row['status'] == 1) {
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=cancel'>Cancel</a></div>";
						} else if($row['status'] == 5) {
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=pay'>Confirm service</a></div>";							
						} else if($row['status'] == 6) {
							echo "<div class='row'><a href='requests.php?token={$row['token']}&action=review'>Review</a></div>";
						}
					}
					echo "</div></td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>	
</div>
<?php
include 'footer.php';
?>
