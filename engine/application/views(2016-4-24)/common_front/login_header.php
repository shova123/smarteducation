
<?php
//$active[$current] = "style='color:#b43f27;'";

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
<div class="col-md-12">
    <div class="menu-admin-area">
        <ul class="list-inline menu-admin">
            <li><span><a href="javascript:history.go(-1);" title="Go Back">Go Back <i class="glyphicon glyphicon-chevron-left"></i></a></span></li>
            <li><span><a href="<?php echo base_url("teachers/teacher_template_list");?>" title="View My Templates"><i class="glyphicon glyphicon-list"></i> View My Templates</a></span></li>
<!--            <li><span><a href="<?php echo base_url("teachers/others_template_list");?>" title="View Others Templates"><i class="glyphicon glyphicon-tasks"></i> View Other Templates</a></span></li>-->
            <li class="logout">Welcome <strong><?php echo ucfirst(@$login_userFULLNAME); ?></strong> <span><a href="<?php echo base_url("teachers/users_logout");?>" title="Logout">Logout <i class="glyphicon glyphicon-off"></i></a></span></li>
        </ul>
    </div>
</div>