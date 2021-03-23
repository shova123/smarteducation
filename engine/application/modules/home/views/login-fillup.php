<script>
    $(document).on('keyup', '.slug_name', function () {
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name+"_"+l_name;
        $("#username").val(text);     
    });


    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        var selboxCourse = document.addEditform.course_id;
//        var selboxSubject = document.addEditform.subject_id;
//        var selboxChapter = document.addEditform.chapter_id;
//        var selboxUnit = document.addEditform.unit_id;

        selbox.options.length = 0;
        selboxCourse.options.length = 0;
//        selboxSubject.options.length = 0;
//        selboxChapter.options.length = 0;
//        selboxUnit.options.length = 0;

        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Level--", "");
            selboxCourse.options[selbox.options.length] = new Option("--Select Course--", "");
//            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//            selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Level--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
//        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//        selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");

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
//        var selboxSubject = document.addEditform.subject_id;
//        var selboxChapter = document.addEditform.chapter_id;
//        var selboxUnit = document.addEditform.unit_id;

        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxDepartment.options.length = 0;
//        selboxSubject.options.length = 0;
//        selboxChapter.options.length = 0;
//        selboxUnit.options.length = 0;

        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
//            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//            selboxUnit.options[selboxUnit.options.length] = new Option("--Select unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
//        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//        selboxUnit.options[selboxUnit.options.length] = new Option("--Select unit--", "");
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
//        var selboxSubject = document.addEditform.subject_id;
//        var selboxChapter = document.addEditform.chapter_id;
//        var selboxUnit = document.addEditform.unit_id;

        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
//        selboxSubject.options.length = 0;
//        selboxChapter.options.length = 0;
//        selboxUnit.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
//            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//            selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
//        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
//        selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
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
//        var selboxSubject = document.addEditform.subject_id;
//        var selboxChapter = document.addEditform.chapter_id;

        selboxDepartment.options.length = 0;
//        selboxSubject.options.length = 0;
//        selboxChapter.options.length = 0;

        if (chosen == " ") {
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select--", "");
//            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        }

        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
//        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
//        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
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


    
</script>
<link href="<?php echo base_url();?>gears/admin/css/progress.css" rel="stylesheet" />
<script src="<?php echo base_url();?>gears/front/js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
<script src="<?php echo base_url();?>gears/front/js/plugins/complexify/jquery.complexify.min.js"></script>

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
		$.post("<?php echo base_url("signin/delete_user_image");?>",{imgName:_img},
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url();?>gears/admin/js/jquery.geocomplete.js"></script> 

<script>
    $(function () {
        $("#geocomplete").geocomplete({
            details: "form",
            country: "AUS",
            types: ["geocode", "establishment"]
        });
    });
    $(document).ready(function () {
        $("#geocomplete").trigger("geocode");
    });
</script>
<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message'))) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        $message = $this->session->flashdata('success_message');
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'danger';
        $color = '#fff';
        $message = @$error_message;
}else
{
        $display = '';
        $formClass = '';
        $formOuter = 'outer';
        $formHead ='head';
        $alertclass = 'danger';
        $color = '#000';
        $message = $this->session->flashdata('error_message');
}
?>
<?php if(@$message){?>
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="myModalLabel">Information</h4>-->
              </div>
              <div class="modal-body">
                  <?php echo @$message;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
<?php }?>
<!--
<1?php if(@$message){?>
            <script>
                window.onload = function(){
                    $(".alert").delay(200).addClass("in");//.fade(10000);
                };
                window.setTimeout(function() { $(".alert").removeClass('in'); }, 10000);
            </script>
        <1?php }?>
<div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
    <div class="alert alert-<1?php echo $alertclass;?> fade <1?php echo $display;?>">
        <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
        <strong><1?php echo @$message;?></strong> 
    </div>
</div>
-->
<?php $isEdit = isset($details) ? true : false;?>


<!-- Wrapper for Slides -->
<div class="inner-page-top inner-page-question slc">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
<!--				<ol class="breadcrumb">
				  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
				  <li><a href="second.php">SLC Materials</a></li>
				  <li class="active">Complete Your Profile</li>
				</ol>-->
				<h1>Complete Your Profile</h1>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<!-- Lesson Details with sidebar here-->
<div class="container">
	<div class="row course-list-tabs">
		
		<div class="col-sm-8 col-md-9 course-list-content">
			<div class="wrapper grey">

        <div class="container">
            <?php if(!empty($form)){if($form == 'open'){?>
            <div class="col-md-12">
                <h3 class="margin-bottom-40 editContent">Fill up the desired information. we will help you.</h3>
            </div>
            
            <div class="col-md-10">
                <?php //if(!empty($user_token)){$redirectPARA = "$user_token/$code";} ?>
                <!--<form action="<1?php
                if (@$isEdit) {
                    echo base_url("signin/signup_complete/$redirectPARA");
                }
                ?>" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">-->
                <!--<form action="" method="post" name="addEditform" id="addEditform" class="addEditform form_validate" enctype='multipart/form-data'>-->
                <form action="" method="post" name="addEditform" id="" class="form-horizontal form-label-left form-validate" enctype='multipart/form-data'>
                    <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True));?>" name="user_token" />
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              
                                <label for="fullname">First Name <span style="color: #cc0000;">*</span></label>
                                <input class="form-control input-lg" id="first_name" name="first_name" type="text" placeholder="Your First Name *" value="<?php
                                if (@$isEdit) {
                                    echo $details->first_name;
                                }
                                ?>" data-rule-required="true" data-rule-lettersonly="true">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fullname1">Last Name <span style="color: #cc0000;">*</span></label>
                                <input class="form-control input-lg" id="last_name" name="last_name" type="text" placeholder="Your Last Name *" value="<?php
                                if (@$isEdit) {
                                    echo $details->last_name;
                                }
                                ?>" data-rule-required="true" data-rule-lettersonly="true">
                            </div>
                        </div>
                        <div class="col-sm-6">      
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address <span style="color: #cc0000;">*</span></label>
                                <input class="form-control input-lg" id="email" name="email" placeholder="Your email *" type="email" value="<?php
                                if (@$isEdit) {
                                    echo $details->email;
                                }
                                ?>" data-rule-email="true" data-rule-required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2">Phone</label>
                                <input class="form-control input-lg" id="phone" name="phone" placeholder="Your mobile number:61 xxx xxx xxx" type="tel" value="<?php
                                if (@$isEdit) {
                                    echo $details->phone;
                                }
                                ?>" data-rule-mobileNP="true">
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Address</label>
                                <input class="form-control input-lg" id="geocomplete" name="address" placeholder="Type in an address" type="text" value="<?php if ($isEdit) {echo $details->address;}?>" data-rule-extendalphanumeric="true"/>
                                <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                                <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>
                            </div>
                        </div>
<!--                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username<span style="color: #cc0000;">*</span></label>
                                <input class="form-control input-lg" id="username" name="username" placeholder="Your Username" type="text" value="<?php
                                if (@$isEdit) {
                                    echo $details->username;
                                }
                                ?>" data-rule-alphanumeric="true" data-rule-required="true">
                            </div>
                        </div>-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail4">Password</label>
                                <input class="complexify-me form-control input-lg" id="password" name="password" placeholder="Your Password" type="password" value="" data-rule-pwcheck="true"  data-rule-required="true"><!--data-rule-minlength="8"-->
                                <span class="help-block">
                                    <div class="progress progress-info">
                                        <div class="bar bar-red" style="width: 0%"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail5">Confirm Password</label>
                                <input class="form-control input-lg" id="password_confirm" name="password_confirm" placeholder="Confirm Your Password" type="password" value="" data-rule-equalTo="#password" data-rule-pwcheck="true" data-rule-required="true">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="information" id="information" placeholder="Other Information" data-rule-extendalphanumeric="true"><?php if(!empty($isEdit)){echo $details->information;}?></textarea>
                            </div>
                        </div>
                                
                        <?php
                        $userID = $details->user_id;
                        $groupTypeDashboardNameUser = $this->ion_auth->has_dashboard($userID);
                        $groupNameDashboardNameUser = $this->ion_auth->has_group_name($userID);
//                        echo $groupTypeDashboardNameUser."<br>";
//                        echo $groupNameDashboardNameUser."<br>";
//                        die;
                         if (!empty($isEdit)) {
                             
                         if(strpos($groupTypeDashboardNameUser, 'user') !== false && strpos($groupNameDashboardNameUser, 'student') !== false){
                        ?>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="board_id" id="board_id" class='form-control board_id advance_search' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Board---</option>
                                <?php
                                if (!empty($boards)) {
                                    foreach ($boards as $board) {
                                        $boardID = $board->board_id;
                                        $boardName = $board->board_name;
                                        $boardSlug = $board->board_slug;
                                        $boardAlias = $board->board_alias;
                                        ?>
                                        <option value="<?php echo $boardID; ?>" <?php
                                        if (!empty($s_board_id) && ($s_board_id == $boardID)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $boardName; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>    
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">

                            <select name="level_id" id="level_id" class='form-control level_id advance_search' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Level---</option>
                                <?php
                                if (!empty($s_level_id)) {
                                    foreach ($levels as $level) {
                                        $levelBoardID = $level->board_id;
                                        $levelID = $level->level_id;

                                        if (!empty($s_board_id) && ($s_board_id == $levelBoardID)) {
                                            ?>
                                            <option value="<?php echo $levelID; ?>" <?php
                                            if (!empty($s_level_id) && ($s_level_id == $levelID)) {
                                                echo "selected";
                                            }
                                            ?>> <?php echo $level->level_name; ?> </option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                            </select>

                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="stream_id" id="stream_id" class='form-control advance_search' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Stream---</option>
                                <?php
                                if (!empty($s_stream_id)) {
                                    foreach ($streams as $stream) {
                                        $streamLevelID = $stream->level_id;
                                        $streamID = $stream->stream_id;
                                        $streamName = $stream->stream_name;

                                        if (!empty($s_level_id) && ($s_level_id == $streamLevelID)) {
                                            ?>
                                            <option value="<?php echo $streamID; ?>" <?php
                                                    if (!empty($s_stream_id) && ($s_stream_id == $streamID)) {
                                                        echo "selected";
                                                    }
                                                    ?>> <?php echo $streamName; ?> </option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>  
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="course_id" id="course_id" class='form-control advance_search' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                <option value="">---Select Course---</option>
                                <?php
                                if (!empty($s_course_id)) {
                                    foreach ($courses as $course) {
                                        $courseIDs = $course->course_id;
                                        $courseLevelID = $course->level_id;
                                        $courseStreamID = $course->stream_id;
                                        $courseName = $course->course_name;
                                        if (!empty($s_stream_id) && ($s_stream_id == $courseStreamID)) {
                                            ?>
                                            <option value="<?php echo $courseIDs; ?>" <?php
                                                    if (!empty($s_course_id) && ($s_course_id == $courseIDs)) {
                                                        echo "selected";
                                                    }
                                                    ?>> <?php echo $courseName; ?> </option>
            <?php
        }
    }
}
?>  
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="department_id" id="department_id" class='form-control advance_search'>
                                <option value="">---Select Department---</option>
                                <?php
                                if (!empty($s_department_id)) {
                                    foreach ($departments as $department) {
                                        $departmentID = $department->department_id;
                                        $departmentLevelID = $department->level_id;
                                        $departmentStreamID = $department->stream_id;
                                        $departmentCourseID = $department->course_id;
                                        $departmentName = $department->department_name;

                                        if (!empty($s_course_id) && ($s_course_id == $departmentCourseID)) {
                                            ?>
                                            <option value="<?php echo $departmentID; ?>" <?php
                                                    if (!empty($s_department_id) && ($s_department_id == $departmentID)) {
                                                        echo "selected";
                                                    }
                                                    ?>> <?php echo $departmentName; ?> </option>
            <?php
        }
    }
}
?>  
                            </select>
                        </div>
            <?php }}?>
                        
                                
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div id="queueImage"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true" data-rule-imagevalidation="true">
                                <div class="imagethumbs-form">
                                <?php 
                                if($isEdit){
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
                                            <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/profile/<?php echo $i;?>&w=150&h=150" />
                                        </a>  
                                    </div>
                                <?php       
                                            }
                                        } 
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!--<div class="g-recaptcha" data-sitekey="6LcKJQwTAAAAAEJDD436vYvtK8lqdzsbHxO00y7g" data-theme="dark"></div>-->
                                <?php echo @$widget; ?>
                                <?php echo @$script; ?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" name="submitDetail" class="btn btn-primary btn-embossed btn-lg btn-wide" value="Submit To complete Signup">
                            <!--<button type="submit" class="btn btn-primary btn-embossed btn-lg btn-wide">Submit contact form</button>-->
                        </div>
                    </div>
                </form>

            </div>
            
            <?php }elseif($form == 'close'){?>
            <div class="col-md-10">
                        <div class="mystyle">
                            <h1>Account Activation Token has been Expired</h1>
<!--                            <span class="pull-left"><h2><strong>Account Type</strong>:</h2></span> 

                            <h3>

                                <i class="fa fa-file-text"></i>Templates Created
                                <br>
                                <span class="total"><?php echo "12"; ?></span>

                            </h3>-->

                        </div>
                    </div>
            <?php }}?>

        </div><!-- /.container -->

    </div><!-- /.wrapper -->
		</div>
	</div>
</div>
<div class="clearfix"></div>