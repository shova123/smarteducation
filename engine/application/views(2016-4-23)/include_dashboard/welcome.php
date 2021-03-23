<?php
$active[$current] = "active";
$groupTypeDashboardNameUser = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());//$dasboardName = $groupDashboard['group_type'];
?>
<section id="logo" class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <a href="<?php echo base_url("signin/$groupTypeDashboardNameUser"."_dashboard");?>">
                <figure>
                    <img src="<?php echo base_url(); ?>gears/front/images/logo.png" alt="logo" class="img-responsive">
                </figure>
            </a>
        </div>
    </div>
</section>
<section class="cover-inner" data-stellar-background-ratio="0.8">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cover-title cover-title-inner">
                <h1>Welcome<br><small> <?php echo $this->session->userdata('username'); ?> to the <?php echo $this->session->userdata('groupNames'); ?> <a href="<?php echo base_url("signin/$groupTypeDashboardNameUser"."_dashboard");?>"> <?php echo ucfirst("Dashboard");?></a></small></h1>
                <?php 
                if(!empty($this->session->userdata('can_hijack'))){
                $loginCode = $this->session->userdata('login_as_code');
                $login_as_id = $this->session->userdata('user_id');
                //$this->load->model('signin_model');
                //$login_as_details = $this->signin_model->get_byId('users', 'user_id', $user_dashboard_id);
                //$login_as_active = $login_as_details->active;
                //if(empty($login_as_active)){
                ?>
                <h2>Inactive</h2>
                <?php //}
                }
                ?>
            </div>
        </div>
    </div>
</section>