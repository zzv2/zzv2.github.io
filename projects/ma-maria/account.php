<?php
include 'header.php';
require_auth();
$result = $db->query("SELECT * from requests INNER JOIN providers on provider_id=providers.id WHERE customer_id=".get_session_user());
$user = get_user();
?>
<div class="content-fixed" id="info">
	<div class="row">
		<?php
		if(isset($_GET['m'])) {
			if($_GET['m'] == 1) {
		?>
				<div class="alert">Profile updated succesfully.</div>
		<?php
			} else if($_GET['m'] == 2) {
		?>
				<div class="alert error">Image filesize is too large. Please select a diferent image.</div>
		<?php
			} else if($_GET['m'] == 3) {
		?>
				<div class="alert error">Invalid image file. Please select a diferent image.</div>
		<?php
			} else if($_GET['m'] == 4) {
		?>
				<div class="alert error">Error occured. Please try again.</div>
		<?php
			} else if($_GET['m'] == 5) {
		?>
				<div class="alert error">Passwords do not match. Please try again.</div>
		<?php
			} else if($_GET['m'] == 6) {
		?>
				<div class="alert error">Please enter complete address.</div>
		<?php
			} 
		}
		?>
		<h1>Account</h1>
		<div class="content-fixed">
			<p>Update your personal information and profile image</p>
			<div class="row row-padding">
				<div class="column column-4">
					<img style="width: 270px;" src="<?php print $user['picture']; ?>"/>
				</div>
				<div class="column column-8">
					<form action="api/profile.php" method="post" enctype="multipart/form-data"> 
					  	<div class="row">						  	
					    	<label>
								<span>Name</span>
						    </label>
					    	<input type="text" id="name" name="name" value="<?php print $user['name']; ?>"/>
					    	<label>
								<span>Phone</span>
						    </label>
					    	<input type="text" id="phone" name="phone" value="<?php print $user['phone']; ?>"/>
					    	<?php if($user['type'] == 'provider') { ?>
							<label>
								<span>Address</span>
						    </label>
					    	<div class="row">
								<div class="row">
									<div class="column column-12">
										<label>
										</label>
								 		<input id="address-line1" type="text" placeholder="Line 1" value="<?php print $user['address-line1']; ?>" name="address-line1"/>
									</div>						    	
								</div>
							</div>
							<div class="row">
								<div class="row">
									<div class="column column-12">
										<input id="address-line2" type="text" placeholder="Line 2" value="<?php print $user['address-line2']; ?>" name="address-line2"/>
									</div>						    	
								</div>
							</div>
							<div class="row">
								<div class="column column-7">
									<input id="city" type="text" placeholder="City" value="<?php print $user['city']; ?>" name="city"/>
								</div>	
								<div class="column column-2">
									<input id="state" type="text" placeholder="State" value="<?php print $user['state']; ?>" name="state"/>
								</div>	
								<div class="column column-3">
									<input id="zipcode" type="text" placeholder="Zipcode" value="<?php print $user['zipcode']; ?>" name="zipcode"/>
								</div>						    	
							</div>
							<?php } ?>
							<label>
								<span>Password</span>
						    </label>
					    	<input type="password" id="password" name="password"/>
							<label>
								<span>Confirm Password</span>
						  	</label>
						    <input type="password" id="password2" name="password2"/>
						    <label>
						  		<span>Profile Image</span>
				  			</label>
						    <input type="file" id="upload" name="file"/>
			    		</div> 
					  <div class="row"> 
					    <button class="btn" type="submit">Update</button>
					  </div> 
					</form>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>
