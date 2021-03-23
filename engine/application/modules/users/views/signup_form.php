<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/styles.css">


<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        if($this->session->flashdata('success_message')){
            $message = $this->session->flashdata('success_message');
        }else if($this->session->flashdata('message')){
            $message = $this->session->flashdata('message');
        }else if($message){
            $message = $message;
        }
        
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'danger';
        $color = '#fff';
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }else{
            $message = @$error_message;
        }
        
}else
{
        $display = '';
        $formClass = '';
        $formOuter = 'outer';
        $formHead ='head';
        $alertclass = 'danger';
        $color = '#000';
        $message = $this->session->flashdata('error_message');
}
?>

        
        <section class="cover-inner" data-stellar-background-ratio="0.8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 cover-title">
                        <h1>Students Signup Form</h1>
<!--                        <h1><small>.. New To Smartshikshya?</small><br>Signup Here</h1>-->
                        <p><small>.. New To Smartshikshya?</small><br>Signup Here</p>
                        <!--<h1>Login<br><small>.. to access our special features</small></h1>-->
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
                                    $this->db->like("group_type",'user');
                                    $this->db->like("name",'student');
                                    $queryGroup = $this->db->get("groups");
                                    $resultGroup = $queryGroup->row();
                                    if(!empty($resultGroup)){
                                        $group_id= $resultGroup->group_id;
                                        $group_name= $resultGroup->name;
                                ?>
                                <input type="hidden" name="groups[]" value="<?php echo $group_id;?>" checked/>
                                <!--<label class='inline' for="c9"><?php echo $group_name;?></label>-->
                                <?php }?>
                                <!--
                                <1?php 
                                    $this->db->select("*");
                                    $queryProfile = $this->db->get("profile");
                                    $resultProfile = $queryProfile->result();
                                    if(!empty($resultProfile)){
                                ?>
                                    <select name="status" id="status" class='form-control' data-rule-required="true" style="display:none;">
                                    <1?php foreach($resultProfile as $profiles){
                                            $profileID = $profiles->profile_id;
                                            $profileTITLE = $profiles->profile_title;
                                            $profileUSERS = $profiles->users;
                                            $profileTEMPLATES = $profiles->templates;
                                            if($profileTITLE =="demo"){
                                    ?>
                                        <option value="<1?php echo $profileID;?>" selected> <1?php echo ucfirst($profileTITLE);?><1?php if(!empty($profileUSERS)){echo "($profileUSERS U/ $profileTEMPLATES T)";}?> </option>
                                        <1?php }}?>
                                    </select>
                                <1?php }?>
                                -->
                                

                                    
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
        </section><!--cover for inner pages-->
        <div class="clearfix"></div>
   