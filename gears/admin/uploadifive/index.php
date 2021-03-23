<!DOCTYPE HTML>
<html>
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
                    
		<div id="queueImage"></div>
		<input id="image_upload" name="image_upload" type="file" multiple="true">
                <div id="queueVideo"></div>
		<input id="video_upload" name="video_upload" type="file" multiple="true">
                <input type="submit" name="submitDetails" value="Submit">
		<!--<a style="position: relative; top: 8px;" href="javascript:$('#image_upload').uploadifive('upload')">Upload Files</a>-->
	</form>

	<script type="text/javascript">
             <?php $timestamp = time(); ?>
		$(function() {
			$('#image_upload').uploadifive({
				'auto'            : true,               // Automatically upload a file when it's added to the queue
                                'buttonClass'     : false,              // A class to add to the UploadiFive button
                                'buttonText'      : 'Upload Image Files',     // The text that appears on the UploadiFive button
                                'checkScript'     : false,              // Path to the script that checks for existing file names 
                                'dnd'             : true,               // Allow drag and drop into the queue
                                'dropTarget'      : false,              // Selector for the drop target
                                'fileSizeLimit'   : '153600',                  // Maximum allowed size of files to upload
                                'fileType'        : false,              // Type of files allowed (image, etc)
                                'width'           : 180,
                                'height'          : 30,    
				'formData'        : {
                                                        'timestamp': '<?php echo $timestamp; ?>',
                                                        'targetFolder': '/uploadifive-v/uploads/images/',
                                                        'token': '<?php echo @md5('unique_salt' . $timestamp); ?>'
                                                    },
				'method'          : 'post',             // The method to use when submitting the upload
                                'multi'           : true,               // Set to true to allow multiple file selections
                                'queueID'         : 'queueImage',              // The ID of the file queue
                                'queueSizeLimit'  : 1,                  // The maximum number of files that can be in the queue
                                'removeCompleted' : false,              // Set to true to remove files that have completed uploading
                                'simUploadLimit'  : 0,                  // The maximum number of files to upload at once
                                'truncateLength'  : 0,                  // The length to truncate the file names to
                                'uploadLimit'     : 1,                  // The maximum number of files you can upload
				'uploadScript' : 'uploadifive.php',
				'onUploadComplete' : function(file, data,response) {
					//console.log(data);
                                        if ($('#fileList').val() != '') {//alert('full');
                                            $('#fileList').val($('#fileList').val() + ':' + data);
                                        }else {//alert('blank');
                                            $('#fileList').val(data);
                                        }
//                                        $('#submitDetails').val('Submit');
				}
			});
		});
	</script>
        <script type="text/javascript">
             <?php $timestamps = time(); ?>
		$(function() {
			$('#video_upload').uploadifive({
				'auto'            : true,               // Automatically upload a file when it's added to the queue
                                'buttonClass'     : false,              // A class to add to the UploadiFive button
                                'buttonText'      : 'Upload Video Files',     // The text that appears on the UploadiFive button
                                'checkScript'     : false,              // Path to the script that checks for existing file names 
                                'dnd'             : true,               // Allow drag and drop into the queue
                                'dropTarget'      : false,              // Selector for the drop target
                                'fileSizeLimit'   : '153600',                  // Maximum allowed size of files to upload
                                'fileType'        : false,              // Type of files allowed (image, etc)
                                'width'           : 180,
                                'height'          : 30,    
				'formData'        : {
                                                        'timestamp': '<?php echo $timestamps; ?>',
                                                        'targetFolder': '/uploadifive-v/uploads/videos/',
                                                        'token': '<?php echo @md5('unique_salt' . $timestamps); ?>'
                                                    },
				'method'          : 'post',             // The method to use when submitting the upload
                                'multi'           : true,               // Set to true to allow multiple file selections
                                'queueID'         : 'queueVideo',              // The ID of the file queue
                                'queueSizeLimit'  : 1,                  // The maximum number of files that can be in the queue
                                'removeCompleted' : false,              // Set to true to remove files that have completed uploading
                                'simUploadLimit'  : 0,                  // The maximum number of files to upload at once
                                'truncateLength'  : 0,                  // The length to truncate the file names to
                                'uploadLimit'     : 1,                  // The maximum number of files you can upload
				'uploadScript' : 'uploadifive_video.php',
				'onUploadComplete' : function(file, data,response) {
					//console.log(data);
                                        if ($('#fileList2').val() != '') {//alert('full');
                                            $('#fileList2').val($('#fileList2').val() + ':' + data);
                                        }else {//alert('blank');
                                            $('#fileList2').val(data);
                                        }
//                                        $('#submitDetails').val('Submit');
				}
			});
		});
	</script>
</body>
</html>