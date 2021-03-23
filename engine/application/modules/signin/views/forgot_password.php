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
                        <h1><?php echo lang('forgot_password_heading');?></h1>
                        <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
                        <!--<h1>Login<br><small>.. to access our special features</small></h1>-->
                    </div>
                </div>
            </div>


            <div class="form-login">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                            <div class="icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                        </div>
                        <form action="<?php echo base_url('signin/forgot_password'); ?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                            <div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    <label for="text" class="sr-only">Email</label>
                                    <input type="text" name='email' id="email" value="" placeholder="Email" class='form-control' data-rule-required="true" data-rule-email="true"><!--data-rule-email="true"-->
                                    <!--<input type="text" class="form-control" name="username" id="username" value="<?php echo @get_cookie('login_name') ?>" placeholder="Username or Email">-->
                                </div>
                            </div>
                            

                            <div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    
                                    <input type="submit" name="submit" value="Submit" id="loginBtn" class="btn btn-primary"/>
                                    <!--<input type="submit" class="btn btn-primary" value="Login" name="submit">-->
                                </div>
                            </div>

                        </form>

                       

                    </div>
                </div>
            </div>
        </section><!--cover for inner pages-->
        <div class="clearfix"></div>
   