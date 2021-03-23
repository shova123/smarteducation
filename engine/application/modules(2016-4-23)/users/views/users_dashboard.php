<!--logo and menu portion here-->
<section id="logo" class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <a href="index.php">
                <figure>
                    <img src="<?php echo base_url();?>gears/front/images/logo.png" alt="logo" class="img-responsive">
                </figure>
            </a>
        </div>
        <!-- <div class="col-sm-6">
          <div class="fat-nav">
            <div class="fat-nav__wrapper">
              <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">pricing</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="login.php" class="btn btn-primary">Login</a></li>
              </ul>
            </div>
          </div>
        </div> -->
    </div>
</section>
<section class="cover-inner" data-stellar-background-ratio="0.8">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cover-title">
                <h1>Welcome<br><small>.. <?php echo $this->session->userdata('username'); ?> to the <?php echo $this->session->userdata('groupNames'); ?> Dashboard.</small></h1>
            </div>
        </div>
    </div>
</section><!--cover for inner pages-->
<section class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline pull-right dash-menu">
                    <li><a href="<?php echo base_url("signin/logout");?>" class="btn btn-warning"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-6">
                <div class="temp-list">
                    <h1><small><i class="fa fa-list-ol"></i> </small> Template List</h1>
                    <ul class="project-listings">
                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <li>
                                <a href="login-detail.php">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url();?>gears/front/images/wwd2.png" alt="img">
                                    </div>
                                    <div class="list-content">
                                        <span class="title">Ascension App Template</span>
                                        <span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="list-action-right">
                                        <i class="fa fa-cog"></i>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div><!--/template list-->
            <div class="col-sm-6">
                <div class="temp-list user-list">
                    <h1><small><i class="fa fa-users"></i> </small> Users List</h1>
                    <ul class="project-listings">
                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <li>
                                <a href="">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url();?>gears/front/images/man.jpg" alt="img">
                                    </div>
                                    <div class="list-content">
                                        <span class="title">Mr. Tony Blayer</span>
                                        <span class="caption">Accountant of our Country</span>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="list-action-right">
                                        <i class="fa fa-cog"></i>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div><!--/template list-->
            <?php $this->load->view("include_dashboard/alert-message");?>
        </div><!--/list template info-->
    </div>
</section>
<div class="clearfix"></div>