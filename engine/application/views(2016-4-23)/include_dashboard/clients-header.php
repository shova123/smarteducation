<?php $active[$current] = "active";?>
<div class="row">
    <div class="col-md-12">
        <ul class=" row list-inline dash-menu">
<!--            <li class="col-xs-2">
                        <a href="<?php echo base_url("users/create_user");?>" class="">
                            <i class="fa fa-user-plus pull-left"></i> <p>Add Users</p>
                        </a>
            </li>-->
            <li class="col-xs-2 <?php if (isset($active[1])) {echo $active[1];}?> <?php if(@$bootstropID1 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID1 >=0){?>
                        data-bootstro-title='Click To view your Groups List' 
                        data-bootstro-content="The Groups are listed over here and you can create new groups, Edit & Delete your groups. Under Which the users are added."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID1;?>'<?php }?>>
                <a href="<?php echo base_url("users/list_group");?>" class="">
                    <i class="fa fa-users pull-left"></i> <p>Groups</p>
                </a>
            </li>
            
            <li class="col-xs-2 <?php if (isset($active[2])) {echo $active[2];}?> <?php if(@$bootstropID2 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID2 >=0){?>
                        data-bootstro-title='Click To view your Users List' 
                        data-bootstro-content="The Users are listed over here and you can create new users, Edit & Delete your Users.<br/><span style='background-color: #FFFF00'>Note: Without group user cannot be created. 1st create Group</span>"
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID2;?>'<?php }?>>
                        <a href="<?php echo base_url("users/users_list");?>" class="">
                            <i class="fa fa-users pull-left"></i> <p>Users</p>
                        </a>
                
            </li>
<!--            <li class="col-xs-2">
                <a href="<?php echo base_url("templates/templates_add"); ?>" class="">templates/templates_add
                    <i class="fa fa-plus pull-left"></i> <p>Template</p>
                </a>
            </li>-->
            <li class="col-xs-2 <?php if (isset($active[3])) {echo $active[3];}?> <?php if(@$bootstropID3 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID3 >=0){?>
                        data-bootstro-title='Click To view your Templates List' 
                        data-bootstro-content="The Templates are listed over here and you can create new Templates, Edit & Delete your Templates.<br/><span style='background-color: #FFFF00'>Note: Without group and user template cannot be created. 1st create Group 2nd create User</span>"
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID3;?>'<?php }?>>
                <a href="<?php echo base_url("templates/templates_list"); ?>" class="">
                    <i class="fa fa-eye pull-left"></i> <p>Template</p>
                </a>
            </li>
            
            
            <li class="col-xs-2 <?php if (isset($active[4])) {echo $active[4];}?> <?php if(@$bootstropID4 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID4 >=0){?>
                        data-bootstro-title='Click To view your Supports' 
                        data-bootstro-content="The Users are listed over here and you can create new users, Edit & Delete your Users."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID4;?>'<?php }?>>
                <?php 
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
                    $this->db->select("*");
                    $this->db->where('ticket_u_id',$loginUserID);
                    $this->db->where('view_by','0');
                    
                    $this->db->from("tickets");
                    $totalReport = $this->db->count_all_results();
                    
                    $queryReport = $this->db->get("tickets");
                    $resultReport = $queryReport->result();
                ?> 
                <a href="<?php echo base_url("users/support");?>" class="">
                    <i class="fa fa-book pull-left"></i> <p>Supports</p><span class="badge"><?php if(!empty($totalReport)){echo $totalReport;}else{echo "0";}?></span>
                </a>
            </li>
            <?php //$this->ion_auth->get_user_id()
            $loginUserDetails = $this->ion_auth->login_user_details();
            $user_token = $loginUserDetails->user_token;
            ?>
            <li class="col-xs-2 <?php if (isset($active[5])) {echo $active[5];}?> <?php if(@$bootstropID5 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID5 >=0){?>
                        data-bootstro-title='Click To view your Profile' 
                        data-bootstro-content="You can view your details."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID5;?>'<?php }?>>
                <a href="<?php echo base_url("users/view_profile/$user_token");?>" class="">
                    <i class="fa fa-user-secret pull-left"></i> <p>Profile</p>
                </a>
            </li>
            
            <?php if(!empty($this->session->userdata('can_hijack'))){
                $loginCode = $this->session->userdata('login_as_code');
                ?>
                <li class="col-xs-2">
                    <a href="<?php echo base_url("signin/login_admin/$loginCode");?>" class="">
                        <i class="fa fa-arrow-circle-left pull-left"></i> <p>Back To Admin</p>
                    </a>
                </li>
            <?php }else{?>
            <li class="col-xs-2">
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


<div class="row">
    <div class="col-md-12">
        <?php 
        function rangeWeek($datestr) {
            date_default_timezone_set(date_default_timezone_get());
            $dt = strtotime($datestr);
            $res['start'] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
            $res['end'] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
            return $res;
        }
        $currentDate = date("Y-m-d");
        $currentMonth = date("m",strtotime($currentDate));
        $weekRange = rangeWeek($currentDate);  
            $weekStart = $weekRange['start'];
            $weekEnd = $weekRange['end'];

        $loginUserId = $this->ion_auth->get_user_id();
        ?>
        <ul class=" row list-inline dash-menu">
            
            <!--Teachers ADDED-->
            <li class="col-xs-4 menu2 active <?php if(@$bootstropID6 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID6 >=0){?>
                        data-bootstro-title='Users Activity' 
                        data-bootstro-content="Shows Total <strong>Users Added</strong> with current <strong>Month</strong> & <strong>Week</strong>. You can also Click <strong>add + </strong>Button to add New User."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID6;?>'<?php }?>>
                <?php
                $this->db->where("c_user_id",$loginUserId);
                $this->db->from("users");
                $totalUsers = $this->db->count_all_results();
                
                $this->db->where("c_user_id",$loginUserId);
                $this->db->like("created_on","-$currentMonth-");
                $this->db->from("users");
                $currentMonthUsers = $this->db->count_all_results();
                
                $this->db->where("c_user_id",$loginUserId);
                $this->db->where('created_on >=', $weekStart);
                $this->db->where('created_on <=', $weekEnd);
                $this->db->from("users");
                $currentWeekUsers = $this->db->count_all_results();
                ?>
                <h3>
                    <span class="pull-left"> <i class="fa fa-male"></i> </span> Users Added
                    <br>
                    <a href="<?php echo base_url("users/users_list");?>"><span class="total"><?php echo $totalUsers;?></span></a><!--this is the total user listing under the basis of the counter of the user-->
                </h3>
                <span class="add-more">
                    <a href="<?php echo base_url("users/create_user");?>" class="" type="button">
                        Add <i class="fa fa-plus"></i>
                    </a>
                </span>
                <div class="row breakdown">
                    <div class="col-xs-6">
                        <small>This Week: <a href="<?php echo base_url("users/users_list/weekly");?>" style="color:#000;"><strong><?php echo $currentWeekUsers;?></strong></a></small>
                        <!--<p class="total"><?php echo $currentWeekUsers;?></p>-->
                    </div>
                    <div class="col-xs-6">
                        <small>This Month: <a href="<?php echo base_url("users/users_list/monthly");?>" style="color:#000;"><strong><?php echo $currentMonthUsers;?></strong></a></small>
                        <!--<p class="total"><?php echo $currentMonthUsers;?></p>-->
                    </div>
                </div>
            </li>
            <!--Templates Created-->
            <li class="col-xs-4 menu2 <?php if(@$bootstropID7 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID7 >=0){?>
                        data-bootstro-title='Templates Activity' 
                        data-bootstro-content="Shows Total <strong>Templates Created</strong> with current <strong>Month</strong> & <strong>Week</strong>. You can also Click <strong>add + </strong>Button to add new templates."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID7;?>'<?php }?>>
                <?php
                $this->db->where("c_user_id",$loginUserId);
                $this->db->from("users_templates");
                $totalTemplates = $this->db->count_all_results();
                
                
                $this->db->where("c_user_id",$loginUserId);
                $this->db->like("created_date","-$currentMonth-");
                $this->db->from("users_templates");
                $currentMonthTemplates = $this->db->count_all_results();
                
                
                
                $this->db->where("c_user_id",$loginUserId);
                $this->db->where('created_date >=', $weekStart);
                $this->db->where('created_date <=', $weekEnd);
                $this->db->from("users_templates");
                $currentWeekTemplates = $this->db->count_all_results();
                ?>
                <h3>
                    <span class="pull-left"> <i class="fa fa-file-text"></i> </span> Templates Created
                    <br>
                    <a href="<?php echo base_url("templates/templates_list");?>"><span class="total"><?php echo $totalTemplates;?></span></a>
                </h3>
                <span class="add-more">
                    <a href="<?php echo base_url("templates/templates_add"); ?>" class="" type="button">
                        Add <i class="fa fa-plus"></i>
                    </a>
                </span>
                <div class="row breakdown">
                    <div class="col-xs-6">
                        <small>This Week: <a href="<?php echo base_url("templates/templates_list/weekly");?>" style="color:#000;"><strong><?php echo $currentWeekTemplates;?></strong></a></small>
                        <!-- <p class="total"><?php echo $currentWeekTemplates;?></p>-->
                    </div>
                    <div class="col-xs-6">
                        <small>This Month: <a href="<?php echo base_url("templates/templates_list/monthly");?>" style="color:#000;"><strong><?php echo $currentMonthTemplates;?></strong></a></small>
                        <!--<p class="total"><?php echo $currentMonthTemplates;?></p>!-->
                    </div>
                </div>
            </li>
            <!--Answers SUBMITTED-->
            <li class="col-xs-4 menu2 <?php if(@$bootstropID8 >=0){?>bootstro<?php }?>" <?php if(@$bootstropID8 >=0){?>
                        data-bootstro-title='Template Answers' 
                        data-bootstro-content="Shows Total <strong>Answers Submitted</strong> with current <strong>Month</strong> & <strong>Week</strong>."
                        data-bootstro-width="400px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropID8;?>'<?php }?>>
                <?php
                    $sql1 = "SELECT *";
                    $sql1 .= " FROM tbl_users_temp_q_a uqa";
                    $sql1 .= " INNER JOIN tbl_users_templates ut on uqa.temp_id = ut.temp_id";
                    $sql1 .= " WHERE ut.c_user_id='$loginUserId'";
                    $query1 = $this->db->query($sql1);//return $query->result();
                    $totalTemplatesAnswer = @$this->db->count_all_results();
                    
                    $sql2 = "SELECT *";
                    $sql2 .= " FROM tbl_users_temp_q_a uqa";
                    $sql2 .= " INNER JOIN tbl_users_templates ut on uqa.temp_id = ut.temp_id";
                    $sql2 .= " WHERE ut.c_user_id='$loginUserId' AND uqa.date LIKE '-$currentMonth-' ";
                    $query2 = $this->db->query($sql2);//return $query->result();
                    $currentMonthTemplatesAnswer = @$this->db->count_all_results();
                    
                    $sql3 = "SELECT *";
                    $sql3 .= " FROM tbl_users_temp_q_a uqa";
                    $sql3 .= " INNER JOIN tbl_users_templates ut on uqa.temp_id = ut.temp_id";
                    $sql3 .= " WHERE ut.c_user_id='$loginUserId' AND uqa.date >='$weekStart' AND uqa.date <='$weekEnd' ";
                    $query3 = $this->db->query($sql3);//return $query->result();
                    $currentWeekTemplatesAnswer = @$this->db->count_all_results();
    
            
                ?>
                
                
                <h3>
                    <span class="pull-left"> <i class="fa fa-book"></i> </span> Answers Submitted
                    
                    <br>
                    <a href="<?php echo base_url("templates/answers_list");?>"><span class="total"><?php if(!empty($totalTemplatesAnswer)){echo $totalTemplatesAnswer;}else{echo "0";}?> </span></a>
                </h3>
                <span class=" pull-right" style="position:absolute; top:5px; right:5px;">
                    <a href="#" data-toggle="modal" data-target="#myModalInvitation" class="btn btn-primary" style="padding:5px;" >
                        Invite End User <i class="glyphicon glyphicon-send"></i>
                    </a>
                </span>
                <div class="row breakdown">
                    <div class="col-xs-6">
                        <small>This Week: <a href="<?php echo base_url("templates/answers_list/weekly");?>" style="color:#000;"><strong><?php if(!empty($currentWeekTemplatesAnswer)){echo $currentWeekTemplatesAnswer;}else{echo "0";}?> </strong></a></small>
                        <!-- <p class="total">21</p> -->
                    </div>
                    <div class="col-xs-6">
                        <small>This Month: <a href="<?php echo base_url("templates/answers_list/monthly");?>" style="color:#000;"><strong><?php if(!empty($currentMonthTemplatesAnswer)){echo $currentMonthTemplatesAnswer;}else{echo "0";}?> </strong></a></small>
                        <!-- <p class="total">05</p> -->
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>


<div class="modal fade" id="myModalInvitation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Send Invitation To End User</h4>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url('users/end_user_invitation'); ?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                    <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                    <label for="text" class="sr-only">Email</label>
                    <!--<input type="text" name='identity' id="identity" value="" placeholder="Email:" class='form-control' data-rule-required="true" data-rule-email="true">data-rule-email="true"-->
                    <input type="email" name="email" id="email" value="" placeholder="Email:" data-rule-email="true" data-rule-required="true" class="form-control">
                    <br/>
                    <input type="submit" name="invitation" value="Send Invitation" id="loginBtn" class="btn btn-primary"/>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<a href="<?php// echo base_url("users/delete_user/$user_tokenss");?>" class="btn btn-danger">Delete</a>-->
              </div>
            </div>
          </div>
        </div>