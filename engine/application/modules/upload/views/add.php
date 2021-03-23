<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/js/plugins/wizard/jquery.form.wizard.min.js"></script>
<script>
    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        var selboxCourse = document.addEditform.course_id;
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        var selboxUnit = document.addEditform.unit_id;

        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxSubject.options.length = 0;
        

        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Level--", "");
            selboxCourse.options[selbox.options.length] = new Option("--Select Course--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
         }
        selbox.options[selbox.options.length] = new Option("--Select Level--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
      
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




    }
    // set option for stream using levels
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        var selboxCourse = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        var selboxSubject = document.addEditform.subject_id;
       
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        

        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
           }
        selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        <?php
if (!empty($streams)) {
    foreach ($streams as $stream) {
        $stream_id = $stream->stream_id;
        $streamLevel_id = $stream->level_id;
        $stream_name = $stream->stream_name;
        ?>

                if (chosen == <?php echo $streamLevel_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $stream_name; ?>", "<?php echo $stream_id; ?>");
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

                if (chosen == <?php echo $courseLevel_id ?>) {
                    selboxCourse.options[selboxCourse.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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

                if (chosen == <?php echo $departmentLevel_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
                }
        <?php
    }
}
?>

<?php
if (!empty($subjects)) {
    foreach ($subjects as $subject) {
        $subject_idd = $subject->subject_id;
        $subjectBoard_id = $subject->board_id;
        $subjectLevel_id = $subject->level_id;
        $subject_name = $subject->subject_name;
        ?>

                if (chosen == <?php echo $subjectLevel_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
        var selboxSubject = document.addEditform.subject_id;
       
        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            }
        selbox.options[selbox.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        <?php
if (!empty($courses)) {
    foreach ($courses as $course) {
        $course_id = $course->course_id;
        $courseLevel_id = $course->level_id;
        $courseStream_id = $course->stream_id;
        $course_name = $course->course_name;
        ?>

                if (chosen == <?php echo $courseStream_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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

                if (chosen == <?php echo $departmentStream_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
                }
        <?php
    }
}
?>


<?php
if (!empty($subjects)) {
    foreach ($subjects as $subject) {
        $subject_idd = $subject->subject_id;
        $subjectBoard_id = $subject->board_id;
        $subjectStream_id = $subject->stream_id;
        $subject_name = $subject->subject_name;
        ?>

                if (chosen == <?php echo $subjectStream_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            
        }

        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        
<?php
if (!empty($departments)) {
    foreach ($departments as $department) {
        $department_id = $department->department_id;
        $departmentCourse_id = $department->course_id;
        $department_name = $department->department_name;
        ?>

                if (chosen == <?php echo $departmentCourse_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
                }
        <?php
    }
}


?>
   }


    function setYear(chosen) {
     
        var selboxChapter = document.addEditform.chapter_id;

        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;


        selboxSubject.options.length = 0;
       

        if (chosen == " ") {
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            
        }

        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        
<?php
if (!empty($subjects)) {
    foreach ($subjects as $subject) {
        $subject_boardID = $subject->board_id;
        $subject_levelID = $subject->level_id;
        $subject_streamID = $subject->stream_id;
        $subject_courseID = $subject->course_id;
        $subject_departmentID = $subject->department_id;
        $subject_year = $subject->year;

        $subject_idd = $subject->subject_id;
        $subject_name = $subject->subject_name;
        ?>

                if (boardID == <?php echo $subject_boardID ?> && levelID == <?php echo $subject_levelID ?> && streamID == <?php echo $subject_streamID ?> && chosen == <?php echo $subject_year ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
                }
        <?php
    }
}
?>


    }

    function setSemester(chosen) {

        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;

        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;
        var year = document.getElementById("year").value;


        selboxSubject.options.length = 0;
       

        if (chosen == " ") {
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
           
        }

        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
       
<?php
if (!empty($subjects)) {
    foreach ($subjects as $subject) {
        $subject_boardID = $subject->board_id;
        $subject_levelID = $subject->level_id;
        $subject_streamID = $subject->stream_id;
        $subject_courseID = $subject->course_id;
        $subject_departmentID = $subject->department_id;
        $subject_year = $subject->year;
        $subject_semester = $subject->semester;

        $subject_idd = $subject->subject_id;
        $subject_name = $subject->subject_name;
        ?>

                if (boardID == <?php echo $subject_boardID ?> && levelID == <?php echo $subject_levelID ?> && streamID == <?php echo $subject_streamID ?> && year == <?php echo $subject_year ?> && chosen == <?php echo $subject_semester ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
                }
        <?php
    }
}
?>



    }

    


</script>
<!--<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>-->
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/tinymce.min.js" language="javascript" type="text/javascript" ></script>
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/js/mathquill.min.js" type="text/javascript" ></script>
<script>
//tinymce.PluginManager.load('equationeditor', '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/plugin.min.js');

    tinymce.init({
        selector: 'textarea.questionFull',
        theme: 'modern',
        plugins: [
            'advlist autolink link image lists charmap eqneditor print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table insertdatetime save table contextmenu directionality emoticons paste textcolor',
            'code jbimages filemanager'
        ],
        //content_css: '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/mathquill.css',
        toolbar: [
            'newdocument | bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | print preview media fullpage | forecolor backcolor emoticons| styleselect formatselect fontselect fontsizeselect',
            'link image jbimages media | charmap eqneditor cut copy paste | bullist numlist outdent indent | blockquote | insertfile undo redo | removeformat subscript superscript'
        ],
        contextmenu: "cut copy paste link image inserttable | cell row column deletetable",
        //menubar:false,
        paste_merge_formats: false,
        paste_enable_default_filters: false,
        paste_remove_styles_if_webkit: false,
        

    });
</script>
<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">

<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#home_image').uploadifive({
            'auto': true, // Automatically upload a file when it's added to the queue
            'buttonClass': false, // A class to add to the UploadiFive button
            'buttonText': 'Upload Syllabus', // The text that appears on the UploadiFive button
            'checkScript': false, // Path to the script that checks for existing file names 
            'dnd': true, // Allow drag and drop into the queue
            'dropTarget': false, // Selector for the drop target
            'fileSizeLimit': '153600', // Maximum allowed size of files to upload
            'fileType': false, // Type of files allowed (image, etc)
            'width': 160,
            'height': 30,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'targetFolder': '/smart/uploads/syllabus/',
                'token': '<?php echo @md5('unique_salt' . $timestamp); ?>'
            },
            'method': 'post', // The method to use when submitting the upload
            'multi': false, // Set to true to allow multiple file selections
            'queueID': 'queueImage', // The ID of the file queue
            'queueSizeLimit': 0, // The maximum number of files that can be in the queue
            'removeCompleted': false, // Set to true to remove files that have completed uploading
            'simUploadLimit': 1, // The maximum number of files to upload at once
            'truncateLength': 0, // The length to truncate the file names to
            'uploadLimit': 0, // The maximum number of files you can upload
            'uploadScript': '<?php echo base_url(); ?>gears/admin/uploadifive/uploadifive.php',
            'onUploadComplete': function (file, data, response) {
                //console.log(data);//alert(data);
                imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/profile/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
                if ($('#fileList').val() != '') {//alert('full');
                    $('#fileList').val($('#fileList').val() + ':' + data);
                } else {//alert('blank');
                    $('#fileList').val(data);
                }
                //$('#submitDetails').val('Submit');
            }
        });
    });
//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
$(document).on('click', 'a#deleteImg', function () {
   		var _img = $(this).next().attr("title");//alert(_img);
		var _this = $(this).parent();
                delete_image(_img);
		$.post("<?php echo base_url("admin/upload/delete_syllabus_image");?>",{imgName:_img},
		function(data){
			$("i.info").text(data).fadeOut(1000);
			_this.fadeOut(1000, function() {			
			_this.remove();
			$("i.info").text('');
			$("i.info").removeAttr('style');
			  });
			});
		//$(this).parent().fadeOut(2500);
		//alert($('#fileList').val());
});

//THIS IS COMMON FUNCTION FOR DELETING FILE FORM THE LIST:
function delete_image(name){
	var filelist = $('#fileList').val();
	var filenames = filelist.split(':'); //alert(filenames.length);
	$('#fileList').val('');
	for(var i=0;i<filenames.length;i++)
	{
		if(filenames[i] != name)
		{	
			if($('#fileList').val()=='')
				$('#fileList').val(filenames[i]);
			else		
				$('#fileList').val($('#fileList').val()+':'+filenames[i]);
		}	
	}
}
</script>
<style>
    .tabbtn{margin-top: 2px !important;margin-right: 2px !important;margin-bottom: 0px !important;}
</style>
<?php $isEdit = isset($details) ? true : false; ?>


<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
<!--            <div class="row">
                <div class="pull-right">
                    <a href="<?php echo base_url("data/reset_add_question"); ?>" class="btn btn-dark">Reset Form</a>
                </div>
            </div>-->

            <div class="x_content">

                <form action="" method="POST" name="addEditform" id="addEditform" class="form-horizontal form-wizard" enctype='multipart/form-data' >
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
                     <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                        
<!--                    <input type="hidden" value="<?php //if (!empty($isEdit)) {echo $details->token;} else {echo md5(uniqid(mt_rand(), True));} ?>" name="token" />-->
                    <div class="step" id="firstStep">
                        <!--<div class="row" id="first_form">-->
                        <span class="section">Please Complete the information below</span>

                        <div class="item form-group">
                            <label class="control-label col-md-2" for="board_id">Select Board<span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="board_id" id="board_id" class='form-control board_id' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="false">
                                    <option value="">---Select Board---</option>
<?php
if (!empty($boards)) {
    foreach ($boards as $board) {
        $boardID = $board->board_id;
        $boardName = $board->board_name;
        $boardSlug = $board->board_slug;
        $boardAlias = $board->board_alias;
        ?>
                                            <option value="<?php echo $boardID; ?>" <?php if (!empty($details->board_id) && ($details->board_id == $boardID)) {
                                        echo "selected";
                                    } ?>><?php echo $boardName; ?> </option>
                                            <?php
                                        }
                                    }
                                    ?>    
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            <label class="control-label col-md-2" for="level_id">Select Level <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="level_id" id="level_id" class='form-control level_id' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="false">
                                    <option value="">---Select Level---</option>
                                    <?php
                                    if (!empty($details->level_id)) {
                                        foreach ($levels as $level) {
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;

                                            if (!empty($details->level_id) && ($details->level_id == $levelBoardID)) {
                                                ?>
                                                <option value="<?php echo $levelID; ?>" <?php if (!empty($details->board_id) && ($details->board_id == $levelID)) {
                                        echo "selected";
                                    } ?>> <?php echo $level->level_name; ?> </option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2" for="page_type">Select Stream</label>
                            <div class="col-md-4">
                                <select name="stream_id" id="stream_id" class='form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="false">
                                    <option value="">---Select Stream---</option>
                                    <?php
                                    if (!empty($details->stream_id)) {
                                        foreach ($streams as $stream) {
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;

                                            if (!empty($details->stream_id) && ($details->stream_id == $streamLevelID)) {
                                                ?>
                                                <option value="<?php echo $streamID; ?>" <?php if (!empty($details->stream_id) && ($details->stream_id == $streamID)) {
                                        echo "selected";
                                    } ?>> <?php echo $streamName; ?> </option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            <label class="control-label col-md-2" for="course_id">Select Course</label>
                            <div class="col-md-4">
                                <select name="course_id" id="course_id" class='form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="">---Select Course---</option>
                                    <?php
                                    if (!empty($details->course_id)) {
                                        foreach ($courses as $course) {
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if (!empty($s_stream_id) && ($s_stream_id == $courseStreamID)) {
                                                ?>
                                                <option value="<?php echo $courseIDs; ?>" <?php if (!empty($details->course_id) && ($details->course_id == $courseIDs)) {
                                        echo "selected";
                                    } ?>> <?php echo $courseName; ?> </option>
            <?php
        }
    }
}
?>  
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2" for="page_type">Select Department</label>
                            <div class="col-md-4">
                                <select name="department_id" id="department_id" class='form-control'>
                                    <option value="">---Select Department---</option>
                                    <?php
                                    if (!empty($details->department_id)) {
                                        foreach ($departments as $department) {
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;

                                            if (!empty($details->department_id) && ($details->department_id == $departmentCourseID)) {
                                                ?>
                                                <option value="<?php echo $departmentID; ?>" <?php if (!empty($details->department_id) && ($details->department_id == $departmentID)) {
                                        echo "selected";
                                    } ?>> <?php echo $departmentName; ?> </option>
            <?php
        }
    }
}
?>  
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="page_type">Select Year</label>

                            <div class="col-md-4">
                                <select name="year" id="year" class='form-control' onchange="setYear(document.addEditform.year.options[document.addEditform.year.selectedIndex].value);">
                                    <option value="">---Select Year---</option>
                                    <?php
                                    if ($details->year) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $year = $streamed->year;
                                        for ($i = 1; $i <= $year; $i++) {
                                            ?>
                                            <option <?php if (!empty($details->year) && ($details->year == $i)) {
                                                echo "selected";
                                            } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php
    }
}
?>
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="form-group">-->
                            <label class="control-label col-md-2" for="content">Select Semester</label>
                            <div class="col-md-4">
                                <select name="semester" id="semester" class='select2_single form-control' onchange="setSemester(document.addEditform.semester.options[document.addEditform.semester.selectedIndex].value);">
                                    <option value="">---Select Semester---</option>
                                    <?php
                                    if ($details->semester) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $semester = $streamed->semester;
                                        for ($j = 1; $j <= $semester; $j++) {
                                            ?>
                                            <option <?php if (!empty($details->semester) && ($details->semester == $j)) {
                                                echo "selected";
                                            } ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>
        <?php
    }
}
?>
                                </select>
                            </div>
                        </div>


                        <div class=" form-group">
                            <label class="control-label col-md-2" for="subject_id">Select Subject <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="subject_id" id="subject_id" class='subject_id form-control' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="false">
                                    <option value="">---Select Subject---</option>
                                    <?php
                                    if (!empty($details->subject_id)) {
                                        foreach ($subjects as $subject) {
                                            $subjectIDs = $subject->subject_id;
                                            $subjectBoardID = $subject->board_id;
                                            $subjectLevelID = $subject->level_id;
                                            $subjectStreamID = $subject->stream_id;
                                            $subjectCourseID = $subject->course_id;
                                            $subjectDepartment_id = $subject->department_id;
                                            $subject_year = $subject->year;
                                            $subjectName = $subject->subject_name;
                                            if (!empty($details->subject_id) && ($details->subject_id == $subjectLevelID) || !empty($details->stream_id) && ($details->stream_id == $subjectStreamID) || !empty($details->course_id) && ($details->course_id == $subjectCourseID)) {
                                                ?>

                                                <option value="<?php echo $subjectIDs; ?>" <?php if (!empty($details->subject_id) && ($details->subject_id == $subjectIDs)) {
                                                    echo "selected";
                                                } ?>> <?php echo $subjectName; ?> </option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="form-group">-->
                             <div class="form-group col-sm-6 my-form-element">
                                 <script>
                                $(document).ready(function () {
                                    $('#change_date').on('change', function () {
                                        if (this.value == 'bs')
                                        {
                                            $("#bs_date").show();
                                            $("#ad_date").hide();
                                        } else if (this.value == 'ad')
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
                                if (!empty($c_year_n)) {
                                    $previous_n_10Year = $c_year_n - 10;
                                    $after_n_10Year = $c_year_n + 10;
                                }
                                //echo $c_year_n;
                                ?>
                           
                                
                                    <!--<i class="fa fa-angle-down"></i>-->
                                    <!--<span class="">-->
                                    <select name="date_type" class="col-sm-4 btn btn-primary" id="change_date">
                                        <option value="">Date Type</option>
                                        <option value="bs" id="bs" <?php if (!empty($isEdit)) {
                                            if ($details->date_type == "bs") { ?>selected="selected" <?php }
                                        } elseif (empty($isEdit)) { ?>selected="selected" <?php } ?> >B.S.</option>
                                        <option value="ad" id="ad" <?php if (!empty($isEdit)) {
                                            if ($details->date_type == "ad") { ?>selected="selected" <?php }
                                        } ?>>A.D.</option>

                                    </select>
                                    <!--</span>-->

                                    <select name="appeared_year" id="ad_date" class="col-sm-6 ui-datepicker-year" style="display:none;" ><!-- data-event="change" data-handler="selectYear"-->
                                                        <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                                                                                    <option <?php if (!empty($isEdit)) {
                                                                if ($i == $details->appeared_year) { ?>selected="selected" <?php }
                                                            } elseif ($i == $c_year) { ?>selected="selected" <?php } ?> value="<?php echo $i ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                                                            </select>

                                                                                            <select name="appeared_year" id="bs_date" class="col-sm-6 ui-datepicker-year"><!-- data-event="change" data-handler="selectYear"-->
                                                        <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                                                                                    <option <?php if (!empty($isEdit)) {
                                                                if ($n == $details->appeared_year) { ?>selected="selected" <?php }
                                                            } elseif ($n == $c_year_n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                                        <?php } ?>
                                    </select>

                                
                          
                            </div>
                          
                        </div>

                        
                        <hr>

                        <div>

<div class="profile_img">
                                <div class="clearfix"></div>
                                <div id="queueImage"></div>
                                <div class="clearfix"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true">
                                <div class="clearfix"></div>
                                <div class="imagethumbs-form">
                                <?php 
                                if($isEdit){
                                        $imgname = $details->home_image;
                                        $img = explode(':',$imgname);
                                        if(!empty($imgname)){
                                            echo '';
                                            foreach($img as $i){
                                ?>
                                    <div class="imagethumb-form additional-file-input" id="add-image1">
                                        <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                        <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                            <?php echo $details->home_image;?>
                                        </a>  
                                    </div>
                                <?php       
                                            }
                                        } 
                                }
                                ?>
                                </div>


                            </div>
                            <div class="clearfix"></div>
                           
                            
                            <div class="row featureHolder" id="second_form">
                                <div class="x_panel" style="background-color: #f7f7f7;">
                                  
                                    
                                    <div class="form-actions">
                                        <input type="reset" class="btn" value="Back" id="back">
                                        <input type="submit" class="btn btn-primary" name="submitQuestion" value="Submit" id="next">
                                    </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        function initMCEall() {
                            tinymce.init({
                                selector: 'textarea',
                                plugins: [
                                    'link image charmap ',
                                    'wordcount fullscreen ',
                                    'paste',
                                    'filemanager'
                                ],
                                toolbar: [
                                    'bold italic underline | link image | charmap insertfile undo redo',
                                    'bullist numlist outdent indent | styleselect formatselect fontselect fontsizeselect'
                                ]
                            });
                        }

                        function add(option) {
                            var uniqTextID = Math.random();
                            if (option === 'subquestion') {
                                var visible = $(".subquestion").is(":visible");
                                if (visible) {
                                    var i = $(".subquestion").length;
                                    //console.log(i);
                                    var subquestion = '<div id="subquestion-' + (i + 1) + '" class="subquestion">';
                                    subquestion += '<div class="x_panel" style="background-color: #f7f7f7;">';
                                    subquestion += '<div class="x_title row" style="background-color: #73879c;color: #FFF;">';
                                    subquestion += '<h2 >Sub-Question ' + (i + 1) + '</h2>';
                                    subquestion += '<a class="btn btn-danger delete pull-right" onclick="remove_subquestion(' + (i + 1) + ')" href="javascript:;"><i class="fa fa-trash-o fa-lg "></i></a>';
                                    subquestion += '<div class="clearfix"></div>';
                                    subquestion += '</div>';
                                    subquestion += '<div class="x_content row">';
                                    subquestion += '<div class="btn-toolbar">';
                                    subquestion += '<textarea id="' + uniqTextID + '" class="form-control" name="subquestion[question][]"> </textarea>';
                                    subquestion += '</div>';
                                    subquestion += '</div>';
                                    subquestion += '<br/>';
                                    subquestion += '</div>';
                                    subquestion += '<button type="button" id="option_' + (i + 1) + '" onclick="addSub(\'option\',' + (i + 1) + ')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option ' + (i + 1) + '</button>';
                                    subquestion += '<div id="option' + (i + 1) + '" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>';
                                    subquestion += '<button type="button" id="hint_' + (i + 1) + '" onclick="addSub(\'hint\',' + (i + 1) + ')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint ' + (i + 1) + '</button>';
                                    subquestion += '<div id="hint' + (i + 1) + '" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>';
                                    subquestion += '<button type="button" id="answer_' + (i + 1) + '" onclick="addSub(\'answer\',' + (i + 1) + ')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer ' + (i + 1) + '</button>';
                                    subquestion += '<div id="answer' + (i + 1) + '" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>';
                                    //                    subquestion += '<button type="button" id="reason_' + (i + 1) + '" onclick="addSub(\'reason\',' + (i + 1) + ')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason ' + (i + 1) + '</button>';
                                    //                    subquestion += '<div id="reason'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>';
                                    subquestion += '<button type="button" id="description_' + (i + 1) + '" onclick="addSub(\'description\',' + (i + 1) + ')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description ' + (i + 1) + '</button>';
                                    subquestion += '<div id="description' + (i + 1) + '" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>';
                                    subquestion += '</div>';
                                    //subquestion += '</div>';

                                    $(subquestion).insertAfter('.subquestion:last');
                                    initMCEall();
                                } else {
                                    $("#subquestion-1").show();
                                  
                                    initMCEall();
                                    return;
                                }
                            }
                            //var input="<input class='form-control' data-rule-required='true' type='text' name='"+option+"[]' value='"+option+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";

                            if (option == 'option') {
                                var btn_color = 'dark';
                                var background_style = 'background-color: #73879c;color: #FFF;';
                            }
                            if (option == 'hint') {
                                var btn_color = 'success';
                                var background_style = 'background-color: #26b99a;color: #FFF;';
                            }
                            if (option == 'answer') {
                                var btn_color = 'info';
                                var background_style = 'background-color: #5bc0de;color: #FFF;';
                            }
                            //        if (option == 'reason') {
                            //            var btn_color = 'warning';
                            //            var background_style = 'background-color: #f0ad4e;color: #FFF;';
                            //        }
                            if (option == 'description') {
                                var btn_color = 'primary';
                                var background_style = 'background-color: #1a82c3;color: #FFF;';
                            }

                            var input = '<div class="form-group col-sm-6 my-form-element">';
                            input += '<label for="textitem" style="' + background_style + '">' + option;
                            input += '<a class="btn btn-danger delete pull-right"  href="javascript:;">';
                            input += '<i class="fa fa-close remove_' + option + '"></i>';
                            input += '</a>';

                            input += '<div class="clearfix"></div>';
                            input += '<textarea id="' + uniqTextID + '" class="form-control " rows="6" name="' + option + '[]"></textarea>';
                            input += '</label>';
                            input += '</div>';

                            $('#' + option).append(input);
                            initMCEall();
                        }



                        function addSub(suboption, num)
                        {
                            var uniqTextID = Math.random();

                            if (suboption == 'option') {
                                var btn_color = 'dark';
                                var background_style = 'background-color: #73879c;color: #FFF;';
                            }
                            if (suboption == 'hint') {
                                var btn_color = 'success';
                                var background_style = 'background-color: #26b99a;color: #FFF;';
                            }
                            if (suboption == 'answer') {
                                var btn_color = 'info';
                                var background_style = 'background-color: #5bc0de;color: #FFF;';
                            }
                            if (suboption == 'reason') {
                                var btn_color = 'warning';
                                var background_style = 'background-color: #f0ad4e;color: #FFF;';
                            }
                            if (suboption == 'description') {
                                var btn_color = 'primary';
                                var background_style = 'background-color: #1a82c3;color: #FFF;';
                            }


                            var input = '<div class="form-group col-sm-6 my-form-element">';
                            input += '<label for="textitem" style="' + background_style + '">' + suboption + num;
                            input += '<a class="btn btn-danger delete pull-right" href="javascript:;">';
                            input += '<i class="fa fa-close remove_sub' + suboption + '"></i>';
                            input += '</a>';

                            input += '<div class="clearfix"></div>';
                            input += '<textarea id="' + uniqTextID + '" class="form-control " rows="6" name="subquestion[' + suboption + '][' + num + '][]"></textarea>';
                            input += '</label>';
                            input += '</div>';
                            $('#subquestion-' + num).find('#' + suboption + num).append(input);
                            initMCEall();
                            //tinymce.execCommand("mceAddControl", false, suboption + num);
                        }


                        $(function () {
                            $("#datepicker").datepicker({
                                dateFormat: 'yy',
                                changeMonth: true,
                                changeYear: true
                            });
                            $(".delete").bind('click', function () {
                                alert("delete");
                            })
                        });
                        $(function () {
                            $("#level_id").change(function () {
                                $.ajax({
                                    method: "post",
                                    dataType: 'json',
                                    data: {'level_id': $(this).val()},
                                    url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                                    beforeSend: function () {
                                        $(".loader-image").show();
                                    },
                                    success: function (data) {
                                        //console.log(data.yearOption);
                                        var yearOption = '';
                                        var semesterOption = '';
                                        if (data.yearOption !== 0) {
                                            yearOption += "<option value=''>Select Year</option>";
                                            for (var i = 1; i <= data.yearOption; i++) {
                                                yearOption += "<option value=" + i + ">" + i + "</option>";
                                                // console.log(i);
                                            }
                                            //                        i = i-1;
                                            //                        yearOption +="<option value="+i+">"+i+"</option>";

                                        }
                                        if (data.semesterOption !== 0) {
                                            semesterOption += "<option value=''>Select Semester</option>";
                                            for (var j = 1; j <= data.semesterOption; j++) {
                                                semesterOption += "<option value=" + j + ">" + j + "</option>";
                                            }
                                            //                        j = j-1;
                                            //                        semesterOption +="<option value="+j+">"+j+"</option>";
                                        }

                                        $("#year").html(yearOption);
                                        $("#semester").html(semesterOption);
                                    }

                                });

                            });

                            $("#stream_id").change(function () { //this occurs when select 1 changes

                                $.ajax({
                                    method: "post",
                                    dataType: 'json',
                                    data: {'stream_id': $(this).val()},
                                    url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                                    beforeSend: function () {
                                        $(".loader-image").show();
                                    },
                                    success: function (data) {
                                        //console.log(data.yearOption);
                                        var yearOption = '';
                                        var semesterOption = '';
                                        if (data.yearOption !== 0) {
                                            yearOption += "<option value=''>Select Year</option>";
                                            for (var i = 1; i <= data.yearOption; i++) {
                                                yearOption += "<option value=" + i + ">" + i + "</option>";
                                                // console.log(i);
                                            }
                                            //                        i = i-1;
                                            //                        yearOption +="<option value="+i+">"+i+"</option>";

                                        }
                                        if (data.semesterOption !== 0) {
                                            semesterOption += "<option value=''>Select Semester</option>";
                                            for (var j = 1; j <= data.semesterOption; j++) {
                                                semesterOption += "<option value=" + j + ">" + j + "</option>";
                                            }
                                            //                        j = j-1;
                                            //                        semesterOption +="<option value="+j+">"+j+"</option>";
                                        }

                                        $("#year").html(yearOption);
                                        $("#semester").html(semesterOption);
                                    }

                                });

                            });

                            $("#course_id").change(function () { //this occurs when select 1 changes

                                $.ajax({
                                    method: "post",
                                    dataType: 'json',
                                    data: {'course_id': $(this).val()},
                                    url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                                    beforeSend: function () {
                                        $(".loader-image").show();
                                    },
                                    success: function (data) {
                                        //console.log(data.yearOption);
                                        var yearOption = '';
                                        var semesterOption = '';
                                        if (data.yearOption !== 0) {
                                            yearOption += "<option value=''>Select Year</option>";
                                            for (var i = 1; i <= data.yearOption; i++) {
                                                yearOption += "<option value=" + i + ">" + i + "</option>";
                                                // console.log(i);
                                            }
                                            //                        i = i-1;
                                            //                        yearOption +="<option value="+i+">"+i+"</option>";

                                        }
                                        if (data.semesterOption !== 0) {
                                            semesterOption += "<option value=''>Select Semester</option>";
                                            for (var j = 1; j <= data.semesterOption; j++) {
                                                semesterOption += "<option value=" + j + ">" + j + "</option>";
                                            }
                                            //                        j = j-1;
                                            //                        semesterOption +="<option value="+j+">"+j+"</option>";
                                        }

                                        $("#year").html(yearOption);
                                        $("#semester").html(semesterOption);
                                    }

                                });

                            });


                            $(".withoutSubquestion").on("click", ".remove_option", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();

                            });
                            $(".withoutSubquestion").on("click", ".remove_hint", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });

                            $(".withoutSubquestion").on("click", ".remove_answer", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });
                            $(".withoutSubquestion").on("click", ".remove_description", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });


                            $(".subquestion").on("click", ".remove_suboption", function (e) { //user click on remove text
                                e.preventDefault();
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });
                            $(".subquestion").on("click", ".remove_subhint", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });

                            $(".subquestion").on("click", ".remove_subanswer", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });
                            $(".subquestion").on("click", ".remove_subdescription", function (e) { //user click on remove text
                                $(this).parent('a').parent('label').parent('div').remove();
                                $(this).closest("i").remove();
                                //j--;
                            });

                        })

                        function remove_subquestion(subquestionID) {
                            // alert(subquestionID);
                            if (subquestionID == 1) {
                                $("#subquestion-" + subquestionID).hide();
                            } else if (subquestionID > 1) {
                                $("#subquestion-" + subquestionID).remove();
                            }
                        }

                    </script>