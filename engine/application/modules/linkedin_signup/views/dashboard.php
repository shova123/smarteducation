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
//@session_start();
if ($this->session->flashdata('message')) {

    $display = 'block';
    $formClass = 'error';
    $formOuter = 'outererror';
    $formHead = 'error';
    $color = '#fff';
    $message = $this->session->flashdata('message');
} else {
    $display = 'none';
    $formClass = '';
    $formOuter = 'outer';
    $formHead = 'head';
    $color = '#000';
}
?>
<!-- dataTables -->

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

    <style>.messages{margin-left:50%;}</style>
    <div class="message" id="message" style="display:<?php echo $display ?>">
        <div class="messages">
            <div class="icon-messages icon-success"></div>
            <div id="displayMsg"><div id="infoMessage"><?php echo $message; ?></div></div>
            <a href="#" onclick="javascript:getElementById('message').style.display = 'none'" class="close-msg" title="close">Close</a>
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
                    <table class="table table-hover table-nomargin table-bordered dataTable">
                        <thead>
                            <tr>
                                <th><?php echo lang('index_fname_th'); ?></th>
                                <th><?php echo lang('index_lname_th'); ?></th>
                                <th><?php echo lang('index_email_th'); ?></th>
                                <th><?php echo lang('index_groups_th'); ?></th>
                                <th><?php echo lang('index_status_th'); ?></th>
                                <th><?php echo lang('index_action_th'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($users)) {
                                $count = 1;
                                foreach ($users as $user) {
                                    $editID = $user->user_id;
                                    $active = $user->active;
                                    if($active == '1'){
                                        $status = "Active";
                                    }elseif($active == '0'){
                                        $status = "Inactive";
                                    }
//                                    $imgname = $row->imgname;
//                                    $img = explode(':', $imgname);
//                                    $imgname = $img['0'];
                                    ?>

                                    <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                        <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group): ?>
                                                <?php echo anchor("signin/edit_group/" . $group->group_id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
                                            <?php endforeach ?>
                                        </td>
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $user->user_id;?>"  style="margin:5px; padding:5px 10px;">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>
                                        <!--<td><1?php echo ($user->active) ? anchor("signin/deactivate/" . $user->user_id, lang('index_active_link')) : anchor("signin/activate/" . $user->user_id, lang('index_inactive_link')); ?></td>-->
                                                <td><?php echo anchor("signin/edit_user/".$user->user_token, 'Edit') ;?></td>

                                                                <!--
                                                                <td>
                                                                    <ul class="gallery">
                                                                        <li>
                                                                            <a href="#">
                                                                                <img src="<?php echo base_url() ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/slides/<?php echo $imgname; ?>" alt="">
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
                                                                </td>
                                                                -->
                            <!--                                        <td>
                                        <?php //echo anchor("signin/edit_user/".$user->id, 'Edit') ; ?>
                                                                    <a class="edit" href="<?php echo base_url("signin/edit_user/" . $user->user_id) ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                                                    <a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                                                                    <a href="#modal-<?php echo $count; ?>" role="button" class="btn" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

                                                                    <div id="modal-<?php echo $count; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                                                </div>
                                                                                 /.modal-header 
                                                                                <div class="modal-body">
                                                                                    <p>
                                                                                        Are you sure to delete this Slider image
                                                                                    </p>
                                                                                </div>
                                                                                 /.modal-body 
                                                                                <div class="modal-footer">
                                                                                    <a href="<?php echo base_url("signin/delete_user/" . $user->user_id) ?>" class="btn btn-danger">Delete</a>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                                 /.modal-footer 
                                                                            </div>
                                                                             /.modal-content 
                                                                        </div>
                                                                         /.modal-dialog 
                                                                    </div>
                                                                </td>-->
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
    </div>
</div>