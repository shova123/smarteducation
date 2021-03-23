<script>
    $(document).on('keyup', '.slug_name', function () {
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name+"_"+l_name;
        $("#username").val(text);     
    //$(document).ready(function () {
        //$("#news_title").onkeyup(function(){
        //alert('this is text');    
        /*var Text = $(this).val();
            //alert(Text);
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'-');*/
            //alert(Text);
            //$("#permalink").val(Text);     
            
//            var str = "This is a Great Blog Post, #1!";
//            str = str.replace(/[^a-zA-Z0-9\s]/g,"");
//            str = str.toLowerCase();
//            str = str.replace(/\s/g,'-');
//            document.write(str);
        //});
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
                'targetFolder': '/uploads/profile/',
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
<style>
.map_canvas { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}
</style>
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

<!--<style>
.map_canvas { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}
</style>-->

<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'success';$color = '#fff';
        if($this->session->flashdata('success_message')){$message = $this->session->flashdata('success_message');}
        else if($this->session->flashdata('message')){$message = $this->session->flashdata('message');}
        else if($message){$message = $message;}
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'danger';$color = '#fff';
        if($this->session->flashdata('error_message')){$message = $this->session->flashdata('error_message');}
        else{$message = @$error_message;}
        
}else
{$display = '';$formClass = '';$formOuter = 'outer';$formHead ='head';$alertclass = 'danger';$color = '#000';$message = $this->session->flashdata('error_message');}
?>
<?php if(@$message){?>
            <script>
                window.onload = function(){
                    $(".alert").delay(200).addClass("in");//.fade(10000);
                };
                window.setTimeout(function() { $(".alert").removeClass('in'); }, 10000);
            </script>
        <?php }?>
       <div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
            <div class="alert alert-<?php echo $alertclass; ?> fade <?php echo $display; ?>">
                <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
                <strong><?php echo @$message; ?></strong> 
            </div>
        </div>

<?php $isEdit = isset($details) ? true : false;?>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group">
                <?php echo lang($subject."_user_heading");?>
<!--                <a class="btn btn-primary" href="<1?php echo base_url('signin/create_user') ?>"><1?php echo lang('index_create_user_link');?> <i class="fa fa-plus"></i></a>-->
            </div>
        </div>
    </div>
    
<!--        <style>.messages{margin-left:50%;}</style>
        <div class="message" id="message" style="display:<?php echo $display ?>">
            <div class="messages">
                <div class="icon-messages icon-success"></div>
                <div id="displayMsg"><div id="infoMessage"><?php echo $message;?></div></div>
                <a href="#" onclick="javascript:getElementById('message').style.display = 'none'" class="close-msg" title="close">Close</a>
            </div>               
        </div>-->
    <div class="row">
        <div class="col-sm-12">
            <?php if(@$isEdit){$userTokens = $details->user_token;}?>
            <?php //if(@$isEdit){uri_string();}else{echo base_url("signin/create_user");} ?>
            <form action="<?php if(@$isEdit){echo base_url("signin/edit_user/$userTokens");}else{echo base_url("signin/create_user");}?>" method="post" name="addEditform" id="addEditform" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                <!--<form action="" method="post" class="addEditform form-horizontal form-bordered form-validate" id="addEditform" enctype='multipart/form-data' >-->
                <!--<input type="hidden" name="link" value="<1?php if ($isEdit) {echo $details->link;} else {echo $link;}?>" />-->
                <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                <?php 
                if(@$isEdit){ 
                    foreach($csrf as $key=>$value){
                ?>
                <input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>"/>
                <?php 
                    } 
                }
                ?>
                <?php if(@$isEdit){?><input type="hidden" name="user_id" value="<?php echo $user->user_id?>"/><?php }?>
                
                
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo lang($subject . '_user_subheading'); ?></h3>
                    </div>


                    <div class="box-content nopadding">
                      <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Category</label>
                            <div class="col-sm-4">
                                <!--<select class="form-control" name="package_activity" onchange="setOptions(document.addEditform.package_activity.options[ document.addEditform.package_activity.selectedIndex].value);">-->
                                <select name="category_id" id="category_id" onchange="setOptions(document.addEditform.category_id.options[ document.addEditform.category_id.selectedIndex].value);" id="select" class=' form-control'>
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
<!--                        </div>
                        
                        <div class="form-group">-->
                            <label for="textfield" class="control-label col-sm-2">Sub Category</label>
                            <div class="col-sm-4">
<!--                            <select class="form-control" name="package_name" > name is used as value obtainer for select changes
                                    <option value="" selected="selected">---Select---</option> option place for javascript to be printed
                                </select>-->
                                
                                <select name="sub_cat_id" id="sub_cat_id" class='form-control'>
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
                        </div>
                        <div class="form-group">
                            
                            <label for="first_name" class="control-label col-sm-2">First Name <span style="color: #cc0000;">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $details->first_name;}?>" class="slug_name form-control" data-rule-required="true" data-rule-lettersonly="true">
                                <!--<span class="help-block">This is just a Job Filed Type</span>-->
                            </div>
<!--                        </div>


                        <div class="form-group">-->
                            <label for="last_name" class="control-label col-sm-2">Last Name <span style="color: #cc0000;">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="last_name" id="last_name" value="<?php if (@$isEdit) {echo $details->last_name;}?>" class="slug_name form-control" data-rule-required="true" data-rule-lettersonly="true">
                                <!--<span class="help-block">This is just a Job Filed Type</span>-->
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="control-label col-sm-2">Email <span style="color: #cc0000;">*</span></label>
                            <div class="col-sm-4">
                                <input type="email" name="email" id="email" value="<?php if (@$isEdit) {echo $details->email;}?>" data-rule-email="true" data-rule-required="true" class="form-control">
                            </div>
<!--                        </div>
                        <div class="form-group">-->
                            <label for="phone" class="control-label col-sm-2">Phone</label>
                            <div class="col-sm-4">
                                <input type="tel" name="phone" id="phone" placeholder="your mobile number: 61 xxx xxx xxx" value="<?php if (@$isEdit) {echo $details->phone;}?>" class="form-control" data-rule-mobileAU="true">
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="company" class="control-label col-sm-2">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="company" id="company" value="<?php if (@$isEdit) {echo $details->company;}?>" class="form-control">
                                <span class="help-block">This is just a Job Filed Type</span>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="address" class="control-label col-sm-2">Address</label>
                            <div class="col-sm-10">
                                <input id="geocomplete" type="text" placeholder="Type in an address" name="address" class="form-control location" value="<?php if ($isEdit) {echo $details->address;}?>" data-rule-extendalphanumeric="true"/>
                                <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                                <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>
                            </div>
<!--                            <div class="col-sm-2">
                                <input id="find" type="button" value="find" class="btn btn-danger form-control"/>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="map_canvas"></div>
                            </div>-->
                        </div>

                         <div class="form-group">
                            <label for="information" class="control-label col-sm-2">Other Information</label>
                            <div class="col-sm-10">
                                <textarea name="information" id="information" class="form-control ckeditor" data-rule-extendalphanumeric="true"><?php
                                    if (@$isEdit) {
                                        echo $details->information;
                                    }
                                    ?></textarea>
                                <span class="help-block">This is page slug recognization</span>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Banner Images</label>
                            <div class="col-sm-10">
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

                            
                    </div>


                </div>
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo "Please enter the User's Login Information";//lang($subject . '_user_subheading'); ?></h3>
                    </div>
                    <div class="box-content nopadding">
                        <div class="form-group">
                            <label for="username" class="control-label col-sm-2">Username <span style="color: #cc0000;">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="username" id="username" value="<?php if (@$isEdit) {echo $details->username;}?>" class="form-control" data-rule-alphanumeric="true" data-rule-required="true">
                                <!--<span class="help-block">This is just a Job Filed Type</span>-->
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="password" id="password" value="" class="form-control" data-rule-minlength="8" data-rule-required="true">
                                <span class="help-block">This is just a Job Filed Type</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="control-label col-sm-2">Confirm Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="password_confirm" id="password_confirm" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" value="" class="form-control">
                                <span class="help-block">This is just a Job Filed Type</span>
                            </div>
                        </div>-->

                        
                    </div>
                </div>
                <?php //if ($this->ion_auth->is_admin()){?>
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo lang('edit_user_groups_heading');?></h3>
                    </div>
                    <div class="box-content nopadding">
                            <div class="form-group">
                                <label for="groups" class="control-label col-sm-2">Group Names <span style="color: #cc0000;">*</span></label>
                                <div class="col-sm-6">
                                    <div class="check-demo-col">
                                        <?php foreach ($groups as $group) { ?>
                                            <div class="check-line">
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
                                                    if ((strpos("superAdmin", $gTYPE) !== false) || (strpos("manager", $gTYPE) !== false) || (strpos("clients", $gTYPE) !== false) || (strpos("users", $gTYPE) !== false)) {
                                                        ?>
                                                        <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> id="c9" class='icheck-me' data-skin="square" data-color="red">
                                                        <label class='inline' for="c9"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                                        <?php
                                                    }
                                                }elseif (strpos("manager", $groupTYPE) !== false) {//check if logged in user is manager type then allow
                                                    if ((strpos("clients", $gTYPE) !== false) || (strpos("users", $gTYPE) !== false)) {
                                                        ?>
                                                        <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> id="c9" class='icheck-me' data-skin="square" data-color="red">
                                                        <label class='inline' for="c9"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                                        <?php
                                                    }
                                                }elseif (strpos("clients", $groupTYPE) !== false) {
                                                    if (strpos("users", $gTYPE) !== false) {
                                                        ?>
                                                        <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>"<?php echo $checked; ?> id="c9" class='icheck-me' data-skin="square" data-color="red">
                                                        <label class='inline' for="c9"><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
                                                        <?php
                                                    }
                                                }
                                                ?>   
                                            </div>
                                        <?php } ?>   

                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <?php //}?>
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo "Submit your information";//lang($subject . '_user_subheading'); ?></h3>
                    </div>
                    <div class="box-content nopadding">
                        
                        
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Active <span style="color: #cc0000;">*</span></label>
                            <div class="col-sm-2">
                                <select name="active" id="active" class='chosen-select form-control'>
                                    <option value="1" <?php
                                    if (($isEdit) && ($details->active == '1')) {
                                        echo "selected";
                                    }
                                    ?>> Active </option>
                                    <option value="0" <?php
                                    if (($isEdit) && ($details->active == '0')) {
                                        echo "selected";
                                    }
                                    ?>> Inactive </option>
                                </select>
                            </div>
<!--                        </div>
                        <div class="form-group">-->
                            <label for="textfield" class="control-label col-sm-2">Status <span style="color: #cc0000;">*</span></label>
                            <?php 
                                $this->db->select("*");
                                $queryProfile = $this->db->get("profile");
                                $resultProfile = $queryProfile->result();
                                if(!empty($resultProfile)){
                            ?>
                            <div class="col-sm-2">
                                <select name="status" id="status" class='chosen-select form-control' data-rule-required="true" >
                                <?php 
                                    foreach($resultProfile as $profiles){
                                        $profileID = $profiles->profile_id;
                                        $profileTITLE = $profiles->profile_title;
                                        $profileUSERS = $profiles->users;
                                        $profileTEMPLATES = $profiles->templates;
                                ?>
                                    <option value="<?php echo $profileID;?>" <?php if (($isEdit) && ($details->profile_id == $profileID)) {echo "selected";}?>> <?php echo ucfirst($profileTITLE);?><?php if(!empty($profileUSERS)){echo "($profileUSERS U/ $profileTEMPLATES T)";}?> </option>
                                <?php }?>
                                </select>
                            </div>
                            <?php }?>

                        </div>
                        
                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-danger" value="<?php echo lang($subject.'_user_submit_btn');?>">
                            <!--<a href='javascript.history.go(-1)' class='btn btn-group'>Back</a>-->
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                            <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('[data-rel="chosen"],[rel="chosen"]').chosen();
    });
</script>


