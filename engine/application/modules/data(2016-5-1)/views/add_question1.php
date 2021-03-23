  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<script>
    $(document).ready(function(){
      $("#second_form").hide();
      $('#stream').hide();
      $('#course').hide();
            $('#department').hide();
            $('#subject').hide();
            $('#chapter').hide();
            $('#unit').hide();
            $('#subunit').hide();
            $('#year').hide();
            $('#semester').hide();
            $("#subquestion-1").hide();

            $("#next").click(function (e) {
                e.preventDefault();
                $("#second_form").show("slow");
                $("#first_form").hide("slow", function () {});
            });
            $("#cancel").click(function () {
                $("#first_form").show("slow");
                $("#second_form").hide("slow", function () {});
            })
    });
    
    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
        <?php
        if (!empty($levels)) {
            foreach ($levels as $level) {
                $levelBoard_id = $level->board_id;
                $level_id = $level->level_id;
                $level_name = $level->level_name;
        ?>
                                                                                
        if (chosen == <?php echo $levelBoard_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $level_name; ?>','<?php echo $level_id; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
    // set option for stream using levels
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
        <?php
        if (!empty($streams)) {
            foreach ($streams as $stream) {
                $stream_id = $stream->stream_id;
                $streamLevel_id = $stream->level_id;
                $stream_name = $stream->stream_name;
        ?>
                                                                                
        if (chosen == <?php echo $streamLevel_id?>){ 
                    
                    
                    
            selbox.options[selbox.options.length] = new Option('<?php echo $stream_name; ?>','<?php echo $stream_id; ?>');
        }
        
        <?php
            }?>
                    
                    <?php
        }
       
            ?>  
                    console.log(selbox.options.length);
                    if(selbox.options.length <=1){
                   $('#stream').hide();
                     
                    <?php
                    if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subjectLevel_id=$subject->level_id;
                $subjectStream_id=$subject->stream_id;
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
        ?>
             
//            $("#chapter").show();
//            $("#unit").show();                                                                   
                if (chosen == <?php echo $subjectLevel_id?>)
                {
                 selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
                }
                if(selboxSubject.options.length <=1){
                    $("#subject").show();
                }
        <?php
            }
           }
        ?>
                    
        }
        else{
            $("#stream").show();
            $("#subject").hide(); 
            $("#chapter").hide();
            $("#unit").hide(); 
        }
        
    }
    // set option for stream using levels
    function setStream(chosen) {
    //$("#course").show();
        var selbox = document.addEditform.course_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        <?php
        //print_r($courses);
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseStream_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
                if(selbox.options.length > 1)
                {
                    $("#year").show();
                    $("#year").show();
                }
        
    }
       function setCourse(chosen) {
         $("#subject").show();
         $("#chapter").show();
         $("#unit").show();
        var selboxDepartment = document.addEditform.department_id;
        var selboxSubject = document.addEditform.subject_id;
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        if (chosen == " ") {
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select--',' ');
            selboxSubject.options[selboxSubject.options.length] = new Option('--Select--',' ');
        }
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentCourse_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
            ?>
            if(selboxDepartment.options.length > 1){
                $("#department").show();
               
            }
            else{
                 $("#department").hide();
            }
       <?php }
        
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectCourse_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
        
        
        
        
    }
     function setDepartment(chosen) {
        var selbox = document.addEditform.chapter_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Chapter--',' ');
        <?php
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $department_id=($subject->department_id)?$subject->department_id:0;
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectCourse_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
    function setSubject(chosen) {
        var selbox = document.addEditform.chapter_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Chapter--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Chapter--',' ');
        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_id = $chapter->course_id;
                $chapterSubject_id = $chapter->subject_id;
                $chapter_name = $chapter->chapter_name;
        ?>
                                                                                
        if (chosen == <?php echo $chapterSubject_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $chapter_name; ?>','<?php echo $chapter_id; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
    
 function setUnit(chosen) {
        var selbox = document.addEditform.subunit_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Sub unit--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select SubUnit--',' ');
        <?php
        if (!empty($subunits)) {
            foreach ($subUnits as $s) {
                $unit_id=$s->unit_id;
                $subunit_name = $chapter->subunit_name;
                $subunit_id = $chapter->subunit_id;
        ?>
                                                                                
        if (chosen == <?php echo $unit_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $subunit_name; ?>','<?php echo $subunit_id; ?>');
        }
        <?php
            }
        }
        
        ?>
        if(selbox.options.length>1){
           $("#subunit").show();
        }
        else{
            $("#subunit").hide();
        }
    }
    function setChapter(chosen) {
        var selbox = document.addEditform.unit_id;
        selbox.options.length = 0;
        if (chosen === " ") {
            selbox.options[selbox.options.length] = new Option('--Select Unit--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Unit--',' ');
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $course_id = $unit->course_id;
                $chapter_id = $unit->chapter_id;
                $chapterSubject_id = $unit->subject_id;
                $unit_name = $unit->unit_name;
                $unit_id = $unit->unit_id;
        ?>
                                                                                
        if (chosen == <?php echo $chapter_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $unit_name; ?>','<?php echo $unit_id; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
    
    
</script>
<?php $isEdit = isset($template_details) ? true : false; ?>


<div class="clearfix"></div>
<form action="" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                
<div class="row" id="first_form">
    <div class="col-sm-12">
        <h1>Data Information</h1>

        <div class="row">
            <div class="sample-form-elements">
                    <input type="hidden" value="<?php if(!empty($isEdit)){ echo $template_details->token;}else{ echo md5(uniqid(mt_rand(), True)); }?>" name="token" />
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Board</label>
                         <select name="board_id"  id="page_type" class=' form-control' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Board---</option>
                                    <?php if(!empty($boards)){
                                        foreach($boards as $board){
                                            $boardID = $board->board_id;
                                            $boardName= $board->board_name;
                                            $boardSlug = $board->board_slug;
                                            $boardAlias = $board->board_alias;
                                        ?>
                                   
                                   <option value="<?php echo $boardID;?>" <?php if (($isEdit) && ($details->board_id == $boardID)){echo "selected";}?>> <?php echo $boardName;?> </option>
                                 <?php
                                        }
                                    }
                                    ?>    
                                </select>
                    </div>

                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Level</label>
                        <select name="level_id"  id="level_id" class=' form-control' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Level---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($levels as $level){
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;
                                            if($details->board_id == $levelBoardID){
                                        ?>
                                   
                                   <option value="<?php echo $levelID;?>" <?php if (($isEdit) && ($details->level_id ==  $levelID)){echo "selected";}?>> <?php echo $level->level_name;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                    </div>
                    
                    <div class="form-group col-sm-6 my-form-element" id="stream">
                        <label for="textitem">Stream</label>
                        <select name="stream_id"  id="stream_id" class=' form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Stream---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($streams as $stream){
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;
                                            if($details->level_id == $streamLevelID){
                                        ?>
                                   
                                   <option value="<?php echo $streamID;?>" <?php if (($isEdit) && ($details->stream_id ==  $streamID)){echo "selected";}?>> <?php echo $streamName;?> </option>
                                    <?php }
                                        }
                                    }
                                    ?>  
                                </select>
                    </div>
                    
                    
                     <div class="form-group col-sm-6 my-form-element" id="course">
                        <label for="textitem">Course</label>
                        <select name="course_id"  id="course_id" class=' form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);"  tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($courses as $course){
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if($details->stream_id == $courseStreamID){
                                        ?>
                                   
                                   <option value="<?php echo $courseIDs;?>" <?php if (($isEdit) && ($details->course_id ==  $courseIDs)){echo "selected";}?>> <?php echo $courseName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                                  </select>
                    </div>
                              <div class="form-group col-sm-6 my-form-element" id="year">
                        <label for="textitem">Year</label>
                                    <!--<input type="number" placeholder="Only numbers" name="year" value="<?php if (@$isEdit) echo $details->year; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">-->
                                    <select name="year" id="year" class=' form-control' tabindex="-1" >
                                        <option value="" selected="selected">---Select Year---</option>
                                        <option value="1" <?php if (($isEdit) && ($details->year == '1')){echo "selected";}?>> 1 </option>
                                        <option value="2" <?php if (($isEdit) && ($details->year == '2')){echo "selected";}?>> 2 </option>
                                        <option value="3" <?php if (($isEdit) && ($details->year == '3')){echo "selected";}?>> 3 </option>
                                        <option value="4" <?php if (($isEdit) && ($details->year == '4')){echo "selected";}?>> 4 </option>
                                        <option value="5" <?php if (($isEdit) && ($details->year == '5')){echo "selected";}?>> 5 </option>
                                        <option value="6" <?php if (($isEdit) && ($details->year == '6')){echo "selected";}?>> 6 </option>
                                        <option value="7" <?php if (($isEdit) && ($details->year == '7')){echo "selected";}?>> 7 </option>
                                        <option value="8" <?php if (($isEdit) && ($details->year == '8')){echo "selected";}?>> 8 </option>
                                        <option value="9" <?php if (($isEdit) && ($details->year == '9')){echo "selected";}?>> 9 </option>
                                        <option value="10" <?php if (($isEdit) && ($details->year == '10')){echo "selected";}?>> 10 </option>
                                    </select>
                                </div>
                       
                    <div class="form-group col-sm-6 my-form-element" id="semester">
                        <label for="textitem">Semester</label>
                                        <!--<input type="number" placeholder="Only numbers" name="semester" value="<?php if (@$isEdit) echo $details->semester; ?>" id="numberfield" data-rule-number="true" class="form-control" >-->
                                    <select name="semester" id="semester" class='select2_single form-control' tabindex="-1" >
                                        <option value="" selected="selected">---Select Semester---</option>
                                        <option value="1" <?php if (($isEdit) && ($details->semester == '1')){echo "selected";}?>> 1 </option>
                                        <option value="2" <?php if (($isEdit) && ($details->semester == '2')){echo "selected";}?>> 2 </option>
                                        <option value="3" <?php if (($isEdit) && ($details->semester == '3')){echo "selected";}?>> 3 </option>
                                        <option value="4" <?php if (($isEdit) && ($details->semester == '4')){echo "selected";}?>> 4 </option>
                                        <option value="5" <?php if (($isEdit) && ($details->semester == '5')){echo "selected";}?>> 5 </option>
                                        <option value="6" <?php if (($isEdit) && ($details->semester == '6')){echo "selected";}?>> 6 </option>
                                        <option value="7" <?php if (($isEdit) && ($details->semester == '7')){echo "selected";}?>> 7 </option>
                                        <option value="8" <?php if (($isEdit) && ($details->semester == '8')){echo "selected";}?>> 8 </option>
                                        <option value="9" <?php if (($isEdit) && ($details->semester == '9')){echo "selected";}?>> 9 </option>
                                        <option value="10" <?php if (($isEdit) && ($details->semester == '10')){echo "selected";}?>> 10 </option>
                                    </select>
                                </div>
                      
                    <div class="form-group col-sm-6 my-form-element" id="department">
                        <label for="textitem">Department</label>
                       <select name="department_id"  id="department_id" class=' form-control' onchange="setDepartment(document.addEditform.department_id.options[document.addEditform.department_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="" selected="selected">---Select Department---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($departments as $department){
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;
                                            if($details->course_id == $departmentCourseID){
                                        ?>
                                   <option value="<?php echo $departmentID;?>" <?php if (($isEdit) && ($details->department_id ==  $departmentID)){echo "selected";}?>> <?php echo $departmentName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                        </select>
                    </div>
                    <div class="form-group col-sm-6 my-form-element" id="subject">
                        <label for="textitem">Subject</label>
                        <select name="subject_id" id="subject_id" class='subject_id select2_single form-control' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="" selected="selected">---Select Subject---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($subjects as $subject){
                                            $subjectIDs = $subject->subject_id;
                                            $subjectBoard_id = $subject->board_id;
                                            $subjectLevel_id = $subject->level_id;
                                            $subjectStream_id = $subject->stream_id;
                                            $subjectCourseID = $subject->course_id;
                                            $subjectDepartment_id = $subject->department_id;
                                            $subject_year = $subject->year;
                                            $subjectName = $subject->subject_name;
                                            if($details->course_id == $subjectCourseID){
                                        ?>
                                   
                                   <option value="<?php echo $subjectIDs;?>" <?php if (($isEdit) && ($details->subject_id ==  $subjectIDs)){echo "selected";}?>> <?php echo $subjectName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                                  </select>
                    </div>
                    <div class="form-group col-sm-6 my-form-element" id="chapter">
                        <label for="textitem">Chapters</label>
                        <select name="chapter_id"  id="chapter_id" class='select2_single form-control' onchange="setChapter(document.addEditform.chapter_id.options[document.addEditform.chapter_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Chapter---</option>
                                    <!--
                                        <1?php if($isEdit){
                                        $chapter=$this->db->query("select * from hya_course_chapter where department_id=$details->department_id AND stream_id=$details->stream_id AND level_id=$details->level_id AND board_id=$details->board_id AND subject_id=$details->subject_id AND status=1")->result();
                                        $year=$department->year;
                                        foreach($chapter as $c){
                                            ?>
                                    <option <1?php if (($isEdit) && ($details->chapter_id ==  $c->chapter_id)){echo "selected";}?> value="<1?php echo $c->chapter_id;?>"><1?php echo $c->chapter_name;?></option>
                                    <1?php
                                        }
                                    }?>
                                    -->
                                    
                                    <?php if(!empty($isEdit)){
                                        foreach($chapters as $chapter){
                                            $chapterIDs = $chapter->chapter_id;
                                            $chapterBoard_id = $chapter->board_id;
                                            $chapterLevel_id = $chapter->level_id;
                                            $chapterStream_id = $chapter->stream_id;
                                            $chapterCourseID = $chapter->course_id;
                                            $chapterDepartment_id = $chapter->department_id;
                                            $chapterSubject_id = $chapter->subject_id;
                                            $chapterName = $chapter->chapter_name;
                                            if($details->subject_id == $chapterSubject_id){
                                        ?>
                                   
                                   <option value="<?php echo $chapterIDs;?>" <?php if (($isEdit) && ($details->chapter_id ==  $chapterIDs)){echo "selected";}?>> <?php echo $chapterName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                                  </select>
                    </div>
                    <div class="form-group col-sm-6 my-form-element" id="unit">
                        <label for="textitem">Units</label>
                        <select name="course_id"  id="course_id" class=' form-control' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);"  tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($courses as $course){
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if($details->stream_id == $courseStreamID){
                                        ?>
                                   
                                   <option value="<?php echo $courseIDs;?>" <?php if (($isEdit) && ($details->course_id ==  $courseIDs)){echo "selected";}?>> <?php echo $courseName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                                  </select>
                    </div>
                    <div class="form-group col-sm-6 my-form-element" id="subunit">
                        <label for="textitem">Sub Units</label>
                        <select name="course_id"  id="course_id" class=' form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);"  tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php if(!empty($isEdit)){
                                        foreach($courses as $course){
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if($details->stream_id == $courseStreamID){
                                        ?>
                                   
                                   <option value="<?php echo $courseIDs;?>" <?php if (($isEdit) && ($details->course_id ==  $courseIDs)){echo "selected";}?>> <?php echo $courseName;?> </option>
                                      <?php
                                            }
                                        }
                                    }
                                    ?>  
                                  </select>
                    </div>
                        
                    
                    
                    
                    
                    <div class="form-group col-sm-6 my-form-element">
                       <label for="textitem">Set</label>
                       <select name="set">
                           <option value="A">A</option>
                           <option value="B">B</option>
                           <option value="C">C</option>
                       </select>   
                    </div>
                    <div class="row">
                            
                       </div>
                     <div class="form-group col-sm-6 my-form-element">
                       <label for="textitem">Question Tags</label>
                       <select name="question_tag">
                           <option value="very_short">Very Short</option>
                           <option value="short">Short</option>
                           <option value="long">Long</option>
                           <option value="theory">Theoritical</option>
                           <option value="practical">Practical</option>
                           <option value="short_note">Write Short Note</option>
                       </select> 
                       </div>
                    
            </div>
                
                     <div class="form-group col-sm-4 my-form-element">
                       <label for="textitem">Appeared Year</label>
                       <select name="appeared_year" class="ui-datepicker-year" data-event="change" data-handler="selectYear">
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option selected="selected" value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
</select>
                       <!--<input type="text" id="datepicker" class="form-control" name="template_title" value="<?php if (@$isEdit) echo $template_details->template_title; ?>" data-rule-required="true" />-->
                    </div>
                     <div class="form-group col-sm-4 my-form-element">
                         <label for="textitem">Marks</label>
                        <input type="text" class="form-control" name="mark" value="<?php if (@$isEdit) echo $template_details->template_title; ?>" data-rule-required="true" />
                    </div>
                    
<div class="row listContainer" id="myListsTable">
                <div class="form-group col-sm-9 my-form-element">
                        <label for="textitem">Question</label>
                        <textarea name="template_description" id="template_description" class="form-control ckeditor"><?php
                            if (@$isEdit) {
                                echo $template_details->template_description;
                            }
                            ?>
                        </textarea>
                </div>
                                                <div class="form-group col-sm-3 my-form-element">
                                                   <label for="textitem">Question Type</label>
                                                    <select name="question_type" class="form-control myselectbox" id="<?php echo $i; ?>">
                                                        <option value="">Select Type</option>
                                                        <option value="Text Entry" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Text Entry") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Text Entry</option>
                                                        <option value="Image" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Image") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Image</option>
                                                        <option value="Video" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Video") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Video</option>
                                                        <option value="Drop Down" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Drop Down") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Drop Down</option>
                                                        <option value="Radio Buttons" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Radio Buttons") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Radio Buttons</option>
                                                        <option value="Checkboxes" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Checkboxes") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Checkboxes</option>


                                                    </select>
                                                </div>
                                            </div>
                    <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='select2_single form-control' tabindex="-1" >
                                    <option value="1" <?php if (($isEdit) && ($details->status == '1')){echo "selected";}?>> Active </option>
                                    <option value="0" <?php if (($isEdit) && ($details->status == '0')){echo "selected";}?>> InActive </option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <button type="submit" name="submitTemplate" class="btn btn-primary submit-btn pull-right" id="next" value="Next">Next</button>
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                        <button type="button" class="btn">Cancel</button>
                    </div>
                
            </div>
        </div>
    </div>
<div class="row" id="second_form">
    <button type="button" onclick="add('subquestion')">Sub Question Option</button>
    <div id="subquestion-1" class="subquestion">
    <button type="button" onclick="addSub('option','1')">Add Option</button>
    <div id="option"></div>
    <button type="button" onclick="addSub('hint','1')">Add Hint</button>
    <div id="hint"></div>
    <button type="button" onclick="addSub('answer','1')">Add Answer</button>
    <div id="answer"></div>
    <button type="button" onclick="addSub('reason','1')">Add Reason</button>
    <div id="reason"></div>
    <button type="button" onclick="addSub('description','1')">Add Description</button>
    <div id="description"></div>
    </div>
    
    
    
    <div id="withoutSubquestion">
    <button type="button" onclick="add('option')">Add Option</button>
    <div id="option"></div>
    <button type="button" onclick="add('hint')">Add Hint</button>
    <div id="hint"></div>
    <button type="button" onclick="add('answer')">Add Answer</button>
    <div id="answer"></div>
    <button type="button" onclick="add('reason')">Add Reason</button>
    <div id="reason"></div>
    <button type="button" onclick="add('description')">Add Description</button>
    <div id="description"></div>
    </div>
    <div class="form-group col-sm-12 my-form-element">
        <input type="submit" name="submitQuestion" class="btn btn-primary" value="Save"/>
                        <button type="button" class="btn" id="cancel">Cancel</button>
    </div>
</div>
</form>
  <script>
      function add(option)
      {
          if(option==='subquestion'){
              
              var visible=$(".subquestion").is(":visible");
              if(visible){
                  var i=$(".subquestion").length;
                  //console.log(i);
                  var subquestion='<textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea><a class="btn btn-danger delete"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a>';
                    
                  subquestion +="<div id='subquestion-"+(i+1)+"'>"; 
                  subquestion +='<button type="button" onclick="addSub(\'option\','+(i+1)+')">Add Option</button><div id="option"></div>';
                  subquestion +='<button type="button" onclick="addSub(\'hint\','+(i+1)+')">Add Hint</button><div id="hint"></div>';
                  subquestion +='<button type="button" onclick="addSub(\'answer\','+(i+1)+')">Add Answer</button><div id="answer"></div>';
                  subquestion +='<button type="button" onclick="addSub(\'reason\','+(i+1)+')">Add Reason</button><div id="reason"></div>';
                  subquestion +='<button type="button" onclick="addSub(\'description\','+(i+1)+')">Add Description</button><div id="description"></div>';
                  
                $('.subquestion').append(subquestion);
              }
                  
                else{
                    $("#subquestion-1").show();
                    $('#withoutSubquestion').hide();
                    var input='<textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea><a class="btn btn-danger delete"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a>';
                    $('#subquestion-1').prepend(input);
                    return;
                }      
                  
             
             
          }
          var input="<input class='form-control' data-rule-required='true' type='text' name='"+option+"[]' value='"+option+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          $('#'+option).append(input);
      }
      
      
      function addSub(suboption,num)
      {
          var input="<input class='form-control' data-rule-required='true' type='text' name='subquestion["+suboption+"]["+num+"][]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          
//          var input="<input class='form-control' data-rule-required='true' type='text' name='"+suboption+"[]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          $('#subquestion-'+num).find('#'+suboption).append(input);
      }
      
  $(function() {
    $( "#datepicker" ).datepicker({
        
            dateFormat:'yy',
        
      changeMonth: true,
      changeYear: true
    });
    $(".delete").bind('click',function(){
        alert("delete");
    })
  });
  </script>

