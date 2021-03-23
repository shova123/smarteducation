<?php
//@session_start();
//if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
//{
//        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'success';$color = '#fff';
//        if($this->session->flashdata('success_message')){$message = $this->session->flashdata('success_message');}
//        else if($this->session->flashdata('message')){$message = $this->session->flashdata('message');}
//        else if($message){$message = $message;}
//}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
//{
//        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'danger';$color = '#fff';
//        if($this->session->flashdata('error_message')){$message = $this->session->flashdata('error_message');}
//        else{$message = @$error_message;}
//        
//}else
//{$display = '';$formClass = '';$formOuter = 'outer';$formHead ='head';$alertclass = 'danger';$color = '#000';$message = $this->session->flashdata('error_message');}
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

            <title><?php echo @$page_title ?> - <?php echo $this->config->item('site_name') ?> </title>

            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/bootstrap.min.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/bootstrap-theme.min.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/bootstrap-slider.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/styles.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/font-awesome.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/animate.min.css">
                
            <script src="<?php echo config_item('admin_js');?>jquery.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/jquery.validate.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/additional-methods.js"></script>
            <script src="<?php echo config_item('admin_js');?>bootstrap.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>eakroko.js"></script>
        
        
            <script>
                var site_name = '<?php echo $this->config->item('site_name') ?>';
                var base_url = '<?php echo base_url();?>';
                var webpath = '<?php echo base_url();?>';
            </script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
        <!-- 
<1?php if(@$message){?>
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade " id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content alert alert-<1?php echo $alertclass;?> ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Information</h4>
              </div>
              <div class="modal-body">
                  <1?php echo @$message;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
<1?php }?>
   
<1?php if(@$message){?>
            <script>
                window.onload = function(){
                    $(".alert").delay(200).addClass("in");//.fade(10000);
                };
                window.setTimeout(function() { $(".alert").removeClass('in'); }, 10000);
            </script>
        <1?php }?>
<div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
            <div class="alert alert-<1?php echo $alertclass;?> fade <1?php echo $display;?>">
                <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
                <strong><1?php echo @$message; ?></strong> 
            </div>
        </div>-->
        <section id="logo" class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <a href="<?php echo base_url("home");?>">
                        <figure>
                            <img src="<?php echo base_url(); ?>gears/front_dashboard/images/logo.png" alt="logo" class="img-responsive">
                        </figure>
                    </a>
                </div>
            </div>
        </section>
        <section class="cover-inner" data-stellar-background-ratio="0.8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 cover-title">
                        <h1><small>.. New To Kontext?</small><br>Signup Here</h1>
                    </div>
                </div>
            </div>


            <div class="form-login">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?php echo base_url('users/register');?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                                <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True));?>" name="user_token" />
                                <?php 
                                    $this->db->select("*");
                                    $this->db->like("group_type",'client');
                                    $this->db->like("name",'client');
                                    $queryGroup = $this->db->get("groups");
                                    $resultGroup = $queryGroup->row();
                                    if(!empty($resultGroup)){
                                        $group_id= $resultGroup->group_id;
                                        $group_name= $resultGroup->name;
                                ?>
                                <input type="hidden" name="groups[]" value="<?php echo $group_id;?>" checked/>
                                <!--<label class='inline' for="c9"><?php echo $group_name;?></label>-->
                                <?php }?>
                                <?php 
                                    $this->db->select("*");
                                    $queryProfile = $this->db->get("profile");
                                    $resultProfile = $queryProfile->result();
                                    if(!empty($resultProfile)){
                                ?>
                                    <select name="status" id="status" class='form-control' data-rule-required="true" style="display:none;">
                                    <?php foreach($resultProfile as $profiles){
                                            $profileID = $profiles->profile_id;
                                            $profileTITLE = $profiles->profile_title;
                                            $profileUSERS = $profiles->users;
                                            $profileTEMPLATES = $profiles->templates;
                                            if($profileTITLE =="demo"){
                                    ?>
                                        <option value="<?php echo $profileID;?>" selected> <?php echo ucfirst($profileTITLE);?><?php if(!empty($profileUSERS)){echo "($profileUSERS U/ $profileTEMPLATES T)";}?> </option>
                                        <?php }}?>
                                    </select>
                                <?php }?>
                                

                                    
                                <div class="col-sm-12">
                                    <h2>Signup Form</h2>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="fullname">First Name <span style="color: #cc0000;">*</span></label>
                                    <!--<input type="text" class="form-control" id="fullname" placeholder="Full Name">-->
                                    <input type="text" name="first_name" id="first_name" value="" class="form-control" data-rule-lettersonly="true" data-rule-required="true" placeholder="First Name"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="fullname">Last Name <span style="color: #cc0000;">*</span></label>
                                    <!--<input type="text" class="form-control" id="fullname" placeholder="Full Name">-->
                                    <input type="text" name="last_name" id="last_name" value="" class="form-control" data-rule-lettersonly="true" data-rule-required="true" placeholder="Last Name"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Email address <span style="color: #cc0000;">*</span></label>
                                    <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email address">-->
                                    <input type="email" name="email" id="email" value="" data-rule-email="true" data-rule-required="true" class="form-control" placeholder="Email Address"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPhone">Phone</label>
                                    <input type="tel" name="phone" id="phone" value="" class="form-control" data-rule-mobileAU="true" placeholder="AUS Mobile Number: 61 xxx xxx xxx"/>
                                </div>
<!--                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Password <span style="color: #cc0000;">*</span></label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    <input type="password" name="password" id="password" value="" class="complexify-me form-control" data-rule-minlength="8" data-rule-required="true" placeholder="Password"/>
                                    <span class="help-block">
                                            <div class="progress progress-info">
                                                    <div class="bar bar-red" style="width: 0%"></div>
                                            </div>
                                    </span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword2">Repeat Password <span style="color: #cc0000;">*</span></label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Repeat Password">
                                    <input type="password" name="password_confirm" id="password_confirm" class="complexify-me form-control" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true" value="" placeholder="Confirm Password"/>
                                    <span class="help-block">
                                            <div class="progress progress-info">
                                                    <div class="bar bar-red" style="width: 0%"></div>
                                            </div>
                                    </span>
                                </div>-->
                                    
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <!--<div class="g-recaptcha" data-sitekey="6LcKJQwTAAAAAEJDD436vYvtK8lqdzsbHxO00y7g" data-theme="dark"></div>-->
                                        <?php echo @$widget; ?>
                                        <?php echo @$script; ?>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="submit" name="submit" class="btn btn-primary " value="Signup"/>
                                    <!--<button type="submit" class="btn btn-primary">Signup</button>-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <?php
        //$this->load->view('common_front/footer', @$data);
        ?>
    </body>
</html>


