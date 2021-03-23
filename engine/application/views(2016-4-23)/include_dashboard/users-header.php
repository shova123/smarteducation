<?php $active[$current] = "active";?>
<div class="row">
    <div class="col-md-12">
        <ul class=" row list-inline dash-menu">
            <?php //$this->ion_auth->get_user_id()
            $loginUserDetails = $this->ion_auth->login_user_details();
            $user_token = $loginUserDetails->user_token;
            ?>
            <li class="col-xs-2 pull-left <?php if (isset($active[1])) {echo $active[1];}?> <?php if(@$bootstropID1 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID1 >=0){?>
                        data-bootstro-title='Click To view your Profile' 
                        data-bootstro-content="You can view your details."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID1;?>'<?php }?>>
                <a href="<?php echo base_url("users/view_profile/$user_token");?>" class="">
                    <i class="fa fa-user-secret pull-left"></i> <p>Profile</p>
                </a>
            </li>
            <li class="col-xs-2 <?php if (isset($active[2])) {echo $active[2];}?> <?php if(@$bootstropID2 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID2 >=0){?>
                        data-bootstro-title='Click To view your Templates List' 
                        data-bootstro-content="The Templates are listed over here and you can create new Templates, Edit & Delete your Templates."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID2;?>'<?php }?>>
                <a href="<?php echo base_url("templates/templates_list"); ?>" class="">
                    <i class="fa fa-eye pull-left"></i> <p>Template</p>
                </a>
            </li>
            <li class="col-xs-2 <?php if (isset($active[3])) {echo $active[3];}?> <?php if(@$bootstropID3 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID3 >=0){?>
                        data-bootstro-title='Reports based on Templates' 
                        data-bootstro-content="The Reports are listed over here and you can create new Reports, Edit & Delete your Reports."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID3;?>'<?php }?>>
                <a href="<?php echo base_url("users/report_issue");?>" class="">
                    <i class="fa fa-pie-chart pull-left"></i> <p>Report Issue</p>
                </a>
            </li>
            
            <?php if(!empty($this->session->userdata('can_hijack'))){
                $loginCode = $this->session->userdata('login_as_code');
                ?>
                <li class="col-xs-2 pull-right">
                    <a href="<?php echo base_url("signin/login_admin/$loginCode");?>" class="">
                        <i class="fa fa-arrow-circle-left pull-left"></i> <p>Back To Admin</p>
                    </a>
                </li>
            <?php }else{?>
            <li class="col-xs-2 pull-right">
                <a href="<?php echo base_url("signin/logout");?>" class="">
                    <i class="fa fa-power-off pull-left"></i> <p>Logout</p>
                </a>
            </li>
            <?php }?>
<!--            <li class="col-xs-2">
                <a href="" class="" type="button">
                    <i class="fa fa-clock-o pull-left"></i> <p>Pending Taks</p> <span class="badge">20</span>
                </a>
            </li>
            <li class="col-xs-2">
                <a href="" class="">
                    <i class="fa fa-flag pull-left"></i> <p>Finished Tasks</p> <span class="badge">03</span>
                </a>
            </li>
            <li class="col-xs-2">
                <a href="form-elements.php" class="">
                    <i class="fa fa-clock-o pull-left"></i> <p>My Templates</p> <span class="badge">2</span>
                </a>
            </li>
            
            <li class="col-xs-2">
                <a href="angularform/index.html" class="">
                    <i class="fa fa-pencil pull-left"></i> <p>Make Questions</p>
                </a>
            </li>-->
        </ul>
    </div>
</div>