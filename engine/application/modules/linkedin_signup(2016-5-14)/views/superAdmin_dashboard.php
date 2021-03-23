<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text();
           
            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var _this = $(this);

            $.get('<?php echo base_url("signin/update_user_status"); ?>', {id: _id, status: _status},
            //alert(data);
            function (data) {
                _this.text(data);
                $('a#' + _id + '').addClass(data);
                //$('.cross').hide();
            });
        });
    });
</script>
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
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1><?php echo strtoupper($this->config->item('site_name')); ?> Dashboard</h1>
        </div>
        <div class="pull-right">
            <ul class="stats">
                <li class='lightred'>
                    <i class="fa fa-calendar"></i>
                    <div class="details">

                        <?php
                        if (!empty($users_details)) {
                            $created_on = $users_details->created_on;
                            $last_login = $users_details->last_login;
                            $ip_address = $users_details->ip_address;

                            $Y = date('Y', strtotime($last_login));
                            $m = date('m', strtotime($last_login));
                            $d = date('d', strtotime($last_login));
                            $mName = date("F", mktime(0, 0, 0, $m, 10));
                            $dName = date("l", strtotime($last_login));
                            //$timeDate = date('F jS, Y g:i:s a', mktime(0, 0, 0, 0, 0, $Y)); // November 30th, 2012 12:00:00 am
                            $timeDate = date('F jS, Y', mktime(0, 0, 0, 0, 0, $Y));
                        }
                        ?>
                        <span class="big">Last Login:</span>
                        <span class="medium"><?php echo "$mName $d, $Y"; ?> </span>
                        <span><?php echo "$dName"; ?></span>
                        <span class="big">From</span>
                        <span class="medium"><?php echo "$ip_address"; ?> </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?php echo base_url('signin/create_user') ?>"><?php echo lang('index_create_user_link'); ?> <i class="fa fa-plus"></i></a>
            </div>
            <div class="btn-group">
                <a class="btn btn-success" href="<?php echo base_url('signin/create_group') ?>"><?php echo lang('index_create_group_link'); ?> <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-table"></i>
                        <p><?php echo lang('index_subheading'); ?></p>
                    </h3>
                </div>
                <div class="box-content nopadding">
                    <!--<table class="table table-hover table-nomargin table-bordered dataTable">-->
                    <table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="text,text,text,null,select,daterange,null,null,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all">
                        <thead>
                            <tr>
                                <th><?php echo lang('index_fullname_th');?></th>
                                <th><?php echo lang('index_username_th');?></th>
                                <th><?php echo lang('index_email_th');?></th>
                                <th><?php echo lang('index_groups_th');?></th>
                                <th>Group Type</th>
                                <th><?php echo lang('index_reg_date_th');?></th>
                                <th><?php echo lang('index_status_th');?></th>
                                <th><?php echo "Login As";?></th>
                                <!--<th><?php echo lang('index_send_email_th');?></th>-->
                                <th><?php echo lang('index_action_th');?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($users)) {
                                $count = 1;
                                foreach ($users as $user) {
                                    $login_as_code   = sha1(md5(microtime()));
                                    $editID = $user->user_id;
                                    $active = $user->active;
                                    $firstname = $user->first_name;
                                    $lastname = $user->last_name;
                                    $user_name = $user->username;
                                    $sent_email = $user->sent_email;
                                    $fullName = ucfirst($firstname)." ". ucfirst($lastname); 
                                    
                                    $groupDetails= $this->ion_auth->get_users_groups($editID)->row();
                                    $groupName = @$groupDetails->name;
                                    $groupType = @$groupDetails->group_type;
                                    
                                    if($active == 1){
                                        $status = "Active";
                                    }elseif($active == 0){
                                        $status = "Inactive";
                                    }
//                                    $imgname = $row->imgname;
//                                    $img = explode(':', $imgname);
//                                    $imgname = $img['0'];
                                    if($groupName != "admin"){
                                    ?>

                                    <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                        <td><?php echo htmlspecialchars($fullName,ENT_QUOTES,'UTF-8');?></td>
                                        <td><?php echo htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');?></td>
                                        <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group):?>
                                                    <?php echo anchor("signin/edit_group/".$group->group_id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'));?>
                                            <?php endforeach?>
                                        </td>
                                        <td><?php echo ucfirst($groupType)?></td>
                                        <td><?php echo htmlspecialchars($user->created_on,ENT_QUOTES,'UTF-8');?></td>
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $user->user_id;?>"  style="margin:5px; padding:5px 10px;">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url("signin/login_as/".$user->user_token."/".$login_as_code);?>" style="margin:5px; padding:5px 10px;">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="glyphicon-keys"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="edit" href="<?php echo base_url("signin/edit_user/".$user->user_token) ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            
                                            <a class="edit" href="#modal-<?php echo $count; ?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                                            <div id="modal-<?php echo $count; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                        </div>
                                                        <!-- /.modal-header -->
                                                        <div class="modal-body">
                                                            <p>
                                                                Are you sure to delete this User <strong>(<?php echo $fullName;?>)</strong> <br>
                                                                <strong>NOTE:</strong> User will be removed from groups and also delete all the related templates,questions that has been created
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("signin/delete_user/".$user->user_token) ?>" class="btn btn-danger">Delete</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                        <!-- /.modal-footer -->
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>