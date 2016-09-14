<!DOCTYPE html>
<?php
require_once('config.php');
require_once('includes/functions.php');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Ma-Maria <?php if(isset($active)) { echo "| $active"; } ?></title>
		<meta name="author" content="Keshav Varma">
		<meta name="description" content="Image Gallery">
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="fonts/stylesheet.css">
		<link rel="stylesheet" href="css/jquery.modal.css">
		<link rel="stylesheet" href="css/jquery.datetimepicker.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.css">
		<link rel="stylesheet" href="css/fullcalendar.css">
		<link rel="stylesheet" href="css/style.css">

		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/ui-lightness/jquery-ui.css">
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.modal.min.js"></script>
		<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>
		<script type="text/javascript" src="js/jquery.steps.min.js"></script>
		<script type="text/javascript" src="js/jquery.customSelect.min.js"></script>
		<script type="text/javascript" src="js/jquery.cycle2.min.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js"></script>
		


		<script type="text/javascript">
			Stripe.setPublishableKey("<?php echo STRIPE_PUB_KEY; ?>");        
		</script>  	
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true&amp;libraries=places"></script>
		<script src="js/script.js"></script>
		<?php if(isset($is_index)) { ?>
		<style>
			footer {
				position: relative;
				bottom: -70px;
				margin-top: 30px;
			}
		</style>
		<?php } ?>
	</head>

	<body>
	
	<div class="wrapper <?php print !isset($is_index) ? 'wrapper-enable' : '' ?>">
		<header>
			<div class="header-fixed">
				<a href="index.php"><img alt="logo" class="logo" src="css/images/logo.png"/></a>
				<?php 
					if(get_session_user() != -1 && isset($_SESSION['type']) && $_SESSION['type'] == 'provider' || isset($show_provider)) {
				?>
						<span class="logo-text">Provider Portal</span>
				<?php
					} 
				?>
				
				<div class="navigation">
					<ul>

						<?php 
							if(get_session_user() != -1) {
								$user = get_user();
								if(isset($_SESSION['type']) && $_SESSION['type'] == 'provider') {
						?>
									<img class="user-img" src="<?php print $user['picture']; ?>"/>
									<li><a href="schedule.php">Schedule</a></li>
									<li><a href="requests.php">Requests</a></li>
									<li><a href="account.php">Account</a></li>
									<li><a href="logout.php">Logout</a></li>
						<?php
								} else {
						?>
									<img class="user-img" src="<?php print $user['picture']; ?>"/>
									<li><a href="requests.php">Requests</a></li>
									<li><a href="account.php">Account</a></li>
									<li><a href="logout.php">Logout</a></li>
						<?php
								}
							} else {
						?>
							<li><a href="#register" rel="modal:open">Sign Up</a></li>
							<!-- <li class="divider">/</li> -->
							<li class="button"><a href="#login" rel="modal:open">Login</a></li>
						<?php
							}
						?>
						
					</ul>
				</div>
			</div>
		</header>

	