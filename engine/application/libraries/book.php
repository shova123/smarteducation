<script>
    function setOptions(chosen) {
        var selbox = document.contactform.package_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = 
                new Option('--Select--',' ');
        }

        <?php
        if (!empty($all_packages)) {
            foreach ($all_packages as $allPack) {
                $activity_id = $allPack->activity_id;
        ?>
                                                                                
        if (chosen == "<?php echo $activity_id ?>") {
        <?php $sub_title = $allPack->package_title;?>
            selbox.options[selbox.options.length] = new Option('<?php echo $sub_title; ?>','<?php echo $sub_title; ?>');//fetching and displaying sub activity in option after selected activity 
        }
        <?php
    }
}
?>
        
    }
</script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<?php echo base_url();?>gears/front/js/jquery.geocomplete.js"></script> 

<script>
      $(function(){
        $("#geocomplete").geocomplete({
            //map: ".map_canvas",
            details: "form",
            country: "AUS",
            types: ["geocode", "establishment"]
        });

      });
      $(document).ready(function() {
        $("#geocomplete").trigger("geocode");
    });
</script>
<section class="header-page fade-up header-page-tours">
    <div class="bounce-in animate4"><h2 class="header-pagetitle">Book Trip</h2></div>
</section>
<div class="divider"><span></span></div>
<section id="internalpage">
    <div class="container clearfix">
        <form method="post" name="contactform" id="contactform" action="" class="contactform form-validate" enctype='multipart/form-data' accept-charset="utf-8">

            <div class="grid_6">
                <ul>
                    <li>
                        <select class="form-control" name="activity_id" id="activity_id" onchange="setOptions(document.contactform.activity_id.options[ document.contactform.activity_id.selectedIndex].value);">
                            <option value="" selected="selected">--Select Activity--</option>
                            <?php 
//                            $this->db->select("*");
//                                $this->db->where("status", "Publish");
//                                $queryCATEGORY = $this->db->get("activity");
//                                $resultCATEGORY = $queryCATEGORY->result_array();
                                if(!empty($activity)){
                                    foreach($activity as $activityARRAY){
                                        $activityID = $activityARRAY->activity_id;
                                        $activityTITLE = $activityARRAY->activity_title;
                                        $activitySLUG = $activityARRAY->activity_slug;
                            ?>
                            <option value="<?php echo $activityID;?>" <?php if(!empty($activity_id)){if($activity_id == $activityID){echo "selected";}}?>><?php echo $activityTITLE;?></option>
                            <?php }}?>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="grid_6">
                <ul>
                    <li>
                        <select class="form-control" name="package_id" id="package_id"><!-- name is used as value obtainer for select changes-->
                            <option value="" selected="selected">---Select---</option> <!--option place for javascript to be printed-->
                            <?php 
                                if(!empty($package_id)){
                                    foreach($packages as $packagesARRAY){
                                        $packageID = $packagesARRAY->package_id;
                                        $packageTITLE = $packagesARRAY->package_title;
                                        $packageSLUG = $packagesARRAY->package_slug;
                            ?>
                            <option value="<?php echo $packageID;?>" <?php if(!empty($package_id)){if($package_id == $packageID){echo "selected";}}?>><?php echo $packageTITLE;?></option>
                            <?php }}?>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="grid_6">
                <ul>
                    <li><input placeholder="Full Name" name="name" type="text" data-rule-required="true" ></li>
                </ul>
            </div>
            <div class="grid_6">
                <ul>
                    <li><input placeholder="Email address" name="email" type="text" data-rule-email="true" data-rule-required="true" ></li>
                </ul>
            </div>
            <div class="grid_6">
                <ul>
                    <li><input placeholder="Phone" name="phone" type="text" data-rule-required="true" ></li>
                </ul>
            </div>
            <div class="grid_6">
                <ul>
                    <li>
                        <!--<input placeholder="Address" name="address" type="text">-->
                        <input id="geocomplete" type="text" placeholder="Type in an address" name="address" class="location" value="" />
<!--                            <input name="lat" type="text" value="<?php if ($isEdit) {echo $details->lat;}?>" hidden>
                            <input name="lng" type="text" value="<?php if ($isEdit) {echo $details->lng;}?>" hidden>-->
                    </li>
                </ul>
            </div>
            <div class="grid_3">
                <ul>
                    <li>
                        <select name="people">
                            <option>--No. of People --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="10+">10+</option>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="grid_3">
                <ul>
                    <li>
                        <input placeholder="no. of days" name="days" type="number">
                    </li>
                </ul>
            </div>
<!--            <div class="grid_3">
                <ul>
                    <li>
                        <input placeholder="Lucky Number" type="number">
                    </li>
                </ul>
            </div>-->
<!--            <div class="grid_12">
                <ul>
                    <li>
                        <input placeholder="Mero Package ko naam" type="text" disabled="disabled">
                    </li>
                </ul>
            </div>-->
            <div class="grid_12">
                <textarea name="message">Message</textarea>
            </div>
            <div class="grid_12">
                <input value="Book Now" type="submit" name="submitDetails">
            </div>
        </form>
    </div>
</section>
<div class="divider"><span></span></div>