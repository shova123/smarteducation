<?php //$this->ion_auth->get_user_id()
$loginUserDetails = $this->ion_auth->login_user_details();
$user_token = $loginUserDetails->user_token;
?>

<!-- Wrapper for Slides -->
<div class="inner-page-top dashboard-top">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
				  <li class="active">Dashboard</li>
				</ol>
				<h1>Welcome</h1>
			</div>
			<div class="col-sm-6 hidden-xs">
				<!-- <img src="assets_front/images/course-slc-head.png" alt="slc" class="img-responsive"> -->
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>