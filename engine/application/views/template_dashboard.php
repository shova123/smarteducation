<?php
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'success';$color = '#fff';
        if($this->session->flashdata('success_message')){
            $message = $this->session->flashdata('success_message');
        }else if($this->session->flashdata('message')){
            $message = $this->session->flashdata('message');
        }else if($message){
            $message = $message;
        }
        
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead ='error';$alertclass = 'danger';$color = '#fff';
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }else{
            $message = @$error_message;
        }
        
}else
{
        $display = '';$formClass = '';$formOuter = 'outer';$formHead ='head';$alertclass = 'danger';$color = '#000';
        $message = $this->session->flashdata('error_message');
}
?>
<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
	<link type="image/x-icon" href="<?php echo base_url();?>gears/front/favicon.ico" rel="shortcut icon"/>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?php echo @$page_title ?> - <?php echo $this->config->item('site_name') ?> </title>

        
        
	<link href="<?php echo base_url();?>gears/front/css/bootstrap.min.css" rel="stylesheet"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'/>
	<link href="<?php echo base_url();?>gears/front/css/font-awesome.min.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>gears/front/css/styles.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>gears/front/css/style-lateral-panel.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>gears/front/responsive-tabs/responsive-tabs.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>gears/front/lightSlider/lightSlider.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/front_dashboard/css/styles.css">
        
        <script type="text/javascript" src="<?php echo base_url();?>gears/front/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>gears/front/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>gears/front/js/plugins/validation/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>gears/front/js/plugins/validation/additional-methods.js"></script>

        <script type="text/javascript" src="<?php echo base_url();?>gears/front/js/eakroko.js"></script>
        
        
        <script>
            var site_name = '<?php echo $this->config->item('site_name') ?>';
            var base_url = '<?php echo base_url();?>';
            var webpath = '<?php echo base_url();?>';
        </script>
        <?php if(@$message){?>
            <script>
                window.onload = function(){
                    $(".alert").delay(200).addClass("in");//.fade(10000);
                };
                window.setTimeout(function() { $(".alert").removeClass('in'); }, 10000);
            </script>
        <?php }?>
    </head>
    <body>
        <?php
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type']; 
            $loginUser_Id = $this->ion_auth->get_user_id();

            $user_details = $this->ion_auth->login_user_details();
            $view_tutorial = $user_details->view_tutorial;

        ?>
        <?php $data['current'] = @$current; ?>
        <?php if (@$message) { ?>
            <div class="span4 " style="position:absolute; top:20%; left:40%;z-index:9999;">
                <div class="alert alert-<?php echo $alertclass; ?> fade <?php echo $display; ?>">
                    <button type="button" class="close" data-dismiss="alert" style="font-size:12px;">×</button>
                    <strong><?php echo @$message; ?></strong> 
                </div>
            </div>
        <?php } ?>
        <?php $this->load->view('include_dashboard/welcome', $data); ?>
        
        <?php $this->load->view("include_dashboard/$groupTypeDashboardName-header", $data); ?>

        <section class="dashboard">
            <!-- <div class="container"> -->
                <?php echo $contents; ?>
            <!-- </div> -->
        </section>
        <div class="clearfix"></div>

        <?php $this->load->view('include_dashboard/footer', $data); ?>
    </body>
</html>