
<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>materials"><i class="fa fa-home"></i></a></li>
				  <li><a href="javascript:;" onclick="history.go(-1)"><?php echo $level->level_name;?> Materials</a></li>
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
	<div class="row course-list-tabs">
		
		<div class="col-sm-8 col-md-9 course-list-content">
			<div class="question">
				<?php echo $row->question; ?>
					
                                    <?php if($row->question_type!="Text entry"){
                                        
                                    }
                                       
                                        $option=$this->db->get_where('hya_data_option',array('question_id'=>$row->question_id))->result();
                                        ?>
                                    <ul class="list-inline row">
						<?php foreach ($option as $op) {
                                                    if($row->question_type=="Drop Down"){
                                                        
                                                        
                                                    }
                                           if($row->question_type=="Radio Buttons"){
                                               ?>
                                                    <div class="radio">
                                                        <label>
                                                          <input type="radio" name="optionsRadios" id="optionsRadios<?php echo $i ?>" value="option1" checked>
                                                           <?php echo $op->option_name;?>
                                                        </label>
				                     </div>
                                        <?php
                                           }
                                               if($row->question_type=="Checkboxes"){
                                                   
                                                    ?>
						<div class="radio">
                                                        <label>
                                                            <input type="checkbox" name="optionsRadios" id="optionsRadios<?php echo $i ?>" value="option1" checked>
                                                         <?php echo $op->option_name;?>
                                                        </label>
				                </div>
                                               <?php } 
                                               
                                               } ?>
				    </ul>
                                   <?php //endif; ?>
                            <?php echo isset($answer->answer_name)?'Answer:'.$answer->answer_name:'';?>
                            <div class="clearfix"></div>
                                <!--<a class="btn btn-primary">Check Button &rarr;</a>-->
                                <a onclick="history.go(-1)" class="btn btn-primary">Back</a>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

