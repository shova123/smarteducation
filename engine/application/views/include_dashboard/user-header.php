<?php
$active[$current] = "active";
$loginUserDetails = $this->ion_auth->login_user_details();
$user_token = $loginUserDetails->user_token;
$groupTypeDashboardNameUser = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());//$dasboardName = $groupDashboard['group_type'];
?>
<section class="cover-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cover-title">
                <h1><a href="<?php echo base_url("signin/$groupTypeDashboardNameUser"."_dashboard");?>" style="color: #006699 !important;">Dashboard</a></h1>
               
                <p>Welcome<br><small> <?php echo $this->session->userdata('username'); ?> to the <?php echo $this->session->userdata('groupNames'); ?> </small></p>
            </div>
        </div>
    </div>


</section>
<!--cover for inner pages-->

