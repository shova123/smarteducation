<script>
    function setOptions(chosen) {
        var selbox = document.addEditform.actions;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] =
                    new Option('--Select--', ' ');

        }
<?php
if (!empty($ModuleControllerMethods)) {
    foreach ($ModuleControllerMethods as $ModuleControllerKeys => $ModuleControllerValues) {
        ?>

                if (chosen == "<?php echo $ModuleControllerKeys; ?>") {
        <?php
        if (!empty($ModuleControllerValues)) {
            foreach ($ModuleControllerValues as $controllerMethodsKeys => $controllerMethodsValues) {
                $exportValues = explode("_", $controllerMethodsValues);
                $totalName = '';
                foreach ($exportValues as $nameKeys => $nameValues) {
                    $totalName.= "$nameValues ";
                }
                ?>
                            selbox.options[selbox.options.length] = new Option('<?php echo $totalName; ?>', '<?php echo $controllerMethodsValues; ?>');
                <?php
            }
        }
        ?>
                }
        <?php
    }
}
?>

    }
</script>
<?php
if (@$isEdit) {
    $token = $details->token;
}
?>
<?php $isEdit = isset($details) ? true : false; ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Group Detail
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">

                    <!--<form class="form-horizontal form-label-left" novalidate>-->
                    <!--<form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left" novalidate>-->
                    <?php //if(@$isEdit){echo base_url("permissions/edit_permissions/$token");}else{echo base_url("permissions/create_permissions");}?>
                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left">
                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
                        <input type="hidden" value="<?php if(@$isEdit){echo $details->user_id;}else{echo $this->session->userdata('user_id');}?>" name="user_id" />
                
                        <span class="section">Please set the permission information below</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Module <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <select name="controller" onchange="setOptions(document.addEditform.controller.options[ document.addEditform.controller.selectedIndex].value);" id="controller" class="form-control" data-rel="chosen" >
                                    <option value="" selected="selected">--Select Module---</option>
                                    <?php 
                                    if(!empty($ModuleControllerMethods)){
                                        foreach($ModuleControllerMethods as $ModuleControllerKeys=>$ModuleControllerValues){
                                            $exploded = explode("/", $ModuleControllerKeys);
                                            $Module = $exploded[0];
                                    ?>
                                    <option value="<?php echo $ModuleControllerKeys;?>" <?php if(($isEdit) && ($details->controller == "$ModuleControllerKeys")){echo "selected";}?>> <?php echo $Module;//$ModuleControllerKeys;?> </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Methods <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="actions" id="select" class="form-control" data-rel="chosen">
                                    <option value="" selected="selected">---Select Methods---</option>
                                    <?php
                                    if ($isEdit) {
                                        if (!empty($ModuleControllerMethodsSelect)) {
                                            $count=0;
                                            foreach ($ModuleControllerMethodsSelect as $ModuleControllerKeysSelect => $ModuleControllerValuesSelect) {
                                                if (!empty($ModuleControllerKeysSelect)) {
                                                    $countY=0;
                                                    foreach ($ModuleControllerValuesSelect as $controllerMethodsKeysSelect => $controllerMethodsValuesSelect) {
                                                        $exportValues = explode("_", $controllerMethodsValuesSelect);
                                                        $totalName = '';
                                                        foreach ($exportValues as $nameKeys => $nameValues) {
                                                            $totalName.= "$nameValues ";
                                                        }
                                    ?>
                                    <option value="<?php echo $controllerMethodsValuesSelect; ?>" <?php if (($isEdit) && ($details->actions == "$controllerMethodsValuesSelect")) { echo "selected"; }?>><?php echo $totalName; ?></option>
                                    <?php
                                                        
                                                    $countY++;}
                                                }
                                            $count++;}
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" class="ckeditor form-control col-md-7 col-xs-12">
                                    <?php
                                    if (@$isEdit) {
                                        echo $details->description;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                        <?php if ($this->ion_auth->is_admin()){?>
                        <span class="section">Please Select the groups to grant permission</span>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Group Names
<!--                                <br>
                                <small class="text-navy">Normal Bootstrap elements</small>-->
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if($isEdit){$explodeGroups = explode(",", $details->groups);}?>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" name="groups[]" value="superAdmin" <?php if(@$isEdit){ foreach($explodeGroups as $grpKeys=>$grpValues){ if($grpValues =='superAdmin'){ ?> <?php }}}?> disabled="disabled" checked="checked" >
                                        Super Admin
                                    </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" name="groups[]" value="manager" <?php if(@$isEdit){ foreach($explodeGroups as $grpKeys=>$grpValues){ if($grpValues =='manager'){?>  checked="checked"<?php }}}?>>
                                        Manager
                                    </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" name="groups[]" value="user" <?php if(@$isEdit){ foreach($explodeGroups as $grpKeys=>$grpValues){ if($grpValues =='user'){?>  checked="checked"<?php }}}?>>
                                        User
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                        <?php }?>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="status" class="select2_single form-control">
                                    <option value="Publish" 
                                    <?php if (($isEdit) && ($details->status == 'Publish')) {?>
                                        selected="selected"
                                    <?php }?>> Publish</option>
                                    <option value="Unpublish" <?php
                                    if (($isEdit) && ($details->status == 'Unpublish')) {?>
                                        selected="selected"
                                    <?php }?>> Unpublish</option>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" name="submitDetails" class="btn btn-success" value="Save Changes">
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- form validation -->
<!--<script src="<?php echo base_url(); ?>gears/admin/js/validator/validator.js"></script>
<script>
                                    // initialize the validator function
                                    validator.message['date'] = 'not a real date';

                                    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
                                    $('form')
                                            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                                            .on('change', 'select.required', validator.checkField)
                                            .on('keypress', 'input[required][pattern]', validator.keypress);

                                    $('.multi.required')
                                            .on('keyup blur', 'input', function () {
                                                validator.checkField.apply($(this).siblings().last()[0]);
                                            });

                                    // bind the validation to the form submit event
                                    //$('#send').click('submit');//.prop('disabled', true);

                                    $('form').submit(function (e) {
                                       // e.preventDefault();
                                        var submit = true;
                                        // evaluate the form using generic validaing
                                        if (!validator.checkAll($(this))) {
                                            submit = false;
                                        }

                                        if (submit)
                                            this.submit();
                                        return false;
                                    });

                                    /* FOR DEMO ONLY */
                                    $('#vfields').change(function () {
                                        $('form').toggleClass('mode2');
                                    }).prop('checked', false);

                                    $('#alerts').change(function () {
                                        validator.defaults.alerts = (this.checked) ? false : true;
                                        if (this.checked)
                                            $('form .alert').remove();
                                    }).prop('checked', false);
</script>-->