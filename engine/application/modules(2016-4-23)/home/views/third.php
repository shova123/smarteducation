<?php include_once ('includes/head_front.php') ?>
<?php include_once ('includes/header_front.php') ?>
<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
				  <li><a href="second.php">SLC Materials</a></li>
				  <li class="active">English</li>
				</ol>
				<h1>English</h1>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs">
		<div class="col-sm-4 col-md-3">
			<div class="sidebar-detail">
				<div class="heading-left">
					<h1><small>Lesson Outline</small></h1>
				</div>
				<ul class="list-unstyled">
					<?php for ($i=0; $i < 10; $i++) {?>
					<li>Chapter Number <?php echo $i ?></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col-sm-8 col-md-9 course-list-content">
			<div class="question">
				<div class="heading-left">
					<h1>Introduction Title is Here</h1>
				</div>
				<p>small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<a class="btn btn-primary">Check Button &rarr;</a>
				<?php for ($i=0; $i < 4; $i++) {?>
				<div class="radio">
				  <label>
				    <input type="radio" name="optionsRadios" id="optionsRadios<?php echo $i ?>" value="option1" checked>
				    Answer choice is here <?php echo $i ?>
				  </label>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php include_once ('includes/footer_front.php') ?>
