<?php
$active[$current] = "active";
$loginUserDetails = $this->ion_auth->login_user_details();
$user_token = $loginUserDetails->user_token;
$groupTypeDashboardNameUser = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());//$dasboardName = $groupDashboard['group_type'];
?>
<section class="cover-inner" data-stellar-background-ratio="0.8">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cover-title">
                <h1><a href="<?php echo base_url("signin/$groupTypeDashboardNameUser"."_dashboard");?>" style="color: #FFF !important;">Dashboard</a></h1>
                <!--<p>Welcome</p>-->
                <p>Welcome<br><small> <?php echo $this->session->userdata('username'); ?> to the <?php echo $this->session->userdata('groupNames'); ?> </small></p>
                <!--<h1>Login<br><small>.. to access our special features</small></h1>-->
            </div>
        </div>
    </div>


</section><!--cover for inner pages-->

