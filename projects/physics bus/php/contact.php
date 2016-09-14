<!DOCTYPE html>

<html>
<head>
	<meta http-equiv= "Content-Type" content= "text/html; charset=utf-8">
	<title>Contact</title>
	<link type= "text/css" rel= "stylesheet" href= "../css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:700%7CJulius+Sans+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	</head>
	<body>

	<?php 

		$page_title="Contact";

include 'header.php'; 

		$first_name= "";
		$last_name="";
		$email= "";
		$phone="";
		$comments= "";
	

		$firsterror="";
		$lasterror="";
		$emailerror="";
		$phonerror="";
		$commenterror="";

		$alert="";


		if (isset($_POST['submit'])){
			$first_name= htmlspecialchars($_POST['first_name']);
			$last_name= htmlspecialchars($_POST['last_name']);
			$email= ($_POST['email']);
			$comments= htmlspecialchars($_POST['comments']);


			if (empty($first_name)){
				$firsterror= "<div class= 'errors'> First Name is Missing</div>";
			}
			if(empty($last_name)){
				$lasterror= "<div class= 'errors'> Last Name is Missing</div>";
			}

			if(empty($email)){
				$emailerror= "<div class= 'errors'> Email is Missing</div>";
			}

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailerror= "<div class= 'errors'> Not a valid email address</div>";
			}

			if($phone= ""){
				$phonerror= "<div class= 'errors'> Phone Number is Missing</div>";
			}

			if($phone != "" && !preg_match("/^\d\d\d\d\d\d\d\d\d\d$/", $phone)){
				$phonerror= "<div class= 'errors'> Not a valid phone number</div>"; 
			}

			if(empty($comments)){
				$commenterror= "<div class= 'errors'> No comments entered</div>";
			}

			if(empty($firsterror) && empty($lasterror) && empty($emailerror) && empty($phonerror) && empty($commenterror)){
				$alert= "<h4 class= 'alert_msg'> Thank you for your submission!</h4>";
				$first_name="";
				$last_name= "";
				$email= "";
				$phone="";
				$comments= "";
			}else{
				$alert= "<h4 class= 'alert_msg'> Please correct the following errors</h4>";
			}

		}


		?>

	<div class= "wrapper">

	<div class= "ultimate_cont_wrap">

	<h2 class= "conthead"> Have a Question? Let Us Know!</h2>
	<?php echo $alert ?>

	<div class= "contact_wrap">

	<form action= "contact.php" method= "post">

		<div class= "contact_item">
		
		<label class= "labs" for="first">First Name</label>
		<input id="first" class= "input_align" type= "text" name= "first_name" required value= "<?php echo $first_name ?>"/>
		<?php echo $firsterror ?>
		</div>

		<div class= "contact_item">
		
		<label class= "labs" for= "last">Last Name </label>
		<input id="last" class= "input_align" type= "text" name= "last_name" required value= "<?php echo $last_name ?>"/>
		<?php echo $lasterror ?>
		</div>

		<div class= "contact_item">
		
		<label class= "labs" for= "email"> E-mail</label>
		<input id="email" class= "input_align" type= "email" name= "email" required value= "<?php echo $email ?>"/>
		<?php echo $emailerror ?>
		</div>


		<div class= "contact_item">
		<label class= "labs" for= "phone"> Phone </label>
		<input id= "phone" class= "input_align" type= "tel" pattern= "\d\d\d\d\d\d\d\d\d\d" placeholder= "1234567891" value= "<?php echo $phone ?>"/>
		<?php echo $phonerror ?>
		</div>


		<div class= "contact_item">
		
		<label class= "labs" for= "comments"> Comments </label>
		<textarea id= "comments" rows= "4" cols= "70" name= "comments" required placeholder= "Enter your comments here."><?php echo $comments; ?></textarea>
		<?php echo $commenterror ?>
		</div>

		<div class= "contact_item">
		 Would you like to subscribe to our newsletter?<br>
		<label> <input type= "radio" name= "response" reuqired value= "Yes"/>Yes</label>
		<label> <input type= "radio" name= "response" value= "No"/>No</label>
		</div>

		<div class= "contact_item">

		Want to volunteer? Click <a href= "https://docs.google.com/forms/d/1j6qmtxtCvCywNUAJX8LURuEaWpye-q0BVVCrdqAwRJ8/viewform?edit_requested=true" target="_blank">here </a>
		</div>

		<div class= "button">
			<button type= "submit" name= "submit">Submit</button>
		</div>

	</form>

	</div>

	<div id= "contact_pic">
	<img src= "../images/bubbles.jpg" alt= "Giant Bubbles and the Bus!">
	</div>



</div>

</div>





	<?php include 'footer.php' ?>

	</body>
</html>