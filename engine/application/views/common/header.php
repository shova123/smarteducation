<?php
$active[$current] = "active";
$this->load->database();
$dbprefix = $this->db->dbprefix;

$loginUserID = $this->ion_auth->get_user_id();

$groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());
if($groupTypeDashboardName == "clients"){
    $redirectController = "clients";
}else{
    $redirectController = "signin";
}
?>
<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
        <?php if($this->ion_auth->is_admin()){?>
            <ul class="nav navbar-nav navbar-left">
<!--                <li class="">
                    <a href="<?php echo base_url("signin/list_group");?>" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class=" fa fa-users"></span> Groups Role <span class=" fa fa-angle-down"></span> 
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li><a href="javascript:;">  Dropdown 1</a></li>
                        <li><a href="javascript:;">  Dropdown 2</a></li>
                        <li><a href="javascript:;">  Dropdown 3</a></li>
                        <li><a href="javascript:;">  Dropdown 4</a></li>
                        
                    </ul>
                </li>-->
                <li role="presentation" class="dropdown">
                    <a href="<?php echo base_url("signin/list_group");?>" class="">
                        <span class=" fa fa-users"></span> Group Role
                    </a>
                    
                </li>
<!--                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <span class=" fa fa-lock"></span> Permissions
                    </a>
                    
                </li>-->
                <li class='<?php if (isset($active[7])) {echo 'active';}?>'>
                    <a href="<?php echo base_url("permissions"); ?>">
                        <span class=" fa fa-lock"></span> <span>Permission</span>
                    </a>
                </li>
            </ul>
        <?php }?>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php
                            $this->db->select("*");
                            $this->db->where("user_id",$loginUserID); 
                            $query = $this->db->get("users"); 
                            $userDetails = $query->row(); 
                            $adminImage = $userDetails->home_image;
                            $adminToken = $userDetails->user_token;
                        if(!empty($adminImage)){?>
                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/profile/<?php echo $adminImage;?>&w=512&h=512" />
                        <?php }?>
                        <?php echo $this->session->userdata('username'); ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li class="<?php if (isset($active[9])) {echo 'active';}?>">
                            <a href="<?php echo base_url("signin/edit_profile/$adminToken");?>">Profile</a><?php //echo base_url("admin/personal") ?>
                        </li>
<!--                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>-->
<!--                        <li>
                            <a href="javascript:;">Help</a>
                        </li>-->
                        <li><a href="<?php echo base_url('signin/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        <li>
                            <a>
                                <span class="image">
                                    <img src="<?php echo base_url();?>gears/admin/images/img2.png" alt="Profile Image" />
                                </span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                                    <img src="<?php echo base_url();?>gears/admin/images/img2.png" alt="Profile Image" />
                                </span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                                    <img src="<?php echo base_url();?>gears/admin/images/img2.png" alt="Profile Image" />
                                </span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                                    <img src="<?php echo base_url();?>gears/admin/images/img2.png" alt="Profile Image" />
                                </span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong><a href="inbox.html">See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php if($this->ion_auth->is_admin()){?>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        <!--<span class="badge bg-green">6</span>-->
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        <li>
                            <a href="<?php echo base_url("settings");?>">
                                <span>
                                    <span>Email Settings</span>
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <?php }?>
            </ul>
        </nav>
    </div>

</div>
<!-- /top navigation -->