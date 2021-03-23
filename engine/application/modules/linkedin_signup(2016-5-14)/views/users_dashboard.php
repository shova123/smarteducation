<div class="clearfix"></div>
<!--Jumbotron front -->
<div class="jumbotron jumbotron-front login-div">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Welcome to <span>Candidate Dashboard</span></h1>
                <p class="lead">Work Match matches the <span>Employee</span> and <span>Employeers</span>. </p>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, unde, consectetur quis harum modi iusto doloribus est sint aliquam aliquid, eaque. Facilis dolorum et, nesciunt quam praesentium repellat deleniti modi.</p>
                <a href="" class="btn btn-success btn-lg">Explore</a>
            </div>
        </div>
    </div>
</div>
<!--workmatch intro-->
<div class="container">
    <div class="row">
        <!--introudction front-->
        <div class="col-sm-6 intro-div">
            <h1>Why WorkMatch ?</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita consequuntur in dolorum accusamus quaerat iusto neque labore asperiores similique aliquid ea officia provident consectetur sapiente cupiditate, vero, dignissimos saepe aperiam.</p>
            <p><strong>What do we offer?</strong></p>
            <ul class="custom-list">
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt quae dolorum magnam sunt cupiditate provident, neque eius.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt quae dolorum magnam sunt cupiditate provident, neque eius.</li>
            </ul>
        </div>
        <!--image intro-->
        <div class="col-sm-6 demo-img">
            <img src="<?php echo base_url(); ?>gears/front/images/demo.gif" alt="" class="img-responsive">
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--our employeers-->
<div class="top-employee">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Our Top Employeers</h1>
            </div>
            <ul class="list-inline row">
                <?php
                for ($i = 0; $i < 4; $i++) {
                    ?>
                    <li class="col-xs-6 col-sm-3 employee-list">
                        <img src="<?php echo base_url(); ?>gears/front/images/employee<?php echo $i ?>.png" alt="" class="img-responsive">
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--customers sayings-->
<div class="container review-portion">
    <div class="row">
        <!--/employee review-->
        <div class="col-sm-7 col-md-6">
            <h1>Happy employers Say</h1>
            <?php
            for ($i = 0; $i < 2; $i++) {
                ?>
                <!--employee review-->
                <div class="row review-employee">
                    <!--employeEreview-->
                    <div class="col-xs-9">
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro architecto explicabo debitis possimus sunt molestias natus fuga ex magni eligendi labore.</p>
                            <footer>
                                Man Name <cite title="CEO. SajiloMail">CEO. SajiloMail</cite>
                            </footer>
                        </blockquote>
                    </div>
                    <!--employeEphoto-->
                    <div class="col-xs-3">
                        <img src="<?php echo base_url(); ?>gears/front/images/testimage.jpg" alt="image" class="img-responsive img-circle">
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--/customer review-->
        <div class="col-sm-5 col-md-5 col-md-offset-1">
            <h1>Successful Customer Stories</h1>
            <!--/customers listings-->
            <div class="row success-story">
                <?php
                for ($j = 0; $j < 6; $j++) {
                    ?>
                    <div class="col-xs-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url(); ?>gears/front/images/testimage.jpg" alt="img" width="50">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Customer Name</h4>
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>