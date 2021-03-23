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
                                <form action="<?php echo base_url('signin/login'); ?>" method="post" id="login_form" class="form-validate" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <!--<input type="email" class="form-control" id="useremail" placeholder="Email">-->
                                        <input type="text" class='form-control'  name='identity' id="identity" value="" placeholder="Email" data-rule-required="true" data-rule-email="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <!--<input type="password" class="form-control" id="userpassword" placeholder="Password">-->
                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" data-rule-required="true">
                                    </div>
                                    <div class="form-group">
                                        <div class="remember" style="margin-left:15px;">
                                                <input type="checkbox" name="remember" value="1" id="remember"/>    
                                                <label for="remember" class="side-label">Remember me</label>
                                        </div>
                                        <label for="submit" class="sr-only">submit</label>
                                        <!--<input type="submit" value="Log in" class="btn btn-success">-->
                                        <input type="submit" name="submit" value="Login" id="loginBtn" class="btn btn-success"/>
                                        <a href="<?php echo base_url("signin/forgot_password"); ?>" class="forgot_password home-forgot">Forgot Password?</a>
                                    </div>
                                </form>
                                <p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
                            </div>
                            <!--signup div for candidate-->
                            <form action="<?php echo base_url('users/register');?>" method="post" id="signup_form" class="form-validate" accept-charset="utf-8">
                            <div class="signup_div">
                                <h1>New Members Signup Here</h1>
                                <a href="" class="btn btn-primary linked-login">Signup with LinkedIn <i class="fa fa-linkedin"></i></a>
                                <!--<form action="<?php echo base_url('users/register');?>" method="post" id="form" class="form-validate" accept-charset="utf-8">-->
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
                                    <!-- <div class="form-group">
                                          <label for="username" class="sr-only">Full Name</label>
                                        <input type="text" class="form-control" id="username" placeholder="Full Name">
                                     </div> -->
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <!--<input type="email" class="form-control" id="useremail" placeholder="Email">-->
                                        <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email" data-rule-email="true" data-rule-required="true"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <!--<input type="password" class="complexify-me form-control" id="userpassword" placeholder="Password">-->
                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" data-rule-minlength="8" data-rule-required="true"/>
<!--                                        <span class="help-block">
                                                <div class="progress progress-info">
                                                        <div class="bar bar-red" style="width: 0%"></div>
                                                </div>
                                        </span>-->
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword-repeat" class="sr-only">Repeat Password</label>
                                        <!--<input type="password" class="form-control" id="userpassword-repeat" placeholder="Repeat Password">-->
                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password" data-rule-equalTo="#password" data-rule-minlength="8" data-rule-required="true"/>
                                    </div>
                                    <div class="form-group">

                                        <!--<div class="g-recaptcha" data-sitekey="6LcKJQwTAAAAAEJDD436vYvtK8lqdzsbHxO00y7g" data-theme="dark"></div>-->
                                                <?php echo @$widget; ?>
                                                <?php echo @$script; ?>
                                    </div>
                                    <!-- <div class="form-group">
                                           <label for="uploadphoto" class="sr-only">Photo</label>
                           <input type="file" class="form-control" id="uploadphoto">
                                   </div> -->
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" name="submit" class="btn btn-success continue_signup" value="Signup"/>
                                        <!--<a class="btn btn-success continue_signup">Continue</a>-->
                                    </div>
                                <!--</form>-->
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                            <!--signup div for candidate-->
                            <div class="signup_div_cont">
                                <h1>Your Full Name and a Smiling Pic<br>
                                        Makes your Profile Better :)</h1>
                                <!--<form>-->
                                    <div class="form-group">
                                        <label for="username" class="sr-only">Full Name</label>
                                        <input type="text" class="form-control" id="username" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="uploadphoto" class="sr-only">Photo</label>
                                        <input type="file" class="form-control" id="uploadphoto">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" value="Sign Up" class="btn btn-success">
                                    </div>
                                <!--</form>-->
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                            </form>
                            <!--forgot password div-->
                            <div class="forgot_pass">
                                <h1>Forgot Your Password?</h1>
                                <form>
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" value="Submit" class="btn btn-success">
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
                                <form>
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" value="Log in" class="btn btn-success">
                                            <a href="" class="forgot_password home-forgot">Forgot Password?</a>
                                    </div>
                                </form>
                                <p>Need an Account?  <a href="" class="show_register">Signup Here</a></p>
                            </div>
                            <!--signup div for candidate-->
                            <div class="signup_div">
                                <h1>New Company? Signup Here</h1>
                                <form>
                                    <div class="form-group">
                                        <label for="coname" class="sr-only">Company Name</label>
                                        <input type="text" class="form-control" id="coname" placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="coemail" class="sr-only">Email address</label>
                                        <input type="email" class="form-control" id="coemail" placeholder="Corporate Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword-repeat" class="sr-only">Repeat Password</label>
                                        <input type="password" class="form-control" id="userpassword-repeat" placeholder="Repeat Password">
                                    </div>
                                    <!-- <div class="form-group">
                                           <label for="uploadphoto" class="sr-only">Photo</label>
                                    <input type="file" class="form-control" id="uploadphoto">
                                    </div> -->
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <a class="btn btn-success continue_signup">Continue</a>
                                    </div>
                                </form>
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                            <!--signup div for candidate-->
                            <div class="signup_div_cont">
                                <h1>Whom do we salutate to?<br>
                                        Give us your Introduction</h1>
                                <form>
                                    <div class="form-group">
                                        <label for="username" class="sr-only">Full Name</label>
                                        <input type="text" class="form-control" id="username" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="uploadphoto" class="sr-only">Photo</label>
                                        <input type="file" class="form-control" id="uploadphoto">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" value="Sign Up" class="btn btn-success">
                                    </div>
                                </form>
                                <p>Already Registered? <a href="" class="show_login"> Login Here</a></p>
                            </div>
                            <!--forgot password div-->
                            <div class="forgot_pass">
                                <h1>Forgot Your Password?</h1>
                                <form>
                                    <div class="form-group">
                                        <label for="useremail" class="sr-only">Email address</label>
                                        <input type="email" class="form-control" id="useremail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="submit" class="sr-only">submit</label>
                                        <input type="submit" value="Submit" class="btn btn-success">
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