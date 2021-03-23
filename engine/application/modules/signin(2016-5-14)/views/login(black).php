<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $nTitle ="success";
        $nType = "success";//success, error, info , dark
        if($this->session->flashdata('success_message')){
            $message = $this->session->flashdata('success_message');
        }else if($this->session->flashdata('message')){
            $message = $this->session->flashdata('message');
        }else if($message){
            $message = $message;
        }
        echo $message;
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $nTitle = "Oh No!";
        $nType = "error";//success, error, info , dark
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }elseif(@$error_message){
            $message = @$error_message;
        }
        echo $message;
        
}else
{       $mtitle = "Oh No!";
        $nType = "error";//success, error, info , dark
        $message = $this->session->flashdata('error_message');
        echo $message;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <title><?php echo @$page_title ?> - <?php echo $this->config->item('site_name');?></title>
        
        <!-- Favicon icon -->
        <!--<link rel="shortcut icon" href="<?php echo config_item('admin_images');?>favicon.ico" />-->
        <link type="image/x-icon" href="<?php echo base_url();?>gears/front/favicon.ico" rel="shortcut icon"/>
        <!-- Apple devices Homescreen icon -->
        <link href="<?php echo base_url();?>gears/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/css/animate.min.css" rel="stylesheet" type="text/css" >
        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url();?>gears/admin/css/custom.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/css/icheck/flat/green.css" rel="stylesheet" type="text/css" />
        <!-- select2 -->
        <link href="<?php echo base_url();?>gears/admin/css/select/select2.min.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="<?php echo base_url();?>gears/admin/js/jquery.min.js" type="text/javascript"></script>
        <!--form validation-->
        <script src="<?php echo base_url();?>gears/admin/js/plugins/validation/jquery.validate.min.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/validation/additional-methods.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/validation/eakroko.min.js"></script>
        
        <style>

@import "compass/css3";

* { box-sizing: border-box; }

body {
	font-family: "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
  color:white;
  font-size:12px;

}

form {
 	background:#111; 
  width:300px;
  margin:30px auto;
  border-radius:0.4em;
  border:1px solid #191919;
  overflow:hidden;
  position:relative;
  box-shadow: 0 5px 10px 5px rgba(0,0,0,0.2);
}

form:after {
  content:"";
  display:block;
  position:absolute;
  height:1px;
  width:100px;
  left:20%;
  background:linear-gradient(left, #111, #444, #b6b6b8, #444, #111);
  top:0;
}

form:before {
 	content:"";
  display:block;
  position:absolute;
  width:8px;
  height:5px;
  border-radius:50%;
  left:34%;
  top:-7px;
  box-shadow: 0 0 6px 4px #fff;
}

.inset {
 	padding:20px; 
  border-top:1px solid #19191a;
}

form h1 {
  font-size:18px;
  text-shadow:0 1px 0 black;
  text-align:center;
  padding:15px 0;
  border-bottom:1px solid rgba(0,0,0,1);
  position:relative;
}

form h1:after {
 	content:"";
  display:block;
  width:250px;
  height:100px;
  position:absolute;
  top:0;
  left:50px;
  pointer-events:none;
  transform:rotate(70deg);
  background:linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
  
}

label {
 	color:#666;
  display:block;
  padding-bottom:9px;
}

input[type=text],
input[type=password] {
 	width:100%;
  padding:8px 5px;
  background:linear-gradient(#1f2124, #27292c);
  border:1px solid #222;
  box-shadow:
    0 1px 0 rgba(255,255,255,0.1);
  border-radius:0.3em;
  margin-bottom:20px;
color:palegreen;
}

label[for=remember]{
 	color:white;
  display:inline-block;
  padding-bottom:0;
  padding-top:5px;
}

input[type=checkbox] {
 	display:inline-block;
  vertical-align:top;
}

.p-container {
 	padding:0 20px 20px 20px; 
}

.p-container:after {
 	clear:both;
  display:table;
  content:"";
}

.p-container span {
  display:block;
  float:left;
  color:skyblue;
  padding-top:8px;
}

input[type=submit] {
 	padding:5px 20px;
  border:1px solid rgba(0,0,0,0.4);
  text-shadow:0 -1px 0 rgba(0,0,0,0.4);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.3),
    inset 0 10px 10px rgba(255,255,255,0.1);
  border-radius:0.3em;
  background:#0184ff;
  color:white;
  float:right;
  font-weight:bold;
  cursor:pointer;
  font-size:13px;
}

input[type=submit]:hover {
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.3),
    inset 0 -10px 10px rgba(255,255,255,0.1);
}

input[type=text]:hover,
input[type=password]:hover,
label:hover ~ input[type=text],
label:hover ~ input[type=password] {
 	background:#27292c;
}
.has-error{color: #ff0000;}
</style>
<!--notification script-->
        <?php if(@$message){?>
        <script type="text/javascript">
             $(document).ready(function() {
                new PNotify({
                    title: '<?php echo $nTitle;?>',
                    text: '<?php echo $error_message;?>.',
                    type: '<?php echo $nType?>'
                }); 
        });
        </script>
        <?php }?>
    </head>

    <body style="background:#F7F7F7;">
        <form action="<?php echo base_url('signin/login'); ?>" method="post" id="form" class="form-validate" >
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>gears/front/images/logo-white.png" alt="smartsikshya" class="img-responsive" width="95"></a>
            <h1>Administrator <br/>Log In</h1>
            <div class="inset">
                <p>
                    <label for="email">EMAIL ADDRESS</label>
                    <input type="text" name='identity' id="identity" value="" placeholder="Email:" class='form-control' data-rule-required="true" data-rule-email="true">
                </p>
                <p>
                    <label for="password">PASSWORD</label>
                    <input type="password" name="password" id="password" value="" placeholder="Password" class='form-control' data-rule-required="true">
                </p>
                <p>
                    <input type="checkbox" name="remember" id="remember" value='1'>
                    <label for="remember">Keep me Log in</label>
                </p>
            </div>
            <p class="p-container">
                <!--<span>Forgot password ???</span>-->
                <input type="submit" name="submit" value="Signin" /><!--class="btn btn-default submit"-->
                <!--<input type="submit" name="go" id="go" value="Log in">-->
            </p>
        </form>
<!--        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <form action="<?php echo base_url('signin/login'); ?>" method="post" id="form" class="form-validate" accept-charset="utf-8">
                            <h1>Admin Signin</h1>
                            <div>
                                <input type="text" name='identity' id="identity" value="" placeholder="Email:" class='form-control' data-rule-required="true" data-rule-email="true">data-rule-email="true"
                            </div>
                            <div>
                                <input type="password" name="password" id="password" value="" placeholder="Password" class='form-control' data-rule-required="true">
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="index.html">Log in</a>
                                <input type="submit" name="submit" value="Signin" class="btn btn-default submit"/>
                                <a class="reset_pass" href="#">Lost your password?</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">


                                <div>

                                </div>
                            </div>
                        </form>
                         form 
                    </section>
                     content 
                </div>

            </div>
        </div>-->
        <!-- PNotify -->
    <script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/notify/pnotify.buttons.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/notify/pnotify.nonblock.js"></script>-->
    <script>
        $(function () {
            var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
            TabbedNotification = function (options) {
                var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title + "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

                if (document.getElementById('custom_notifications') == null) {
                    alert('doesnt exists');
                } else {
                    $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
                    $('#custom_notifications #notif-group').append(message);
                    cnt++;
                    CustomTabs(options);
                }
            }

            CustomTabs = function (options) {
                $('.tabbed_notifications > div').hide();
                $('.tabbed_notifications > div:first-of-type').show();
                $('#custom_notifications').removeClass('dsp_none');
                $('.notifications a').click(function (e) {
                    e.preventDefault();
                    var $this = $(this),
                        tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                        others = $this.closest('li').siblings().children('a'),
                        target = $this.attr('href');
                    others.removeClass('active');
                    $this.addClass('active');
                    $(tabbed_notifications).children('div').hide();
                    $(target).show();
                });
            }

            CustomTabs();

            var tabid = idname = '';
            $(document).on('click', '.notification_close', function (e) {
                idname = $(this).parent().parent().attr("id");
                tabid = idname.substr(-2);
                $('#ntf' + tabid).remove();
                $('#ntlink' + tabid).parent().remove();
                $('.notifications a').first().addClass('active');
                $('#notif-group div').first().css('display','block');
            });
        })
    </script>
    </body>

</html>


