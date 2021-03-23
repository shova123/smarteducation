<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-book"></i> <span>SmartSikshya</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
<!--        <div class="profile">
            <div class="profile_pic">
                <img src="<?php echo base_url();?>gears/admin/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Anthony Fernando</h2>
            </div>
        </div>-->
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>Website generals</h3>
                <ul class="nav side-menu">
                    <li><a href='<?php echo base_url("pages/page_list");?>'><i class="fa fa-clipboard"></i> Content Manager </a></li>
                    <li><a><i class="fa fa-image"></i> Image Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url('admin/slideshow');?>">Slider</a>
                            </li>
                            <li><a href="index2.html">Gallery</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>System Management</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-users"></i> User Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url("signin/user_list/");?>">Users</a>
                            </li>
                            <li><a href="projects.html">User's Log/ Activities</a>
                            </li>
                            
                        </ul>
                    </li>
<!--                    <li><a><i class="fa fa-windows"></i> Faculty Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="#">Faculties</a>SLC,high school, Bachelor, master
                            </li>
                            <li><a href="#">Courses/Subjects</a>Accounts, science,social
                            </li>
                            <li><a href="plain_page.html">Plain Page</a>
                            </li>
                            <li><a href="login.html">Login Page</a>
                            </li>
                            <li><a href="pricing_tables.html">Pricing Tables</a>
                            </li>

                        </ul>
                    </li>-->
<!--                    <li><a><i class="fa fa-windows"></i> Course Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url("course/board");?>">Board</a>
                            </li>

                        </ul>
                    </li>-->
                    <li><a><i class="fa fa-windows"></i> Course Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?php echo base_url("course/board");?>">Board</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_level");?>">Level</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_stream");?>">Stream</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_course");?>">Course</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_department");?>">Department</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_subject");?>">subjects</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_chapter");?>">Chapters</a>
                            </li>
                            <li><a href="<?php echo base_url("course/list_unit");?>">Unit</a>
                            </li>

                        </ul>
                    </li>
                    
                     <li><a><i class="fa fa-windows"></i> Data Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <?php 
                            $this->db->select("*");
                            $this->db->from("hya_course_level");
                            $this->db->where("status","1");
                            $this->db->group_by("level_name");
                            $this->db->order_by("order","ASC");
                            $levels=$this->db->get()->result();
                            if(!empty($levels)):
                                foreach($levels as $level){
                                $levelName=$level->level_name;
                                $levelSlug=$level->level_slug;
                                ?>
                               
                            <li><a href="<?php echo base_url("data/$levelSlug");?>"><?php echo $levelName?></a>
                            </li>
                            <?php }
                            endif;
                            ?>

                        </ul>
                    </li>
<!--                    <li><a><i class="fa fa-windows"></i> Faculty Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="page_404.html">404 Error</a>
                            </li>
                            <li><a href="page_500.html">500 Error</a>
                            </li>
                            <li><a href="plain_page.html">Plain Page</a>
                            </li>
                            <li><a href="login.html">Login Page</a>
                            </li>
                            <li><a href="pricing_tables.html">Pricing Tables</a>
                            </li>

                        </ul>
                    </li>-->
<!--                    <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                    </li>-->
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
<!--        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>-->
        <!-- /menu footer buttons -->
    </div>
</div>