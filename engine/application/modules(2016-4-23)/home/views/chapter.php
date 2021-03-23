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
				  <li><a href="third.php">English</a></li>
				  <li class="active">Chapter 1</li>
				</ol>
				<h1>English Chapter Name</h1>
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
					<li><a href="third.php">Chapter Number <?php echo $i ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col-sm-8 col-md-9 course-content">
			<!-- Individual Questions -->
			<div class="question panel panel-default">
				<div class="panel-body">
					<ul class="list-inline outline-course">
						<li>S.N. 1</li>
						<li><i class="fa fa-calendar"></i> 2014</li>
						<li>set <strong>A</strong></li>
						<li>Marks: <strong>5</strong></li>
						<li class="label label-primary">Theory Question</li>
					</ul>
					<p>small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<ul class="list-inline row">
						<?php for ($i=0; $i < 4; $i++) {?>
						<li class="col-sm-6 label label-default">
							Answer Number One
						</li>
						<?php } ?>
					</ul>
					<a class="btn btn-primary"> Mark &#10003;</a>
				</div>
			</div>
			<!-- Practical Question -->
			<div class="question panel panel-default">
				<div class="panel-body">
					<ul class="list-inline outline-course">
						<li>S.N. 1</li>
						<li><i class="fa fa-calendar"></i> 2014</li>
						<li>set <strong>A</strong></li>
						<li>Marks: <strong>5</strong></li>
						<li class="label label-info">practical Question</li>
					</ul>
					<p class="lead">small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor</p>
					<p>small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>
			</div>
			<!-- pagination -->
			<nav>
			  <ul class="pager">
			    <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Previous</a></li>
    			<li class="next"><a href="#">Next <span aria-hidden="true">&rarr;</span></a></li>
			  </ul>
			</nav>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php include_once ('includes/footer_front.php') ?>
