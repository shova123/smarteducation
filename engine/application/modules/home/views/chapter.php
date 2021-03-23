<style>
    
    ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
 
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
 
 
ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
 
ul.tsc_paginationA01 li a { color:white; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#337ab7; background:-moz-linear-gradient(top, #337ab7 1px, #337ab7 1px, #337ab7); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #337ab7), color-stop(0.02, #337ab7), color-stop(1, #337ab7)); }
ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a { background:#FFFFFF; color:black }
</style>
<!-- Top BreadCrumb Here -->
<div class="inner-page-top inner-page-question">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
                                   <?php if(!empty($level)): ?>
				  <li><a href="javascript:;"><?php echo $level->level_name;?> Materials</a></li>
                                  <?php endif;?>
                                  <?php if(!empty($stream)): ?>
                                  <li><a href="javascript:;"><?php echo $stream->stream_name;?> </a></li>
                                  <?php endif;?>
                                  <?php if(!empty($subject)): ?>
				  <li><a> <?php echo $subject->subject_name;?></a></li>
				  <?php else: echo "<li><a>No Materials</a></li>"; endif;?>
				</ol>
                            <?php if(!empty($subject)): ?>
				<h1> <?php echo $subject->subject_name;?></h1>
                                 <?php else: echo "<h1>No Materials</h1>"; endif;?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs">
            
	<div class="col-sm-4 col-md-3">
        <div class="sidebar affix-top">
            <button class="btn btn-primary btn-flat btn-block" id="collapsebtn" type="button" data-toggle="collapse" data-target="#side-form-toggle" aria-expanded="false" aria-controls="collapseExample">QUICK SEARCH <i class="fa fa-search"></i></button>
            <div id="side-form-toggle" class="collapse">
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
                        <div class="form-group">
                                <label class="sr-only">Search By Subject</label>
        						<select class="form-control" name="subject">
                                    <option value="">Search by Subjects</option>
                                        <?php if(!empty($subjects)):
                                            foreach($subjects as $s):
                                                //echo $subjectSearch .'----'.$s->subject_id;die;
                                        ?>
                                        <option value="<?php echo $s->subject_id;?>" <?php if(!empty($subjectSearch) && ($subjectSearch ==$s->subject_id)) echo "selected='selected'";?>><?php echo $s->subject_name;?></option>
                                        <?php
                                            endforeach;
                                            endif;
                                        ?>                       
                                </select>                   
                                <!--<div class="checkbox">
        						    <label>
                                                                <input type="checkbox" name="marks[]" value="<?php echo $mark;?>"> <?php echo $mark;?>
        						    </label>
        						</div>-->
					    </div>
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
                        <div class="row" style="white-space:nowrap">
                            <div class="col-sm-4">    
                                <select name="date_type" class="btn btn-primary" id="change_date">
                                    <option value="">Date Type</option>
                                    <option value="bs" id="bs" <?php if (!empty($datetype)) {if ($datetype == "bs") { ?>selected="selected" <?php }}?> >B.S.</option>
                                    <option value="ad" id="ad" <?php if (!empty($datetype)) {if ($datetype == "ad") { ?>selected="selected" <?php }} else { ?>selected="selected" <?php }?>>A.D.</option>
                                
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <select name="appeared_year" id="ad_date" class="form-control" <?php if($datetype=="ad") echo "style=display:block";else echo "style=display:none" ?>> data-event="change" data-handler="selectYear"
                           
                                <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                <option <?php if ($i == $c_year || $date==$i) { ?>selected="selected" <?php } ?> value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select>

                                <select name="appeared_year" id="bs_date" class="form-control" <?php if($datetype=="bs") echo "style=display:block";else echo "style=display:none" ?> > data-event="change" data-handler="selectYear"
                                <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                <option <?php if ($n == $c_year_n || $date==$n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
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
					
                    <button type="submit">Search</button>
                    </form>
				</div>
                <div class="clearfix"></div>

                <!-- yaha suru arko form -->
                <?php if(!empty($chapters)):?>
                <div class="sidebar-detail">
                    <div class="heading-left">
                        <h1><small>Lesson Outline</small></h1>
                    </div>
                    <form action="" method="post" name="addEditform" id="addEditform">
                        <div class="form-group">
                            <label class="sr-only">Search By Chapter</label>
                            <select name="chapter_id" id="chapter_id" class='form-control' data-rule-required="true" onchange="setChapter(document.addEditform.chapter_id.options[document.addEditform.chapter_id.selectedIndex].value);">
                                <option value="">Search by Chapters</option>
                                <?php if(!empty($chapters)):
                                    foreach($chapters as $chapter):
                                        //echo $subjectSearch .'----'.$s->subject_id;die;
                                ?>
                                <option value="<?php echo $chapter['chapter_id'];?>" <?php if(!empty($chapterSearch) && ($chapterSearch ==$chapter['chapter_id'])) echo "selected='selected'";?>><?php echo $chapter['chapter_name'];?></option>
                                <?php
                                    endforeach;
                                    endif;
                                ?>                       
                            </select>           
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Search By Unit</label>
                            <select name="unit_id" id="unit_id" class='form-control' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);">
                                <option value="">Search by Unit</option>
                                <?php if(!empty($units)):
                                    foreach($units as $u):
                                    //echo $subjectSearch .'----'.$s->subject_id;die;
                                ?>
                                <option value="<?php echo $u->unit_id;?>" <?php if(!empty($unitSearch) && ($unitSearch ==$u->unit_id)) echo "selected='selected'";?>><?php echo $u->unit_name;?></option>
                                <?php
                                    endforeach;
                                    endif;
                                ?>                       
                            </select> 
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Search By Subunit</label>
                            <select class="form-control" name="subunit_id" id="subunit_id">
                                <option value="">Search by Subunit</option>
                                <?php if(!empty($subunit)):
                                    foreach($subunit as $su):
                                    //echo $subjectSearch .'----'.$s->subject_id;die;
                                ?>
                                <option value="<?php echo $su->subunit_id;?>" <?php if(!empty($subunitSearch) && ($subunitSearch ==$su->subunit_id)) echo "selected='selected'";?>><?php echo $su->subunit_name;?></option>
                                <?php
                                    endforeach;
                                    endif;
                                ?>                       
                            </select> 
                        </div>
                        <button type="submit">Search</button>
                    </form>
                    <!--<ul class="list-unstyled">
                        <?php foreach ($chapters as $chapter) {?>
                        <li><a href="<?php echo base_url();?>chapter/<?php echo $chapter['chapter_slug'];?>/<?php echo $subject->subject_slug;?>"><?php echo $chapter['chapter_name'] ?></a></li>
                        <?php } ?>
                    </ul>-->
                </div>
                <?php endif;?>
                <!-- yaha end arko form -->
            </div>
		</div>
	</div>
	
    <div class="col-sm-8 col-md-9 course-content">
        <h3><center><?php echo ucfirst(str_replace("_", " ", $tag)); ?></center></h3>
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
                            <li> Exam Q.N. <strong>5</strong></li>
                            <?php if(isset($question['set'])):
                            ?>                       
    						<li>set <strong><?php echo $question['set'];?></strong></li>
                            <?php
                                endif;
                            ?>
                            <?php if(isset($question['mark'])):?>
    						<li>Marks: <strong><?php echo $question['mark'];?></strong></li>
                            <?php endif;?>
                            <li><a class="btn btn-primary" href="<?php echo base_url();?>question_view/<?php echo $question['token'];?>"> Ans &rarr;</a></li>
    						<!-- <li class="label label-primary"><?php echo $question['question_tag'];?></li> -->
    					</ul>
                        <!-- <p><?php echo $sn;?>.</p> -->
				        <?php echo  $question['question'];?>
                        <!-- <small style="font-size:12px; color:#777">- <i class="fa fa-calendar"></i> <?php echo $question['appeared_year'];?></small>	 -->
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
                        <!-- <a class="btn btn-primary" href="<?php echo base_url();?>question_view/<?php echo $question['token'];?>"> Detail</a> -->
				    </div>
                </div>
			</div>
                        <?php
                         $sn++;
                            endforeach;?>
                        <div class="clearfix"></div>
                        <!--<a class="cd-btn btn btn-primary" href="#0"><i class="fa fa-sign-in"></i>To View More Join Now</a>-->
                           <?php else: echo 'No Questions Available';
                        endif;
                        ?>
			<!-- Practical Question -->
            <div class="row">
                <div class="col-md-12 text-center pagination-parent-div">
                    <?php echo $pagination; ?>
                </div>
            </div>

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

<script>
function setChapter(chosen) {

        var selbox = document.addEditform.unit_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Unit--", "");
<?php
if (!empty($units)) {
    foreach ($units as $unit) {
        $unit_id = $unit->unit_id;
        $unitChapter_id = $unit->chapter_id;
        $unit_name = $unit->unit_name;
        ?>

                if (chosen == <?php echo $unitChapter_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
                }
        <?php
    }
}
?>

    }

    function setUnit(chosen) {

        var selbox = document.addEditform.subunit_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select SubUnit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select SubUnit--", "");
<?php
if (!empty($subunits)) {
    foreach ($subunits as $s) {
        $subunit_id = $s->subunit_id;
        $subunitUnit_id = $s->unit_id;
        $subunit_name = $s->subunit_name;
        ?>

                if (chosen == <?php echo $subunitUnit_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $subunit_name; ?>", "<?php echo $subunit_id; ?>");
                }
        <?php
    }
}
?>
        //            if (selbox.options.length > 1) {
//                $("#subunit").show();
//            } else {
//                $("#subunit").hide();
//            }
    }


</script>
