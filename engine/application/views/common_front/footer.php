<?php

$this->load->library('facebook');
$login_url = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('signin/facebooklogin'), 
                'scope' => array("email,first_name,last_name,user_photos") // permissions here
            ));


?>


<div class="clearfix"></div>
	<!--Display quick Facts-->
<!--	<section class="dark-bg partners-list">
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
	</section>-->
	<!--/Footer info section-->
	<section class="footer-address">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-md-push-4">
					<div class="heading-left">
						<h1>our social links</h1>
					</div>
					<ul class="list-inline  social-icons">
		                
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
                            <?php     $this->db->select('*')->where("page_type",'subpage');
                            $home_aboutus=$this->db->get('static_pages')->row();
                            if(!empty($home_aboutus)) :
                                $slug=$home_aboutus->page_slug;
                            ?>
                            
				<div class="col-sm-6 col-md-4 col-md-pull-4">
					<div class="heading-left">
						<h1><?php echo $home_aboutus->page_title;?></h1>
					</div>
					     <?php echo substr($home_aboutus->content, 0, 100);?>.. <a href="<?php echo base_url("$slug");?>">More</a></p>
				</div>
                            <?php endif;?>
				<div class="col-md-4 col-sm-6">
					<div class="heading-left">
						<h1>Contact Us</h1>
					</div>
                                        <?php $contact=$this->db->select('*')->get('contact_us')->row(); ?>
					<address>
						<i class="fa fa-map-marker"></i><?php if(!empty($contact)) echo $contact->address;?>  <br>
						<i class="fa fa-envelope"></i> <a href="mailto:<?php if(!empty($contact)) echo $contact->email;?>" title="mailus"><?php if(!empty($contact)) echo $contact->email;?></a> / <a href="mailto:support@smartsikshya.com" title="mailus">support@smartsikshya.com</a> <br>
						<i class="fa fa-phone"></i> <a href="tel:<?php if(!empty($contact)) echo $contact->phone;?>" title="call us"><?php if(!empty($contact)) echo $contact->phone;?></a>
					</address>
					
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
                                               
						<!--<a href="" class="btn btn-primary btn-block">Login with facebook <i class="fa fa-facebook"></i></a>-->
                                                <!--<a href="<?php echo base_url("linkedin_signup/initiate");?>" class="btn btn-primary linked-login"><i class="fa fa-linkedin"></i> Signup With LinkedIn</a>-->
						<form action="<?php echo base_url('signin/login'); ?>" method="post" id="formFront" class="formFront form-validate" name="formFront" accept-charset="utf-8">
							<div class="form-group">
							    <label for="useremail">Email address</label>
							    <input type="text" class="form-control" name='identity' id="identity" placeholder="Email:" data-rule-required="true" data-rule-email="true">
							</div>
							<div class="form-group">
							    <label for="userpassword">Password</label>
							    <input type="password" name="password" id="password" value="" placeholder="Password" class='form-control' data-rule-required="true">
							</div>
                                                        <div class="form-group remember" style="margin-left:15px;">
                                                            <input type="checkbox" name="remember" value="1" id="remember"/>    
                                                            <label for="remember" class="side-label">Remember me</label>
                                                        </div>
							<div class="form-group">
								<input type="submit" name="submit" value="Log in" class="btn btn-primary">
								<a href="" class="forgot_password home-forgot">Forgot Password?</a>
							</div>
						</form>
						<p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
					</div>
					<!--signup div for candidate-->
					<div class="signup_div">
						<h2>New Members Signup Here</h2>
                                                 <a href="https://graph.facebook.com/oauth/authorize?client_id=816999125058531&redirect_uri=<?php echo base_url('signin/facebooklogin');?>&scope=public_profile,email,user_birthday,user_hometown" class="btn btn-primary btn-block">Signup with Facebook <i class="fa fa-facebook"></i></a>						

						<!--<a href="" class="btn btn-primary btn-block">Signup with Facebook <i class="fa fa-facebook"></i></a>-->
                                                <!--<a href="<?php echo base_url("linkedin_signup/initiate");?>" class="btn btn-primary linked-login"><i class="fa fa-linkedin"></i> Signup With LinkedIn</a>-->
						<form action="<?php echo base_url('users/register'); ?>" method="POST" id="formFrontSignup" class="formFrontSignup form-validate" name="formFrontSignup" accept-charset="utf-8">
                                                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                                                    <?php
                                                    $this->db->select("*");
                                                    $this->db->like("group_type", 'user');
                                                    $this->db->like("name", 'student');
//                                                    $this->db->or_like("name", 'candidate');
                                                    $queryGroup = $this->db->get("groups");
                                                    $resultGroup = $queryGroup->row();

                                                    if (!empty($resultGroup)) {
                                                        $group_id = $resultGroup->group_id;
                                                        $group_name = $resultGroup->name;
                                                        ?>
                                                        <input type="hidden" name="groups[]" value="<?php echo $group_id; ?>" checked/>
                                                    <?php } ?>
                                                   
                                                        <div class="form-group">
                                                            <label for="useremail" class="sr-only">Email address</label>
                                                            <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email" data-rule-email="true" data-rule-required="true" /><!--data-rule-checkExists="true"/>-->
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username" class="sr-only">Full Name</label>
                                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="First Name | Last Name" data-rule-required="true" data-rule-extendfullname="true"><!--data-rule-lettersonly="true"-->
                                                            <!--<input type="hidden" name="username" class="form-control" id="username" placeholder="UserName">-->
                                                        </div>
<!--							<div class="form-group">
							    <label for="userpassword">Password</label>
							    <input type="password" class="form-control" id="userpassword" placeholder="Password">
							</div>
							<div class="form-group">
							    <label for="userpassword-repeat">Repeat Password</label>
							    <input type="password" class="form-control" id="userpassword-repeat" placeholder="Repeat Password">
							</div>-->
							<div class="form-group">
                                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
								<!--<a class="btn btn-primary">Submit</a>-->
							</div>
						</form>
						<p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
					</div>
					<!--forgot password div-->
					<div class="forgot_pass">
						<h2>Forgot Your Password?</h2>
						
                                                <form action="<?php echo base_url('signin/forgot_password'); ?>" method="post" id="forget-form" class="form-validate" accept-charset="utf-8">
                                                    <div class="form-group">
                                                        <label for="useremail" class="sr-only">Email address</label>
                                                        <input type="text" name='email' id="email" value="" placeholder="Email" class='form-control' data-rule-required="true" data-rule-email="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="submit" class="sr-only">submit</label>
                                                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                                    </div>
                                                </form>
						<p>Remembered Password? <a href="" class="show_login"> Login Here</a></p>
					</div>
			    </div>
			  </div>
			</div> <!-- cd-panel-content -->
		</div> <!-- cd-panel-container -->
	</div> <!-- cd-panel -->	
	