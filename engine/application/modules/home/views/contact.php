<?php $page="Contact"; ?>
        
        <div class="inner-page-top inner-page-question slc">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                          <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i></a></li>
                         <li class="active">Contact Us</li>
                        </ol>
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top" id="templatemo_contact">
        </div> <!-- /.page-header -->

        <div class="contact-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6 map-wrapper">
                        <h3 class="widget-title">Find Us on Map</h3>
                        <div class="clearfix"></div>
                        <div style="height:300px;width:1000px;max-width:100%;list-style:none; transition: none;overflow:hidden;"><div id="embed-map-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Baluwatar+Bus+Stop,+Thirbam+Sadak,+Kathmandu,+Central+Region,+Nepal&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="google-map-code" rel="nofollow" href="http://www.interserver-coupons.com" id="enable-maps-data">interserver coupons</a><style>#embed-map-display img{max-width:none!important;background:none!important;font-size: inherit;}</style></div><script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=d676b961-8f5a-7c54-6f0e-3665370d14a9&c=google-map-code&u=1464069715" defer="defer" async="async"></script>
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14542.450988180988!2d85.31121269650527!3d27.71376830415003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb18fd316fffff%3A0xeadbbec5e61f0346!2sThe+Webomatic+Solutions+Pvt.+Ltd.!5e0!3m2!1sen!2snp!4v1461142639138" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                        <div class="contact-infos">
                            <ul class="list-unstyled">
                                <li><strong><p class="lead">Smartsikchhya</p></strong></li>
                              
                                <li>Baluwatar,Bhatbhatini road,Kathmandu,Nepal</li>
                                <li>Tel / Fax : 01-4444444</li>
                                <li>Email : <a href="mailto:info@smartsikshya.com">info@smartsikshya.com</a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6">
                        <h3 class="widget-title">Write To Us</h3>
                        <div class="contact-form">
                        <!--Start of form-action-->
                        <div id="err">
                              <?php
                              if(isset($_GET['sent']))
                                {
                                    $sent = $_GET['sent'];
                                ?>
                              <?php if($sent==1) 
                              {     
                                ?><br />
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4><strong>THANK YOU!</strong> Your Message has Been Sent Successfully.</h4>
                            </div>
                            <?php
                              }else if($sent==2){
                            ?><br />
                            <div class="alert alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4><strong>OOPs!</strong> There is something wrong here. please try again.</h4>
                            </div>
                            <?php                   
                            }else
                            {
                            ?><br />
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <h4><strong>OMG!!</strong> Something's wrong here. please try again.</h4>
                            </div>
                            <?php
                              }
                            ?>
                            <?php
                              }
                            ?>
                        </div>
                        <!--End of Form Action-->
                            <form name="contactform" id="contactform" action="response-msg.php" method="post" onsubmit="return formvalidation(this)">
                                <p>
                                    <input name="fname" type="text" id="fname" placeholder="Your Name" class="form-control">
                                </p>
                                <p>
                                    <input name="email" type="text" id="email" placeholder="Your Email" class="form-control"> 
                                </p>
                                <p>
                                    <input name="subject" type="text" id="subject" placeholder="Subject" class="form-control">
                                </p>
                                <p>
                                    <textarea name="message" id="message" placeholder="Message" class="form-control"></textarea>    
                                </p>
<!--                                <p>
                                    <img src="<?php echo base_url();?>verimages/image-verify.php" alt="verify" style="margin-bottom:7px;" />
                                    <input name="code_check" type="text" placeholder="Enter Code" class="form-control" />
                                </p>-->
                                <input type="submit" class="mainBtn btn btn-primary" id="submit" value="Send Message">
                            </form>
                        </div> <!-- /.contact-form -->
                    </div>
                </div>
            </div>
        </div>
  