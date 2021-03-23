<?php
@session_start();
if($this->session->flashdata('success_message')) 
{
	$display = 'in';
	$formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        $message = $this->session->flashdata('success_message');
}elseif(@$error_message) 
{
	$display = 'in';
	$formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'danger';
        $color = '#fff';
        $message = @$error_message;
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
                
            <link href="<?php echo base_url();?>gears/front/dist/css/flat-ui.css" rel="stylesheet">
            <link href="<?php echo base_url();?>gears/front/docs/assets/css/demo.css" rel="stylesheet">
                
            <script src="<?php echo config_item('admin_js');?>jquery.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/jquery.validate.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/additional-methods.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>bootstrap.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>eakroko.js"></script>
        
        <?php if(@$message){?>
            <script>
                window.onload = function(){
                    //$(".alert").removeClass("in").show();
                    $(".alert").delay(200).addClass("in").fade(10000);
                };
            </script>
        <?php }?>
            <script>
                var site_name = '<?php echo $this->config->item('site_name') ?>';
                var base_url = '<?php echo base_url();?>';
                var webpath = '<?php echo base_url();?>';
            </script>
    </head>


    <body>
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
                        <h1>Login<br><small>.. to access our special features</small></h1>
                    </div>
                </div>
            </div>


            <div class="form-login <?php echo $formHead ?>">
                <div class="container">
                    <div class="login">
                        <div class="login-screen">
                            <div class="login-icon">
                                <img src="<?php echo base_url();?>gears/front/images/login/icon.png" alt="Welcome to Mail App" />
                                <h4>Welcome to <small>Kontext App</small></h4>
                            </div>
                            
                            <div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
                                <div class="alert alert-<?php echo $alertclass; ?> fade <?php echo $display; ?>">
                                    <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
                                    <strong><?php echo @$message; ?></strong> 
                                </div>
                            </div>
                            
                            <div class="login-form">
                                <form action="<?php echo base_url('signin/login'); ?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                                
                                
                                    <div class="form-group">
                                        <input type="text" class="form-control login-field" name='identity' id="identity" value="" placeholder="Email/Username:" data-rule-required="true" data-rule-email="true">
                                        <label class="login-field-icon fui-user" for="login-name"></label>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" value="" placeholder="Password" class='form-control login-field' data-rule-required="true">
                                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                                    </div>
                                    
                                    <input type="submit" name="submit" value="Login" id="loginBtn" class="btn btn-primary btn-lg btn-block"/>
<!--                                    <a class="btn btn-primary btn-lg btn-block" href="#">Log in</a>-->
                                    <div class="remember" style="margin-left:15px;">
<!--                                        <input type="checkbox" name="remember" value="1" id="remember"/>    
                                        <label for="remember" class="side-label">Remember me</label>-->
                                        <a href="<?php echo base_url("signin/forgot_password"); ?>" class="login-link" href="#">Lost your password?</a>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <?php
        $this->load->view('common_front/footer', @$data);
        ?>

<!--        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/jquery.stellar.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/sitescript.js"></script>-->
    </body>
</html>


