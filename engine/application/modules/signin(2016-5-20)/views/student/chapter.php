
<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>materials"><i class="fa fa-home"></i></a></li>
				  <li><a href="#"><?php echo $level->level_name;?> Materials</a></li>
				  <li><a> <?php echo $subject->subject_name;?></a></li>
				  
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
            
		<div class="col-sm-4 col-md-3">
                    <div class="sidebar">
				<div class="heading-left">
					<h1><small>Search Materials by</small></h1>
				</div>
				<div class="search-box">
                                    <form method="post" action="">
					<div class="form-group">
						
						<label class="sr-only">By Year</label>
						<script>
                                $(document).ready(function(){
                                    $('#change_date').on('change', function() {
                                        if ( this.value == 'bs')
                                      {
                                        $("#bs_date").show();
                                        $("#ad_date").hide();
                                      }else if ( this.value == 'ad')
                                      {
                                        $("#ad_date").show();
                                        $("#bs_date").hide();
                                      }
                                    });
                                });
                            </script>
                            <?php
                                   $currentDate = date('Y-m-d');
                                    $c_year = date('Y', strtotime($currentDate));
                                    $month = date('F', strtotime($currentDate));
                                    $previous10Year = $c_year - 10;
                                    $after10Year = $c_year + 10;
                                    $previous_n_10Year='';
                                    //$c_year_n=$c_year;
                                    if(!empty($c_year_n)){
                                        $previous_n_10Year = $c_year_n - 10;
                                        $after_n_10Year = $c_year_n + 10;
                                    }
                                    //echo $c_year_n;
                                    ?>
                                        
                                         <select name="date_type" class="col-sm-4 btn btn-primary" id="change_date">
                                            <option value="">Date Type</option>
                                            <option value="bs" id="bs" <?php if (!empty($datetype)) {if ($datetype == "bs") { ?>selected="selected" <?php }}?> >B.S.</option>
                                            <option value="ad" id="ad" <?php if (!empty($datetype)) {if ($datetype == "ad") { ?>selected="selected" <?php }} else { ?>selected="selected" <?php }?>>A.D.</option>
                                            
                                        </select>
                            
                                    <select name="appeared_year" id="ad_date" class="form-control" <?php if($datetype=="ad") echo "style=display:block";else echo "style=display:none" ?>><!-- data-event="change" data-handler="selectYear"-->
                                       
                                        <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                        <option <?php if ($i == $c_year || $date==$i) { ?>selected="selected" <?php } ?> value="<?php echo $i ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>

                                    <select name="appeared_year" id="bs_date" class="form-control" <?php if($datetype=="bs") echo "style=display:block";else echo "style=display:none" ?> ><!-- data-event="change" data-handler="selectYear"-->
                                    <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                        <option <?php if ($n == $c_year_n || $date==$n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                    <?php } ?>
                                    </select>
                                    
                                </div>
					
					<div class="form-group">
						<label class="sr-only">Search By Question Tag</label>
						<select class="form-control" name="question_tag">
                                                        <option value="">search by Ques. Tags</option>
                                                        <option value="very_short" <?php if(!empty($tag) && ($tag =='very_short')) echo "selected='selected'";?>>Very Short</option>
                                                        <option value="short" <?php if(!empty($tag) && ($tag =='short')) echo "selected='selected'";?>>Short</option>
                                                        <option value="long" <?php if(!empty($tag) && ($tag =='long')) echo "selected='selected'";?>>Long</option>
                                                        <option value="theory" <?php if(!empty($tag) && ($tag =='theory')) echo "selected='selected'";?>>Theory</option>
                                                        <option value="practical" <?php if(!empty($tag) && ($tag =='practical')) echo "selected='selected'";?>>Practical</option>
                                                        <option value="short_note" <?php if(!empty($tag) && ($tag =='short_note')) echo "selected='selected'";?>>Write Short Note</option>
                                                </select> 
					</div>
					<div class="form-group">
                                            <label class="sr-only">Search By Marks</label>
						<select class="form-control" name="marks">
                                                    <option value="">Search by Marks</option>
                                                    <?php if(!empty($marks)):
                                                foreach($marks as $m):
                                                ?>
                                                        <option value="<?php echo $m;?>" <?php if(!empty($mark) && ($mark ==$m)) echo "selected='selected'";?>><?php echo $m;?></option>
                                                         <?php
                                                endforeach;
                                            endif;
                                            ?>
                                                       
                                                </select> 
                                            
                                            
<!--						<div class="checkbox">
						    <label>
                                                        <input type="checkbox" name="marks[]" value="<?php echo $mark;?>"> <?php echo $mark;?>
						    </label>
						</div>-->
                                           
						
					</div>
                                        <button type="submit">Search</button>
                                        </form>
				</div>
			</div>
                    <?php if(!empty($chapters)):?>
			<div class="sidebar-detail">
				<div class="heading-left">
					<h1><small>Lesson Outline</small></h1>
				</div>
				<ul class="list-unstyled">
					<?php foreach ($chapters as $chapter) {?>
					<li><a href="<?php echo base_url();?>chapter/<?php echo $chapter['chapter_slug'];?>/<?php echo $subject->subject_slug;?>"><?php echo $chapter['chapter_name'] ?></a></li>
					<?php } ?>
				</ul>
			</div>
                    <?php endif;?>
		</div>
		<div class="col-sm-8 col-md-9 course-content">
			<!-- Individual Questions -->
                        <?php $sn=1; if(!empty($questions)) :
                            foreach($questions as $question):
                            ?>
                       
			<div class="question panel panel-default ">
				<div class="panel-body ">
                                    <div class="">
					<ul class="list-inline outline-course ">
						<li><?php echo $sn;?></li>
						<li><i class="fa fa-calendar"></i> <?php echo $question['appeared_year'];?></li>
                                                <?php if(isset($question['set'])):
                                                    ?>
                                               
						<li>set <strong><?php echo $question['set'];?></strong></li>
                                                 <?php
                                                endif;
                                                ?>
                                                <?php if(isset($question['mark'])):?>
						<li>Marks: <strong><?php echo $question['mark'];?></strong></li>
                                                <?php endif;?>
						<li class="label label-primary"><?php echo $question['question_tag'];?></li>
					</ul>
				    <?php echo  $question['question'];?>	
                                    <?php if($question['question_type']!="Text entry")
                                          {
                                        
                                          }
                                       
                                        $option=$this->db->get_where('hya_data_option',array('question_id'=>$question['question_id']))->result();
                                        ?>
                                    <ul class="list-inline row">
						<?php foreach ($option as $op) {
                                                    if($question['question_type']=="Drop Down"){}
                                           if($question['question_type']=="Radio Buttons"){}
                                               if($question['question_type']=="Checkboxes"){
                                                   
                                                    ?>
						<li class="col-sm-6 label label-default">
						         <?php echo $op->option_name;?>
						</li>
                                               <?php } 
                                               
                                               } ?>
				    </ul>
                                   <?php //endif; ?>
                                    <a class="btn btn-primary" href="<?php echo base_url();?>question_detail/<?php echo $question['token'];?>"> Detail</a>
				</div>
                                    </div>
			</div>
                         <?php
                         $sn++;
                            endforeach;
                            else: echo 'No Data Available';
                        endif;
?>
			<!-- Practical Question -->
			
			<!-- pagination -->
<!--			<nav>
			  <ul class="pager">
			    <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Previous</a></li>
    			<li class="next"><a href="#">Next <span aria-hidden="true">&rarr;</span></a></li>
			  </ul>
			</nav>-->
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script src="<?php echo base_url();?>gears/front/js/jquery.jscroll.js"></script>
<script>
$('.jscroll').jscroll({
   
    autoTrigger : true,
    
});

</script>
