<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        if($this->session->flashdata('success_message')){
            $message = $this->session->flashdata('success_message');
        }else if($this->session->flashdata('message')){
            $message = $this->session->flashdata('message');
        }else if($message){
            $message = $message;
        }
        
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'danger';
        $color = '#fff';
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }else{
            $message = @$error_message;
        }
        
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
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="myModalLabel">Information</h4>-->
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

<?php $isEdit = isset($details) ? true : false; ?>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group">
                <?php echo lang($subject . "_group_heading"); ?>
<!--                <a class="btn btn-primary" href="<1?php echo base_url('signin/create_user') ?>"><1?php echo lang('index_create_user_link');?> <i class="fa fa-plus"></i></a>-->
            </div>
        </div>
    </div>

<!--    <style>.messages{margin-left:50%;}</style>
    <div class="message" id="message" style="display:<?php echo $display ?>">
        <div class="messages">
            <div class="icon-messages icon-success"></div>
            <div id="displayMsg"><div id="infoMessage"><?php echo $message; ?></div></div>
            <a href="#" onclick="javascript:getElementById('message').style.display = 'none'" class="close-msg" title="close">Close</a>
        </div>               
    </div>-->
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (@$isEdit) {
                $groupId = $details->group_id;
            }
            ?>
            <?php //if(@$isEdit){uri_string();}else{echo base_url("signin/create_user");} ?>
            <form action="<?php if (@$isEdit) {echo base_url("signin/edit_group/$groupId");} else {echo base_url("signin/create_group");}?>" method="post" name="addEditform" id="addEditform" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                <!--<?php if (@$isEdit) { ?><input type="hidden" name="user_id" value="<?php echo $user->user_id ?>"/><?php } ?>-->
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo lang($subject . '_group_subheading'); ?></h3>
                    </div>
                    <div class="box-content nopadding">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Group Type</label>
                            <?php 
                                $users_groups = $this->ion_auth_model->get_users_groups($this->ion_auth->get_user_id())->row();
                                $groupTYPE = $users_groups->group_type;
                           ?>
                            <div class="col-sm-6">
                                <select name="group_type" id="group_type" class=' form-control' data-rel="chosen" required>
                                    <option value="" selected="selected">--select teacher---</option>
                                    
                                    <?php if($this->ion_auth->is_admin()){?>
                                        <option value="superAdmin" <?php if (($isEdit) && ($details->group_type == "superAdmin")) echo "selected"; ?>> Super Admin</option>
                                        <option value="manager" <?php if (($isEdit) && ($details->group_type == "manager")) echo "selected"; ?>> Manager</option>
                                    <?php }?> 
                                    <?php if((strpos("manager",$groupTYPE) !== false) ||(strpos("superAdmin",$groupTYPE) !== false)) {?>
                                        <option value="company" <?php if (($isEdit) && ($details->group_type == "company")) echo "selected"; ?>> Company</option>
                                    <?php }?>
                                    <?php if((strpos("company",$groupTYPE) !== false) || (strpos("manager",$groupTYPE) !== false) ||(strpos("superAdmin",$groupTYPE) !== false)) {?>
                                            <option value="users" <?php if (($isEdit) && ($details->group_type == "users")) echo "selected"; ?>> Users</option>
                                    <?php }?>
                                   
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="first_name" class="control-label col-sm-2">Group Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" value="<?php
                                if (@$isEdit) {
                                    echo $details->name;
                                }
                                ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="information" class="control-label col-sm-2">Group Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control ckeditor"><?php
                                    if (@$isEdit) {
                                        echo $details->description;
                                    }
                                    ?>
                                </textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i><?php echo "Submit your information"; //lang($subject . '_user_subheading');    ?></h3>
                    </div>
                    <div class="box-content nopadding">
                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-danger" value="<?php echo lang($subject . '_group_submit_btn'); ?>">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                            <button type="button" class="btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
