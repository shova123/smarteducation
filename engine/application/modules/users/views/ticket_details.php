<?php
//@session_start();
if ($this->session->flashdata('message')) {

    $display = 'block';
    $formClass = 'error';
    $formOuter = 'outererror';
    $formHead = 'error';
    $color = '#fff';
    $message = $this->session->flashdata('message');
} else if (!empty($message)) {
    $display = 'block';
    $formClass = 'error';
    $formOuter = 'outererror';
    $formHead = 'error';
    $color = '#fff';
    $message = $message;
} else {
    $display = 'none';
    $formClass = '';
    $formOuter = 'outer';
    $formHead = 'head';
    $color = '#000';
}
?>

<script type="text/javascript">   
    function setCategory(chosen) {
        
        var selbox = document.addEditform.sub_cat_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--', ' ');
        }
        selbox.options[selbox.options.length] = new Option('--select Subcategory--', '');
    <?php
    if (!empty($sub_category)) {

        foreach ($sub_category as $subCat) {
            $catID = $subCat->category_id;
            $subCatID = $subCat->sub_cat_id;
            $subCatTITLE = $subCat->subcategory_title;
            ?>

                        if (chosen == <?php echo $catID ?>) {
                            selbox.options[selbox.options.length] = new Option('<?php echo $subCatTITLE; ?>', '<?php echo $subCatID; ?>');
                        }
            <?php
        }
    }
    ?>

    }
</script>
<script type="text/javascript">  
    function setSubCategory(chosenSub) {
        var selboxSub = document.addEditform.temp_id;
        selboxSub.options.length = 0;
        if (chosenSub == " ") {
            selboxSub.options[selboxSub.options.length] =new Option('--Select--', ' ');
        }
        selboxSub.options[selboxSub.options.length] = new Option('--select Template--', '');
    <?php
    if (!empty($templates)) {
        foreach ($templates as $templatesDetail) {
            $category_id = $templatesDetail->category_id;
            $sub_cat_id = $templatesDetail->sub_cat_id;
            $temp_id = $templatesDetail->temp_id;
            $templateTITLE = $templatesDetail->template_title;
            ?>

                        if (chosenSub == <?php echo $sub_cat_id ?>) {
                            selboxSub.options[selboxSub.options.length] = new Option('<?php echo $templateTITLE; ?>', '<?php echo $temp_id; ?>');
                        }
            <?php
        }
    }
    ?>

    }
</script>

<script type="text/javascript"> 
    function setTemplates(chosen) {
        //var selboxTemp = document.addEditform.c_user_id;
        var selboxTemp = document.getElementById("c_user_id");
        selboxTemp.options.length = 0;
//        if (chosen == " ") {
//            selboxTemp.options[selboxTemp.options.length] = new Option('--Select--', ' ');
//        }
//        selboxTemp.options[selboxTemp.options.length] = new Option('--select Users--', '');
        <?php
        if (!empty($temp_c_users)) {
            foreach ($temp_c_users as $usersDetailed) {
                $user_ids = $usersDetailed->user_id;
                $c_user_ids = $usersDetailed->c_user_id;
                $temp_ids = $usersDetailed->temp_id;
                $first_named = $usersDetailed->first_name;
                $last_named = $usersDetailed->last_name;
                $fullNamed = "$first_named $last_named";
        ?>
                    if (chosen == <?php echo $temp_ids;?>) {
                        selboxTemp.options[selboxTemp.options.length] = new Option('<?php echo $fullNamed; ?>', '<?php echo $c_user_ids; ?>');
                    }
        <?php
            }
        }
        ?>

    }
</script>


<?php $isEdit = isset($report_details) ? true : false; ?>
<?php $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());?>

<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">
        <h1>Template Information</h1>

        <div class="row">
            <div class="sample-form-elements">
                <form action="" method="post" name="addEditform" id="addEditform" class="form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                    <input type="hidden" value="<?php if(!empty($isEdit)){ echo $report_details->report_token;}else{ echo md5(uniqid(mt_rand(), True)); }?>" name="report_token" />
                    <input type="hidden" value="<?php if(!empty($user_id)){ echo @$user_id;}?>" name="user_id" />
                    <input type="hidden" value="<?php if(!empty($c_user_id)){ echo @$c_user_id;}?>" name="c_user_id" />
                    
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Category</label>
                        <select name="category_id" id="category_id" class="form-control" onchange="setCategory(document.addEditform.category_id.options[ document.addEditform.category_id.selectedIndex].value);" disabled="disabled">
                            <option value="">--select category--</option>
                            <?php
                            if (!empty($category)) {
                                foreach ($category as $listCateogry) {
                                    $categoryID = $listCateogry->category_id;
                                    $categoryTITLE = $listCateogry->category_title;
                                    ?>
                                    <option value="<?php echo $categoryID; ?>" <?php
                                    if (($isEdit) && ($report_details->category_id == $categoryID)) {
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
                        <label for="textitem">Sub Category</label>
                        <select name="sub_cat_id" id="sub_cat_id" class='form-control' onchange="setSubCategory(document.addEditform.sub_cat_id.options[ document.addEditform.sub_cat_id.selectedIndex].value);" disabled="disabled">
                            <option value="" selected="selected">---Select Sub Category---</option>
                            <?php
                            if ($isEdit) {
                                if (!empty($sub_category)) {
                                    foreach ($sub_category as $subCatList) {
                                        $subCatID = $subCatList->sub_cat_id;
                                        $subCatTITLE = $subCatList->subcategory_title;
                                        $subCatSLUG = $subCatList->subcategory_slug;
                                        ?>
                                        <option value="<?php echo $subCatID; ?>" <?php
                                        if (($isEdit) && ($report_details->sub_cat_id == $subCatID)) {
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
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="textitem">Templates</label>
                        <select name="temp_id" id="temp_id" onchange="setTemplates(document.addEditform.temp_id.options[ document.addEditform.temp_id.selectedIndex].value);" class='form-control' disabled="disabled">
                            <option value="" selected="selected">---Select Template---</option>
                            <?php
                            if ($isEdit) {
                                if (!empty($templates)) {
                                    foreach ($templates as $tempList) {
                                        $tempID = $tempList->temp_id;
                                        $tempTITLE = $tempList->template_title;
                                        ?>
                                        <option value="<?php echo $tempID; ?>" <?php
                                        if (($isEdit) && ($report_details->temp_id == $tempID)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $tempTITLE; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 my-form-element">
                        <label for="c_user_id">Temp Creator Users</label>
                        <select name="c_user_id" id="c_user_id" class='form-control' disabled="disabled">
                            <!--<option value="" selected="selected">---Select Users---</option>-->
                            <?php
                            if ($isEdit) {
                                if (!empty($temp_c_users)) {
                                    foreach ($temp_c_users as $userList) {
                                        $temp_C_userID = $userList->user_id;
                                        $temp_C_userFIRSTname = $userList->first_name;
                                        $temp_C_userLASTname = $userList->last_name;
                                        $temp_C_userFULLname = "$temp_C_userFIRSTname $temp_C_userLASTname";
                                        ?>
                                        <option value="<?php echo $temp_C_userID; ?>" <?php
                                        if (($isEdit) && ($report_details->c_user_id == $temp_C_userID)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $temp_C_userFULLname; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="<?php if (!empty($isEdit)){echo $report_details->subject;}?>" data-rule-required="true" disabled="disabled">
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <!--<label for="textitem">Message</label>-->
                        <div class="box box-color green box-small box-bordered">
                            <div class="box-title"><h3><i class="fa fa-envelope"></i> Message</h3></div>
                            <div class="box-content" style="text-justify: auto;">
                                <?php if (@$isEdit) {echo $report_details->content;}?>
                            </div>

                        </div>
                        
<!--                        <textarea name="content" id="content" class="form-control ckeditor"><?php
                            if (@$isEdit) {
                                echo $report_details->content;
                            }
                            ?>
                        </textarea>-->
                    </div>
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submitReport" class="btn btn-primary submit-btn pull-right" value="Submit">
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                        <button type="button" onclick="history.go(-1);" class="btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view("include_dashboard/alert-message");?>
</div>

