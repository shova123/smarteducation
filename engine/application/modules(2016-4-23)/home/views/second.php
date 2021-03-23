<?php include_once ('includes/head_front.php') ?>
<?php include_once ('includes/header_front.php') ?>
<!-- Wrapper for Slides -->
<div class="inner-page-top slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
				  <li class="active">Slc materials</li>
				</ol>
				<h1>SLC</h1>
			</div>
			<div class="col-sm-6 hidden-xs">
				<img src="assets_front/images/course-slc-head.png" alt="slc" class="img-responsive">
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!--course list intro with sidebar affix-->
<div class="container">
	<div class="row course-list-tabs">
		<div class="col-sm-4 col-md-3">
			<div class="sidebar affix">
				<div class="heading-left">
					<h1><small>Search Materials by</small></h1>
				</div>
				<div class="search-box">
					<div class="form-group">
						<label for="text" class="sr-only">by keywords</label>
						<input type="text" id="text" placeholder="text input" class="form-control">
					</div>
					<div class="form-group">
						<label class="sr-only">by dropdown</label>
						<select class="form-control">
							<option selected="selected">-- Choose Dropdown Option --</option>
							<option value="opt1">Option one</option>
							<option value="opt2">Option two</option>
							<option value="opt3">Option three</option>
						</select>
					</div>
					<div class="form-group">
						<div class="checkbox">
						    <label>
						      <input type="checkbox"> Choose This
						    </label>
						</div>
						<div class="checkbox">
						    <label>
						      <input type="checkbox"> Maybe This
						    </label>
						</div>
						<div class="checkbox">
						    <label>
						      <input type="checkbox"> Even This
						    </label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-md-9 course-list-content">
			<div class="heading-left">
				<h1>Get Access to the SLC Materials</h1>
			</div>
			<p>small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<div class="tab-content">
				<!--START of tabs -->
				<div class="tabs">
					<!--TAB MENU-->
					<ul class="nav nav-tabs sidebar-tabs" id="sidebar" role="tablist">
						<li class="active"><a href="#tab-1" role="tab" data-toggle="tab">Model Question</a></li>
						<li><a href="#tab-2" role="tab" data-toggle="tab">Past Questions</a></li>
						<li><a href="#tab-3" role="tab" data-toggle="tab">Practice Sets</a></li>
					</ul>
					<!-- Tab CONTENTS -->
					<div class="tab-content">
						<!--1 Tab content-->
						<div class="tab-pane active" id="tab-1">
							<p class="lead">Demo of double columns listing of subject notes demo</p>
							<div class="row">
								<div class="col-sm-6">
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics (20)</a></li>
										<li><a href="chapter.php">English (47)</a></li>
										<li><a href="chapter.php">Nepali (64)</a></li>
										<?php } ?>
									</ul>	
								</div>
								<div class="col-sm-6">
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics <span class="badge">20</span></a></li>
										<li><a href="chapter.php">English <span class="badge">13</span></a></li>
										<li><a href="chapter.php">Nepali <span class="badge">6</span></a></li>
										<?php } ?>
									</ul>	
								</div>
							</div>
						</div>
						<!--2 Tab content-->
						<div class="tab-pane" id="tab-2">
							<p class="lead">Demo of Triple columns listing of subject notes demo</p>
							<div class="row">
								<?php for ($loop=0; $loop < 3; $loop++) { ?>
								<div class="col-sm-4">
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics <small>-12</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
										<?php } ?>
									</ul>	
								</div>
								<?php } ?>
							</div>
						</div>
						<!--3 Tab Content-->
						<div class="tab-pane" id="tab-3">
							<p class="lead">Demo of Single columns listing of subject longer name demo</p>
							<div class="row">
								<div class="col-sm-4">
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics 50 Sets Practice <small>-12</small></a></li>
										<li><a href="chapter.php">English 23 Sets Practice <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali 05 sets practice <small>-45</small></a></li>
										<?php } ?>
									</ul>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/tabs-->
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php include_once ('includes/footer_front.php') ?>
