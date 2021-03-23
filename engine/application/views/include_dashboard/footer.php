<?php $active[$current] = "active";?>
	<div class="clearfix"></div>
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

	