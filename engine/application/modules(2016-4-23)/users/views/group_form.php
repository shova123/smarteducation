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
        <h1>Group Information</h1>(<?php if(!empty($title)){echo $title;}?>)

        <div class="row">
            <div class="sample-form-elements">
                <?php if (@$isEdit) {$groupId = $details->group_id;}?>
                <form action="<?php if (@$isEdit) {echo base_url("users/edit_group/$groupId");} else {echo base_url("users/create_group");}?>" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                    <!--<?php if(@$isEdit){?><input type="hidden" name="user_id" value="<?php echo $user->user_id?>"/><?php }?>-->
                
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="group_type">Group Type <span style="color: #cc0000;">*</span></label>
                        <input type="text" name="group_type" id="group_type" value="users" class="form-control" data-rule-required="true" readonly>
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="name">Group Name <span style="color: #cc0000;">*</span></label>
                        <input type="text" name="name" id="name" value="<?php if (@$isEdit) {echo $details->name;}?>" class="form-control" data-rule-required="true" data-rule-alphanumeric="true" >
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="description">Group Information</label>
                        <textarea name="description" id="description" class="form-control ckeditor"><?php
                            if (@$isEdit) {
                                echo $details->description;
                            }
                            ?>
                        </textarea>
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submit" class="btn btn-primary submit-btn pull-right" value="<?php echo lang($subject . '_group_submit_btn'); ?>">
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                        <!--<button type="button" class="btn">Cancel</button>-->
                        <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view("include_dashboard/alert-message");?>
</div>

