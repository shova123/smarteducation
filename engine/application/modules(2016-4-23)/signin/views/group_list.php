<div class="">
    <div class="page-title">
        <div class="title_left">
            <a href="<?php echo base_url('signin/create_group');?>" class="btn btn-round btn-primary" type="button">Add Group</a>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Below is list of all groups</h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!--<table id="example" class="table table-striped responsive-utilities jambo_table">-->
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="text,select,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th>Group Name </th>
                                <th>Group Role </th>
                                <th class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($groups)) {
                                $count = 1;
                                foreach ($groups as $group) {
                                    $group_id = $group->group_id;
                                    $name = $group->name;
                                    $exploded = explode("_", $name);
                                    $f_gName="";foreach($exploded as $gName){$f_gName = $f_gName."$gName ";}$trimmedGname = trim($f_gName, " ");
                                    $groupType = $group->group_type;
                                    $description = $group->description;
                            ?>
                            <tr class="even pointer">
<!--                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>-->
                                <td><?php echo $trimmedGname;?></td>
                                <td><?php echo $groupType;?></td>
                                <td class=" last">
                                        <a class="edit" href="<?php echo base_url("signin/edit_group/$group_id") ?>">
                                            <button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <a href="#modal-<?php echo $count; ?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

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
                                                            Are you sure to delete this Group
                                                        </p>
                                                    </div>
                                                    <!-- /.modal-body -->
                                                    <div class="modal-footer">
                                                        <a href="<?php echo base_url("signin/delete_group/$group_id") ?>" class="btn btn-danger">Delete</a>
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