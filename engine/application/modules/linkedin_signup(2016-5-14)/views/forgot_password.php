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
        <!--<link rel="stylesheet" href="<?php echo config_item('admin_css');?>plugins/icheck/all.css"/>-->
        <!--<link rel="stylesheet" href="<?php echo config_item('admin_css');?>stylesheets.css"/>-->
                
            <script src="<?php echo config_item('admin_js');?>jquery.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/jquery.validate.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>plugins/validation/additional-methods.min.js"></script>
        <!--<script src="<?php echo config_item('admin_js');?>plugins/icheck/jquery.icheck.min.js"></script>-->
            <script src="<?php echo config_item('admin_js');?>bootstrap.min.js"></script>
            <script src="<?php echo config_item('admin_js');?>eakroko.js"></script>
        
            <script>
                var site_name = '<?php echo $this->config->item('site_name') ?>';
                var base_url = '<?php echo base_url();?>';
                var webpath = '<?php echo base_url();?>';
            </script>
            </head>
    <body>
        
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
<?php if(@$message){?>
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="myModalLabel">Information</h4>-->
              </div>
              <div class="modal-body">
                  <?php echo @$message;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
<?php }?>
        <!--logo and menu portion here-->
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
                        <h1><?php echo lang('forgot_password_heading');?></h1>
                        <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
                        <!--<h1>Login<br><small>.. to access our special features</small></h1>-->
                    </div>
                </div>
            </div>


            <div class="form-login <?php echo $formHead ?>">
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
        <?php
        $this->load->view('common_front/footer', @$data);
        ?>

        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/jquery.stellar.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/sitescript.js"></script>
    </body>
</html>


