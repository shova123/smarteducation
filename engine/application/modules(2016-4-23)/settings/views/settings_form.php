<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea',
    plugins: [
      'advlist autolink link image lists charmap eqneditor print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table insertdatetime save table contextmenu directionality emoticons template paste textcolor',
      'code jbimages filemanager'
    ],
    //content_css: '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/mathquill.css',
    toolbar: [
        'newdocument | bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | print preview media fullpage | forecolor backcolor emoticons| styleselect formatselect fontselect fontsizeselect',
        'link image jbimages media | charmap eqneditor cut copy paste | bullist numlist outdent indent | blockquote | insertfile undo redo | removeformat subscript superscript'
    ],
    menubar:false
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.stringToSlug.js"></script>
<script>
    $(document).ready(function () {
        $("#setting_title").stringToSlug();
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
                'targetFolder': '/smartsikshya.com/uploads/setting/',
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
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/setting/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
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
		$.post("<?php echo base_url("setting/delete_setting_image");?>",{imgName:_img},
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

<?php $isEdit = isset($details) ? true : false; ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <?php echo $page_title; ?>
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                    <form action="" method="POST" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' >
                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
<!--<input type="hidden" id="fileList" name="fileList" value="<?php if($isEdit) echo $details->home_image;?>" />-->
                            
                        
<!--                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Sub Menu Type</label>
                            <div class="col-sm-4">
                                <select name="setting_type" id="select" class='chosen-select form-control'>
                                    <option value="" <?php if (($isEdit) && ($details->setting_type == '')) echo "selected"; ?>> Select Menu Type</option>
                                    <option value="package" <?php if (($isEdit) && ($details->setting_type == 'package')) echo "selected"; ?>> Package ( single page ) </option>
                                    <option value="region" <?php if (($isEdit) && ($details->setting_type == 'region')) echo "selected"; ?>> Region ( Double Page ) </option>
                                </select>
                                <span class="help-block">Choose option to publish or unpublish the page.</span>
                            </div>
                        </div>-->
                            
                        
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Setting Title</label>
                                <div class="col-sm-10">
                                        <input type="text" name="setting_title" id="setting_title" value="<?php if (@$isEdit) echo $details->setting_title; ?>" class="form-control">
                                </div>
                        </div>
                        <div class="form-group" style="display:none;">
                                <label for="textfield" class="control-label col-sm-2">Setting Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="setting_slug" id="permalink" value="<?php if (@$isEdit) echo $details->setting_slug; ?>" class="form-control slug" readonly>
                                    <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Setting Type</label>
                            <div class="col-sm-4">
                                <select name="setting_type" id="setting_type" class='chosen-select form-control'>
                                    <option value="">-- Setting Type --</option>
                                    <option value="activation" <?php if (($isEdit) && ($details->setting_type == 'activation')){echo "selected";}?>> User Activation</option>
                                    <option value="automation" <?php if (($isEdit) && ($details->setting_type == 'automation')){echo "selected";}?>> Automation</option>
                                    <option value="failed" <?php if (($isEdit) && ($details->setting_type == 'failed')){echo "selected";}?>> Failed</option>
                                    <option value="alert" <?php if (($isEdit) && ($details->setting_type == 'alert')){echo "selected";}?>> Alert</option>
                                </select>
                                <span class="help-block">Choose option to make email notification clear</span>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Setting Actions</label>
                            <div class="col-sm-4">
                                <select name="setting_action" id="setting_action" class='chosen-select form-control'>
                                    <option value="">-- Setting Action --</option>
                                    <option value="register" <?php if (($isEdit) && ($details->setting_action == 'register')){echo "selected";}?>> User Register</option>
                                    <option value="invitation" <?php if (($isEdit) && ($details->setting_action == 'invitation')){echo "selected";}?>> End-User Invitation</option>
                                    <option value="forgotten_password" <?php if (($isEdit) && ($details->setting_action == 'forgotten_password')){echo "selected";}?>> Forget Password</option>
                                    <option value="forgotten_password_complete" <?php if (($isEdit) && ($details->setting_action == 'forgotten_password_complete')){echo "selected";}?>> Forget Password Completion</option>
                                </select>
                                <span class="help-block">Choose option to make email notification clear</span>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Email Header</label>
                                <div class="col-sm-10">
                                        <textarea name="header" id="header" class="form-control"><?php if (@$isEdit) echo $details->header; ?></textarea>
                                        <span class="help-block">Email Header position setting</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Email Footer</label>
                                <div class="col-sm-10">
                                        <textarea name="footer" id="footer" class="form-control"><?php if (@$isEdit) echo $details->footer; ?></textarea>
                                        <span class="help-block">Email Footer position setting</span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Status</label>
                            <div class="col-sm-2">
                                <select name="status" id="select" class='chosen-select form-control'>
                                   <option value="Publish" <?php if (($isEdit) && ($details->status == 'Publish')){echo "selected";}?>> Publish </option>
                                    <option value="Unpublish" <?php if (($isEdit) && ($details->status == 'Unpublish')){echo "selected";}?>> Unpublish </option>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Image</label>
                            <div class="col-sm-10">
                                <span class="help-block">Image extension ( .jpg, .jpeg,.gif,.png)</span>
                                <div id="queueImage"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true">
                                <div class="imagethumbs-form">
                                    <?php
                                    if ($isEdit) {
                                        $imgname = $details->home_image;
                                        $img = explode(':', $imgname);
                                        if (!empty($imgname)) {
                                            echo '';
                                            foreach ($img as $i) {
                                                ?>
                                                <div class="imagethumb-form additional-file-input" id="add-image1">
                                                    <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                                    <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/setting/<?php echo $i;?>&w=150&h=150" />
                                                    </a>  
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            
                        </div>-->

                        
                        <div class="form-actions">
                            <input type="submit" name="submitDetail" class="btn btn-primary" value="SUBMIT">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                             <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>