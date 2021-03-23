<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text();
           
            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var _this = $(this);

            $.get('<?php echo base_url("permissions/update_permissions_status"); ?>', {id: _id, status: _status},
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
            <!--<a href="<?php echo base_url('signin/create_group');?>" class="btn btn-round btn-success" type="button">Add Group</a>-->
            <a class="btn btn-round btn-primary" href="<?php echo base_url('permissions/create_permissions') ?>">Create New Permission <i class="fa fa-plus"></i></a>
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
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th>Modules</th>
                                <th>Actions</th>
                                <th>Permission Groups</th>
                                <th>Parent User</th>
                                <th>Status</th>
                                <th class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($permissions)) {
                                $count = 1;
                                foreach ($permissions as $permission) {
                                    $editID = $permission->p_id;
                                    $token = $permission->token;
                                    $controller = $permission->controller;
                                    $actions = $permission->actions;
                                        $exportValues = explode("_", $actions);
                                        $totalActionName = '';
                                        foreach ($exportValues as $nameKeys => $nameValues) {
                                            $totalActionName.= "$nameValues ";
                                        }
                                    $groups = $permission->groups;
                                    $user_id = $permission->user_id;
                                    $status = $permission->status;
                                    $userDetails = $this->ion_auth->user($user_id)->row();
                                    $username = $userDetails->username;
                                    
                                    $exploded = explode("/", $controller);
                                    $Module = $exploded[0];
                            ?>
                            <tr class="even pointer">
<!--                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>-->
                                <td><?php echo htmlspecialchars($Module,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($totalActionName,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($groups,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($username,ENT_QUOTES,'UTF-8');?></td>
                                <td class="publish_status">
                                    <a href="javascript:;" id="<?php echo $permission->p_id;?>"  style="margin:5px; padding:5px 10px;">
                                        <?php echo @$status; ?>
                                    </a>
                                </td>
                                <td class=" last">
                                        <a class="edit" href="<?php echo base_url("permissions/edit_permissions/".$token) ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            <a href="#modal-<?php echo $count; ?>" role="button" class="btn" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

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
                                                                Are you sure to delete this Method <strong>[ <?php echo $Module;?> ]</strong>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("permissions/delete_permissions/".$token) ?>" class="btn btn-danger">Delete</a>
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
                            <?php $count++;}}?>

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