<div class="footerWrapper" id="footer3">
    <div class="item footer dark">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center social">
                    <?php
                        $this->db->select("*");
                        $this->db->where("status", "Publish");
                        $queryhead = $this->db->get("social_links");
                        $resultLINKS = $queryhead->result_array();
                        
                    ?>
                    <!-- <h2>Product of <a href="">Ascension App</a></h2> -->
                    <span>We're social, come meet and meet us:</span><br>
                    
                    <?php 
                    $icon_title='';
                    foreach($resultLINKS as $socioLinks){
                            $siteNAME = $socioLinks['site_name'];
                            $linkTITLE = $socioLinks['link_title'];
                            $httpLINKS = $socioLinks['http_links'];
                            
                            if($siteNAME == "facebook"){$icon_title = 'facebook-square';}
                            if($siteNAME == "google"){$icon_title = 'google-plus-square';}
                            if($siteNAME == "linkedin"){$icon_title = 'linkedin-square';}
                            if($siteNAME == "twitter"){$icon_title = 'twitter-square';}
                            if($siteNAME == "skype"){$icon_title = 'skype';}
                            if($siteNAME == "youtube"){$icon_title = 'youtube-square';}
                            if($siteNAME == "flicker"){$icon_title = 'flicker-square';}
                            if($siteNAME == "instagram"){$icon_title = 'instagram-square';}
                    ?>
                            <a href="<?php echo $httpLINKS;?>" target="_blank"><span class="fa fa-<?php echo $icon_title;?>"></span></a>
                    <?php }?>
                    
                            
                    
                    
                    <p>&copy; Copyright 2015. Kontext. Concept and App by <a href="">Ascension App</a></p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>   	
    </div><!-- /.item -->
</div><!-- /.footerWrapper -->


<!--
<1?php 
                    foreach($resultLINKS as $socioLinks){
                            $siteNAME = $socioLinks['site_name'];
                            $linkTITLE = $socioLinks['link_title'];
                            $httpLINKS = $socioLinks['http_links'];
                            if($siteNAME == "facebook"){$FB = $linkTITLE; $HTTPfb = $httpLINKS;}
                            if($siteNAME == "google"){$GOOGLE = $linkTITLE; $HTTPgoogle = $httpLINKS;}
                            if($siteNAME == "linkedin"){$LINKEDIN = $linkTITLE; $HTTPlinkedin = $httpLINKS;}
                            if($siteNAME == "twitter"){$TWITTER = $linkTITLE; $HTTPtwitter = $httpLINKS;}
                            if($siteNAME == "youtube"){$YOUTUBE = $linkTITLE; $HTTPyoutube = $httpLINKS;}
                            if($siteNAME == "flicker"){$FLICKER = $linkTITLE; $HTTPflicker = $httpLINKS;}
                            if($siteNAME == "instagram"){$INSTAGRAM = $linkTITLE; $HTTPinstagram = $httpLINKS;}
                        }
                        ?>        
                    <a href="#"><span class="fa fa-facebook-square"></span></a>
                    <a href="#"><span class="fa fa-twitter-square"></span></a>
                    <a href="#"><span class="fa fa-linkedin-square"></span></a>
                    <a href="#"><span class="fa fa-google-plus-square"></span></a>
                    <1?php if(!empty($FB)){?><li><a href="<1?php echo $HTTPfb;?>" title="<1?php echo $FB;?>" target="_blank"><i class="fa fa-facebook"></i></a></li><1?php }?>
                    <1?php if(!empty($TWITTER)){?><li><a href="<1?php echo $HTTPtwitter;?>" title="<1?php echo $TWITTER;?>" target="_blank"><i class="fa fa-twitter"></i></a></li><1?php }?>
                    <1?php if(!empty($YOUTUBE)){?><li><a href="<1?php echo $HTTPyoutube;?>" title="<1?php echo $YOUTUBE;?>" target="_blank"><i class="fa fa-youtube"></i></a></li><1?php }?>
                    <1?php if(!empty($GOOGLE)){?><li><a href="<1?php echo $HTTPgoogle;?>" title="<1?php echo $GOOGLE;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><1?php }?>
                    <1?php if(!empty($LINKEDIN)){?><li><a href="<1?php echo $HTTPlinkedin;?>" title="<1?php echo $LINKEDIN;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><1?php }?>
                    <1?php if(!empty($FLICKER)){?><li><a href="<1?php echo $HTTPflicker;?>" title="<1?php echo $FLICKER;?>" target="_blank"><i class="fa fa-flickr"></i></a></li><1?php }?>
                    <1?php if(!empty($INSTAGRAM)){?><li><a href="<1?php echo $HTTPinstagram;?>" title="<1?php echo $INSTAGRAM;?>" target="_blank"><i class="fa fa-instagram"></i></a></li><1?php }?>
-->