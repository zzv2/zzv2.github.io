<?php
$is_index = True;
include 'header.php';
?>

<div class="hero">

	<div class="text-wrapper">
		<div class="blurb">
			<img alt="logo" class="logo" src="css/images/logo.png" style="width: 300px;margin: 30px;">
			<div class="highlight">Time for spring cleaning?</div>
			<div class="detail">Get help around the house when you need it with Ma-Maria.</div>
		</div>
		<div class="request-form">
			<!-- BEGIN: Do not modify spacing as whitespace between elements introduces visual gap -->
			<input id="address" placeholder="Address" type="text" name="address" /><input id="date" placeholder="Date/Time" type="text" name="date" /><select id="hours" name="hours" class="styled">
				<option value="0" disabled="disabled">Hours</option>
				<option value="2">2 hours</option>
				<option value="3">3 hours</option>
				<option value="4">4 hours</option>
				<option value="5">5 hours</option>
				<option value="6">6 hours</option>
				<option value="7">7 hours</option>
				<option value="8">8 hours</option>
			</select><div class="arrow-down"></div><button id="request" type="submit">Request</button>
			<!-- END: Do not modify spacing as whitespace between elements introduces visual gap -->
		</div>
	</div>

	<div id="request-wizard">
		
		<h3></h3>
		<section>
			<div class="loading">
				<span class="loading"></span>
				Searching for help...
			</div>
			<div class="request-results">
				
				<div class="row step-header">
					<span class="number">1</span>
					<h3 class="header">Here are our top recommendations for your area!</h3>
				</div>

				<div class="row">
					<div class="column column-12 column-centered">
						<div class="results"></div>
					</div>
				</div>
				<div class="row">
					<!-- TODO: maybe option to select others, depends on time -->
					<!-- Or, <a href="#" class="more">show me more</a>. -->
				</div>				
			</div>
		</section>
		<h3></h3>
		<section>
			<div class="row step-header">
				<span class="number">2</span>
				<h3 class="header">Provide contact information</h3>
			</div>
			<div class="column column-6 column-centered auth <?php print (get_session_user() == -1) ? '' : 'hide' ?>">
				<div class="row text-center">
					<span style="display:block; margin: 15px;">Please login to your account below.</span>
					<form>
						<div class="row">
							<div class="column column-12">
								  <label>
									<span>Email</span>
								  </label>
								<input type="text" placeholder="" id="email" value=""/>
							</div>
						</div>
						<div class="row">
							<div class="column column-12">
								<label>
									<span>Password</span>
								</label>
								<input type="password" placeholder="" id="password"/>
							</div>
						</div>
						<div class="row text-right" style="padding: 10px;">
							<a href="#register" class="btn gray" rel="modal:open">Sign Up</a>
							<button class="btn login">Login</button>
						</div>		

					</form>
				</div>
			</div>
			<div class="row text-left info <?php print (get_session_user() == -1) ? 'hide' : '' ?>">
				<div class="column column-10 column-centered">
				<form method="POST">
					<div class="row">
						<div class="column column-centered">
							<div class="row">
								<div class="column column-4">
									<div class="row">
										<div class="column column-12">
											  <label>
												<span>Name</span>
											  </label>
											<input type="text" placeholder="" name="name" value="<?php print (get_session_user() != -1) ? $_SESSION['name'] : '' ?>"/>
										</div>
									</div>
									<div class="row">
										<div class="column column-12">
											<label>
												<span>Phone Number</span>
											</label>
											<input id="phone" type="text" placeholder="" name="phone" value="<?php print (get_session_user() != -1) ? $_SESSION['phone'] : '' ?>"/>
										</div>
									</div>
								</div>
								<div class="column column-8">
									<div class="row">
										<div class="row">
											<div class="column column-12">
												<label>
													<span>Address</span>
												</label>
										 		<input id="address-line1" type="text" placeholder="Line 1" disabled="disabled" name="address-line1"/>
											</div>						    	
										</div>
									</div>
									<div class="row">
										<div class="row">
											<div class="column column-12">
												<input id="address-line2" type="text" placeholder="Line 2" name="address-line2"/>
											</div>						    	
										</div>
									</div>
									<div class="row">
										<div class="column column-7">
											<input id="city" type="text" disabled="disabled" placeholder="City" name="city"/>
										</div>	
										<div class="column column-2">
											<input id="state" type="text" disabled="disabled" placeholder="State" name="state"/>
										</div>	
										<div class="column column-3">
											<input id="zipcode" type="text" disabled="disabled" placeholder="Zipcode" name="zipcode"/>
										</div>						    	
									</div>
								</div>
							</div>
							<div class="row">
								<div class="column column-centered">
									<div class="row">
										<div class="column column-12">
										  	<label>
												<span>Additional Comments</span>
										  	</label>
											<textarea style="width: 100%; height: 90px;" name="comments" placeholder="Optional note to include with your request."></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
			
			<div class="row btn-row text-right">
				<button class="btn gray cancel">Cancel</button>
				<button class="btn validate-address">Next</button>
			</div>		

		</section>
		<h3></h3>
		<section>
			<div class="row step-header">
				<span class="number">3</span>
				<h3 class="header">Confirm and pay</h3>
			</div>

			<div class="row text-left payment-details">
				<form method="POST" id="payment-form">
					<div class="row">
						<div class="column column-centered">
							<div class="row">
								<div class="column column-4">
								  <label>
									<span>Card Number</span>
									<input type="text" placeholder="" data-stripe="number" value="4242424242424242"/>
								  </label>
								</div>
								<div class="column column-1">
								  <label>
									<span>CVC</span>
									<input type="text" data-stripe="cvc" value="123"/>
								  </label>
								</div>
								<div class="column column-4 input-expiration">
								  <label>
									<span>Expiration (MM/YY)</span>
								  </label>

									<div></div>
									<input type="text" class="exp-month" data-stripe="exp-month" value="12"/><input type="text" class="exp-year" data-stripe="exp-year" value="16"/>
								</div>
							</div>
							<div class="row payment-errors">Errors:</div>
						</div>
					</div>
				</form>
			</div>

			<div class="row btn-row text-right">
				<button class="btn gray cancel">Cancel</button>
				<button class="btn pay">Pay and Confirm</button>
			</div>

		</section>
	</div>

	<div id="request-wizard-confirmation">
		Confirmed
	</div>
	<div class="hero-footer row">
		<a href="#info">Learn more</a><i class="fa fa-angle-down"></i>
	</div>

</div>

<div class="content-fixed" id="info">
	<div class="row">
		Our client will be inserting an infographic here.
	</div>
</div>
<?php
include 'footer.php';
?>
