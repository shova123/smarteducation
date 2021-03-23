<?php $isEdit = isset($details) ? true : false; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-edit"></i><?php echo $page_title;?></h3>
                </div>
                <div class="box-content nopadding">
                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' >
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Profile Title</label>
                                <div class="col-sm-10">
                                        <input type="text" name="profile_title" id="profile_title" value="<?php if (@$isEdit) echo $details->profile_title; ?>" class="form-control" readonly>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">User Capacity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="users" id="users" value="<?php if (@$isEdit) echo $details->users; ?>" class="form-control" />
                                    <span class="help-block">Profile capacity to add Users<p style="color: #cc0000;"> 0 is set as default unlimited number of Users</p></span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Template Capacity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="templates" id="templates" value="<?php if (@$isEdit) echo $details->templates; ?>" class="form-control" />
                                    <span class="help-block">Profile capacity to add Templates<p style="color: #cc0000;"> 0 is set as default unlimited number of Templates</p></span>
                                </div>
                        </div>
                            
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Profile Content </label>
                                <div class="col-sm-10">
                                        <textarea name="content" id="content" class="form-control ckeditor"><?php if (@$isEdit) echo $details->content; ?></textarea>
                                        <span class="help-block">Describe the profile</span>
                                </div>
                        </div>
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