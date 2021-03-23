<script src='https://www.google.com/recaptcha/api.js'></script>
<header class="item header margin-top-0 header10" id="header10">
    <div class="wrapper" id="index">
        <?php $this->load->view('common_front/navigation', @$data); ?>
        <?php
        $this->db->select("*");
        $this->db->where('page_type', 'content');
        $this->db->like("display_type", "container");
        $this->db->where("page_slug", "home");
        $queryHome = $this->db->get("static_pages");
        $resultHome = $queryHome->row();
        $homeTITLE = $resultHome->page_title;
        $homeSLUG = $resultHome->page_slug;
        $homeContent = $resultHome->content;
        if (!empty($resultHome)) {
            ?> 
            <div class="container padding-top-100">
                <div class="row">

                    <div class="col-md-5">
                        <div style="" class="editContent">
                            <?php echo @$homeContent; ?>
                        </div>
                        <form class="headerForm">

                            <!--<a type="submit" href="#0" class="btn btn-primary btn-block cd-btn"><span class="fui-check"></span> Sign up now</a>-->
                            <a href="<?php echo base_url("users/signup");?>" class="btn btn-primary btn-block"><span class="fui-check"></span> Sign up now</a>
                        </form>
                        <h4 class="text-center"><small class="badge img-circle">OR</small></h4>
                        <a href="<?php echo base_url("signin/login"); ?>" class="btn btn-primary btn-block login-btn"> Login <span class="fui-arrow-right"></span> </a>
                        <!--<button type="submit" class="btn btn-primary btn-block login-btn"> Login <span class="fui-arrow-right"></span></button>-->
                    </div><!-- .col -->
                    <?php
                    $this->db->select("*");
                    $this->db->where("page_name", "$homeSLUG");
                    $this->db->like('page_type', 'subcontent');
                    //$this->db->where('page_type', 'subcontentvideo');
                    $this->db->order_by('order', 'ASC');
                    $queryHomeSubContent = $this->db->get("static_pages");
                    $resultHomeSub = $queryHomeSubContent->result();

                    foreach ($resultHomeSub as $resultHomeSubContent) {
                        $homeSubTITLE = $resultHomeSubContent->page_title;
                        $homeSubSLUG = $resultHomeSubContent->page_slug;
                        $homeSubType = $resultHomeSubContent->page_type;
                        $homeSubContent = $resultHomeSubContent->content;
                        $homeSubContentYouTubeLink = $resultHomeSubContent->youtube_link;
                        $homeSubContentVideoId = $resultHomeSubContent->video_id;
                        ?> 
                        <div class="col-md-6 col-md-offset-1">
                            <?php if ($homeSubType == "subcontentvideo") { ?>
                                <div class="videoWrapper">
                                    <!--<object width="560" height="315" data="http://www.youtube.com/v/<?php echo $homeSubContentVideoId; ?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $homeSubContentVideoId; ?>" /></object>-->
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $homeSubContentVideoId; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php } ?>

                            <?php if ($homeSubType == "subcontent") { ?>
                                <div class="videoWrapper">
                                    <p> <?php echo @$homeSubContent; ?> </p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div><!-- /.row -->
            </div>
        <?php } ?>
    </div><!-- /.wrapper -->
</header>
<?php
$this->db->select("*");
$this->db->where('page_type', 'content');
$this->db->like("display_type", "container");
$this->db->like("page_slug", "about");
$queryAbout = $this->db->get("static_pages");
$resultAbout = $queryAbout->row();
$aboutTITLE = $resultAbout->page_title;
$aboutSLUG = $resultAbout->page_slug;
$aboutCONTENT = $resultAbout->content;
$aboutIMAGE = $resultAbout->home_image;
if (!empty($resultAbout)) {
    ?> 
    <div class="item content" id="content_section1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo @$aboutCONTENT ?>
                </div>
                <?php
                $this->db->select("*");
                $this->db->where("page_name", "$aboutSLUG");
                $this->db->like('page_type', 'subcontent');
                //$this->db->where('page_type', 'subcontentvideo');
                $this->db->order_by('order', 'ASC');
                $queryAboutSubContent = $this->db->get("static_pages");
                $resultAboutSub = $queryAboutSubContent->result();
                if (!empty($resultAboutSub)) {
                    foreach ($resultAboutSub as $resultAboutSubContent) {
                        $aboutSubTITLE = $resultAboutSubContent->page_title;
                        $aboutSubSLUG = $resultAboutSubContent->page_slug;
                        $aboutSubType = $resultAboutSubContent->page_type;
                        $aboutSubContent = $resultAboutSubContent->content;
                        $aboutSubContentYouTubeLink = $resultAboutSubContent->youtube_link;
                        $aboutSubContentVideoId = $resultAboutSubContent->video_id;
                        ?> 
                        <div class="col-md-12 text-center">
                            <?php if ($aboutSubType == "subcontentvideo") { ?>
                                <div class="videoWrapper">
                                    <!--<object width="560" height="315" data="http://www.youtube.com/v/<?php echo $aboutSubContentVideoId; ?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $aboutSubContentVideoId; ?>" /></object>-->
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $aboutSubContentVideoId; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php } ?>

                            <?php if ($aboutSubType == "subcontent") { ?>
                                <div class="videoWrapper">
                                    <p> <?php echo @$aboutSubContent; ?> </p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
<?php } ?>


<?php
$this->db->select("*");
$this->db->where('page_type', 'content');
$this->db->like("display_type", "container");
$this->db->like("page_slug", "feature");
$queryFeature = $this->db->get("static_pages");
$resultFeature = $queryFeature->row();

$featureTITLE = $resultFeature->page_title;
$featureSLUG = $resultFeature->page_slug;
$featureContent = $resultFeature->content;
?>
<div class="container" id="divider3">
    <div class="col-md-12">
        <div class="divider dotted">
            <span style="color: rgb(52, 73, 94); font-size: 22px;" class="editContent"><strong>Our Features</strong></span>
            <?php
            if (!empty($resultFeature)) {
                echo @$featureContent;
            }
            ?> 
        </div>
    </div>
</div>
<?php
$this->db->select("*");
$this->db->where("page_name", "$featureSLUG");
$this->db->like("display_type", "container");
$this->db->like('page_type', 'subcontent');
//$this->db->where('page_type', 'subcontentvideo');
$this->db->order_by('order', 'ASC');
$queryFeatureSubContent = $this->db->get("static_pages");
$resultFeatureSub = $queryFeatureSubContent->result();

if (!empty($resultFeatureSub)) {
    $featureCount = 1;
    $featureCounts = 1;
    ?> 
    <div class="item content padding-bottom-60" id="divider3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-append-content">
                        <?php
                        foreach ($resultFeatureSub as $resultFeatureSubContent) {
                            $featureSubTITLE = $resultFeatureSubContent->page_title;
                            ?>
                            <li <?php if ($featureCount == 1) { ?>class="active"<?php } ?>><a href="#<?php echo "tab$featureCount"; ?>"><?php echo $featureSubTITLE; ?></a></li>
                            <?php
                            $featureCount++;
                        }
                        ?>
                    </ul>
                    <div class="tab-content tabs">
                        <?php
                        foreach ($resultFeatureSub as $resultFeatureSubContents) {
                            $featureSubSLUG = $resultFeatureSubContents->page_slug;
                            $featureSubType = $resultFeatureSubContents->page_type;
                            $featureSubContent = $resultFeatureSubContents->content;
                            $featureSubContentYouTubeLink = $resultFeatureSubContents->youtube_link;
                            $featureSubContentVideoId = $resultFeatureSubContents->video_id;
                            ?>
                            <div class="tab-pane <?php if ($featureCounts == 1) { ?>active<?php } ?>" id="<?php echo "tab$featureCounts"; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if ($featureSubType == "subcontentvideo") { ?>
                                                                    <!--<object width="560" height="315" data="http://www.youtube.com/v/<?php echo $featureSubContentVideoId; ?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $featureSubContentVideoId; ?>" /></object>-->
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $featureSubContentVideoId; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                        <?php } ?>
                                        <?php if ($featureSubType == "subcontent") { ?>
                                            <?php echo $featureSubContent; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $featureCounts++;
                        }
                        ?>
                    </div> 
                </div>
            </div>

        </div>
    </div>
<?php } ?>
<header class="item header header11">
    <div class="container">
        <div class="row banner">  
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    Want <b>Office Automation</b> that is easy                
                    <br>
                    and fully time saver?
                </h1>
                <!-- <div class="text-center">
  
                 <img src="<?php echo base_url(); ?>gears/front/images/image1.png" alt="Image 1">
 
               </div> -->
            </div>
            <div class="col-sm-6  col-sm-offset-3">
                <a href="<?php echo base_url("cost-calculator.html"); ?>" class="btn btn-primary btn-block">Try Now</a>
            </div>
        </div><!-- /.row -->
    </div>
</header>

<div class="item pricing" id="pricing_table2">
    <?php
    $this->db->select("*");
    $this->db->where('page_type', 'content');
    $this->db->like("display_type", "container");
    $this->db->like("page_slug", "price");
    $this->db->or_like("page_slug", "pricing");
    $queryPricing = $this->db->get("static_pages");
    $resultPricing = $queryPricing->row();
    $pricingTITLE = $resultPricing->page_title;
    $pricingSLUG = $resultPricing->page_slug;
    $pricingContent = $resultPricing->content;
    if (!empty($resultPricing)) {
        echo $pricingContent;
    }
    ?> 
    <?php
    $this->db->select("*");
    $this->db->where("page_name", "$pricingSLUG");
    //$this->db->like('page_type', 'subcontent');
    $this->db->like('page_type', 'subcontentpricing');
    $this->db->from("static_pages");
    $pricingDivNumber = $this->db->count_all_results();

    $this->db->select("*");
    $this->db->where("page_name", "$pricingSLUG");
    //$this->db->like('page_type', 'subcontent');
    $this->db->like('page_type', 'subcontentpricing');
    $this->db->order_by('order', 'ASC');
    $queryPricingSubContent = $this->db->get("static_pages");
    $resultPricingSub = $queryPricingSubContent->result();

    if (!empty($resultPricingSub)) {
        $col_md = ceil(12 / $pricingDivNumber);
        ?>

        <div class="container">
            <div class="row">
                <?php
                foreach ($resultPricingSub as $resultPricingSubContent) {
                    $pricingSubTITLE = $resultPricingSubContent->page_title;
                    $pricingSubSLUG = $resultPricingSubContent->page_slug;
                    $pricingSubType = $resultPricingSubContent->page_type;
                    $pricingSubPrice = $resultPricingSubContent->price;
                    $pricingSubContent = $resultPricingSubContent->content;
                    $pricingSubContentYouTubeLink = $resultPricingSubContent->youtube_link;
                    $pricingSubContentVideoId = $resultPricingSubContent->video_id;
                    ?>
                    <div class="col-md-<?php echo $col_md; ?>">
                        <div class="pricing2">
                            <div class="top">
                                <h2 class="editContent"><?php echo $pricingSubTITLE; ?></h2>
                                <p class="price"><span class="currency">$</span> <b class="editContent"><?php
                                        if (!empty($pricingSubPrice)) {
                                            echo $pricingSubPrice;
                                        } else {
                                            echo "0";
                                        }
                                        ?></b> <span class="month editContent">p/month</span></p>
                            </div>
                            <div class="bottom">
                                <div class="editContent">
                                    <?php echo @$pricingSubContent; ?>
                                    <!--                            <ul>
                                                                    <li><span class="fa fa-check"></span> <b>100</b> Paper works</li>
                                                                    
                                                                </ul>-->
                                </div>

<!--                                <a href="#0" class="btn btn-hg btn-embossed btn-block btn-primary cd-btn">Sign Up Now</a>-->
                                <a href="<?php echo base_url("users/signup");?>" class="btn btn-primary btn-block"><span class="fui-check"></span> Sign up now</a>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    <?php } ?>
</div><!-- /.item -->

<?php
$this->db->select("*");
$this->db->where('status', 'Publish');
$this->db->order_by('order', 'ASC');
$queryTestimonials = $this->db->get("testimonials");
$resultTestimonials = $queryTestimonials->result();


if (!empty($resultTestimonials)) {
    ?> 
    <div class="container" id="slideshow1">
        <div class="col-md-12">
            <h1 id="h1" style="text-align:center;">Customer's Review</h1>

            <div id="myCarousel" class="carousel carousel2 slide carousel-fade" data-interval="false">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                    $testimonialCount = 1;
                    foreach ($resultTestimonials as $testimonials) {
                        $authorTITLE = $testimonials->author_title;
                        $authorSLUG = $testimonials->author_slug;
                        $testimonialContent = $testimonials->content;
                        $testimonialImage = $testimonials->home_image;
                        $testimonialDate = $testimonials->date;

                        $testimonialImage = $testimonials->home_image;
                        if (!empty($testimonialImage)) {
                            $imagePath = "testimonials/$testimonialImage";
                        } else {
                            $imagePath = "no-image.jpg";
                        }
                        ?>
                        <div class="item <?php if ($testimonialCount == 1) { ?>active<?php } ?>">
                            <div class="row">
                                <div class="col-sm-4 col-md-2 col-md-offset-1">
                                    <img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/<?php echo $imagePath; ?>&w=200&h=200" alt="" class="img-responsive"/>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <blockquote>
                                        <p><?php echo @$testimonialContent; ?></p>
                                        <small><?php echo @$authorTITLE; ?></small>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <?php
                        $testimonialCount++;
                    }
                    ?>
                    <!--                <div class="item">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-2 col-md-offset-1">
                                                <img src="<?php echo base_url(); ?>gears/front/images/man.png" alt="" class="img-responsive">
                                            </div>
                                            <div class="col-sm-8 col-md-8">
                                                <blockquote>
                                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus.</p>
                                                    <small>Steve Jobs, CEO Apple</small>
                                                </blockquote>
                                            </div>
                                        </div> /.row 
                                    </div>-->
                </div>
                <!-- Controls -->
                <a class="left carousel-control fui-arrow-left" href="#myCarousel" data-slide="prev"></a>
                <a class="right carousel-control fui-arrow-right" href="#myCarousel" data-slide="next"></a>
            </div>

        </div><!-- /.col -->
    </div>
<?php } ?>


<div class="item contact padding-top-0 padding-bottom-0" id="contact1">
    <div class="wrapper grey">
        <div class="container">
            <div class="col-md-5">

                <h3 class="margin-bottom-40 editContent">Get in touch! We're here for you...</h3>
                <form method="post" action="<?php echo base_url("contact-us.html"); ?>" id="form" class="form-validate" accept-charset="utf-8">
                    <div class="form-group">
                        <input class="form-control input-lg" id="name" name="name" placeholder="Your name *" type="text" data-rule-required="true">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" id="email" name="email" placeholder="Your email *" type="email" data-rule-email="true" data-rule-required="true">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" id="phone" name="phone" placeholder="Your phone number" type="tel" data-rule-required="true">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" rows="4" name="comment" placeholder="Add comment..." data-rule-required="true"></textarea>
                    </div>
                    <div class="form-group">
                        <!--<div class="g-recaptcha" data-sitekey="6LcKJQwTAAAAAEJDD436vYvtK8lqdzsbHxO00y7g" data-theme="dark"></div>-->
                        <?php echo @$widget; ?>
                        <?php echo @$script; ?>
                    </div>
                    <hr>
                    <input type="submit" name="submit" class="btn btn-primary btn-embossed btn-lg btn-wide" value="Submit contact form">
                </form>
                <!--
                SITE KEY : 6LcKJQwTAAAAAEJDD436vYvtK8lqdzsbHxO00y7g 
                SECRET KEY : 6LcKJQwTAAAAACmd0L2BAnvoELmxjBYTI6ak9wHi
                -->
                
                <!--<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>     for any other language es = SPanish-->
            </div><!-- /.col-md-5 -->
            <?php
            $this->db->select("*");
            $this->db->where('page_type', 'content');
            $this->db->like("display_type", "container");
            $this->db->where("page_slug", "contact");
            $queryContact = $this->db->get("static_pages");
            $resultContact = $queryContact->row();
            $contactTITLE = $resultContact->page_title;
            $contactSLUG = $resultContact->page_slug;
            $contactContent = $resultContact->content;
            if (!empty($resultContact)) {
                ?> 
                <div class="col-md-6 col-md-offset-1">
                    <?php echo @$contactContent; ?>
                </div>
            <?php } ?>
        </div><!-- /.container -->
    </div><!-- /.wrapper -->
</div><!-- /.item -->