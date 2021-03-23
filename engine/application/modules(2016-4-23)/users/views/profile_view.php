
<!--Styles to add on online server-->
<style type="text/css">
    .form-bk{
        background:#f0f0f0;
        margin-bottom:1px;
    }
    .profile-display{
        padding: 10px 0 10px 15px;
    }
    .my-profile-portion .form-bk{
        padding-bottom:40px;
    }
    .my-profile-portion .form-bk img{
        margin-bottom: 20px;
    }
    .my-profile-portion .col-sm-9{
        border-left: 1px solid #e1e1e1;
    }
</style>
<?php 
$isEdit = isset($details) ? true : false;
if (@$isEdit) {$user_token = $details->user_token;}
if (@$isEdit) {$firstname = $details->first_name;}
if (@$isEdit) {$last_name = $details->last_name;}
$full_name = "$firstname $last_name";
if (@$isEdit) {$email = $details->email;}
if (@$isEdit) {$phone = $details->phone;}
if (@$isEdit) {$address = $details->address;}
if (@$isEdit) {$lat = $details->lat;}
if (@$isEdit) {$lng = $details->lng;}
if (@$isEdit) {$information = $details->information;}
if (@$isEdit) {$username = $details->username;}
if (@$isEdit) {$home_image = $details->home_image;}
?>

<!--user profile div-->
<div class="row my-profile-portion">
    <div class="col-sm-12 form-bk">
        <h1>PROFILE</h1>
        <div class="row">
            <!--/right profile image-->
            <div class="col-sm-3 col-md-2">
                <!--<img src="assets_front/images/man.jpg" alt="profile-pic" class="img-responsive" width="120">-->
                <?php if(!empty($home_image)){?>
                <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/profile/<?php echo $home_image;?>&w=150&h=150" />
                <?php }?>
                <?php if(!empty($username)){?>
                <div class="edit-profile">
                    <strong><?php echo ucfirst($username);?></strong>
                </div>
                <?php }?>
                <div class="edit-profile <?php if(@$bootstropIDA5 >=0){?>bootstro<?php }?>" <?php if(@$bootstropIDA5 >=0){?>
                        data-bootstro-title='Click' 
                        data-bootstro-content="You can edit your profile"
                        data-bootstro-width="200px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropIDA5;?>'<?php }?>>
                    <a href="<?php echo base_url("users/edit_profile/$user_token");?>"><strong><i class="fa fa-edit"></i></strong>  Edit Profile</a>
                </div>
            </div>
            <!--/left other profile info-->
            <div class="col-sm-9 col-md-8">
                <?php if(!empty($information)){?>
                <div class="profile-display">
                    <i class="fa fa-info-circle"></i><?php echo $information;?>
                </div>
                <hr>
                <?php }?>
                <?php if(!empty($full_name)){?>
                <div class="profile-display">
                    <i class="fa fa-user"></i> <strong><?php echo ucfirst($full_name);?></strong>
                </div>
                <?php }?>
                <?php if(!empty($email)){?>
                <div class="profile-display">
                    <i class="fa fa-envelope"></i> <strong><?php echo $email;?></strong> 
                    <span title="edit" data-toggle="tooltip"></span>
                </div>
                <?php }?>
                <?php if(!empty($phone)){?>
                <div class="profile-display">
                    <i class="fa fa-phone"></i> <strong><?php echo $phone;?></strong>
                </div>
                <?php }?>
                <?php if(!empty($address)){?>
                <div class="profile-display">
                    <i class="fa fa-map-marker"></i> <strong><?php echo $address;?></strong>
                </div>
                <?php }?>
                
            </div>
        </div>
        <!--/end of row-->
    </div>
    <?php $this->load->view("include_dashboard/alert-message");?>
</div>
<!--/end of user profile display-->
