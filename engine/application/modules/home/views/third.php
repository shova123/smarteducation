
<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
				  <li><a href="javascript:;"><i class="fa fa-home"></i></a></li>
				  <li><a href="javascript:;" onclick="history.go(-1)"><?php echo $level->level_name;?> Materials</a></li>
				   <?php if(!empty($stream)): ?>
                                  <li><a href="javascript:;"><?php echo $stream->stream_name;?> </a></li>
                                  <?php endif;?>
                                  <li class="active"> <?php echo $subject->subject_name;?></li>
				</ol>
                            
				<h1> <?php echo $subject->subject_name;?></h1>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs detail-course-list-tabs">
		
		<div class="col-sm-8 col-md-9 course-content">
    <!-- THIS IS STATIC FOR QUESTIONS AND HINTS AND LISTS AND DESCRIPTIONS -->
      
      <!-- THIS BRINGS TO END OF ALL STATIC THINGS -->
			<div class="question">
                            
                                <div class="panel-body">
                                   
                                  <ul class="list-inline outline-course" style="padding-bottom:8px;">
                                      <li class="question-detail-course"><?php echo 'Q.'.$row->question; ?></li>
                                  </ul>
                                 </div>

                                <div class="clearfix"></div>

                             
				
					 <?php 
                                       
//                                        $option=$this->db->get_where('hya_data_option',array('question_id'=>$row->question_id))->result();
                                        if(!empty($subquestion)):
                                        ?>
                                    <div class="row">
						<?php foreach ($subquestion as $sq) {?>
                                              <div class="col-sm-12 col-md-6">
                                                  <p><?php if(!empty( $sq->subquestion_name)) echo $sq->subquestion_name;?></p>
                                                      </div>
                                             <?php   } ?>
				    </div>
                            <?php endif; 
                                       
//                                        $option=$this->db->get_where('hya_data_option',array('question_id'=>$row->question_id))->result();
                                        if(!empty($option)):
                                        ?>
                                    <div class="row">
						<?php foreach ($option as $op) {?>
                                           
                                                   <div class="row">
                                                            <div class="col-sm-12">
                                                  <div class="answer-panel ">
                                                   <?php echo $op->option_name;?>
                                                  </div>
                                                </div>
                                                          
                                                           
                                              </div>
                                                
                                                     
                                             <?php   } ?>
				    </div>
                            <?php endif;
                            if(!empty($hint)):
                            ?>
                                 <div class="row">
						<?php foreach ($hint as $h) {?>
                                              <div class="col-sm-12 col-md-6">
                                                  <div class="answer-panel hint"><strong>HINT: </strong> <?php echo $h->hint_name;?></div>
                            
                                                  
                                                      </div>
                                             <?php   } ?>
				    </div>
                            <?php endif;
//                            if(!empty($option)):
                            ?>
                            <?php echo isset($answer->answer_name)?'Answer:'.$answer->answer_name:'';?>
                            
                            <div class="clearfix"></div>
                                <!--<a class="btn btn-primary">Check Button &rarr;</a>-->
                                <a onclick="history.go(-1)" class="btn btn-primary">Back</a>
			
                             </div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

