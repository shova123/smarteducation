<!-- Wrapper for Slides -->

<div class="carousel slide hidden-xs" id="carousel-example-generic" data-ride="carousel">
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
        	<!--<div class="fill" style="background:url('./uploads/slides/<?php echo $slideIMAGE;?>') no-repeat fixed center center"></div>-->
            <!--<img src="<1?php echo base_url();?>uploads/slides/<1?php echo $slideIMAGE;?>">--> 
            
            <img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/slides/<?php echo $slideIMAGE;?>&w=1920&h=651" alt="<?php echo $slideTITLE; ?>"/>
        </div>
        <?php $counter++;}}?>
    </div>
</div>
<!--find desired  materials-->
<div class="dark-bg search-course">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<h2>Find Materials</h2>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="sr-only">Search Keywords</label>
					<input type="text" class="form-control" placeholder="Keywords">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="sr-only">Choose Level</label>
					<select class="form-control">
						<option>-- Choose Level --</option>
						<option value="slc">SLC</option>
						<option value="+2">Plus Two</option>
						<option value="Bachelors">Bachelors</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
				<div class="form-group">
					<input type="submit" value="search" class="btn btn-primary btn-block" name="search">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!--intro with small desc-->
<div class="container">
	<div class="row large-gap lead-line">
		<div class="col-sm-12">
			<div class="heading">
				<h1>SmartSikshya Experience</h1>
			</div>
			<p class="lead">Experience something smart with SmartSikshya</p>
		</div>
		<?php
			$content = array(
				'Book Shelf on your own digital device' => '<p> no necessity of collecting many books and adjusting your book shelf time and again. Just few clicks and you can customize the book shelf in your own digital device.</p><p><i>We create an environment for you to create…</i></p>',
				'Your Own learning Class' => '<p>SmartSikshya reaches to you, even at places where learning materials are not easily accessible and where the time of reach is very long.</p><p><i>We believe learning should never be confined within the boundary…</i></p>',
				'Eco Friendly Learning' => '<p>Did you know, worldwide, paper accounts for 42% of the trees cut down by industry and roughly 40 million acres of forests continue to disappear each year. Imagine the positive impact it can create in the environment by taking the step to go digital.<p><p><i>We believe in going green by opting to digital medium…</i></p>',
				'Interactive café with S-café' => '<p>Experience a different café experience while you learn. Whenever you encounter a problem while learning and seek to know the solution or like to share your views, visit this interactive S-café and expand your knowledge with your fellow Smartyans.</p><p><i>We provide platform for you to grow your educational network…</i></p>'
			);
			foreach($content as $i => $i_value){
		?>
		<div class="col-sm-6">
			<div class="feature-box">
				<i class="fa fa-book"></i>
				<h2><?php echo $i ?></h2>
				<?php echo $i_value ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<div class="clearfix"></div>
<!--/special intro-->
<section class="fill2 large-gap">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 ">
				<iframe width="90%" height="315" src="https://www.youtube.com/embed/M0HAfbZFWp4?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="col-sm-7 col-md-6 col-md-offset-1 intro-desc">
				<div class="heading">
					<h1>Introduction about our program</h1>
				</div>
				<p>SmartSikshya is an online education portal offering education materials from SLC to Master’s Level.</p>
				<p class="lead">A platform “where learning goes Smart…�?</p>
				<p>Education material includes updated past questions, practice sets, model questions and online quizzes of different level.</p>
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
				<ul class="list-unstyled news-listings">
					<?php 
						for ($i=0; $i < 5; $i++) {
					?>
					<li>
						<a href="" title="news title">
							<h3>News Title here</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod..</p>
						</a>
					</li>
					<?php } ?>
				</ul>
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
		<ul id="video-slide">
		<?php
			for ($i=0; $i < 6; $i++) {
		?>
			<li><iframe width="100%" height="205" src="https://www.youtube.com/embed/M0HAfbZFWp4?rel=0" frameborder="0" allowfullscreen></iframe></li>
			<!-- <li>asim</li> -->
		<?php } ?>
		</ul>
	</div>
</div>

