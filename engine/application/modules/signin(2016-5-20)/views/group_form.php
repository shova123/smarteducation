<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<script>
    $(function(){
        $('#group_name').slugIt({
            output: '#name',
            separator: '_',
        });
        $('#group_name').keyup();
    });
</script>
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
<!--                                <div class="x_title">
                                    <h2>Form validation <small>sub title</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>-->
                                <div class="x_content">

                                    <!--<form class="form-horizontal form-label-left" novalidate>-->
                                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate">
                                        <span class="section">Please enter the group information below</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Group Role <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="group_type" id="group_type" class=' form-control' data-rel="chosen" data-rule-required="true">
                                                    <option value="" selected="selected">--select Group type---</option>
                                                    <option value="superAdmin" <?php if (($isEdit) && ($details->group_type == "superAdmin")) echo "selected"; ?>> Super Admin</option>
                                                    <option value="manager" <?php if (($isEdit) && ($details->group_type == "manager")) echo "selected"; ?>> Manager</option>
                                                    <option value="user" <?php if (($isEdit) && ($details->group_type == "user")) echo "selected"; ?>> User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Group Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="group_name" value="<?php if (@$isEdit) {$group_named = $details->name; $exploded = explode("_", $group_named); $f_gName="";foreach($exploded as $gName){$f_gName = $f_gName."$gName ";}$trimmedGname = trim($f_gName, " ");echo $trimmedGname;}?>" class="form-control col-md-7 col-xs-12" placeholder="e.g Data Manager" data-rule-required="true">
                                                <input type="text" name="name" id="name" value="<?php if (@$isEdit) {echo $details->name;}?>" hidden="">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Information<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="description" id="description" required="required" class="ckeditor form-control col-md-7 col-xs-12">
                                                    <?php
                                                    if (@$isEdit) {
                                                        echo $details->description;
                                                    }
                                                    ?>
                                                </textarea>
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
