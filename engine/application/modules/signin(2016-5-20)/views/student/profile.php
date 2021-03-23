<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">

<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#home_image').uploadifive({
            'auto': true, // Automatically upload a file when it's added to the queue
            'buttonClass': false, // A class to add to the UploadiFive button
            'buttonText': 'Upload Image', // The text that appears on the UploadiFive button
            'checkScript': false, // Path to the script that checks for existing file names 
            'dnd': true, // Allow drag and drop into the queue
            'dropTarget': false, // Selector for the drop target
            'fileSizeLimit': '153600', // Maximum allowed size of files to upload
            'fileType': false, // Type of files allowed (image, etc)
            'width': 180,
            'height': 30,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'targetFolder': '/smart/uploads/profile/',
                'token': '<?php echo @md5('unique_salt' . $timestamp); ?>'
            },
            'method': 'post', // The method to use when submitting the upload
            'multi': true, // Set to true to allow multiple file selections
            'queueID': 'queueImage', // The ID of the file queue
            'queueSizeLimit': 1, // The maximum number of files that can be in the queue
            'removeCompleted': false, // Set to true to remove files that have completed uploading
            'simUploadLimit': 0, // The maximum number of files to upload at once
            'truncateLength': 0, // The length to truncate the file names to
            'uploadLimit': 1, // The maximum number of files you can upload
            'uploadScript': '<?php echo base_url(); ?>gears/admin/uploadifive/uploadifive.php',
            'onUploadComplete': function (file, data, response) {
                $('#queueImage img').remove();
                //console.log(data);//alert(data);
                imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/profile/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
                if ($('#fileList').val() != '') {//alert('full');
                    $('#fileList').val(data);
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
		$.post("<?php echo base_url("pages/delete_image");?>",{imgName:_img},
		function(data){
			$("i.info").text(data).fadeOut(1000);
			_this.fadeOut(1000, function () {			
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

<script src="<?php echo base_url();?>gears/admin/js/plugins/wizard/jquery.form.wizard.min.js"></script>
<script>
    $(document).ready(function () {
        $("#subquestion-1").hide();
    });

    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        var selboxCourse = document.addEditform.course_id;
        

        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        

        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Level--", "");
            selboxCourse.options[selbox.options.length] = new Option("--Select Course--", "");
            
        }
        selbox.options[selbox.options.length] = new Option("--Select Level--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        

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
            selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            
        }
        selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        
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



    }
    // set option for stream using levels
    function setStream(chosen) {
        var selbox = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        

        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
        
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            
        }
        selbox.options[selbox.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        
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



    }

    function setCourse(chosen) {

        var selboxDepartment = document.addEditform.department_id;
        
        selboxDepartment.options.length = 0;
       

        if (chosen == " ") {
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select--", "");
            
        }

        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
     
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
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        
        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;
       
                
     
               

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
            
                
         }
    
</script>

<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/js/mathquill.min.js"></script>-->
<script>
//tinymce.PluginManager.load('equationeditor', '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/plugin.min.js');

tinymce.init({
    selector: 'textarea.questionFull',
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
    //    wirisimagebgcolor: '#FFFFFF',
//    wirisimagesymbolcolor: '#000000',
//    wiristransparency: 'true',
//    wirisimagefontsize: '16',
//    wirisimagenumbercolor: '#000000',
//    wirisimageidentcolor: '#000000',
//    wirisformulaeditorlang: 'es'
//    tiny_mce_wiris_formulaEditor,
//    tiny_mce_wiris_formulaEditorChemistry,
//    tiny_mce_wiris_CAS,

    //paste_data_images: true
    
//    theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
//    paste_auto_cleanup_on_paste : true,
//    paste_preprocess : function(pl, o) {
//        // Content string containing the HTML from the clipboard
//        alert(o.content);
//        o.content = "-: CLEANED :-\n" + o.content;
//    },
//    paste_postprocess : function(pl, o) {
//        // Content DOM node containing the DOM structure of the clipboard
//        alert(o.node.innerHTML);
//        o.node.innerHTML = o.node.innerHTML + "\n-: CLEANED :-";
//    },
    
});
 </script>
<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>signin/<?php echo $currentGroups[0]->group_type;?>_dashboard"><i class="fa fa-home"></i></a></li>
				  <li class="active">My Profile</li>
				</ol>
				<h1>Edit Profile</h1>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" name="addEditform" id="addEditform" >
                <input name="fileList" id="fileList" type="hidden" value="<?php if(!empty($details)) echo $details->home_image;?>"> 
                
		<div class="col-sm-4 col-md-3">
                    <div class="sidebar-detail profile-image">
                     <div class="imagethumbs-form">
                                            <?php
                                            if(!empty($details) && $details->home_image !=0){
                                              
                                                    ?>
                          <div id="queueImage">
                                                      <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="imagethumbs-form">
                                <?php 
                               
                                        $imgname = $details->home_image;
                                        $img = explode(':',$imgname);
                                        //dumparray($img);
                                        if(!empty($imgname)){
                                            echo '';
                                            foreach($img as $i){
                                ?> 
                                   
                                    <div class="imagethumb-form additional-file-input" id="add-image1">
                                        <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                        <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                            
                                            <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/profile/<?php echo $i;?>&w=150&h=150" class="img-responsive thumbnail"/>
                                        </a>  
                                    </div>
                                   
                                <?php       
                                            }
                                        } 
                                
                                ?>
                                </div>
                            </div>
                     </div>
                                                    <?php
                                               
                                            }else{?>
                         <!--<div id="queueImage">--> 
                             <img src="<?php echo base_url();?>uploads/profilenoimage.jpg" class="img-responsive thumbnail" alt="<?php if(!empty($details)) echo $details->first_name;?>">
                         <!--</div>-->
				
                          
                                            <?php }     ?>
                                                                                     
                                <input id="home_image" name="home_image" type="file" multiple="true" data-rule-imagevalidation="true">
                         </div>
			
                           

			</div>
		</div>
		<div class="col-sm-8 col-md-9 course-content">
			<!-- solving Questions -->
			<div class="question panel panel-default">
				<div class="panel-body">
					<ul class="list-inline outline-course">
						<li><strong>PERSONAL INFORMATION</strong></li>
						<li class="pull-right"><a href="" title="SAVE" data-toggle="tooltip"><i class="fa fa-save"></i></a></li>
					</ul>
					
					<div class="row profile-edit-form-row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="firstname">First Name</label>
                                                                <input type="text" class="form-control" name="first_name" palcheholder="First Name"  id="firstname" value="<?php if(!empty($details)) echo $details->first_name;?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
                                                                <input type="text" class="form-control" name="last_name" palcheholder="Last Name"  id="lastname" value="<?php if(!empty($details)) echo $details->last_name;?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="emailaddress">Email Address</label>
                                                                <input type="email" class="form-control" name="email" palcheholder="Email Address" value="email@domain.com" id="emailaddress" value="<?php if(!empty($details)) echo $details->email;?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="phoneno">Phone Number</label>
                                                                <input type="text" class="form-control" name="phone" palcheholder="Phone Number" value="9841414141" id="phoneno" value="<?php if(!empty($details)) echo $details->phone;?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="districtname">Address</label>
                                                                <input type="text" class="form-control" name="address" palcheholder="District" value="Kathmandu" id="districtname" value="<?php if(!empty($details)) echo $details->address;?>">
							</div>
						</div>
						
					</div>
					
					<ul class="list-inline outline-course">
						<li><strong>Education Information</strong></li>
					</ul>
					
						<div class="row profile-edit-form-row">
                                                   
                            
                            <div class="col-md-6">
                                 <div class="item form-group">
                                <label class="control-label col-md-6" for="board_id">Select Board<span class="required">*</span></label>
                                <select name="board_id" id="board_id" class='form-control board_id' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Board---</option>
                                    <?php
                                    if (!empty($boards)) {
                                        foreach ($boards as $board) {
                                            $boardID = $board->board_id;
                                            $boardName = $board->board_name;
                                            $boardSlug = $board->board_slug;
                                            $boardAlias = $board->board_alias;
                                    ?>
                                        <option value="<?php echo $boardID; ?>" <?php if (!empty($s_board) && ($s_board == $boardID)) {echo "selected";}?>><?php echo $boardName; ?> </option>
                                    <?php
                                                }
                                            }
                                    ?>    
                                </select>
                            </div>
                                                    </div>
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label col-md-6" for="level_id">Select Level <span class="required">*</span></label>
                                <select name="level_id" id="level_id" class='form-control level_id' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Level---</option>
                                    <?php
                                    if (!empty($levels)) {
                                        foreach ($levels as $level) {
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;
                                    
                                        
                                    ?>
                                                <option value="<?php echo $levelID; ?>" <?php if (!empty($s_level) && ($s_level == $levelID)) {echo "selected";}?>> <?php echo $level->level_name; ?> </option>
                                    <?php
                                                   
                                                }
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                            
                            <div class="col-md-6">
                                <div class="item form-group">
                                <label class="control-label col-md-6" for="page_type">Select Stream</label>
                                <select name="stream_id" id="stream_id" class='form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Stream---</option>
                                    <?php
                                    if (!empty($streams)) {
                                        foreach (array_unique($streams) as $stream) {
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;
                                            
                                          
                                    ?>
                                            <option value="<?php echo $streamID; ?>" <?php if (!empty($s_stream) && ($s_stream == $streamID)) {echo "selected";}?>> <?php echo $streamName; ?> </option>
                                    <?php
                                           
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label col-md-6" for="course_id">Select Course</label>
                                <select name="course_id" id="course_id" class='form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="">---Select Course---</option>
                                    <?php
                                    if (!empty($courses)) {
                                        foreach ($courses as $course) {
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                           
                                    ?>
                                        <option value="<?php echo $courseIDs; ?>" <?php if (!empty($s_course) && ($s_course == $courseIDs)) {echo "selected";}?>> <?php echo $courseName; ?> </option>
                                    <?php
                                           
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                        
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label col-md-6" for="page_type">Select Department</label>
                                <select name="department_id" id="department_id" class='form-control'>
                                    <option value="">---Select Department---</option>
                                    <?php
                                    if (!empty($departments)) {
                                        foreach ($departments as $department) {
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;
                                            
                                           
                                    ?>
                                        <option value="<?php echo $departmentID; ?>" <?php if (!empty($s_department) && ($s_department == $departmentID)) {echo "selected";}?>> <?php echo $departmentName; ?> </option>
                                    <?php
                                           
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>


                        
                          

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label col-md-6" for="page_type">Select Year</label>
                                <select name="year" id="year" class='form-control' onchange="setYear(document.addEditform.year.options[document.addEditform.year.selectedIndex].value);">
                                    <option value="">---Select Year---</option>
                                    <?php
                                    
                                  if(!empty($s_stream)){
                                      $stream_id=  empty($s_stream->stream_id)?0:$s_stream->stream_id;
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$stream_id")->row();
                                        $year = $streamed->year;
                                        for ($i = 1; $i <= $year; $i++){
                                    ?>
                                        <option <?php if (!empty($s_year) && ($s_year == $i)) { echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                        }
                                  }
                                   
                                    ?>
                                </select>
                            </div>
                        </div>
                            <!--                        </div>
                                                    <div class="form-group">-->
                            
                           <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-6" for="content">Select Semester</label>
                                <select name="semester" id="semester" class='select2_single form-control' onchange="setSemester(document.addEditform.semester.options[document.addEditform.semester.selectedIndex].value);">
                                    <option value="">---Select Semester---</option>
                                    <?php
                                   if(!empty($s_stream)){
                                        $stream_id=  empty($s_stream->stream_id)?0:$s_stream->stream_id;
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$stream_id")->row();
                                        $semester = $streamed->semester;
                                        for ($j = 1; $j <= $semester; $j++) {
                                    ?>
                                            <option <?php if (!empty($s_semester) && ($s_semester == $j)) {echo "selected";} ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php
                                        }
                                   }
                                   
                                    ?>
                                </select>
                            </div>
                        </div>
<!--							<div class="col-sm-6">
								<div class="form-group">
									<label for="edulevel">Education Level</label>
									<select name="level" id="edulevel" class="form-control">
										<option value="slc">SLC</option>
										<option value="+2">+2</option>
										<option value="BBS">BBS</option>
										<option value="BBA">BBA</option>
										<option value="IOM">IOM</option>
										<option value="MBA">MBA</option>
									</select>
								</div>
							</div>-->
<!--							<div class="col-sm-6">
								<div class="form-group">
									<label for="institutename">Current / Past Institute</label>
									<input type="text" class="form-control" palcheholder="Institute Name (current/past)" value="St. Xaviers College" id="institutename">
								</div>
							</div>-->
						</div>
					
                                    <input type="submit" value="SAVE"  name="profileEditSave" class="btn btn-primary"> 
                                       
				</div>
			</div>
		</div>
            </form>
	</div>
</div>
<div class="clearfix"></div>
<script>
//$('input[type="file"]').change(function () {
//    var image=$('input[type="file"]').val();
//    $.ajax({
//            url:'<?php echo base_url();?>signin/uploadProfileImage',
//            secureuri:false,
//            type: "POST",
//            fileElementId:'image',
//            dataType: 'text',
//            data:{file:image},
//            cache: true,
//            success: function (data){
//                alert(data);
//                console.log(data);
//
//            },
//        });
//})

</script>
<script>
   
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
        
        
       
    })
       
</script>

