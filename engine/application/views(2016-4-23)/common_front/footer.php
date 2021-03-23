	<div class="clearfix"></div>
	<!--Display quick Facts-->
	<section class="dark-bg partners-list">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="heading">
						<h1>Our Partners</h1>
					</div>
				</div>
				<div class="clearfix"></div>
				<ul id="course-slide">
					<?php
						for ($i=0; $i < 6; $i++) {
					?>
					<li><img src="<?php echo base_url();?>gears/front/images/partner<?php echo $i ?>.png " alt="partner"></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</section>
	<!--/Footer info section-->
	<section class="footer-address">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-md-push-4">
					<div class="heading-left">
						<h1>Our Gallery</h1>
					</div>
					<ul class="list-inline gallery-footer">
						<?php
							for ($i=0; $i < 3; $i++) {
						?>
						<li>
							<a href="" title="custom"><img src="<?php echo base_url();?>gears/front/images/course-thumb0.jpg" class="img-responsive" alt="gal0"></a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-sm-6 col-md-4 col-md-pull-4">
					<div class="heading-left">
						<h1>About Us</h1>
					</div>
					<p>Sikshya is not just something that helps us grow in our academic career but a blend of something which also teaches the best way to utilise what is around. One of those ways is bought forward by SmartSikshya. SmartSikshya is born with a belief of bringing the smart revolution in educational/ learning practises.  Young, dynamic and people with this same believe came together to make it possible.. <a href="">More</a></p>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="heading-left">
						<h1>Contact Us</h1>
					</div>
					<address>
						<i class="fa fa-map-marker"></i> Road Name, Chowk Name, Place Name Kathmandu <br>
						<i class="fa fa-envelope"></i> <a href="mailto:info@smartsikshya.com" title="mailus">info@smartsikshya.com</a> / <a href="mailto:support@thewebomaticsolutions.com" title="mailus">support@smartsikshya.com</a> <br>
						<i class="fa fa-phone"></i> <a href="tel:014366383" title="call us">(+977) 1 - 4 - 366 - 383</a>
					</address>
					<ul class="list-inline  social-icons">
		                <li class="col-md-12"><small>our social links</small></li>
		                <?php
		                    $socials = array('facebook','twitter','linkedin','youtube' );
		                    for ($i=0;$i<count($socials);$i++){
		                ?>
		                <li>
		                    <a href="" target="_blank" title="<?php echo $socials[$i] ?>"><i class="fa fa-<?php echo $socials[$i] ?>"></i></a>
		                </li>
		                <?php } ?>
		            </ul>
				</div>
			</div>
		</div>
	</section>
	<!--/copyright section-->
	<footer>
		<div class="container">
			<p class="text-center">&copy; copyright <?php echo date("Y"); ?> SmartSikshya, All Rights Reserved.</p>
		</div>
	</footer>

	<!--OFFSCREEN FOR LOGIN-->
	<!--offscreen div for displaying help content-->
	<div class="cd-panel from-right">
		<header class="cd-panel-header">
			<h1>SIGNUP / LOGIN</h1>
			<a href="#0" class="cd-panel-close"><i class="fa fa-times"></i></a>
		</header>
		<div class="cd-panel-container">
			<div class="cd-panel-content">
			  <div class="row">
			    <div class="col-sm-8">
			    	<!--/login div-->
			    	<div class="login_div">
						<h2>Members Login Here</h2>
						<a href="" class="btn btn-primary btn-block">Login with facebook <i class="fa fa-facebook"></i></a>
						<form action="">
							<div class="form-group">
							    <label for="useremail">Email address</label>
							    <input type="email" class="form-control" id="useremail" placeholder="Email">
							</div>
							<div class="form-group">
							    <label for="userpassword">Password</label>
							    <input type="password" class="form-control" id="userpassword" placeholder="Password">
							</div>
							<div class="form-group">
								<input type="submit" value="Log in" class="btn btn-primary">
								<a href="" class="forgot_password home-forgot">Forgot Password?</a>
							</div>
						</form>
						<p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
					</div>
					<!--signup div for candidate-->
					<div class="signup_div">
						<h2>New Members Signup Here</h2>
						<a href="" class="btn btn-primary btn-block">Signup with Facebook <i class="fa fa-facebook"></i></a>
						<form>
							<div class="form-group">
							    <label for="useremail">Email address</label>
							    <input type="email" class="form-control" id="useremail" placeholder="Email">
							</div>
							<div class="form-group">
							    <label for="userpassword">Password</label>
							    <input type="password" class="form-control" id="userpassword" placeholder="Password">
							</div>
							<div class="form-group">
							    <label for="userpassword-repeat">Repeat Password</label>
							    <input type="password" class="form-control" id="userpassword-repeat" placeholder="Repeat Password">
							</div>
							<div class="form-group">
								<a class="btn btn-primary">Submit</a>
							</div>
						</form>
						<p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
					</div>
					<!--forgot password div-->
					<div class="forgot_pass">
						<h2>Forgot Your Password?</h2>
						<form>
							<div class="form-group">
							    <label for="useremail">Email address</label>
							    <input type="email" class="form-control" id="useremail" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="submit" value="Submit" class="btn btn-primary">
							</div>
						</form>
						<p>Remembered Password? <a href="" class="show_login"> Login Here</a></p>
					</div>
			    </div>
			  </div>
			</div> <!-- cd-panel-content -->
		</div> <!-- cd-panel-container -->
	</div> <!-- cd-panel -->	
	