<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
				 <li class="active"><?php if(!empty($about)) echo $about->page_title;?></li>
				</ol>
				<h1><?php if(!empty($about)) echo $about->page_title;?></h1>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs">
		<!-- <div class="col-sm-4 col-md-3">
			<div class="sidebar-detail">
				
				
			</div>
		</div> -->
		<div class="col-sm-12 course-list-content">
			<div class="question">
				<div class="heading-left">
					<h1><?php if(!empty($about)) echo $about->page_title;?></h1>
				</div>
				<?php  if(!empty($about)) echo $about->content;?>
				
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

