<script src='https://www.google.com/recaptcha/api.js'></script>

<!--<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>-->
<!--<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>-->
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 login-div">
            <div class="row">
                <div class="col-sm-5 login-form-index">
                    <!--/loginMenuTab-->
                    <ul class="list-inline choose-login">
                        <li role="presentation" class="active"><a href="#candidate" aria-controls="candidate" role="tab" data-toggle="tab"><i class="fa fa-black-tie"></i> Candidate </a></li>
                        <li role="presentation"><a href="#company" aria-controls="company" role="tab" data-toggle="tab"> <i class="fa fa-industry"></i> Company  </a></li>
                    </ul>
                    <!--/loginMenuContentTab-->
                    <div class="tab-content">
                        <!--/candidate login here-->
                        <div role="tabpanel" class="tab-pane active" id="candidate">
                            <!--/login div-->
                            <div class="login_div">
                                <h1>Members Login Here</h1>
                                <a href="" class="btn btn-primary linked-login">Login with LinkedIn <i class="fa fa-linkedin"></i></a>
                                <form action="<?php echo base_url('signin/login'); ?>" method="post" id="candidate_login_form" class="form-validate" accept-charset="utf-8">
                                    <input type="hidden" name="type" value="users">
                                    <input type="hidden" name="admin_type" value="superAdmin">
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="text" class='form-control'  name='identity' id="identity" value="" placeholder="Email" data-rule-required="true" data-rule-email="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" data-rule-required="true">
                                    </div>
                                    <div class="form-group">
                                        <div class="remember" style="margin-left:15px;">
                                            <input type="checkbox" name="remember" value="1" id="remember"/>    
                                            <label for="remember" class="side-label">Remember me</label>
                                        </div>
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" name="submit" value="Login" id="loginBtn" class="btn btn-success"/>
                                        <a href="<?php echo base_url("signin/forgot_password"); ?>" class="forgot_password home-forgot">Forgot Password?</a>
                                    </div>
                                </form>
                                <p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
                            </div>
                            <div class="signup_div">
                                <form action="<?php echo base_url('users/register'); ?>" method="POST" class='register-form form-horizontal form-wizard' id="candidate_signup_form">
                                    
                                    <div class="step" id="firstStep">
                                        <h1>New Members Signup Here</h1>
                                        <a href="" class="btn btn-primary linked-login">Signup with LinkedIn <i class="fa fa-linkedin"></i></a>
                                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                                        <?php
                                        $this->db->select("*");
                                        $this->db->like("group_type", 'users');
                                        $this->db->or_like("name", 'users');
                                        $this->db->or_like("name", 'candidate');
                                        $queryGroup = $this->db->get("groups");
                                        $resultGroup = $queryGroup->row();

                                        if (!empty($resultGroup)) {
                                            $group_id = $resultGroup->group_id;
                                            $group_name = $resultGroup->name;
                                            ?>
                                            <input type="hidden" name="groups[]" value="<?php echo $group_id; ?>" checked/>
                                        <?php } ?>
                                        <?php
                                        $this->db->select("*");
                                        $queryProfile = $this->db->get("profile");
                                        $resultProfile = $queryProfile->result();
                                        if (!empty($resultProfile)) {
                                        ?>
                                            <select style="display:none;" name="status" id="status" class='form-control' data-rule-required="true">
                                                <?php
                                                foreach ($resultProfile as $profiles) {
                                                    $profileID = $profiles->profile_id;
                                                    $profileTITLE = $profiles->profile_title;
                                                    $profileUSERS = $profiles->users;
                                                    $profileTEMPLATES = $profiles->templates;
                                                    if ($profileTITLE == "demo") {
                                                ?>
                                                <option value="<?php echo $profileID; ?>" selected> <?php echo ucfirst($profileTITLE); ?><?php if (!empty($profileUSERS)) {echo "($profileUSERS U/ $profileTEMPLATES T)";} ?> </option>
                                                <?php }} ?>
                                            </select>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label for="useremail" class="sr-only">Email address</label>
                                            <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email" data-rule-email="true" data-rule-required="true" /><!--data-rule-checkExists="true"/>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword" class="sr-only">Password</label>
                                            <input type="password" class="form-control" name="password" id="candidate_signup_password" value="" placeholder="Password" data-rule-minlength="8" data-rule-required="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword-repeat" class="sr-only">Repeat Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password" data-rule-equalTo="#candidate_signup_password" data-rule-minlength="8" data-rule-required="true"/>
                                        </div>
                                    </div>
                                    
                                    <div class="step" id="secondStep">
                                        <h1>Your Full Name and a Smiling Pic<br>
                                            Makes your Profile Better <i class="fa fa-smile-o"></i></h1>
                                        <script>
                                            $(document).on('keyup', '#full_name', function () {
                                                var Text = $(this).val();
                                                Text = Text.toLowerCase();
                                                var regExp = /\s+/g;
                                                Text = Text.replace(regExp, '_');
                                                $("#username").val(Text);

                                            });
                                        </script>
                                        <div class="form-group">
                                            <label for="username" class="sr-only">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" data-rule-required="true" ><!--data-rule-lettersonly="true"-->
                                            <input type="hidden" name="username" class="form-control" id="username" placeholder="UserName">
                                        </div>
                                        <div class="form-group">
                                            <label for="uploadphoto" class="sr-only">Photo</label>
                                            <input type="file" class="form-control" id="uploadphoto">
                                        </div>
                                        <div class="form-group">
                                            <?php echo @$widget; ?>
                                            <!--<div id="recaptcha"></div>-->
                                            
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <input type="reset" class="btn btn-primary" value="Back" id="back">
                                        <input type="submit" class="btn btn-success" value="Sign Up" id="next">
                                    </div>

                                </form>
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>

                            <!--forgot password div-->
                            <div class="forgot_pass">
                                <h1>Forgot Your Password?</h1>
                                <form action="<?php echo base_url('signin/forgot_password'); ?>" method="post" id="forget-form" class="form-validate" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <!--<input type="email" class="form-control" id="useremail" placeholder="Email">-->
                                        <input type="text" name='email' id="email" value="" placeholder="Email" class='form-control' data-rule-required="true" data-rule-email="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                    </div>
                                </form>
                                <p>Remembered Password? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                        </div>
                        <!--/company login here-->
                        <div role="tabpanel" class="tab-pane" id="company">
                            <!--/login div-->
                            <div class="login_div">
                                <h1>Company Members Login Here</h1>
                                
                                <form action="<?php echo base_url('signin/login'); ?>" method="post" id="company_login_form" class="form-validate" accept-charset="utf-8">
                                    <input type="hidden" name="type" value="company">
                                    <input type="hidden" name="admin_type" value="superAdmin">
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="text" class='form-control'  name='identity' id="identity" value="" placeholder="Email" data-rule-required="true" data-rule-email="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" data-rule-required="true">
                                    </div>
                                    <div class="form-group">
                                        <div class="remember" style="margin-left:15px;">
                                            <input type="checkbox" name="remember" value="1" id="remember"/>    
                                            <label for="remember" class="side-label">Remember me</label>
                                        </div>
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" name="submit" value="Login" id="loginBtn" class="btn btn-success"/>
                                        <a href="<?php echo base_url("signin/forgot_password"); ?>" class="forgot_password home-forgot">Forgot Password?</a>
                                    </div>
                                </form>
                                <p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
                            </div>
                            <!--signup div for candidate-->
                            <div class="signup_div">

                                <form action="<?php echo base_url('users/register'); ?>" method="POST" class='register-form form-horizontal form-wizard' id="company_signup_form">
                                    <div class="step" id="firstStep">
                                        <h1>New Company? Signup Here</h1>
                                        <input type="hidden" name="type" value="company"/>
                                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="user_token" />
                                        <?php
                                        $this->db->select("*");
                                        $this->db->like("group_type", 'company');
                                        $this->db->or_like("name", 'company');

                                        $queryCompanyGroup = $this->db->get("groups");
                                        $resultCompanyGroup = $queryCompanyGroup->row();

                                        if (!empty($resultCompanyGroup)) {
                                            $companyGroup_id = $resultCompanyGroup->group_id;
                                            $companyGroup_name = $resultCompanyGroup->name;
                                            ?>
                                            <input type="hidden" name="groups[]" value="<?php echo $companyGroup_id; ?>" checked/>
                                        <?php } ?>
                                        <?php
                                        $this->db->select("*");
                                        $companyqueryProfile = $this->db->get("profile");
                                        $companyresultProfile = $companyqueryProfile->result();
                                        if (!empty($resultProfile)) {
                                            ?>
                                            <select style="display:none;" name="status" id="status" class='form-control' data-rule-required="true">
                                                <?php
                                                foreach ($companyresultProfile as $profile) {
                                                    $profileIDs = $profile->profile_id;
                                                    $profileTITLEs = $profile->profile_title;
                                                    $profileUSERSs = $profile->users;
                                                    $profileTEMPLATESs = $profile->templates;
                                                    if ($profileTITLEs == "demo") {
                                                ?>
                                                        <option value="<?php echo $profileID; ?>" selected> <?php echo ucfirst($profileTITLEs); ?><?php if (!empty($profileUSERSs)) {echo "($profileUSERSs U/ $profileTEMPLATESs T)";} ?> </option>
                                                <?php }} ?>
                                            </select>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="company" class="sr-only">Company Name</label>
                                            <input type="text" name="company" class="form-control" id="company" placeholder="Company Name" data-rule-required="true" >
                                        </div>
                                        <div class="form-group">
                                            <label for="useremail" class="sr-only">Email address</label>
                                            <input type="email" class="form-control" name="email" id="email" value="" placeholder="Corporate Email" data-rule-email="true" data-rule-required="true" /><!--data-rule-checkExists="true"/>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword" class="sr-only">Password</label>
                                            <input type="password" class="form-control" name="password" id="company_signup_password" value="" placeholder="Password" data-rule-minlength="8" data-rule-required="true"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword-repeat" class="sr-only">Repeat Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password" data-rule-equalTo="#company_signup_password" data-rule-minlength="8" data-rule-required="true"/>
                                        </div>
                                    </div>
                                    <div class="step" id="secondStep">
                                        <h1>Whom do we salutate to?Give us your Introduction</h1>
                                        <script>
                                            $(document).on('keyup', '#companyfull_name', function () {
                                                var Text = $(this).val();
                                                Text = Text.toLowerCase();
                                                var regExp = /\s+/g;
                                                Text = Text.replace(regExp, '_');
                                                $("#companyusername").val(Text);

                                            });
                                        </script>
                                        <div class="form-group">
                                            <label for="username" class="sr-only">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" id="companyfull_name" placeholder="Full Name" data-rule-required="true" ><!--data-rule-lettersonly="true"-->
                                            <input type="hidden" name="username" class="form-control" id="companyusername" placeholder="UserName">
                                        </div>
                                        <div class="form-group">
                                            <label for="uploadphoto" class="sr-only">Photo</label>
                                            <input type="file" class="form-control" id="uploadphoto">
                                        </div>
                                        <div class="form-group">
                                            <?php //echo @$widget; ?>
                                            <div id="myrecaptcha"></div>
                                            
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        /*remember to include jquery before adding this code*/
                                        $(document).ready(function() {
                                            // Duplicate our reCapcha 
                                            $('#myrecaptcha').html($('#recaptcha').clone(true,true));
                                        });


                                        </script>
                                    <div class="form-actions">
                                        <input type="reset" class="btn btn-primary" value="Back" id="back">
                                        <input type="submit" class="btn btn-success" value="Sign Up" id="next">
                                    </div>

                                </form>
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>

                            <div class="forgot_pass">
                                <h1>Forgot Your Password?</h1>
                                <form action="<?php echo base_url('signin/forgot_password'); ?>" method="post" id="company-forget-form" class="form-validate" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="text" name='email' id="email" value="" placeholder="Email" class='form-control' data-rule-required="true" data-rule-email="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                    </div>
                                </form>
                                <p>Remembered Password? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                        </div>
                    </div>
                    <!--Like Us-->
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                </div>
                <!--/end of loginform index-->
                <div class="col-sm-5">
                </div>
            </div>
        </div>
        <!--/end of login-div-->
    </div>
</div>
<?php //echo @$script; ?>