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

<!--START of -->
<br/><br/>
<hr/>
<section class="main-content">
    <?php 
        if(!empty($template_view)){
            $templateToken = $template_view->token;
            echo $template_view->html_content;

        }
    ?>
<!--    <div class="title-page">
        <div class="container">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="container">
        <div class="content-area">
            <div class="row">
                <1?php $this->load->view('common_front/login_header');?>
                <div class="col-md-3">
                    <h3>Archieve</h3>
                    <ul class="list-unstyled archivelist">
                        <li><a href="" title="GoTo this Month">August 2013</a></li>
                        <li><a href="" title="GoTo this Month">July 2013</a></li>
                        <li><a href="" title="GoTo this Month">June 2013</a></li>
                        <li><a href="" title="GoTo this Month">May 2013</a></li>
                        <li><a href="" title="GoTo this Month">April 2013</a></li>
                        <li><a href="" title="GoTo this Month">March 2013</a></li>
                        <li><a href="" title="GoTo this Month">February 2013</a></li>
                        <li><a href="" title="GoTo this Month">January 2013</a></li>
                    </ul>
                </div>
                <div class="col-md-9 margin-top">
                    <a href="<1?php echo base_url("teachers/template_add");?>" class="btn btn-success" style="margin:5px; padding:5px 10px;" title="edit">
                        <i class="glyphicon glyphicon-edit"></i> Create New Template
                    </a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%;">S.N</th>
                                <th style="width:35%;">Title</th>
                                <th style="width:25%;">Action</th>
                                <th style="width:15%;">View</th>
                                <th style="width:20%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <1?php 
                                if(!empty($template_lists)){
                                    foreach($template_lists as $templatesDETAILS){
                                        $id = $templatesDETAILS->temp_id;
                                        $templateTITLE = $templatesDETAILS->template_title;
                                        $templatePATH = $templatesDETAILS->template_path;
                                        $templateTOKEN = $templatesDETAILS->token;
                                        $status = $templatesDETAILS->status;
                            ?>
                            <tr>
                                <td>1</td>
                                <td><1?php echo $templateTITLE;?></td>
                                <td>
                                    <a href="<1?php echo base_url("teachers/template_edit/$templateTOKEN");?>" class="btn btn-success" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-edit"></i> EDIT</a>
                                    <a href="<1?php echo base_url("teachers/template_delete/$templateTOKEN");?>" class="btn btn-warning" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-trash"></i> DELETE</a>
                                </td>
                                <td>
                                    <a href="<1?php echo base_url("teachers/template_view/$templateTOKEN");?>" target="_blank" class="btn btn-warning" style="margin:5px; padding:5px 10px;" title="edit"><i class="glyphicon glyphicon-trash"></i> View</a>
                                </td>
                                <td class="publish_status">
                                    <a href="javascript:;" id="<1?php echo $id;?>" class="btn btn-info" style="margin:5px; padding:5px 10px;">
                                        <i class="glyphicon glyphicon-ok"></i> <1?php echo $status;?>
                                    </a>
                                </td>
                            </tr>
                            <1?php }}?>
                        </tbody>
                    </table>
                </div>
                
            </div>

            <div class="clearfix"></div>
        </div>
    </div>-->
<br/>
 <a href="<?php echo base_url("teachers/question_view/$templateToken");?>" style="text-decoration:blink;" target="_blank" class="btn btn-lg btn-success" style="margin:5px; padding:5px 10px; border-radius:0px;" title="edit">
                        <i class="glyphicon glyphicon-asterisk"></i> Solve Questions
                    </a>

<?php $this->load->view("include_dashboard/alert-message");?>
</section>


