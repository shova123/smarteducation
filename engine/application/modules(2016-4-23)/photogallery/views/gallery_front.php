
    <!-- subheader begin -->
    <div id="subheader">
        <div class="container">
            <div class="row">
                <div class="span6">
                    
                    <h1>
                    <?php if(!empty($photo_gallery)){
                        foreach($photo_gallery as $gallImg){
                        echo $gallImg->gallery_name;
                        }?>
                    <?php }else{
                        echo "Gallery";
                    }?>
                    </h1>
                    <?php if(!empty($photo_gallery)){?>
                    <h3><a href="<?php echo base_url('photogallery');?>"> Gallery </a></h3>
                    <?php }?>
                    
                </div>
                
            </div>
        </div>
    </div>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content">
        <div class="container">
            
            <div class="row">
                <div id="gallery" class="gallery">
                        
                    <?php if(!empty($gallery)){
                        foreach($gallery as $gall){
                    $gallery_id = $gall->id;
                    $gallery_name = $gall->gallery_name;
                    
                    $posted_date = $gall->date;
                                        $Y = date('Y', strtotime($posted_date)); //NUmber year separated 
                                        $m = date('m', strtotime($posted_date)); //nuMBer mont separated
                                        $d = date('d', strtotime($posted_date)); //numbER day separated
                                            $monthName = date("F", mktime(0, 0, 0, $m, 10)); // output: $m=05  $monthName = may 
                                            $converted_date = $monthName." ".$d.", ".$Y; //output: May 
                                        
                        $query = mysql_query("SELECT * FROM tbl_gallery_images WHERE gid='".$gallery_id."' ");
                        while($data_images=  mysql_fetch_array($query)){
                                $gallery_image = $data_images['imgname'];
                        }
                    ?>
                    <!-- <h4>Gallery item -->
                    <div class="span3 item news">
                        <a class="preview" href="<?php echo base_url("photogallery/photo_gallery_front/$gallery_id");?>" title="<?php echo $gallery_name;?>">
                            <?php if(!empty($gallery_image)){?>
                            <img src="<?php echo base_url();?>assets/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/gallery/<?php echo $gallery_image?>&w=640&h=380" alt="" />
                            <?php }else{?>
                            <img src="<?php echo base_url();?>assets/images_front/property/no-image.jpg" alt="" class="img-hover">
                            <?php }?>   
                            
<!--                            <img src="<?php echo base_url();?>assets/createThumb/create_thumb.php?src=<1?php echo base_url();?>uploads/gallery/<1?php echo $gallery_image;?>&w=250&h=250" alt=""/>-->
                            <!--  data-original="<1?php echo base_url();?>assets/createThumb/create_thumb.php?src=<1?php echo base_url();?>uploads/gallery/<1?php echo $gallery_image;?>&w=250&h=250"                          -->
                        </a>
                        <h4><?php echo $gallery_name;?></h4>
                        <span><?php echo $converted_date;?></span>
                    </div>
                    <!-- close <h4>Gallery item -->
                    <?php }}?>
                    
                    <?php if(!empty($photo_gallery)){
                        foreach($photo_gallery as $gallImg){
                    $gallery_id = $gallImg->id;
                        $query2 = mysql_query("SELECT * FROM tbl_gallery_images WHERE gid='".$gallery_id."' ");
                        while($data_images2=  mysql_fetch_array($query2)){
                                $gallery_image2 = $data_images2['imgname'];
                                $img_name = $data_images2['title'];
                                $posted_date2 = $data_images2['date'];
                                        $Y2 = date('Y', strtotime($posted_date2)); //NUmber year separated 
                                        $m2 = date('m', strtotime($posted_date2)); //nuMBer mont separated
                                        $d2 = date('d', strtotime($posted_date2)); //numbER day separated
                                            $monthName2 = date("F", mktime(0, 0, 0, $m2, 10)); // output: $m=05  $monthName = may 
                                            $converted_date2 = $monthName2." ".$d2.", ".$Y2; //output: May 
                    ?>
                    <!-- <h4>Gallery item -->
                    <div class="span3 item news">
                        <a class="preview" href="<?php echo base_url();?>uploads/gallery/<?php echo $gallery_image2;?>" data-gal="prettyPhoto" title="<?php echo $img_name;?>">
                            <?php if(!empty($gallery_image2)){?>
                            <img src="<?php echo base_url();?>assets/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/gallery/<?php echo $gallery_image2?>&w=640&h=380" alt="" />
                            <?php }else{?>
                            <img src="<?php echo base_url();?>assets/images_front/property/no-image.jpg" alt="" class="img-hover">
                            <?php }?>   
                            
<!--                            <img src="<1?php echo base_url();?>assets/createThumb/create_thumb.php?src=<1?php echo base_url();?>uploads/gallery/<1?php echo $gallery_image2;?>&w=250&h=250" alt="">-->
                           
                        </a>
                        <h4><?php echo $img_name;?></h4>
                        <span><?php echo $converted_date2;?></span>
                    </div>
                    <!-- close <h4>Gallery item -->
                    <?php }}}?>
                  		
                </div>
            </div>
            
            
            
					<div class="pagination text-center ">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>







        </div>
    </div>
    <!-- content close -->
