<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
                                  <li>News</li>
				 <li class="active"><?php if(!empty($news)) echo $news->heading;?></li>
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
                             <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/news/<?php echo $news->home_image;?>&w=250&h=250" class="img-responsive" />
                                        
                            <!--<img src="<?php echo base_url();?>uploads/news/<?php echo $news->home_image;?>" class="img-responsive">-->	
				
			</div>
		</div>
		<div class="col-sm-8 col-md-9 course-list-content">
			<div class="question">
				<div class="heading-left">
					<h1><?php if(!empty($news)) echo $news->heading;?></h1>
				</div>
				<?php  if(!empty($news)) echo $news->content;?>
				
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

