<style>
    .option{
        color: #fff;
    font-size: 17px;
    background: #286090;
    }
</style>
<!-- Wrapper for Slides -->
<div class="carousel slide hidden-xs" id="carousel-example-generic" data-ride="carousel" style="height:65%">
	<ol class="carousel-indicators">
            <?php
            if (!empty($home_slider)) {
                $count =0;
                foreach ($home_slider as $slidersImages) {
            ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $count;?>" <?php if($count ==0){?>class="active"<?php }?>></li>
            <?php $count++;}}?>
	</ol>
    <div class="carousel-inner" style="">
        <?php
        if (!empty($home_slider)) {
            $counter =0;
            foreach ($home_slider as $slidersImages) {
                $slideTITLE = $slidersImages->title;
                $slideIMAGE = $slidersImages->imgname;
                $slideDESCRIBE = $slidersImages->describe;
        ?>
        <div class="item <?php if($counter ==0){echo 'active'; }?>">
        	<div class="fill" style="background:url('./uploads/slides/<?php echo $slideIMAGE;?>') no-repeat fixed center center"></div>
            <!--<img src="<1?php echo base_url();?>uploads/slides/<1?php echo $slideIMAGE;?>">--> 
            
            <!--<img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/slides/<?php echo $slideIMAGE;?>&w=1500&h=800" alt="<?php echo $slideTITLE; ?>"/>-->
        </div>
        <?php $counter++;}}?>
    </div>
<!--    <div class="carousel-inner" style="">
        <div class="item active">
            <div class="fill" style="background:url('<?php echo base_url();?>gears/front/images/banner0.jpg') no-repeat fixed center center"></div>
             <img src="<?php echo base_url();?>gears/front/images/banner0.jpg">
        <div class="item">
        	<div class="fill" style="background:url('<?php echo base_url();?>gears/front/images/banner1.jpg') no-repeat fixed center center"></div>
             <img src="<?php echo base_url();?>gears/front/images/banner1.jpg">
        </div>
    </div>
</div>-->
</div>

<!--find desired  materials-->
<!--<div class="dark-bg search-course">
	<div class="container">
		<div class="row">
            <form action="<?php echo base_url("search");?>" method="post">
				<div class="col-sm-3">
					<h2>Find Materials</h2>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="sr-only">Search Keywords</label>
	                                        <input type="text" name="ssubject" class="form-control" placeholder="subject">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="sr-only">Choose Course</label>
	                                        
	                                       <?php
												//echo "<pre>";
												//print_r($courses);die;
	                                       ?>
	                                        <select class="form-control" name="course">
	                                            <option value="1">-- Choose Course --</option>
	                                                <?php 
	                                               
	                                                foreach($courses as $key=>$course):
													//$course=  array_unique($course);
	                                               ?>
	                                            <option class="option" label="<?php echo $key;?>" disabled><?php echo $key;?>
	                                                    <?php  foreach($course as $c):
	                                                         if(!empty($c->course_name) && !empty($c->course_id)):
	                                                        ?>
							<option value="<?php echo $c->course_id;?>"><?php echo $c->course_name;?></option>
	                                               <?php else:?>
	                                               
							     <option value="<?php echo $c->level_id;?>"><?php echo $c->level_name;?></option>
	                                                <?php endif;endforeach;?>
	                                                </option>
	                                                 <?php endforeach;?>  
	                                                
	                                                    
							
						</select>
					</div>
				</div>
				<div class="col-sm-2 col-sm-offset-1">
					<div class="form-group">
						<input type="submit" value="search" class="btn btn-primary btn-block" name="search">
					</div>
				</div>
            </form>
		</div>
	</div>
</div>-->
<div class="clearfix"></div>
<!--intro with small desc-->
<div class="container">
	<div class="row lead-line">
		<div class="col-sm-12">
			<div class="heading">
				<h1>SmartSikshya Experience</h1>
			</div>
			<p class="lead">Experience something smart with SmartSikshya</p>
		</div>
		<?php
                if(!empty($home_subcontent)){
                    
               
			$content = $home_subcontent;
			foreach($content as $i => $i_value){
		?>
		<div class="col-sm-6">
			<div class="feature-box">
				<i class="fa fa-book"></i>
				<h2><?php echo $i_value->page_title ?></h2>
				<?php echo $i_value->content ?>
			</div>
		</div>
		<?php }  }?>
	</div>
</div>
<div class="clearfix"></div>
<!--/special intro-->
<section class="fill2 large-gap">
	<div class="container">
		<div class="row">
                    <?php if(!empty($home_video)):?>
			<div class="col-sm-5 ">
				<iframe width="90%" height="315" src="<?php echo $home_video->youtube_link;?>" frameborder="0" allowfullscreen></iframe>
			</div>
                    <?php else:?>
                    <div class="col-sm-5 ">
				<iframe width="90%" height="315" src="https://www.youtube.com/embed/M0HAfbZFWp4?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
                        <?php 
                       
                    endif;?>
			<div class="col-sm-7 col-md-6 col-md-offset-1 intro-desc">
				<div class="heading">
					<h1><?php if(!empty($home_content)) echo $home_content->page_title;?></h1>
				</div>
                               <?php if(!empty($home_content)) echo $home_content->content;?>
				</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<!--/listing materials-->
<div class="container">
	<div class="row course-port">
		<!-- LIst courses here -->
		<div class="col-sm-12 col-md-9">
			<div class="heading-left">
				<h1>Available Materials</h1>
			</div>
			<div class="row">
				<?php
					$courses = array('slc' ,'bridgecourse','plus2','alevel','ioe','iom','mba','kuumat','cmat' );
					for ($i=0; $i < count($courses); $i++){
				?>
				<div class="col-xs-6 col-sm-4 col-md-4">
					<a href="second.php" class="single <?php echo $courses[$i] ?>">
						<figure>
							<img src="<?php echo base_url();?>gears/front/images/<?php echo $i ?>.png" alt="icon" class="img-responsive">
							<figcaption>
								<h2><?php echo $courses[$i] ?></h2>
								<!-- <hr> -->
								<ul class="list-inline">
									<li><i class="fa fa-file-text-o"></i> 25 notes</li>
									<li><i class="fa fa-download"></i> 305 downloads</li>
								</ul>
							</figcaption>
						</figure>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
		<!-- NEWS with ad here -->
		<div class="col-sm-12 col-md-3">
			<div class="news-listings-parent">
				<div class="heading-left">
					<h1>News &amp; Events</h1>
				</div>
                            <?php if(!empty($news)):
                                
                                ?>
                            	<ul class="list-unstyled news-listings">
					<?php 
						foreach($news as $new):
                                                    $newSlug=$new->slug;
					?>
					<li>
						<a href="" title="news title">
                                                    <a href="<?php echo base_url("news/$newSlug");?>"> <h3><?php echo $new->heading;?></h3></a>
							<?php echo subString($new->content,150).'......';?>
						</a>
					</li>
					<?php endforeach;?>
				</ul>
                            <?php
                                
                                endif;
                            ?>
			</div>
			<!-- ADVERTISEMENT -->
			<div class="ad-sidebar">
				
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!--/Video Tutorials-->
<div class="container">
	<div class="row video-tutorial">
		<div class="col-sm-12">
			<div class="heading-left">
				<h1>Video Tutorials</h1>
			</div>
		</div>
		<div class="clearfix"></div>
                <?php if(!empty($videos)):
                    ?>
                
		<ul id="video-slide">
		<?php
			foreach ($videos as $video) {
                            $videosID = $video->video_id;
		?>
			<li><iframe width="100%" height="205" src="https://www.youtube.com/embed/<?php echo $videosID;?>?rel=0" frameborder="0" allowfullscreen></iframe></li>
			<!-- <li>asim</li> -->
		<?php } ?>
		</ul>
                <?php
                endif;?>
	</div>
</div>

<script>
$(document).ready(function(){
    $('.single').css('height','268px');
})

</script>

