<?php
$active[$current] = "style='color:#b43f27;'";

$login_userID = $this->session->userdata('users_user_id');
$login_userTYPE = $this->session->userdata('users_user_type');
$login_userNAME = $this->session->userdata('users_name');

if(!empty($login_userID)){
        $this->db->select("*");
        $this->db->where("user_id", $login_userID);
        $queryUsers = $this->db->get("tbl_users");
        $resultUsers = $queryUsers->row();
        $userTOKEN = $resultUsers->user_token;
        $login_userFULLNAME = $resultUsers->user_fullname;
        $login_userEMAIL = $resultUsers->user_email;
}
?>
<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
        	$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);
        
        $.get('<?php echo base_url("users/update_template_status");?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
              		$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>


<section class="main-content">
    <div class="title-page">
        <div class="container">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="container">
        <div class="content-area">
            <div class="row">
                <?php $this->load->view('common_front/login_header');?>
<!--                <div class="col-md-3">
                    <h3>Teachers</h3>
                    <ul class="list-unstyled archivelist">
                        <?php 
                            $this->db->select("*");
                            $this->db->where("user_id !=", $login_userID);
                            $queryUsers = $this->db->get("tbl_users");
                            $resultUsers = $queryUsers->result();
                            
                            if(!empty($resultUsers)){
                                
                                foreach($resultUsers as $usersList){
                                    $userFUllname = ucfirst($usersList->user_fullname);
                                    $userToken = $usersList->user_token;
                            
                        ?>
                        <li><a href="<?php echo base_url("users/other_teacher_template_list/$userToken");?>" title="GoTo this Month"><?php echo $userFUllname;?></a></li>
                        <?php }}?>
                    </ul>
                </div>-->
                <div class="col-md-12 margin-top adv-table editable-table " >
<!--                    <a href="<1?php echo base_url("users/template_add");?>" class="btn btn-lg btn-success" style="margin:5px; padding:5px 10px; border-radius:0px;" title="edit">
                        <i class="glyphicon glyphicon-asterisk"></i> Create New Template
                    </a>-->
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th style="width:10%;">S.N</th>
                                <th style="width:50%;">Title</th>
<!--                                <th style="width:25%;">Action</th>-->
                                <th style="width:10%;">View</th>
                                <th style="width:30%;">Downloads</th>
<!--                                <th style="width:20%;">Status</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($template_lists)){
                                    $countusers=1;
                                    foreach($template_lists as $templatesDETAILS){
                                        $id = $templatesDETAILS->temp_id;
                                        $storage_type = $templatesDETAILS->storage_type;
                                        $templateTITLE = $templatesDETAILS->template_title;
                                        $templatePATH = $templatesDETAILS->template_path;
                                        $templateTOKEN = $templatesDETAILS->token;
                                        $status = $templatesDETAILS->status;
                            ?>
                            <tr>
                                <td><?php echo $countusers;?></td>
                                <td><?php echo $templateTITLE;?></td>
<!--                                <td>
                                    <a href="<1?php echo base_url("users/template_edit/$templateTOKEN");?>" class="btn btn-success" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-edit"></i> EDIT</a>
                                    <a href="<1?php echo base_url("users/template_delete/$templateTOKEN");?>" class="btn btn-warning" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-trash"></i> DELETE</a>
                                </td>-->
                                <td>
                                    <a href="<?php echo base_url("users/template_view/$templateTOKEN");?>" target="_blank" class="btn btn-warning" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("users/generate_qrcode/$templateTOKEN");?>" class="btn btn-primary" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-download"></i> Download QR</a>
                                    <?php 
                                    if(!empty($storage_type)){
                                        if($storage_type == 'database'){
                                    ?>
                                    <a href="<?php echo base_url("users/answer_download/$templateTOKEN");?>" class="btn btn-success" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-download"></i> Download Answers</a>
                                <?php }}?>
                                </td>
<!--                                <td class="publish_status">
                                    <1?php 
                                    
                                            if(@$status == "Publish"){
                                                $background="info";
                                                $icon = "ok";
                                            }
                                            if(@$status == "Unpublish"){
                                                $background="danger";
                                                $icon = "remove";
                                            }
                                           
                                            
                                    ?>
                                    <a href="javascript:;" id="<1?php echo $id;?>" class="btn btn-<1?php echo @$background;?>" style="margin:5px; padding:5px 10px;">
                                        <i class="glyphicon glyphicon-<1?php echo @$icon;?>"></i> <1?php echo $status;?>
                                    </a>
                                </td>-->
                            </tr>
                            <?php $countusers++;}}?>
                        </tbody>
                    </table>
                </div>
                <?php $this->load->view("include_dashboard/alert-message");?>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</section>