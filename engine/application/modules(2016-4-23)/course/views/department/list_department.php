<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text().trim();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo base_url('course/update_status_department');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>


<div class="">
    <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url("course/add_department")?>"> Add new Department <i class="fa fa-plus"></i></a>
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
                    <h2><?php echo ucfirst(@$page_title);?></h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="null,select,select,select,null,null,null" data-nosort="0" data-checkall="all">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th width="5%">Sn.</th>
                                <th width="15%">Level</th>
                                <th width="15%">Stream</th>
                                <th width="15%">Course</th>
                                <th width="15%">Department Name</th>
                                <th width="15%">Status</th>
                                <th width="15%" class=" no-link last"><span class="nobr">Operation</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(!empty($departments)){
                                    $count = 1;
                                        foreach($departments as $row){
                                            $department_id=$row->department_id;
                                            $level_id=$row->level_id;
                                            $departmentName = $row->department_name;
                                            $departmentAliasName = $row->department_alias;
                                            $active=$row->status;
                                            $levelBoardId = @$row->board_id;
                                            //$boardAliasName = @$row->board_alias;
                                            //$boardName = @$row->board_name;
                                            $levelName = @$row->level_name;
                                            $streamName = @$row->stream_name;
                                            $courseName = @$row->course_name;
                                            
                                            $this->db->select('*');
                                            $this->db->where('board_id' ,$levelBoardId); 
                                            $queryBoard = $this->db->get("course_board"); 
                                            $resultBoard = $queryBoard->row(); 
                                                $boardAliasName = @$resultBoard->board_alias;
                                                $boardName = @$resultBoard->board_name;
                                ?>

                                    <tr>
                                        <td style="text-align:left;"><?php echo $count?></td>
                                        <td><?php echo $levelName;?></td>
                                        <td><?php echo $streamName;?></td>
                                        <td><?php echo $courseName;?></td>
                                        <td><?php echo $departmentName;?><a data-toggle='tooltip' data-placement='top' title='<?php echo ucfirst($boardName);?>'><?php echo $boardAliasName;?></a></td>
                                        
                                       <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $row->department_id; ?>"  style="margin:5px; padding:5px 10px;<?php if (!empty($active)) { ?>background-color: #006600;<?php } ?>" class="badge">
                                                <?php
                                                if ($row->status == 1)
                                                    echo 'Active';
                                                else
                                                    echo "Inactive";
                                                ?>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <a class="edit" href="<?php echo base_url("course/edit_department/$department_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            <a class="edit" href="#modal-<?php echo $count; ?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

                                            <div id="modal-<?php echo $count; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Delete Modal</h4>
                                                        </div>
                                                        <!-- /.modal-header -->
                                                        <div class="modal-body">
                                                            <p>
                                                                Are you sure to delete the Level  <strong><?php echo $row->department_name;?></strong>.<br/>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("course/delete_department/$department_id") ?>" class="btn btn-danger">Delete</a>
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