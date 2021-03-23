<script>
    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        var selboxCourse = document.addEditform.course_id;
        
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
            selboxCourse.options[selbox.options.length] = new Option('--Select Course--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
        selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
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
            
        
                
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $courseBoard_id = $course->board_id;
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseBoard_id?>){
            selboxCourse.options[selboxCourse.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
                
        
        
    }
    // set option for stream using levels
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        var selboxCourse = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxDepartment.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
            selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
        selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
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
            }
        }
        ?>
                
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseLevel_id?>){
            selboxCourse.options[selboxCourse.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
        
        
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentLevel_id = $department->level_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentLevel_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
        }
        ?>
    }
    // set option for stream using levels
    function setStream(chosen) {
        var selbox = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        <?php
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
                
                <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentLevel_id = $department->level_id;
                $departmentStream_id = $department->stream_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentStream_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
    
    function setCourse(chosen) {
        
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
        }
        
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
    
    function setSubject(chosen) {
        var selbox = document.addEditform.chapter_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
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
    
    
    
    
</script>

<?php $isEdit = isset($details) ? true : false; ?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <?php echo $page_title;?>
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">

                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" enctype='multipart/form-data' >
                        
                
                        <span class="section">Please Complete the information below</span>
<div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Board<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="board_id"  id="page_type" class=' form-control' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Board---</option>
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
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Level<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Stream</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="stream_id"  id="stream_id" class=' form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);">
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
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Course</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="course_id"  id="course_id" class=' form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
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
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Department</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="department_id"  id="department_id" class=' form-control'>
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
                        </div>
                                                                        
                        
                        <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Year</label>
                           
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="year"  id="year" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Year---</option>
                                    <?php if($isEdit){
                                        $coursed=$this->db->query("select * from hya_course_course where course_id=$details->course_id")->row();
                                        $year=$coursed->year;
                                        for($i=1;$i<=$year;$i++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->year ==  $i)){echo "selected";}?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                        }
                                    }?>
                                    
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="semester"  id="semester" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Semester---</option>
                                       <?php if($isEdit){
                                        $coursed=$this->db->query("select * from hya_course_course where course_id=$details->course_id")->row();
                                        $semester=$coursed->semester;
                                        for($j=1;$j<=$semester;$j++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->semester ==  $j)){echo "selected";}?> value="<?php echo $j;?>"><?php echo $j;?></option>
                                    <?php
                                        }
                                    }?>
                                  </select>
                                </div>
                        </div>
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Year</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" placeholder="Only numbers" name="year" value="<?php if (@$isEdit) echo $details->year; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
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
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" placeholder="Only numbers" name="semester" value="<?php if (@$isEdit) echo $details->semester; ?>" id="numberfield" data-rule-number="true" class="form-control" >
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
                        </div>-->
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id">Select Subject<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Chapter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="chapter_id"  id="chapter_id" class='select2_single form-control' tab-index="-1" data-rule-required="true">
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
                        </div>
<!--                        <div class="item form-group" >
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unit Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="unit">
                                <input type="text" name="unit_name[]" id="page_title"  value="<?php if (@$isEdit) {echo $details->unit_name;}?>" class="unit slug_name form-control col-md-7 col-xs-12" placeholder="Unit Name" data-rule-required="true" data-rule-minlength="2"><br/><br/>
                                <div style="margin-left:30px;">
                                    <?php if(!empty($subunits)&& $isEdit):
                                        foreach($subunits as $s):
                                        ?>
                                    
                                    <input type="text" name="subunit_name[0][]" id="page_title" value="<?php echo $s->subunit_name;?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Sub Unit Name" data-rule-required="true" ><br/><br/>
                                <?php 
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                          <?php   if(!$isEdit):
                              ?>
                           
                            <a id="addUnit" class="btn btn-primary">Add More Unit</a>
                            
                             <?php
                          endif;
                          ?>
                            <a id="addSubUnit" class="btn btn-primary">Add Sub Unit</a>
                        </div>-->

                        <hr>
<!--                        <div class="item form-group" >
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unit Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="unit">
                                <input type="text" name="unit_name[]" id="page_title"  value="<?php if (@$isEdit) {echo $details->unit_name;}?>" class="unit slug_name form-control col-md-7 col-xs-12" placeholder="Unit Name" data-rule-required="true" data-rule-minlength="2">
                                <div style="margin-left:30px;">
                                    <?php if(!empty($subunits)&& $isEdit):
                                        foreach($subunits as $s):
                                        ?>
                                    
                                    <input type="text" name="subunit_name[0][]" id="page_title" value="<?php echo $s->subunit_name;?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Sub Unit Name" data-rule-required="true" >
                                <?php 
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                          <?php   if(!$isEdit):
                              ?>
                           
                            <a id="addUnit" class="btn btn-primary">Add More Unit</a>
                            
                             <?php
                          endif;
                          ?>
                            <a id="addSubUnit" class="btn btn-primary">Add Sub Unit</a>
                        </div>-->
                        
                        <div class="item form-group" id="unit">
                            <a id="addUnit" class="btn btn-primary">Add More Unit</a>
<!--                            <a id="addSubUnit" class="btn btn-primary">Add Sub Unit</a>-->
                            <br>
                            <div class="input-group col-md-6 col-sm-6 col-xs-12" >
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary">Unit 1</button>
                                </span>
                                <input type="text" name="unit_name[]" id="<?php if (@$isEdit) {echo $details->unit_id;}?>" value="<?php if (@$isEdit) {echo $details->unit_name;}?>" class="unit form-control col-md-7 col-xs-12" placeholder="Unit 1" data-rule-required="true" data-rule-minlength="2">
                                <span class="input-group-btn">
                                    <a id="1" class="addSubUnit btn btn-warning">Add Sub Unit <i class="fa fa-angle-double-down"></i></a>
                                </span>
                            </div>
                            
                            
                            <?php
                                if (!empty($subunits) && $isEdit):
                                    $count = 1;
                                    foreach ($subunits as $s):
                            ?>
                            <div style="margin-left:30px;" >
                                <div class="input-group col-md-6 col-sm-6 col-xs-12" >
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info">Sub-unit </button>
                                    </span>
                                    <input type="text" name="subunit_name[0][]" id="<?php echo $s->subunit_id; ?>" value="<?php echo $s->subunit_name; ?>" class=" form-control col-md-7 col-xs-12" placeholder="Sub Unit " data-rule-required="true" >
                                    <span class="input-group-btn">
                                        <button type="button" class="remove_subunit btn btn-danger" id="<?php echo $s->subunit_id; ?>"><i class="fa fa-close"></i></button>
                                    </span>
                                </div>
                            </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                                

                        </div>
                        <hr>


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
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" name="submit" class="btn btn-success" value="Save">
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("a.cancel").click(function(){
    alert("clicables");
})
})
$(function() { //run on document.ready
$("#level_id").change(function() { //this occurs when select 1 changes
        
        $.ajax({
            method: "post",
            dataType:'json',
            data: {'level_id': $(this).val()},
            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                //console.log(data.yearOption);
                var yearOption='';
                var semesterOption='';
                if(data.yearOption !==0){
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                        for(var j=1;j<=data.semesterOption;j++){
                            semesterOption +="<option value="+j+">"+j+"</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                }
                
                $("#year").html(yearOption);
                $("#semester").html(semesterOption);
            }

        });
        
  });
  
  
  $("#course_id").change(function() { //this occurs when select 1 changes
        
        $.ajax({
            method: "post",
            dataType:'json',
            data: {'course_id': $(this).val()},
            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                //console.log(data.yearOption);
                var yearOption='';
                var semesterOption='';
                if(data.yearOption !==0){
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                        for(var j=1;j<=data.semesterOption;j++){
                            semesterOption +="<option value="+j+">"+j+"</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                }
                
                $("#year").html(yearOption);
                $("#semester").html(semesterOption);
            }

        });
        
  });
  $("#subject").change(function() { //this occurs when select 1 changes
      var data ='';
      var key ,val;
      $("select option:selected").each(function () {
          if($(this).parent('select').attr('name')==='chapter_id'){
              return false;
          }
          key=$(this).parent('select').attr('name');
          val=$(this).val();
          data +=key+"="+val + ' AND  ';
          //console.log($(this).parent('select').attr('name') +":"+$(this).val());
      })
        $.ajax({
            method: "post",
            dataType:'json',
            data: data,
            url: "<?php echo base_url(); ?>course/ajaxSelectchapter",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
               var chapter='<option value="" selected="selected">---Select Chapter---</option>';
                if(data.length !==0){
                    $.each(data, function( key, value ) {
                        
                            chapter +="<option value="+value.chapter_id+">"+value.chapter_name+"</option>";
                        
                      
                      });
                }
               
                
                
                $("#chapter").html(chapter);
            }

        });
        
  });
  
  var i=2;
  var j=1;
    $('#addUnit').click(function(){
    add ='<div class="input-group col-md-6 col-sm-6 col-xs-12" >';
        add +='<span class="input-group-btn">';
            add +='<button type="button" class="btn btn-primary">Unit '+i+'</button>';
        add +='</span>';
        add +='<input type="text" name="unit_name[]" id="1" value="" class="form-control col-md-7 col-xs-12" placeholder="Unit '+i+'" data-rule-required="true" data-rule-minlength="2">';
        add +='<span class="input-group-btn">';
            add +='<a id="'+i+'" class="addSubUnit btn btn-warning">Add Sub Unit <i class="fa fa-angle-double-down"></i></a>';
        add +='</span>';
    add +='</div>';
                    
      //var add='<input type="text" name="unit_name[]" id="page_title" value="" class="unit slug_name form-control col-md-7 col-xs-12" placeholder="Unit Name" data-rule-required="true" ><br/><br/>';
      $("#unit").append(add).focus();
      i++;
    });
    $('.addSubUnit').click(function(){
        var unit=$('.unit').length;
        
        console.log($('.unit').length)
        if(($('.unit').length)===1){
            unit=0;
        }
        else{
             unit=($('.unit').length)-1;
        }

alert(unit);
        console.log(unit);
        add ='<div style="margin-left:30px;">';
        add +='<div class="input-group col-md-6 col-sm-6 col-xs-12" >';
        add += '<span class="input-group-btn">';
            add +='<button type="button" class="btn btn-info">Sub-unit </button>';
        add +='</span>';
            add +='<input type="text" name="subunit_name[0][]" id="page_title" value="" class="form-control col-md-7 col-xs-12" placeholder="Sub Unit " data-rule-required="true" >';
        add +='<span class="input-group-btn">';
            add +='<button type="button" class="remove_subunit btn btn-danger"><i class="fa fa-close"></i></button>';
        add +='</span>';
        add +='</div>';
        add +='</div>';
        //var add='<div style="margin-left:30px;"><input type="text" name="subunit_name['+unit+'][]" id="page_title" value="" class="slug_name form-control col-md-7 col-xs-12" placeholder="Sub Unit Name" data-rule-required="true" ></div><br/><br/>';
        $("#unit").append(add).focus();
        j++;
    });
  $("#unit").on("click",".remove_subunit", function(e){ //user click on remove text
        var _sunit_id = $(this).attr('id');
        
        $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
        $.get('<?php echo base_url("course/delete_ajax_subunit"); ?>', {sunit_id: _sunit_id},
        function (data) {
            //_this.text(data);
            $('a#' + _sunit_id + '').addClass(data);
            //$('.cross').hide();
        });
         e.preventDefault(); 
         $(this).parent('span').parent('div').parent('div').remove(); j--;
        
    })

  $('select').change(function(){
      if($(this).attr('name')==='chapter_id' || $(this).attr('name')==='subject_id'){
          return false;
      }
      var data ='';
      var key ,val;
      $("select option:selected").each(function () {
          if($(this).parent('select').attr('name')==='subject_id'){
              return false;
          }
          key=$(this).parent('select').attr('name');
          val=$(this).val();
          data +=key+"="+val + ' AND  ';
          //console.log($(this).parent('select').attr('name') +":"+$(this).val());
      })
      
     // alert($(this).val());
      $.ajax({
            method: "post",
            dataType:'json',
            //data:{'board_id':1,'department_id':0},
           data:data,
            url: "<?php echo base_url(); ?>course/ajaxSelectSubjectFromUnit",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                console.log(data);
                var subject='<option value="0" selected="selected">---Select Subject---</option>';
                var chapter='<option value="0" selected="selected">---Select Chapter---</option>';
                if(data.subject.length !==0){
                    $.each(data.subject, function( key, value ) {
                        
                            subject +="<option value="+value.subject_id+">"+value.subject_name+"</option>";
                        
                      
                      });
                            
                                
                                
            
           
        
                }
                if(data.chapter.length !==0){
                    $.each(data.chapter, function( key1, value1 ) {
                        
                            chapter +="<option value="+value1.chapter_id+">"+value1.chapter_name+"</option>";
                        
                      
                      });
                            
                                
                                
            
           
        
                }
                
                
                $("select[name=subject_id]").html(subject);
                $("#chapter").html(chapter);
                
            }

        });
  })
  });
</script>