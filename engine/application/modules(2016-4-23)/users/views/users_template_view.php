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
<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="temp-list">
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Template View</h1>
                <form class="search-item">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->
                </form>
                <?php 
                    if(!empty($template_view)){
                        $templateToken = $template_view->token;
                        echo $template_view->html_content;

                    }
                ?>
                <br/>
                    <a href="<?php echo base_url("teachers/question_view/$templateToken");?>" style="text-decoration:blink;" target="_blank" class="btn btn-lg btn-success" style="margin:5px; padding:5px 10px; border-radius:0px;" title="edit">
                        <i class="glyphicon glyphicon-asterisk"></i> Solve Questions
                    </a>
                
                
            </div>
        </div>
    </div><!--/template list-->
    <?php $this->load->view("include_dashboard/alert-message");?>
</div><!--/list template info-->


