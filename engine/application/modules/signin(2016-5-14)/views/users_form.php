<!--<script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/js/jquery.slugit.js"></script>-->
<script>
    $(document).on('keyup', '.slug_name', function(){
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name + "_" + l_name;
        $("#username").val(text);     
    });
</script>
<!--<script>
//    $(function () {
//        $('#group_name').slugIt({
//            output: '#name',
//            separator: '_',
//        });
//        $('#group_name').keyup();
//    });
</script>-->
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
<script>
    function setOptions(chosen) {
        var selbox = document.addEditform.sub_cat_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
        }
        <?php
        if (!empty($sub_category_list)) {
            foreach ($sub_category_list as $allSubCat) {
                $subCatID= $allSubCat->sub_cat_id;
                $catID= $allSubCat->category_id;
                $subCatTITLE= $allSubCat->subcategory_title;
                $subCatSLUG = $allSubCat->subcategory_slug;
        ?>
                                                                                
        if (chosen == "<?php echo $catID?>") {
            selbox.options[selbox.options.length] = new Option('<?php echo $subCatTITLE; ?>','<?php echo $subCatID; ?>');
        }
        <?php
    }
}
?>
        
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
<?php $isEdit = isset($details) ? true : false;?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <?php echo lang($subject . '_user_subheading'); ?>
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">

                    <?php if(@$isEdit){$userTokens = $details->user_token;}?>
                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" enctype='multipart/form-data' >
                        <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                        
                        <?php if(@$isEdit){?><input type="hidden" name="user_id" value="<?php echo $user->user_id?>"/><?php }?>
                
                        <span class="section">Please Complete the information below</span>

<!--                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <select name="category_id" id="category_id" onchange="setOptions(document.addEditform.category_id.options[ document.addEditform.category_id.selectedIndex].value);" id="select" class='select2_single form-control' tab-index="-1">
                                    <option value="">--select category--</option>
                                    <?php 
                                        if(!empty($category_list)){
                                            foreach($category_list as $listCateogry){
                                                $categoryID = $listCateogry->category_id;
                                                $categoryTITLE = $listCateogry->category_title;
                                    ?>
                                    <option value="<?php echo $categoryID;?>" <?php if (($isEdit) && ($details->category_id == $categoryID)){echo "selected";}?>> <?php echo ucfirst($categoryTITLE);?> </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub-Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="sub_cat_id" id="sub_cat_id" class='select2_single form-control' tab-index="-1">
                                   <option value="" selected="selected">---Select Sub Category---</option>
                                    <?php
                                    if($isEdit){
                                    if (!empty($sub_category_list)) {
                                        foreach ($sub_category_list as $subCatList) {
                                            $subCatID= $subCatList->sub_cat_id;
                                            $subCatTITLE= $subCatList->subcategory_title;
                                            $subCatSLUG = $subCatList->subcategory_slug;
                                    ?>
                                   <option value="<?php echo $subCatID;?>" <?php if (($isEdit) && ($details->sub_cat_id == $subCatID)){echo "selected";}?>><?php echo $subCatTITLE;?></option>
                                    <?php }}}?>
                                </select>
                            </div>
                        </div>-->
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $details->first_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="First Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="last_name" id="last_name" value="<?php if (@$isEdit) {echo $details->last_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Last Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" name="email" id="email" value="<?php if (@$isEdit) {echo $details->email;}?>" class="form-control col-md-7 col-xs-12" placeholder="Email"  data-rule-email="true" data-rule-required="true">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="tel" name="phone" id="phone" placeholder="your mobile number: 977 xxxxxxxxxx" value="<?php if (@$isEdit) {echo $details->phone;}?>"  class="form-control col-md-7 col-xs-12" data-rule-mobileNP="true" data-rule-required="true">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="geocomplete" type="text" placeholder="Type in an address" name="address" value="<?php if ($isEdit) {echo $details->address;}?>" class="form-control col-md-7 col-xs-12 location" placeholder="Address" data-rule-extendalphanumeric="true" data-rule-required="true">
                                <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                                <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Other Information<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="information" id="information" class="ckeditor form-control col-md-7 col-xs-12">
                                    <?php
                                    if (@$isEdit) {
                                        echo $details->information;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
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

                        <span class="section">Please enter the User's Login Information</span>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="username" id="username" value="<?php if (@$isEdit) {echo $details->username;}?>" class="form-control col-md-7 col-xs-12" placeholder="Username" data-rule-required="true" data-rule-alphanumeric="true">
                            </div>
                        </div>
<!--                        <div class="item form-group">
                            <label for="password" class="control-label col-md-3">Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" >data-validate-length="6,8" 
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password2" type="password" name="password_confirm" data-validate-linked="password" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>-->

                        <span class="section"><?php echo lang('edit_user_groups_heading');?></span>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Group Names
<!--                                <br>
                                <small class="text-navy">Normal Bootstrap elements</small>-->
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                
                               
                                <?php foreach ($groups as $group) { ?>
                                <!--<div class="check-line">-->
                                    <?php
                                    $users_groups = $this->ion_auth_model->get_users_groups($this->ion_auth->get_user_id())->row();
                                    $groupTYPE = $users_groups->group_type;

                                    $gID = $group['group_id'];
                                    $gTYPE = $group['group_type'];
                                    $checked = null;
                                    $item = null;
                                    if(!empty($currentGroups)){
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->group_id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    }

                                    if (strpos("superAdmin", $groupTYPE) !== false) {//check if logged in user is super admin type then allow
                                        if ((strpos("superAdmin", $gTYPE) !== false) || (strpos("manager", $gTYPE) !== false) || (strpos("user", $gTYPE) !== false) ) {
                                            ?>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> class='flat'>
                                            <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }elseif (strpos("manager", $groupTYPE) !== false) {//check if logged in user is manager type then allow
                                        if ((strpos("user", $gTYPE) !== false)) {
                                            ?>
                                            <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> id="c9" class='icheck-me' data-skin="square" data-color="red">
                                            <label class='inline' for="c9"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                            <?php
                                        }
                                    }elseif (strpos("user", $gTYPE) !== false) {
                                            ?>
                                            <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> id="c9" class='icheck-me' data-skin="square" data-color="red">
                                            <label class='inline' for="c9"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                            <?php
                                    }
                                    ?>   
                                <!--</div>-->
                            <?php } ?>  
                                
                                
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="active" id="active" class="select2_single form-control" tabindex="-1" data-rel="chosen"  >
                                    <option value="1" 
                                    <?php if (($isEdit) && ($details->active == '1')) {?>
                                        selected="selected"
                                    <?php }?>> Active</option>
                                    <option value="0" <?php
                                    if (($isEdit) && ($details->active == '0')) {?>
                                        selected="selected"
                                    <?php }?>> Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" name="submitDetail" class="btn btn-success" value="Save">
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>