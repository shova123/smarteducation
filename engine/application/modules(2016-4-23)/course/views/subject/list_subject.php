<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text().trim();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo base_url('course/update_status_subject');?>', {id : _id, status : _status},
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
            <a class="btn btn-round btn-primary" href="<?php echo base_url("course/add_subject")?>"> Add new Subject <i class="fa fa-plus"></i></a>
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
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="null,select,select,select,select,select,select,null,null,null" data-nosort="0" data-checkall="all">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th>Sn.</th>
                                <th width="15%">Level </th>
                                <th width="15%">Stream </th>
                                <th width="15%">Course </th>
                                <th width="15%">Department</th>
                                <th width="15%">Year</th>
                                <th width="15%">Semester</th>
                                <th width="15%">Subject</th>
                               
                                <th>Status</th>
                                <th class=" no-link last"><span class="nobr">Operation</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $CI = &get_instance();
                            $dbprefix = $CI->db->dbprefix;
                            if(!empty($results)){
//                                echo "<pre>";
//                                print_r($results);die;
                                    $count = 1;
                                        foreach($results as $row){
                                            $edit_id=$row->subject_id;
                                            $active=$row->status;
                                            $course=$this->db->query("select * from ".$dbprefix."course_course where course_id=$row->course_id")->row();
                                            
                                            $level=$this->db->query("select * from ".$dbprefix."course_level where level_id=$row->level_id")->row();
                                            $stream=$this->db->query("select * from ".$dbprefix."course_stream where stream_id=$row->stream_id")->row();
                                            $department=$this->db->query("select * from ".$dbprefix."course_department where department_id=$row->department_id")->row();
                                ?>

                                    <tr>
                                        <td style="text-align:left;"><?php echo $count?></td>
                                        <?php $year = $row->year;  if($year%2==0){$classLable = 'info';}else{$classLable = 'warning';}?>
                                        <td><?php if(empty($level)){ echo "-";} else {echo $level->level_name;}?></td>
                                        <td><?php if(empty($stream)){ echo "-";} else {echo $stream->stream_name;} ?></td>
                                        <td><?php if(empty($course)){ echo "-";} else {echo $course->course_name;} ?></td>
                                        
                                        <td><?php  if(empty($department)){ echo "-";} else {echo $department->department_name;}?></td>
                                        <td><?php echo $year;?>   </td>
                                        <td><?php echo $row->semester;?>  </td>
                                        <td><?php echo $row->subject_name;?>   <br/><span class="label label-<?php echo $classLable;?>">(Year:<?php echo $year;?>)</span></td>
                                       
                                        
                                       
                                       <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $row->subject_id; ?>"  style="margin:5px; padding:5px 10px;<?php if (!empty($active)) { ?>background-color: #006600;<?php } ?>" class="badge">
                                                <?php
                                                if ($row->status == 1)
                                                    echo 'Active';
                                                else
                                                    echo "Inactive";
                                                ?>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <a class="edit" href="<?php echo base_url("course/edit_subject/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                Are you sure to delete the Level  <strong><?php echo $row->subject_name;?></strong>.<br/>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("course/delete_subject/$edit_id") ?>" class="btn btn-danger">Delete</a>
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