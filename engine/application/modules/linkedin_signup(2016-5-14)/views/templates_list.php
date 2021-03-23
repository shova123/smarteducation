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
        <div class="pull-right">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?php echo base_url('signin/create_user') ?>"><?php echo lang('index_create_user_link'); ?> <i class="fa fa-plus"></i></a>
            </div>
            <div class="btn-group">
                <a class="btn btn-success" href="<?php echo base_url('signin/create_group') ?>"><?php echo lang('index_create_group_link'); ?> <i class="fa fa-plus"></i></a>
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
                                <th>User</th>
                                <th>Template Titles</th>
                                <th>View</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($templates_list)) {
                                $count = 1;
                                foreach ($templates_list as $templatesDET) {
                                    $editIds = $templatesDET->temp_id;
                                    $userIDs = $templatesDET->user_id;
                                    $templateTITLE = $templatesDET->template_title;
                                    $templatePATHs = $templatesDET->template_path;
                                    $templateTOKEN = $templatesDET->token;
                                    $status = $templatesDET->status;

                                    $this->db->select("*");
                                    $this->db->where("user_id", $userIDs);
                                    $queryUsers = $this->db->get("tbl_users");
                                    $resultUsers = $queryUsers->row();

                                    $userFirstName = $resultUsers->first_name;
                                    $userLastName = $resultUsers->last_name;
                                    $userFullName = "$userFirstName $userLastName";
                                    ?>

                                    <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                        <td><?php
                                            if (!empty($userFullName)) {
                                                echo htmlspecialchars($userFullName, ENT_QUOTES, 'UTF-8');
                                            } else {
                                                echo '-';
                                            }
                                            ?></td>
                                        <td>
                                            <strong><?php
                                            if (!empty($templateTITLE)) {
                                                echo htmlspecialchars($templateTITLE, ENT_QUOTES, 'UTF-8');
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                            </strong>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url("signin/template_view/$templateTOKEN"); ?>" class="btn btn-success" rel="tooltip" title="<?php
                                            if (!empty($userFullName)) {
                                                echo "View $userFullName's Template In New Tab";
                                            }
                                            ?>" data-placement="top">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
<!--                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $editIds; ?>"  style="margin:5px; padding:5px 10px;">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>-->
                                        

                                        <td>
                                            <?php //echo anchor("signin/edit_user/".$user->id, 'Edit') ;  ?>
                                            <a class="edit" href="<?php echo base_url("signin/template_edit/$templateTOKEN") ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            <!--<a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count; ?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>-->
                                            <a href="#modal-<?php echo $count; ?>" role="button" class="btn" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

                                            <div id="modal-<?php echo $count; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Are you sure to delete <?php echo $templateTITLE; ?> Template of User :<?php echo $userFullName; ?> 
                                                                If You Delete The Template all the related Questions and Answers will be deleted automatically
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("signin/template_delete/$templateTOKEN") ?>" class="btn btn-danger">Delete</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>

                                                </div>

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