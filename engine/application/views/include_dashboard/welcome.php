<?php
$active[$current] = "active";
$groupTypeDashboardNameUser = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());//$dasboardName = $groupDashboard['group_type'];
$loginUserDetails = $this->ion_auth->login_user_details();
$user_token = $loginUserDetails->user_token;
$loginUserID = $this->ion_auth->get_user_id();
//                $sql = "SELECT *";
//                $sql .= " FROM tbl_tickets";
//                //$sql .= " INNER JOIN tbl_users u on ri.user_id = u.user_id";
//                $sql .= " WHERE c_user_id='$loginUserID'";
//                $query = $this->db->query($sql);
//                    $resultReport = $query->result();
//                    $totalReport=0;
//                    foreach($resultReport as $reports){
//                        $countReport++;
//                    }
?>
<?php
//    $this->db->select("*");
//    $this->db->where('ticket_u_id',$loginUserID);
//    $this->db->where('view_by','0');
//
//    $this->db->from("tickets");
//    $totalReport = $this->db->count_all_results();
//
//    $queryReport = $this->db->get("tickets");
//    $resultReport = $queryReport->result();
?> 

<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsenav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>gears/front/images/logo-white.png" alt="smartsikshya" class="img-responsive" width="95"></a>
        </div>
        
        <div class="collapse navbar-collapse" id="collapsenav">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url("signin/view_profile/$user_token");?>">Profile</a></li>
                
                <?php if(!empty($this->session->userdata('can_hijack'))){
                $loginCode = $this->session->userdata('login_as_code');
                ?>
                    <li class="col-xs-2">
                        <a href="<?php echo base_url("signin/login_admin/$loginCode");?>" class="">
                            
                            <li class="join"><i class="fa fa-arrow-circle-left"></i> Back To Admin</li>
                        </a>
                    </li>
                <?php }else{?>
                <li class="col-xs-2">
                    <a href="<?php echo base_url("signin/logout");?>" class="">
                        <li class="join"><i class="fa fa-power-off"></i> Logout</li>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
