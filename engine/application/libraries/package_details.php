<?php
function shorten_stringPackage($string, $wordsreturned){
    $retval = $string; // Just in case of a problem
    $array = explode(" ", $string);
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    }else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array) . " ...";
    }
    return $retval;
}
?>

<?php
    if(!empty($activity_details)){ 
        $activityID   = $activity_details->activity_id;
        $activityTITLE   = $activity_details->activity_title;
        $activityLINK   = $activity_details->link;
        $activitySLUG   = $activity_details->activity_slug;
        $activityCONTENT = $activity_details->activity_description;
        $activityTYPE = $activity_details->activity_type;
        $activityIMAGE= $activity_details->home_image;
    }
//    if (!empty($region_details)) {
//        $regionID = $region_details->region_id;
//        $regionTITLE = $region_details->region_title;
//        $regionSLUG = $region_details->region_slug;
//        $regionLINK = $region_details->link;
//        $regionCONTENT = $region_details->region_description;
//    }


if(!empty($package_details)) {
        $packageID = $package_details->package_id;
        $packCatID = $package_details->activity_id;
        $packRegID = $package_details->region_id;
        $packageTITLE = $package_details->package_title;
        $packageLINK = $package_details->link;
        $packageIMAGE = $package_details->package_image;
        $packageSLUG = $package_details->package_slug;

        $packageTRIPCODE= $package_details->trip_code;
        $packageTRIPDURATION = $package_details->trip_duration;
        $packagePRIMARYACT = $package_details->primary_activity;
        $packageSECONDARYACT = $package_details->secondary_activity;
        $packageMAXALTITUDE = $package_details->max_altitude;
        $packageGROUPSIZE = $package_details->group_size;
        $packageTRANSPORTATION = $package_details->transportation;
        $packageARRIVAL = $package_details->arrival;
        $packageDEPARTURE = $package_details->departure;
        $packageMEALS = $package_details->meals;
        $packageACCOMODATION = $package_details->accomodation;
        
        $packageOVERVIEW = $package_details->overview;
        $equipmentREQUIRED = $package_details->equipment_required;
        $packageITINERARY = $package_details->itinerary;
        $packageDetailedITINERARY = $package_details->detailed_itinerary;
        $packageCOSTdetail = $package_details->cost_details;
        $packageTripFacts = $package_details->features;
?> 
<section class="header-page fade-up header-page-tours">
    <div class="bounce-in animate4"><h2 class="header-pagetitle"><?php echo ucfirst(@$packageTITLE);?></h2></div>
</section>
<div class="divider"><span></span></div>
<section id="internalpage">
    <div class="container clearfix">
        <div class="grid_8">
            <div class="singlepost green" style="position:relative;">
                <?php if (!empty($packageIMAGE)) { ?>
                    <img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/package/<?php echo $packageIMAGE; ?>&w=1920&h=920" class="imgsinglepost"/><!--&w=800&h=500-->
                <?php }?>
                <h1 class="titlesinglepost">Overview</h1>
                <!--SHARE THIS-->
                Share this:
                    <!-- facebook bata lyaako direct yo fb ko button chai -->
		    <!--<div class="fb-share-button" 
		        data-href="http://zedtravels.com/nepal-package/kathmandu-valley-day-tour.html" 
		        data-layout="button_count">
		    </div>-->
		    <style>
		    .stButton{ margin-bottom:4px;}
		    	.stButton .stFb, .stButton .stTwbutton, .stButton .stMainServices, .stButton .stButton_gradient{ height:22px !important;}
		    </style>
		 <div class="share-button">
			<span class='st_twitter_hcount' displayText='Tweet' style="height:24px !important"></span>
			<span class='st_pinterest_hcount' displayText='pi' style="height:24px !important"></span>
			<span class='st_googleplus_hcount' displayText='Plus' style="height:24px !important;"></span>
			<span class='st_facebook_hcount' displayText='Share' style="height:24px !important"></span>
		</div>
		<!--SEND CHRISTMAS MSG HERE-->
		<span id="overlayTriggerTwo" style="position:absolute; margin-top:-150px; right: 0; cursor:pointer"><img src="http://zedtravels.com/gears/front/images/christmas.png" alt="christmas" width="120"></span>
		<!--FORM FOR CHRISTMAS-->
			<div style="display:none" id="overlayContentTwo">
				<h1><i class="fa fa-bell"></i> Send Christmas message for your friend</h1>
				<br><br>
				<h2><i class="fa fa-user"></i> Sender: </h2>
                                <?php //echo base_url("send_gift/$packageLINK-package/$packageSLUG.html");?>
                                <form method="post" name="contactform" action="" id="contactform" class="contactform form-validate" enctype='multipart/form-data' accept-charset="utf-8">
					<div class="grid_6">
						<input type="text" name="sender_name" placeholder="Full Name" data-rule-required="true">
					</div>
					<div class="grid_6">
						<input type="text" name="sender_email" placeholder="Email Address" data-rule-email="true" data-rule-required="true" >
					</div>
					<div class="grid_6">
						<input type="text" name="sender_phone" placeholder="Contact Number" data-rule-required="true" >
					</div>
                                        <div class="grid_6">
						<input type="text" name="sender_address" placeholder="Location">
					</div>
					<div class="clearfix grid_12"></div>
				<br><br>
					<div class="grid_12">
						<h2><i class="fa fa-user"></i> Receiver: </h2>
					</div>
					<div class="grid_6">
						<input type="text" name="receiver_name" placeholder="Full Name" data-rule-required="true" >
					</div>
					<div class="grid_6">
						<input type="text" name="receiver_email" placeholder="Email Address" data-rule-email="true" data-rule-required="true" >
					</div>
                                        <div class="grid_6">
						<input type="text" name="receiver_phone" placeholder="Contact Number" data-rule-required="true" >
					</div>
                                        <div class="grid_6">
						<input type="text" name="receiver_address" placeholder="Location">
					</div>
					<div class="grid_6">
						<input type="submit" value="Send" name="submitDetails">
					</div>
				</form>
				<button class="overlay-close" id="overlayCloseTwo"><i class="fa fa-times"></i></button>
			</div>
		<!--/END OF FORM FOR CHRISTMAS-->
                <a href="<?php echo base_url("book/$packageSLUG.html");?>" class="book-btn">Book Now !</a>
		<p>&nbsp;</p>
                <?php //if(!empty($packageOVERVIEW)){echo $packageOVERVIEW;}?>
                <section>
                    <div class="tabshometour" style="width:100%">
                        <div class="hometabs ui-tabs ui-widget ui-widget-content ui-corner-all">
                            <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                                <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="true">
                                    <a href="#tabs-3" title="Overview" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3" >Overview</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false">
                                    <a href="#tabs-4" title="Itenirary" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-4" >Itenirary</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-5" aria-labelledby="ui-id-5" aria-selected="false">
                                    <a href="#tabs-5" title="Included/Excluded" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-5">Included/Excluded</a>
                                </li>
                                <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-6" aria-labelledby="ui-id-6" aria-selected="false">
                                    <a href="#tabs-6" title="Cost/Service" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-6">Cost/Service</a>
                                </li>
                            </ul>
                            <div id="tabs-3" class="contenthometab weatherhometab ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-3" role="tabpanel" aria-expanded="true" aria-hidden="false" style="display: block;">
                                <div class="row">
                                    <div class="grid_4">
                                        <ul>
                                            <li><span class="left"><i class="fa fa-clock-o"></i>Duration:</span> <span class="right"><?php if(!empty($packageTRIPDURATION)){echo $packageTRIPDURATION;}else{echo "N/A";}?> Days</span></li>
                                            <li><span class="left"><i class="fa fa-star"></i>Primary Activity:</span> <span class="right"><?php if(!empty($packagePRIMARYACT)){echo $packagePRIMARYACT;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-users"></i>Group-size:</span> <span class="right"><?php if(!empty($packageGROUPSIZE)){echo $packageGROUPSIZE;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-globe"></i>Country:</span> <span class="right"><?php if(!empty($packageLINK)){echo ucfirst($packageLINK);}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-plane"></i>Arrival In:</span> <span class="right"><?php if(!empty($packageARRIVAL)){echo $packageARRIVAL;}else{echo "N/A";}?></span></li>
                                        </ul>
                                    </div>

                                    <div class="grid_4">
                                        <ul>
                                            <li><span class="left"><i class="fa fa-barcode"></i>Trip Code:</span> <span class="right"><?php if(!empty($packageTRIPCODE)){echo $packageTRIPCODE;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-star-half-o"></i>Secondary Activity:</span> <span class="right"><?php if(!empty($packageSECONDARYACT)){echo $packageSECONDARYACT;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-signal"></i>Max-Altitude:</span> <span class="right"><?php if(!empty($packageMAXALTITUDE)){echo $packageMAXALTITUDE;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-car"></i>Transportation:</span> <span class="right"><?php if(!empty($packageTRANSPORTATION)){echo $packageTRANSPORTATION;}else{echo "N/A";}?></span></li>
                                            <li><span class="left"><i class="fa fa-plane"></i>Departure From:</span> <span class="right"><?php if(!empty($packageDEPARTURE)){echo $packageDEPARTURE;}else{echo "N/A";}?></span></li>
                                        </ul>
                                    </div>
                                    <div class="grid_8">
                                        <ul>
                                            <li><span class="left1"><i class="fa fa-cutlery"></i>Meals:</span> <span class="right1"><?php if(!empty($packageMEALS)){echo $packageMEALS;}else{echo "N/A";}?></span></li>
                                            <li><span class="left1"><i class="fa fa-building"></i>Accomodation:</span> <span class="right1"><?php if(!empty($packageACCOMODATION)){echo $packageACCOMODATION;}else{echo "N/A";}?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="divider"><span></span></div>
                                <?php if(!empty($packageOVERVIEW)){echo $packageOVERVIEW;}?>
                            </div>

                            <div id="tabs-4" class="contenthometab moneyhometab ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-4" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
                                <?php if(!empty($packageITINERARY)){echo $packageITINERARY;}?>
                            </div>
                            <div id="tabs-5" class="contenthometab moneyhometab ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
<!--                                <h1>Equipments Required in This Trip</h1><br><br>
                                <h4>Recommended Clothing &amp; Equpments</h4>-->
                                <?php if(!empty($equipmentREQUIRED)){echo $equipmentREQUIRED;}?>
                            </div>
                            <div id="tabs-6" class="contenthometab galleryhometab ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-6" role="tabpanel" style="display: none;" aria-expanded="false" aria-hidden="true">
                                <?php if(!empty($packageCOSTdetail)){echo $packageCOSTdetail;}?>
                            </div>
                        </div>
                    </div>
                    
                </section>
<!--                <div class="authorsinglepost">
                    <p class="descriptionauthorsinglepost">
                        <span class="nameauthorsinglepost">Special Message</span><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus, elit vitae fermentum hendrerit, neque erat fringilla nibh  
                    </p>
                </div>-->
            </div>
        </div>
        <div class="grid_4">
            <?php $this->load->view('common_front/right-sidebar', @$data); ?> 
        </div>
    </div>
</section>
<div class="divider"><span></span></div>
<?php }?>