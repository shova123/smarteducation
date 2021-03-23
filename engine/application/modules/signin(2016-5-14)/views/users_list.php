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


<div class="">
    <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url('signin/create_user') ?>"><?php echo lang('index_create_user_link');?> <i class="fa fa-plus"></i></a>
        
            <!--<a class="btn btn-success" href="<?php echo base_url('signin/create_group') ?>"><?php echo lang('index_create_group_link');?> <i class="fa fa-plus"></i></a>-->
        </div>

<!--        <div class="title_right">
            <button class="btn btn-round btn-success" type="button">Add Group</button>
        </div>-->
    </div>
    
    <div class="clearfix"></div>
    
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo lang('index_subheading');?></h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="text,text,select,null,null,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
                    <!--<table id="example" class="table table-striped responsive-utilities jambo_table">-->
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <!--<th><?php echo lang('index_fullname_th');?></th>-->
                                <th><?php echo lang('index_username_th');?></th>
                                <th><?php echo lang('index_email_th');?></th>
                                <!--<th><?php echo lang('index_groups_th');?></th>-->
                                <th>Group Type</th>
                                <!--<th><?php echo lang('index_reg_date_th');?></th>-->
                                <th><?php echo lang('index_status_th');?></th>
                                <th><?php echo "Login As";?></th>
                                <!--<th><?php echo lang('index_send_email_th');?></th>-->
                                <th class=" no-link last"><span class="nobr"><?php echo lang('index_action_th');?></span></th>
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
                                    $fullName = "$firstname $lastname"; 
                                    
                                    
                                    $groupDetails= $this->ion_auth->get_users_groups($editID)->row();
                                    $groupName = @$groupDetails->name;
                                    $groupType = @$groupDetails->group_type;
                                    
                                    $present_date = date("Y-m-d");
                                        $p_Y = date('Y', strtotime($present_date));
                                        $p_m = date('m', strtotime($present_date));
                                    $created_on = $user->created_on;
                                        $c_Y = date('Y', strtotime($created_on));
                                        $c_m = date('m', strtotime($created_on));
                                    $viewTutorial = $user->view_tutorial;
                                        
                                    if($active == 1){
                                        $status = "Active";
                                    }elseif($active == 0){
                                        $status = "Inactive";
                                    }
//                                    $imgname = $row->imgname;
//                                    $img = explode(':', $imgname);
//                                    $imgname = $img['0'];
                                    ?>

                                    <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                        <!--<td><?php echo htmlspecialchars($fullName,ENT_QUOTES,'UTF-8');?></td>-->
                                        <td><?php echo htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');?> <?php if(($p_Y == $c_Y) && ($p_m == $c_m) && ($viewTutorial == 0)){?><span class="badge" style="background-color: #CC0000;">New</span><?php }?></td>
                                        <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
<!--                                        <td>
                                            <?php foreach ($user->groups as $group):?>
                                                    <?php echo anchor("signin/edit_group/".$group->group_id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                                            <?php endforeach?>
                                        </td>-->
                                        <td><?php echo ucfirst($groupType)?></td>
                                        <!--<td><?php echo htmlspecialchars($user->created_on,ENT_QUOTES,'UTF-8');?></td>-->
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $user->user_id;?>"  style="margin:5px; padding:5px 10px;<?php if(!empty($active)){?>background-color: #006600;<?php }?>" class="badge">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url("signin/login_as/".$user->user_token."/".$login_as_code);?>" style="margin:5px; padding:5px 10px;">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="fa fa-key"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <!--<td><1?php echo ($user->active) ? anchor("signin/deactivate/".$user->user_id, lang('index_active_link')) : anchor("signin/activate/". $user->user_id, lang('index_inactive_link'));?></td>-->
<!--                                        <td><1?php echo anchor("signin/edit_user/".$user->id, 'Edit') ;?></td>-->
                                        
<!--                                        <td>
                                            <ul class="gallery">
                                                <li>
                                                    <a href="#">
                                                        <img src="<?php echo base_url() ?>assets/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/slides/<?php echo $imgname; ?>" alt="">
                                                    </a>
                                                    <div class="extras">
                                                        <div class="extras-inner">
                                                            <a href="<?php echo base_url(); ?>uploads/slides/<?php echo $imgname; ?>" class='colorbox-image' rel="group-1">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>-->
<!--                                        <td>
                                            <a href="<?php echo base_url("signin/send_user_email/".$user->user_token);?>" style="margin:5px; padding:5px 10px;">
                                                <?php if($sent_email == '1'){
                                                    $btn = "btn-success";
                                                    $icon = "glyphicon-message_out";
                                                }else{
                                                    $btn = "btn-warning";
                                                    $icon = "glyphicon-envelope";
                                                }?>
                                                <button class="btn btn-xs <?php echo $btn;?>">
                                                    <i class="<?php echo $icon;?>"></i>
                                                </button>
                                            </a>
                                            
                                            <?php if($sent_email=='1'){?>
                                            <a href="<?php echo base_url("signin/send_user_email/".$user->user_token);?>">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="glyphicon-message_plus"></i>
                                                </button>
                                            </a>    
                                            <?php }?>
                                            
                                        </td>-->
                                        <td>
                                            <?php //echo anchor("signin/edit_user/".$user->id, 'Edit') ;?>
                                            <a class="edit" href="<?php echo base_url("signin/edit_user/".$user->user_token) ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            <!--<a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>-->
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
                                                                Are you sure to delete this user <strong><?php echo ucfirst($fullName);?></strong>
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
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <br />
        <br />
        <br />

    </div>
</div>