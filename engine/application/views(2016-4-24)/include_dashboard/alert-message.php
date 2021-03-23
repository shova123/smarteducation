<!--<div class="col-md-12">
    <?php
    $loggedInUserIDs = $this->ion_auth->get_user_id();
    $groupTypeDashboardName = $this->ion_auth->has_dashboard($loggedInUserIDs); //$dasboardName = $groupDashboard['group_type'];

    $user_detailed = $this->ion_auth->login_user_details();
    $profileIDs = $user_detailed->profile_id;

    $this->db->select("*");
    $this->db->where('profile_id', $profileIDs);
    $queryProfile = $this->db->get("profile");
    $resultProfile = @$queryProfile->row();
    $userProfileTitle = @$resultProfile->profile_title;
    $usersCapacity = @$resultProfile->users;
    $templatesCapacity = @$resultProfile->templates;

    $this->db->select("*");
    $this->db->where('user_id', $loggedInUserIDs);
    $this->db->where('profile_id', $profileIDs);
    $queryProfileCounter = $this->db->get("profile_counter");
    $resultProfileCounter = @$queryProfileCounter->row();
    $usersCreated = @$resultProfileCounter->users_count;
    $templatesCreated = @$resultProfileCounter->templates_count;
    ?>
    <div class="mystyle">
        <h1>Account Description</h1>
        <span class="pull-left"><h2><strong>Account Type</strong>: <?php echo ucfirst($userProfileTitle); ?></h2></span> 
              
                <h3>
        
                    <i class="fa fa-file-text"></i>Templates Created
                    <br>
                    <span class="total"><?php echo "12"; ?></span>
        
                </h3>
        <div class="row">
            <div class="col-md-12">

                <ul class=" row list-inline dash-menu">
                    Templates Created
                    <li class="col-xs-4 menu2">
                        <h3>
                            <span class="pull-left"> <i class="fa fa-file-text"></i> </span> Templates Created
                            <br>
                            <span class="total"><?php if(!empty($templatesCreated)){ echo $templatesCreated;}else{echo '0';} ?></span>
                        </h3>
                        
                        <div class="row breakdown">
                            <div class="col-xs-6">
                                <small>Templates Capacity: <strong><?php echo $templatesCapacity; ?></strong></small>
                            </div>

                        </div>
                    </li>
                    <li class="col-xs-4 menu2">
                        <h3>
                            <span class="pull-left"> <i class="fa fa-male"></i> </span> Users Added
                            <br>
                            <span class="total"><?php if(!empty($usersCreated)){ echo $usersCreated;}else{echo '0';} ?></span>
                        </h3>
                       
                        <div class="row breakdown">
                            <div class="col-xs-6">
                                <small> Users Capacity: <strong><?php echo $usersCapacity; ?></strong></small>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>-->

