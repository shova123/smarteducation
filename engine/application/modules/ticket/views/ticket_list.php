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
<!--
<1?php
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
<1?php if(@$message){?>
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
                
              </div>
              <div class="modal-body">
                  <1?php echo @$message;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
<1?php }?>
-->
<div class="container-fluid">
    
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?php echo base_url('signin/create_user') ?>"><?php echo lang('index_create_user_link');?> <i class="fa fa-plus"></i></a>
            </div>
            <div class="btn-group">
                <a class="btn btn-success" href="<?php echo base_url('signin/create_group') ?>"><?php echo lang('index_create_group_link');?> <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-table"></i>
                        <p><?php echo lang('index_subheading');?></p>
                    </h3>
                </div>
                <div class="box-content nopadding">
<!--                    <table class="table table-hover table-nomargin table-bordered dataTable">-->
                    <table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="null,daterange,text,select,select,select,null,null" data-column_filter_dateformat="yy-mm-dd"  data-nosort="0" data-checkall="all"><!--text,text,text,null,select,daterange,null,null,null-->
                        <thead>
                            <tr>
                                <th>Sn.</th>
                                <th>Created On</th>
                                <th>Subject</th>
                                <th>Group Type</th>
                                <th>Status</th>
                                <th>Last Update by</th>
                                <th>Submitted By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($tickets_list)) {
                                $count = 1;
                                foreach ($tickets_list as $tickets) {
                                    $login_as_code   = sha1(md5(microtime()));
                                    $ticket_id = $tickets->ticket_id;
                                    $ticket_u_id = $tickets->ticket_u_id;
                                    $view_by = $tickets->view_by;
                                    $subject = $tickets->subject;
                                    $status = $tickets->status;
                                    $created_on = $tickets->date;
                                    
                                    
                                    $groupDetails= $this->ion_auth->get_users_groups($ticket_u_id)->row();
                                    $groupName = @$groupDetails->name;
                                    $groupType = @$groupDetails->group_type;
                                    
                                    $present_date = date("Y-m-d");
                                        $p_Y = date('Y', strtotime($present_date));
                                        $p_m = date('m', strtotime($present_date));
                                    
                                        $c_Y = date('Y', strtotime($created_on));
                                        $c_m = date('m', strtotime($created_on));
                                    $viewTutorial = $tickets->view_by;
                                        
                                    
//                                    $imgname = $row->imgname;
//                                    $img = explode(':', $imgname);
//                                    $imgname = $img['0'];
                                    ?>

                                    <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                        <td><?php echo $count;?></td>
                                        <td><?php echo $created_on;?></td>
                                        <td><?php echo $subject;?></td>
                                        
<!--                                        <td>
                                            <?php foreach ($tickets->groups as $group):?>
                                                    <?php echo anchor("signin/edit_group/".$group->group_id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                                            <?php endforeach?>
                                        </td>-->
                                        <td><?php echo ucfirst($groupType)?></td>
                                        <!--<td><?php echo htmlspecialchars($tickets->created_on,ENT_QUOTES,'UTF-8');?></td>-->
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $tickets->ticket_id;?>"  style="margin:5px; padding:5px 10px;<?php if(!empty($active)){?>background-color: #006600;<?php }?>" class="badge">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>
                                        <td>Admin</td>
                                        <td>People</td>
                                        
                                        <td>
                                            <?php //echo anchor("signin/edit_user/".$tickets->id, 'Edit') ;?>
                                            <a class="edit" href="<?php echo base_url("signin/edit_user/".$tickets->ticket_id) ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                Are you sure to delete this Slider image
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("signin/delete_user/".$tickets->ticket_id) ?>" class="btn btn-danger">Delete</a>
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
    </div>
</div>