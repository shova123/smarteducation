<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">

<script type="text/javascript">
<?php $timestamp = time();?>
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
                'timestamp': '<?php echo $timestamp;?>',
                'targetFolder': '/uploads/profile/',
                'token': '<?php echo @md5('unique_salt' . $timestamp);?>'
            },
            'method': 'post', // The method to use when submitting the upload
            'multi': false, // Set to true to allow multiple file selections
            'queueID': 'queueImage', // The ID of the file queue
            'queueSizeLimit': 0, // The maximum number of files that can be in the queue
            'removeCompleted': false, // Set to true to remove files that have completed uploading
            'simUploadLimit': 1, // The maximum number of files to upload at once
            'truncateLength': 0, // The length to truncate the file names to
            'uploadLimit': 0, // The maximum number of files you can upload
            'uploadScript': '<?php echo base_url();?>gears/admin/uploadifive/uploadifive.php',
            'onUploadComplete': function (file, data, response) {
                //console.log(data);//alert(data);
                imagePath = "<?php echo str_replace("\\", "/", ROOT);?>";
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="' + data + '" class="img-wrap"><img src="' + "<?php echo base_url();?>" + 'gears/admin/createThumb/create_thumb.php?src=' + imagePath + 'uploads/profile/' + data + '&w=150&h=150" alt="' + data + '" /></a></div>');
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
        $.post("<?php echo base_url("signin/delete_user_image");?>", {imgName: _img},
        function (data) {
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
    function delete_image(name) {
        var filelist = $('#fileList').val();
        var filenames = filelist.split(':'); //alert(filenames.length);
        $('#fileList').val('');
        for (var i = 0; i < filenames.length; i++)
        {
            if (filenames[i] != name)
            {
                if ($('#fileList').val() == '')
                    $('#fileList').val(filenames[i]);
                else
                    $('#fileList').val($('#fileList').val() + ':' + filenames[i]);
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
<?php   if(!empty($sub_category_list)) {
            foreach ($sub_category_list as $allSubCat) {
                $subCatID= $allSubCat->sub_cat_id;
                $catID= $allSubCat->category_id;
                $subCatTITLE= $allSubCat->subcategory_title;
                $subCatSLUG = $allSubCat->subcategory_slug;
?>
                if(chosen == "<?php echo $catID?>") {
                    selbox.options[selbox.options.length] = new Option('<?php echo $subCatTITLE; ?>','<?php echo $subCatID; ?>');
                }
<?php       }
        }
?>
    }
</script>
<!--<style>
.map_canvas { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}
</style>-->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url();?>gears/admin/js/jquery.geocomplete.js"></script> 

<script>
      $(function(){
        $("#geocomplete").geocomplete({
            //map: ".map_canvas",
            details: "form",
            country: "AUS",
            types: ["geocode", "establishment"]

        });

      });
      $(document).ready(function() {
        $("#geocomplete").trigger("geocode");
    });
</script>
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
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade " id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content alert alert-<?php echo $alertclass;?> ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Information</h4>
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
<!--<1?php if(@$message){?>
    <script>
        window.onload = function(){
            //$(".alert").removeClass("in").show();
            $(".alert").delay(200).addClass("in").fade(10000);
        };
    </script>
<1?php }?>
<div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
    <div class="alert alert-<1?php echo $alertclass; ?> fade <1?php echo $display; ?>">
        <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
        <strong><1?php echo @$message; ?></strong> 
    </div>
</div>-->

    
<?php $isEdit = isset($details) ? true : false;?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12 form-bk">
        <h1>Users Information</h1>
        
        <div class="row">
            <div class="sample-form-elements">
                <?php if(@$isEdit){$userTokens = $details->user_token;}?>
                <form action="<?php if(@$isEdit){echo base_url("users/edit_user/$userTokens");}else{echo base_url("users/create_user");}?>" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                    <input type="hidden" id="fileList" name="fileList" value="<?php if ($isEdit) {echo $details->home_image;}?>" />
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                <?php if(@$isEdit){ foreach($csrf as $key=>$value){?>
                    <input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>"/>
                <?php } }?>
                <?php if(@$isEdit){?><input type="hidden" name="user_id" value="<?php echo $user->user_id?>"/><?php }?>
                
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Category <span style="color: #cc0000;">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" onchange="setOptions(document.addEditform.category_id.options[ document.addEditform.category_id.selectedIndex].value);" data-rule-required="true" >
                            <option value="">--select category--</option>
                            <?php
                            if (!empty($category_list)) {
                                foreach ($category_list as $listCateogry) {
                                    $categoryID = $listCateogry->category_id;
                                    $categoryTITLE = $listCateogry->category_title;
                                    ?>
                                    <option value="<?php echo $categoryID; ?>" <?php
                                    if (($isEdit) && ($details->category_id == $categoryID)) {
                                        echo "selected";
                                    }
                                    ?>> <?php echo ucfirst($categoryTITLE); ?> </option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Sub Category <span style="color: #cc0000;">*</span></label>
                        <select name="sub_cat_id" id="sub_cat_id" class='form-control' data-rule-required="true" >
                            <option value="" selected="selected">---Select Sub Category---</option>
                            <?php
                            if ($isEdit) {
                                if (!empty($sub_category_list)) {
                                    foreach ($sub_category_list as $subCatList) {
                                        $subCatID = $subCatList->sub_cat_id;
                                        $subCatTITLE = $subCatList->subcategory_title;
                                        $subCatSLUG = $subCatList->subcategory_slug;
                                        ?>
                                        <option value="<?php echo $subCatID; ?>" <?php
                                        if (($isEdit) && ($details->sub_cat_id == $subCatID)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $subCatTITLE; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                
                <?php if($user_create_restriction == false){?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="first_name">First Name <span style="color: #cc0000;">*</span></label>
                        <!--<input type="text" class="form-control" id="textitem" placeholder="text input here">-->
                        <input type="text" name="first_name" id="first_name" value="<?php if (@$isEdit) {echo $details->first_name;}?>" class="form-control" data-rule-required="true" data-rule-lettersonly="true">
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="last_name">Last Name <span style="color: #cc0000;">*</span></label>
                        <!--<input type="text" class="form-control" id="textitem" placeholder="text input here">-->
                        <input type="text" name="last_name" id="last_name" value="<?php if (@$isEdit) {echo $details->last_name;}?>" class="form-control" data-rule-required="true" data-rule-lettersonly="true">
                    </div>
                <?php }?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="email">Email <span style="color: #cc0000;">*</span></label>
                        <input type="email" name="email" id="email" value="<?php if (@$isEdit) {echo $details->email;}?>" data-rule-email="true" data-rule-required="true" class="form-control">
                    </div>
                <?php if($user_create_restriction == false){?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" placeholder="your mobile number: 61 xxx xxx xxx" value="<?php if (@$isEdit) {echo $details->phone;}?>" class="form-control" data-rule-mobileAU="true">
                    </div>
                <?php }?>
<!--                    <div class="form-group col-sm-6 my-form-element">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company" id="company" value="<?php if (@$isEdit) {echo $details->company;}?>" class="form-control">
                    </div>-->
<!--                    <div class="form-group col-sm-12 my-form-element">
                            <label for="tag_keywords"># Tag Keywords</label>
                            <div class="col-sm-10">
                            <input type="text" name="tag_keywords" id="tag_keywords" class="tagsinput form-control" value="Bussiness,IT">
                            </div>
                    </div>-->
                    <?php if($user_create_restriction == false){?>
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="address">Address</label>
                        <input id="geocomplete" type="text" placeholder="Type in an address" name="address" class="form-control location" value="<?php if ($isEdit) {echo $details->address;}?>" data-rule-extendalphanumeric="true"/>
                            <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                            <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>
                    </div>
                    
<!--                    <div class="form-group col-sm-2 my-form-element">
                        <label for="address">Address</label>
                        <input id="find" type="button" value="find" class="btn btn-danger form-control"/>
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                         <div class="map_canvas"></div>
                    </div>-->
                    
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="textitem">Other Information</label>
                        <textarea name="information" id="information" class="form-control ckeditor" data-rule-extendalphanumeric="true"><?php
                            if (@$isEdit) {
                                echo $details->information;
                            }
                            ?>
                        </textarea>
                    </div>
                    <?php }?>
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-6 my-form-element">
                            <label for="username">Username <span style="color: #cc0000;">*</span></label>
                            <input type="text" name="username" id="username" value="<?php if (@$isEdit) {echo $details->username;}?>" class="form-control" data-rule-required="true" data-rule-alphanumeric="true" >
                        </div>
                    </div>
<?php if($user_create_restriction == false){?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="password">Password <span style="color: #cc0000;">*</span></label>
                        <input type="password" name="password" id="password" value="" class="complexify-me form-control" data-rule-minlength="8" data-rule-required="true" data-rule-nowhitespace="true">
                        <span class="help-block">
                                <div class="progress progress-info">
                                        <div class="bar bar-red" style="width: 0%"></div>
                                </div>
                        </span>
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="password_confirm">Confirm Password <span style="color: #cc0000;">*</span></label>
                        <input type="password" name="password_confirm" id="password_confirm" class="complexify-me form-control" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" value="" data-rule-nowhitespace="true">
<!--                        <span class="help-block">
                                <div class="progress progress-info">
                                        <div class="bar bar-red" style="width: 0%"></div>
                                </div>
                        </span>-->
                    </div>

                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textfield">Active <span style="color: #cc0000;">*</span></label>
                        <select name="active" id="active" class='form-control' data-rule-required="true" >
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
<?php }?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textfield">Status <span style="color: #cc0000;">*</span></label>
                        <?php 
                            $this->db->select("*");
                            $queryProfile = $this->db->get("profile");
                            $resultProfile = $queryProfile->result();
                            if(!empty($resultProfile)){
                        ?>
                            <select name="profile_id" id="profile_id" class='chosen-select form-control' data-rule-required="true" >
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
                        <?php }?>
                        
                    </div>
                    
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-6 my-form-element">
                            <label for="groups">Groups <span style="color: #cc0000;">*</span></label>
                            <div class="clearfix"></div>
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
                                                        if (strpos("clients", $groupTYPE) !== false) {
                                                        if (strpos("users", $gTYPE) !== false) {
                                                            ?>
                                                            <input type="radio" name="groups[]" value="<?php echo $group['group_id']; ?>" <?php echo $checked;?> >
                                                            <!--id="c9" class='icheck-me' data-skin="square" data-color="red"-->
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
<?php if($user_create_restriction == false){?>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="home_image">Profile Image</label>
                        <!--<input class="form-control input-lg" id="password_confirm" name="password_confirm" placeholder="Password" type="password" value="" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" >-->
                                <div id="queueImage"></div>
                                <div class="clearfix"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true" data-rule-imagevalidation="true">
                                <div class="clearfix"></div>
                                <div class="imagethumbs-form">
                                    <?php
                                    if ($isEdit) {
                                        $imgname = $details->home_image;
                                        $img = explode(':', $imgname);
                                        //dumparray($img);
                                        if (!empty($imgname)) {
                                            echo '';
                                            foreach ($img as $i) {
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
<?php }?>
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submit" class="btn btn-primary submit-btn pull-right" value="<?php echo lang($subject.'_user_submit_btn');?>">
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                        <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view("include_dashboard/alert-message");?>
</div>

