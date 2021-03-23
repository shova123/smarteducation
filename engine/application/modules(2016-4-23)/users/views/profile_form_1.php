<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">

<!--STyles for inline select form-->
<style type="text/css">
    .inlineselect{
        border: none;
        line-height: inherit;
        font-size:inherit;
        display: inline-block;
        padding: 10px 10px 2px;
        background-color: #e3e3e3;
        margin-right:10px;
        color: #b14943;
        cursor: pointer;
        border-bottom: 1px dashed #b14943;
    }
    .inlineselect option{
        padding: 5px;
        background:#e3e3e3;
        border: 0px;
    }
    .parsley-error-list{
        list-style: none;
        color: #cc0000;
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
                'targetFolder': '/kontext/uploads/profile/',
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
</script>
<script>
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
      $(function(){
        $("#geocomplete").geocomplete({
            //map: ".map_canvas",
            details: "form",
            country: "AUS",
            types: ["geocode", "establishment"]
//            markerOptions: {
//                draggable: true
//              }
        });


//        $("#geocomplete").bind("geocode:dragged", function(event, location){
//          $("input[name=lat]").val(latLng.lat());
//          $("input[name=lng]").val(latLng.lng());
//          $("#reset").show();
//        });

//        $("#find").click(function(){
//          $("#geocomplete").trigger("geocode");
//        });
      });
      
      $(document).ready(function() {
        $("#geocomplete").trigger("geocode");
    });
</script>
<?php
@session_start();
if($this->session->flashdata('success_message')) 
{
	$display = 'in';
	$formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        $message = $this->session->flashdata('success_message');
}elseif(@$error_message) 
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
    <script>
        window.onload = function(){
            //$(".alert").removeClass("in").show();
            $(".alert").delay(200).addClass("in").fade(10000);
        };
    </script>
<?php }?>
<?php $isEdit = isset($details) ? true : false;?>
<div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
    <div class="alert alert-<?php echo $alertclass; ?> fade <?php echo $display; ?>">
        <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
        <strong><?php echo @$message; ?></strong> 
    </div>
</div>

<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12 form-bk">
        <h1>Users Information</h1>

        <div class="row">
            <div class="sample-form-elements">
                <?php if(@$isEdit){$userTokens = $details->user_token;}?>
                <form action="<?php if(@$isEdit){echo base_url("users/edit_profile/$userTokens");}?>" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                    <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                <?php if(@$isEdit){ foreach($csrf as $key=>$value){?>
                    <input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>"/>
                <?php } }?>
                <?php if(@$isEdit){?><input type="hidden" name="user_id" value="<?php echo $user->user_id?>"/><?php }?>

                    <div class="form-group col-sm-6 my-form-element">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $details->first_name;}?>" class="form-control" data-rule-required="true" >
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?php if (@$isEdit) {echo $details->last_name;}?>" class="form-control" data-rule-required="true" >
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php if (@$isEdit) {echo $details->email;}?>" data-rule-email="true" data-rule-required="true" class="form-control">
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" value="<?php if (@$isEdit) {echo $details->phone;}?>" class="form-control" data-rule-number="true">
                    </div>

                    
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="address">Address</label>
                        <input id="geocomplete" type="text" placeholder="Type in an address" name="address" class="form-control location" value="<?php if ($isEdit) {echo $details->address;}?>" />
                            <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                            <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>
                    </div>
                    
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="textitem">Other Information</label>
                        <textarea name="information" id="information" class="form-control ckeditor"><?php
                            if (@$isEdit) {
                                echo $details->information;
                            }
                            ?>
                        </textarea>
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="home_image">Profile Image</label>
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
 
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php if (@$isEdit) {echo $details->username;}?>" class="form-control" data-rule-required="true" >
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="" class="complexify-me form-control" data-rule-minlength="8" data-rule-required="true">
                        <span class="help-block">
                                <div class="progress progress-info">
                                        <div class="bar bar-red" style="width: 0%"></div>
                                </div>
                        </span>
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="password_confirm">Confirm Password</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="complexify-me form-control" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" value="">
                        <span class="help-block">
                                <div class="progress progress-info">
                                        <div class="bar bar-red" style="width: 0%"></div>
                                </div>
                        </span>
                    </div>
   
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submit" class="btn btn-primary submit-btn pull-right" value="<?php echo lang($subject.'_user_submit_btn');?>">
                        <button type="button" onclick="history.go(-1);" class="btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

