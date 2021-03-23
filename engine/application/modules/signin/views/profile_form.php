<script>
    $(document).on('keyup', '.slug_name', function(){
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name + "_" + l_name;
        $("#username").val(text);     
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
            'buttonText': 'Profile Image', // The text that appears on the UploadiFive button
            'checkScript': false, // Path to the script that checks for existing file names 
            'dnd': true, // Allow drag and drop into the queue
            'dropTarget': false, // Selector for the drop target
            'fileSizeLimit': '153600', // Maximum allowed size of files to upload
            'fileType': false, // Type of files allowed (image, etc)
            'width': 160,
            'height': 30,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'targetFolder': '/smartsikshya.com/uploads/profile/',
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
                $('.imagethumbs-form .row').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/profile/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url();?>gears/admin/js/jquery.geocomplete.js"></script> 
<script>
      $(function(){
        $("#geocomplete").geocomplete({
            details: "form",
            country: "NP",
            types: ["geocode", "establishment"]
        });
      });
      $(document).ready(function() {
        $("#geocomplete").trigger("geocode");
    });
</script>
    
<?php $isEdit = isset($users_details) ? true : false;?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>User Profile</h3>
        </div>

<!--        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>-->
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
<!--                    <form class="form-horizontal form-label-left" action="<?php echo base_url("signin/edit_profile/");?>" method="post" name="addEditforms" id="addEditforms" enctype='multipart/form-data' novalidate>-->
                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" ><!--novalidate-->
                        <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                    
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="clearfix"></div>
                                <div id="queueImage" class="row"></div>
                                <div class="clearfix"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true">
                                <div class="clearfix"></div>
                                <div class="imagethumbs-form">
                                <?php 
                                if($isEdit){
                                        $imgname = $users_details->home_image;
                                        $img = explode(':',$imgname);
                                        if(!empty($imgname)){
                                            echo '';
                                            foreach($img as $i){
                                ?>
                                    <div class="imagethumb-form additional-file-input" id="add-image1">
                                        <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                        <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                            <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/profile/<?php echo $i;?>&w=80&h=80" />
                                        </a>  
                                    </div>
                                <?php       
                                            }
                                        } 
                                }
                                ?>
                                </div>


                            </div>
                        <br />


                        </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
<!--                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                </li>-->
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<!--                                    <form class="form-horizontal form-label-left" action="" method="post" name="addEditform" id="addEditform" enctype='multipart/form-data' accept-charset="utf-8" novalidate>

                                        <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />-->
<!--                                        <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
                                        </p>-->
                                        <span class="section">Personal Info</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >First Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="first_name" class="slug_name form-control col-md-7 col-xs-12" name="first_name" value="<?php if (@$isEdit) {echo $users_details->first_name;}?>" placeholder="First Name" data-rule-required="true" data-rule-minlength="2"><!--data-validate-length-range="6" data-validate-words="2" -->
                                                <!--<input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $users_details->first_name;}?>" class="slug_name form-control" data-rule-required="true" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last name">Last Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last_name" class="slug_name form-control col-md-7 col-xs-12" name="last_name" value="<?php if (@$isEdit) {echo $users_details->last_name;}?>" placeholder="Last Name" data-rule-required="true" data-rule-minlength="2"><!--data-validate-length-range="6" data-validate-words="2" -->
                                                <!--<input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $users_details->first_name;}?>" class="slug_name form-control" data-rule-required="true" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email" value="<?php if (@$isEdit) {echo $users_details->email;}?>" class="form-control col-md-7 col-xs-12" data-rule-email="true" data-rule-required="true">
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="geocomplete" type="text" placeholder="Type in an address" name="address" class="form-control col-md-7 col-xs-12 location" value="<?php if (@$isEdit) {echo $users_details->address;}?>" data-rule-extendalphanumeric="true" data-rule-required="true"/>
                                                <input name="lat" type="text" value="<?php if ($isEdit) {echo $users_details->lat;}?>" hidden>
                                                <input name="lng" type="text" value="<?php if ($isEdit) {echo $users_details->lng;}?>" hidden>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="information">Information<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="information" id="information" class="ckeditor form-control col-md-7 col-xs-12" data-rule-required="true">
                                                    <?php
                                                    if (@$isEdit) {
                                                        echo $users_details->information;
                                                    }
                                                    ?>
                                                </textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Username <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="username" type="text" name="username" value="<?php if (@$isEdit) {echo $users_details->username;}?>" class="optional form-control col-md-7 col-xs-12" data-rule-required="true" data-rule-alphanumeric="true">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" data-rule-minlength="8" data-rule-required="true" data-rule-nowhitespace="true"><!--data-validate-length="6,8" -->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password2" type="password" name="password_confirm" class="form-control col-md-7 col-xs-12" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" value="" data-rule-nowhitespace="true">
                                            </div>
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <input type="submit" name="submit" class="btn btn-success" id="send" value="Save Changes">
                                                <!--<button id="send" type="submit" class="btn btn-success">Submit</button>-->
                                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                                            </div>
                                        </div>
<!--                                    </form>-->
                                    <!-- end recent activity -->

                                </div>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- image cropping -->
<!--    <script src="<?php echo base_url();?>gears/admin/js/cropping/cropper.min.js"></script>
    <script src="<?php echo base_url();?>gears/admin/js/cropping/main.js"></script>-->