<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
				  <li class="active"><?php if(!empty($course->course_name)) echo $course->course_name;else echo  $course->level_name;?> materials</li>
				</ol>
                            <h1><?php if(!empty($course->course_name)) echo ucwords($course->course_name);else echo  ucwords($course->level_name)?></h1>
			</div>
			<!-- <div class="col-sm-6 hidden-xs">
				<img src="<?php echo base_url();?>gears/front/images/course-slc-head.png" alt="slc" class="img-responsive">
			</div> -->
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!--course list intro with sidebar affix-->
<div class="container">
	<div class="row course-list-tabs">

		<div class="col-sm-12 col-md-12 course-list-content">
			<div class="heading-left">
				<h1>Get Access to the Courses Materials</h1>
			</div>
			<p>Small description can be placed here if we want to explain something important here. Thats it other content is just lorem ipsum text Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
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
							<!--<p class="lead">Demo of double columns listing of subject notes demo</p>-->
							<div class="row">
								<div class="col-sm-6">
									<!--<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics (20)</a></li>
										<li><a href="chapter.php">English (47)</a></li>
										<li><a href="chapter.php">Nepali (64)</a></li>
										<?php } ?>
									</ul>	-->
								</div>
								<div class="col-sm-6">
									<!--<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics <span class="badge">20</span></a></li>
										<li><a href="chapter.php">English <span class="badge">13</span></a></li>
										<li><a href="chapter.php">Nepali <span class="badge">6</span></a></li>
										<?php } ?>
									</ul>	-->
								</div>
							</div>
						</div>
                                                
						<!--2 Tab content-->
						<div class="tab-pane" id="tab-2">
							<!--<p class="lead">Demo of Triple columns listing of subject notes demo</p>-->
							<div class="row">
								<?php 
                                                                
                                    if(!empty($course) && isset($course->level_slug) && $course->level_slug=='school-leaving-certificate'):
                                        ?>
                                 	<div class="col-sm-6">
                                   		<ul class="custom-list">
											<?php
	                                            $levelId=$course->level_id;
	                                            $subjects=$this->db->query("select * from hya_course_subject where level_id=$levelId")->result();
	                                            foreach ($subjects as $subject){
	                                                $subjectSlug=$subject->token;
											?>
											<li><a href="<?php echo base_url("questions/$subjectSlug");?>"><?php echo $subject->subject_name;?> <small>-12</small></a></li>
											<!--<li><a href="chapter.php">English <small>-34</small></a></li>
											<li><a href="chapter.php">Nepali <small>-45</small></a></li>
	                                                                                <li><a href="chapter.php">English <small>-34</small></a></li>
											<li><a href="chapter.php">Nepali <small>-45</small></a></li>-->
											<?php } ?>
										</ul>	
							    	</div>
                                                           
                                    <?php 
                                        elseif(!empty($course) && isset($course->course_name)):
                                        $year=$course->year;
                                        $levelId=$course->level_id;
                                        $courseId=$course->course_id;
                                    for($y=1;$y<=$year;$y++){
                                    ?>
                                                            
							    	<div class="col-sm-6">
                                        <h3>Year <?php echo $y;?> <small><br>Choose a Subject to view Past Questions</small></h3>
										<ul class="custom-list">
											<?php
                                                $subjects=$this->db->query("select * from hya_course_subject where level_id=$levelId AND course_id=$courseId and year=$y")->result();
												//echo $this->db->last_query();die;
                                                foreach ($subjects as $subject){
                                                $subjectSlug=$subject->token;
											?>
											<li><a href="<?php echo base_url("questions/$subjectSlug");?>"><?php echo $subject->subject_name;?> <small>-12</small></a></li>
											<?php } ?>
										</ul>	
							    	</div>
									
									<?php
                                    	}
                                       	else:
                                       	$year=$stream->year;
                                        $levelId=$stream->level_id;
                                        $streamId=$stream->stream_id;
                                    for($y=1;$y<=$year;$y++){
                                    ?>
                                                            
							    	<div class="col-sm-6">
										<h3>Year <?php echo $y;?> <small><br>Choose a Subject to view Past Questions</small></h3>
										<ul class="custom-list">
											<?php
                                                $subjects=$this->db->query("select * from hya_course_subject where level_id=$levelId AND stream_id=$streamId and year=$y")->result();
												//echo $this->db->last_query();die;
                                                foreach ($subjects as $subject){
                                                    $subjectId=$subject->subject_id;
                                                    $subjectSlug=$subject->token;
                                                     $questions=$this->db->query("select * from hya_data_question where subject_id=$subjectId and status=1")->result();
											?>
											<li><a href="<?php echo base_url("questions/$subjectSlug");?>"><?php echo $subject->subject_name;?> <small>-<?php echo count($questions);?></small></a></li>
											<?php } ?>
										</ul>	
							    	</div>
                                    <?php
                                        } 
            							endif;
            						?>
									<!--<div class="col-sm-3">
                                                                 <h3>2nd Year</h3>
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 2; $i++){
										?>
										<li><a href="chapter.php">Mathematics <small>-12</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
                                                                                    <?php } ?>
									</ul>	
								</div>
                                                            <div class="col-sm-3">
                                                                 <h3>3rd Year</h3>
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 2; $i++){
										?>
										<li><a href="chapter.php">Mathematics <small>-12</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
                                                                                    <?php } ?>
									</ul>	
							    </div>
                                                            <div class="col-sm-3">
                                                                 <h3>4th Year</h3>
									<ul class="custom-list">
										<?php
											for ($i=0; $i < 2; $i++){
										?>
										<li><a href="chapter.php">Mathematics <small>-12</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
										<li><a href="chapter.php">English <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali <small>-45</small></a></li>
                                                                                    <?php } ?>
									</ul>	
							    </div>-->
								
                                                            
							</div>
						</div>
                                                
						<!--3 Tab Content-->
						<div class="tab-pane" id="tab-3">
							<!--<p class="lead">Demo of Single columns listing of subject longer name demo</p>-->
							<div class="row">
								<div class="col-sm-4">
<!--									<ul class="custom-list">
										<?php
											for ($i=0; $i < 3; $i++){
										?>
										<li><a href="chapter.php">Mathematics 50 Sets Practice <small>-12</small></a></li>
										<li><a href="chapter.php">English 23 Sets Practice <small>-34</small></a></li>
										<li><a href="chapter.php">Nepali 05 sets practice <small>-45</small></a></li>
										<?php } ?>
									</ul>	-->
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

