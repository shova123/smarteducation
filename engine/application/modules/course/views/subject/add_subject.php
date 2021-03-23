<?php
if(!empty($this->session->userdata("subject_board_id"))){
    $s_board_id = $this->session->userdata("subject_board_id");
    $s_level_id = $this->session->userdata("subject_level_id");
    $s_stream_id = $this->session->userdata("subject_stream_id");
    $s_course_id = $this->session->userdata("subject_course_id");
    $s_department_id = $this->session->userdata("subject_department_id");
    $s_year = $this->session->userdata("subject_year");
    $s_semester = $this->session->userdata("subject_semester");
}

?>

<script>
    function setBoard(chosen) {
            var selbox = document.addEditform.level_id;
            //var selboxStream = document.addEditform.stream_id;
            var selboxCourse = document.addEditform.course_id;
            //var selboxDepartment = document.addEditform.department_id;

            selbox.options.length = 0;
            //selboxStream.options.length = 0;
            selboxCourse.options.length = 0;
            //selboxDepartment.options.length = 0;
            if (chosen == " ") {
                selbox.options[selbox.options.length] = new Option("--Select Level--", " ");
                //selboxStream.options[selbox.options.length] = new Option("--Select Stream--"," ");
                selboxCourse.options[selbox.options.length] = new Option("--Select Course--", " ");
                //selboxDepartment.options[selbox.options.length] = new Option("--Select--"," ");
            }
            selbox.options[selbox.options.length] = new Option("--Select Level--", " ");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", " ");
    <?php
    if (!empty($levels)) {
        foreach ($levels as $level) {
            $levelBoard_id = $level->board_id;
            $level_id = $level->level_id;
            $level_name = $level->level_name;
            ?>

                    if (chosen == <?php echo $levelBoard_id ?>) {
                        selbox.options[selbox.options.length] = new Option("<?php echo $level_name; ?>", "<?php echo $level_id; ?>");
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

                    if (chosen == <?php echo $courseBoard_id ?>) {
                        selboxCourse.options[selboxCourse.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select Stream--"," ");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--"," ");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--"," ");
        }
        selbox.options[selbox.options.length] = new Option("--Select Stream--"," ");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--"," ");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--"," ");
        <?php
        if (!empty($streams)) {
            foreach ($streams as $stream) {
                $stream_id = $stream->stream_id;
                $streamLevel_id = $stream->level_id;
                $stream_name = $stream->stream_name;
        ?>
                                                                                
        if (chosen == <?php echo $streamLevel_id?>){
            selbox.options[selbox.options.length] = new Option("<?php echo $stream_name; ?>","<?php echo $stream_id; ?>");
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
            selboxCourse.options[selboxCourse.options.length] = new Option("<?php echo $course_name; ?>","<?php echo $course_id; ?>");
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
            selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>","<?php echo $department_id; ?>");
        }
        <?php
            }
        }
        ?>
        
//        $.ajax({
//            method: "post",
//            dataType:"json",
//            data: {"level_id": chosen},
//            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
//            beforeSend: function () {
//                $(".loader-image").show();
//            },
//            success: function (data) {
//                var yearOption="";
//                var semesterOption="";
//                if(data.yearOption !==0){
//                        for(var i=1;i<=data.yearOption;i++){
//                            yearOption +="<option value="+i+">"+i+"</option>";
//                        }
//                }
//                if(data.semesterOption !==0){
//                        for(var j=1;j<=data.semesterOption;j++){
//                            semesterOption +="<option value="+j+">"+j+"</option>";
//                        }
//                }
//                
//                $("#year").html(yearOption);
//                $("#semester").html(semesterOption);
//            }
//        });



    }
    // set option for stream using levels
    function setStream(chosen) {
        var selbox = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--"," ");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--"," ");
        }
        selbox.options[selbox.options.length] = new Option("--Select Course--"," ");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--"," ");
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseStream_id?>){
            selbox.options[selbox.options.length] = new Option("<?php echo $course_name; ?>","<?php echo $course_id; ?>");
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
            selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>","<?php echo $department_id; ?>");
        }
        <?php
            }
        }
        ?>
        
    }
    
    function setCourse(chosen) {
        var selbox = document.addEditform.department_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--"," ");
        }
        selbox.options[selbox.options.length] = new Option("--Select Department--"," ");
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentCourse_id?>){
            selbox.options[selbox.options.length] = new Option("<?php echo $department_name; ?>","<?php echo $department_id; ?>");
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
                <?php if(empty($isEdit)){?>
                <div class="row">
                    <div class="pull-right">
                        <a href="<?php echo base_url("course/reset_add_subject");?>" class="btn btn-dark">Reset Form</a>
                    </div>
                </div>
                <?php }?>
                <div class="x_content">

                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" enctype="multipart/form-data" >
                        
                
                        <span class="section">Please Complete the information below</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Board<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="board_id"  id="board_id" class=" form-control" onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="" selected="selected">---Select Board---</option>
                                    <?php if(!empty($boards)){
                                        foreach($boards as $board){
                                            $boardID = $board->board_id;
                                            $boardName= $board->board_name;
                                            $boardSlug = $board->board_slug;
                                            $boardAlias = $board->board_alias;
                                        ?>
                                   
                                   <option value="<?php echo $boardID;?>" <?php if (($isEdit) && ($details->board_id == $boardID)){echo "selected";}elseif (!empty($s_board_id) && ($s_board_id == $boardID)){echo "selected";}?>> <?php echo $boardName;?> </option>
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
                                <select name="level_id" id="level_id" class="form-control" onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Level---</option>
                                    <?php if(!empty($isEdit) || $s_level_id){
                                        foreach($levels as $level){
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;
                                            
                                            if(!empty($isEdit)){$editAddBoardID = $details->board_id;}
                                            if(!empty($s_board_id)){$editAddBoardID = $s_board_id;}
                                            
                                            if($editAddBoardID == $levelBoardID){
                                        ?>
                                   
                                   <option value="<?php echo $levelID;?>" <?php if (($isEdit) && ($details->level_id ==  $levelID)){echo "selected";}elseif(!empty($s_level_id) && ($s_level_id == $levelID)){echo "selected";}?>> <?php echo $level->level_name;?> </option>
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
                                <select name="stream_id" id="stream_id" class=" form-control" onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);">
                                    <option value="" selected="selected">---Select Stream---</option>
                                    <?php if(!empty($isEdit) || $s_stream_id){
                                        foreach($streams as $stream){
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;
                                            
                                            if(!empty($isEdit)){$editAddLevelID = $details->level_id;}
                                            if(!empty($s_level_id)){$editAddLevelID = $s_level_id;}
                                            
                                            if($editAddLevelID == $streamLevelID){
                                        ?>
                                   
                                   <option value="<?php echo $streamID;?>" <?php if (($isEdit) && ($details->stream_id ==  $streamID)){echo "selected";}elseif(!empty($s_stream_id) && ($s_stream_id == $streamID)){echo "selected";}?>> <?php echo $streamName;?> </option>
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
                                <select name="course_id"  id="course_id" class=" form-control" onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php if(!empty($isEdit) || $s_course_id){
                                        foreach($courses as $course){
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            
                                            if(!empty($isEdit)){$editAddStreamID = $details->stream_id;}
                                            if(!empty($s_stream_id)){$editAddStreamID = $s_stream_id;}
                                            
                                            if($editAddStreamID == $courseStreamID){
                                        ?>
                                   
                                   <option value="<?php echo $courseIDs;?>" <?php if (($isEdit) && ($details->course_id ==  $courseIDs)){echo "selected";}elseif (!empty($s_course_id) && ($s_course_id == $courseIDs)){echo "selected";}?>> <?php echo $courseName;?> </option>
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
                                <select name="department_id"  id="department_id" class=" form-control">
                                    <option value="" selected="selected">---Select Department---</option>
                                    <?php if(!empty($isEdit) || $s_department_id){
                                        foreach($departments as $department){
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;
                                            
                                            if(!empty($isEdit)){$editAddCourseID = $details->course_id;}
                                            if(!empty($s_course_id)){$editAddCourseID = $s_course_id;}
                                            
                                            if($editAddCourseID == $departmentCourseID){
                                        ?>
                                   <option value="<?php echo $departmentID;?>" <?php if (($isEdit) && ($details->department_id ==  $departmentID)){echo "selected";}elseif (!empty($s_department_id) && ($s_department_id == $departmentID)){echo "selected";}?>> <?php echo $departmentName;?> </option>
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
                                <select name="year" id="year" class="form-control">
                                    <option value="" selected="selected">---Select Year---</option>
                                    <?php if($isEdit || $s_year){
                                        
                                        if(!empty($isEdit) && empty($s_year)){$streamIded = $details->stream_id;}
                                        if(!empty($s_year) && empty($isEdit)){$streamIded = $s_stream_id;}
                                        $streamed=$this->db->query("select * from hya_course_stream where stream_id=$streamIded")->row();
                                        $year=$streamed->year;
                                        for($i=1;$i<=$year;$i++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->year ==  $i)){echo "selected";}elseif(!empty($s_year) && ($s_year == $i)){echo "selected";}?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                        }
                                    }?>
                                    
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="semester" id="semester" class="select2_single form-control">
                                    <option value="" selected="selected">---Select Semester---</option>
                                       <?php if($isEdit || $s_semester){
                                           if(!empty($isEdit) && empty($s_semester)){$streamIded = $details->stream_id;}
                                        if(!empty($s_semester) && empty($isEdit)){$streamIded = $s_stream_id;}
                                           
                                        $streamed=$this->db->query("select * from hya_course_stream where stream_id=$streamIded")->row();
                                        $semester=$streamed->semester;
                                        for($j=1;$j<=$semester;$j++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->semester ==  $j)){echo "selected";}elseif (!empty($s_semester) && ($s_semester == $j)) {echo "selected";}?> value="<?php echo $j;?>"><?php echo $j;?></option>
                                    <?php
                                        }
                                    }?>
                                  </select>
                                </div>
                        </div>

                        <hr>
                        <div class="item form-group" id="subject">
                            <?php if(!$isEdit){?>
                                <a id="addSubject" class="btn btn-primary">Add More Subject</a>
                            <?php }?>
                            
                                
                            <div class="input-group col-md-6 col-sm-6 col-xs-12" >
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary">Subject 1</button>
                                </span>
                                
                                <input type="text" name="subject_name[]" id="subject_name1" value="<?php if (@$isEdit) {echo $details->subject_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Subject 1" data-rule-required="true" data-rule-minlength="2">
                                
                                
                            </div>
                          
                        </div>
                        <hr>
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->subject_order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>              -->

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class="form-control" data-rule-required="true">
                                    <option value="">--Select Status--</option>
                                    <option value="1" <?php if (($isEdit) && ($details->status == "1")){echo "selected";}else{echo "selected";}?>> Active </option>
                                    <option value="0" <?php if (($isEdit) && ($details->status == "0")){echo "selected";}?>> InActive </option>
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
                    yearOption +="<option value=''>Select Year</option>";
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                    semesterOption +="<option value=''>Select Semester</option>";
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
  
  $("#stream_id").change(function() { //this occurs when select 1 changes
        
        $.ajax({
            method: "post",
            dataType:'json',
            data: {'stream_id': $(this).val()},
            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                //console.log(data.yearOption);
                var yearOption='';
                var semesterOption='';
                if(data.yearOption !==0){
                    yearOption +="<option value=''>Select Year</option>";
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                    semesterOption +="<option value=''>Select Semester</option>";
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
                    yearOption +="<option value=''>Select Year</option>";
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                    semesterOption +="<option value=''>Select Semester</option>";
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
  
  var subNum =2;
  $('#addSubject').click(function(){
    var add ='<div class="input-group col-md-6 col-sm-6 col-xs-12" >';
        add +='<span class="input-group-btn">';
            add +='<button type="button" class="btn btn-primary">Subject '+subNum+'</button>';
        add +='</span>';
        add +='<input type="text" name="subject_name[]" id="subject_name'+subNum+'" value="" class="slug_name form-control col-md-7 col-xs-12" placeholder="Subject '+subNum+'" data-rule-required="true" data-rule-minlength="2">';
    add +='</div>';
  //var add='<input type="text" name="subject_name[]" id="subject_name" value="" class="slug_name form-control col-md-7 col-xs-12" placeholder="Subject Name" data-rule-required="true">';
  $("#subject").append(add).focus();
  subNum++;
  })
});
</script>