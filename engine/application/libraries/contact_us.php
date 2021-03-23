<div class="contactmap">
    <div class="infocontact infocontactdark blue">
        <?php 
        if(!empty($contact_details)){
            $address = $contact_details->pri_address;
            $f_phone = $contact_details->f_phone;
            $s_phone = $contact_details->s_phone;
            $email = $contact_details->email;
            $website = $contact_details->website;
            $google_map = $contact_details->google_map;
            $info = $contact_details->info;

            $trimmedEmail = trim($email, ',');
            $explodedEmail = explode(",", $trimmedEmail);
        ?>
        <div class="contentinfocontact">
            <p class="titleinfocontact">Zed Travel</p>
            <?php echo $info;?>
        </div>
        <div class="triangleinfocontact">
            <span></span>
        </div>
        <div class="markercontactmap">
            <div class="circlemarker"><div class="innercirclemarker"></div></div>
            <div class="trianglemarker"></div>
        </div>
        <?php }?>
    </div>
    <!--google maps-->
    <div id="map-canvas" class="map-canvas-dark"></div>
    <!--google maps-->
</div>
<!--end contactmap-->
<div class="divider"><span></span></div>
<section id="internalpage">
    <div class="container clearfix">
        <form action="" method="post" name="addEditform" id="addEditform" class="contactform form-validate" enctype='multipart/form-data' accept-charset="utf-8">
            <div class="grid_4 red">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputfirstname"></div></li>
                    <li><input type="text" name="first_name" id="first_name" class="form-control" data-rule-required="true" data-rule-lettersonly="true" placeholder="First Name"></li>
                </ul>
            </div>
            <div class="grid_4 green">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputlastname"></div></li>
                    <li><input type="text" name="last_name" id="last_name" class="form-control" data-rule-required="true" data-rule-lettersonly="true" placeholder="Last Name"></li>
                </ul>
            </div>
            <div class="grid_4 orange">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputemail"></div></li>
                    <li><input type="text" name="email" id="email" data-rule-email="true" data-rule-required="true" class="form-control" placeholder="Email"></li>
                </ul>
            </div>
<!--            <div class="grid_4 violet">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputdate"></div></li>
                    <li><input name="date" value="Date" type="text"></li>
                </ul>
            </div>-->
            <div class="grid_4 blue">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputphone"></div></li>
                    <li><input type="text" name="phone" id="phone" placeholder="your phone number" class="form-control" data-rule-required="true"></li><!--data-rule-mobileAU="true"-->
                </ul>
            </div>
            <div class="grid_4 yellow">
                <ul>
                    <li class="filterinputicon"><div class="inputicon inputobject"></div></li>
                    <li><input type="text" name="subject" id="subject" class="form-control" data-rule-required="true" data-rule-lettersonly="true" placeholder="Subject"></li>
                </ul>
            </div>
            <div class="grid_12">
                <textarea name="message" placeholder="Message"></textarea>
            </div>
            <div class="grid_12">
                <input type="submit" name="submitDetails" class="btn btn-primary submit-btn pull-right" value="SEND">
            </div>
        </form>
    </div>
</section>
<div class="divider"><span></span></div>

