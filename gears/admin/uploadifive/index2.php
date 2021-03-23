<!DOCTYPE HTML>
<html>
    <?php $base_url = 'http://localhost/uploadifive/';?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="jquery-2.0.2.min.js" type="text/javascript"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="jquery.uploadifive-v1.0.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="uploadifive.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
.uploadifive-button {
	float: left;
	margin-right: 10px;
}
#queue {
	border: 1px solid #E5E5E5;
	height: 177px;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
	width: 300px;
}
</style>



</head>
<?php 
if(!empty($_POST)){
if(isset($_POST)){
    if($_POST['submitDetails']){
        echo "<pre>";
        print_r($_POST);die;
    }
}
}
?>
<body>
	<h1>UploadiFive Demo</h1>
        <?php $isEdit = isset($details) ? true : false; ?>
	    <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="fileList" name="fileList" />
                    <input type="hidden" id="fileList2" name="fileList2" />
                    
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
<!--                <div class="col-sm-10">
                    <input type="file" name="file_upload" id="file_upload" multiple="true"/>
                    <div class="imagethumbs-form">
                        <?php
                        if ($isEdit) {
                            $imgname = $details->file_upload;
                            $img = explode(':', $imgname);
                            //dumparray($img);
                            if (!empty($imgname)) {
                                echo '';
                                foreach ($img as $i) {
                                    ?>
                                    <div class="imagethumb-form additional-file-input" id="add-image1">
                                        <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                        <a href="#" title="<?php echo $i; ?>" class="img-wrap">
                                            <img src="<?php echo base_url(); ?>createThumb/create_thumb.php?src=<?php echo base_url(); ?>uploads/<?php echo $i; ?>&w=150&h=150" />
                                        </a>  
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>-->
                
                <input type="submit" name="submitDetails" value="SUBMIT">
		<!--<a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>-->
	</form>

	<script type="text/javascript">
            <?php $timestamp = time(); ?>
		$(function() {
			$('#file_upload').uploadifive({
                                'auto'            : true,               // Automatically upload a file when it's added to the queue
                                'buttonClass'     : false,              // A class to add to the UploadiFive button
                                'buttonText'      : 'Upload Image Files',     // The text that appears on the UploadiFive button
                                'checkScript'     : false,              // Path to the script that checks for existing file names 
                                'dnd'             : true,               // Allow drag and drop into the queue
                                'dropTarget'      : false,              // Selector for the drop target
                                'fileSizeLimit'   : '99200',                  // Maximum allowed size of files to upload
                                'fileType'        : false,              // Type of files allowed (image, etc)
                                'formData'        : {
                                                        'timestamp': '<?php echo $timestamp; ?>',
                                                        'targetFolder': '/uploadifive/uploads/',
                                                        'token': '<?php echo @md5('unique_salt' . $timestamp); ?>'
                                                    },
                                'height'          : 30,                 // The height of the button
                                'method'          : 'post',             // The method to use when submitting the upload
                                'multi'           : true,               // Set to true to allow multiple file selections
                                'queueID'         : 'queue',              // The ID of the file queue
                                'queueSizeLimit'  : 0,                  // The maximum number of files that can be in the queue
                                'removeCompleted' : false,              // Set to true to remove files that have completed uploading
                                'simUploadLimit'  : 0,                  // The maximum number of files to upload at once
                                'truncateLength'  : 0,                  // The length to truncate the file names to
                                'uploadLimit'     : 0,                  // The maximum number of files you can upload
                                'uploadScript'    : 'uploadifive.php',  // The path to the upload script
                                'width'           : 100,

                                'onUploadComplete' : function(file, data,response) {
                                    //alert(file.name);
                                    //alert(data);
					//console.log(data);
                                        if ($('#fileList').val() != '') {//alert('full');
                                            $('#fileList').val($('#fileList').val() + ':' + data);
                                        }else {//alert('blank');
                                            $('#fileList').val(data);
                                        }
                                        //imagePath = "<?php echo str_replace("\\", "/", ROOT); ?>";
                                        //$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="' + "<?php echo base_url(); ?>" + 'assets/createThumb/create_thumb.php?src=' + imagePath + 'uploads/' + data + '&w=150&h=150" alt="' + data + '" /></a></div>');
                                        //$('#submitDetail').removeAttr('disabled');
                                        //$('#submitDetail').val('Submit');
				}
			});
		});
	</script>
</body>
</html>