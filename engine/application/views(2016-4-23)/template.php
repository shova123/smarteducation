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
        
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $nTitle = "Oh No!";
        $nType = "error";//success, error, info , dark
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }else{
            $message = @$error_message;
        }
        
}else
{       $nTitle = "Oh No!";
        $nType = "error";//success, error, info , dark
        $message = $this->session->flashdata('error_message');
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <title><?php echo @$page_title ?> - <?php echo $this->config->item('site_name');?></title>
        
        <!-- Favicon icon -->
        <link type="image/x-icon" href="<?php echo base_url();?>gears/front/favicon.ico" rel="shortcut icon"/>
        <!-- Apple devices Homescreen icon -->
        <link href="<?php echo base_url();?>gears/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/css/animate.min.css" rel="stylesheet" type="text/css" >
        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url();?>gears/admin/css/custom.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url();?>gears/admin/css/icheck/flat/green.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>gears/admin/css/dim.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>gears/admin/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>gears/admin/js/plugins/datatables/css/TableTools.css">
        <!--new datatable-->
        <link href="<?php echo base_url();?>gears/admin/js/plugins/datatables/ui-datatable-datepicker.css" rel="stylesheet" type="text/css" />
<!--        <link rel="stylesheet" href="<?php echo base_url();?>gears/admin/js/plugins/datatables/TableTools.css">
        <link rel="stylesheet" href="<?php echo base_url();?>gears/admin/js/plugins/datatables/datatableStyle.css">-->
        <!-- select2 -->
        <link href="<?php echo base_url();?>gears/admin/css/select/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- jQuery -->
        <script src="<?php echo base_url();?>gears/admin/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>gears/admin/js/bootstrap.min.js"  type="text/javascript"></script>
        
        <!--for datatable UI elements only-->
        <script src="<?php echo base_url();?>gears/admin/js/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/momentjs/moment-range.min.js"></script>
	
        <script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.fixedColumns.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.fixedHeader.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.scroller.min.js"></script>
        
        
	
	
        
        <!--form validation-->
        <script src="<?php echo base_url();?>gears/admin/js/plugins/validation/jquery.validate.min.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/validation/additional-methods.js"></script>
        <script src="<?php echo base_url();?>gears/admin/js/plugins/eakroko.min.js"></script>
        
        
        <script>
            var site_name = '<?php echo $this->config->item('site_name') ?>';
            var base_url = '<?php echo base_url();?>';
            var webpath = '<?php echo base_url();?>';
        </script>

        <!--notification script-->
        <?php if(!empty($message)){?>
        <script type="text/javascript">
             $(document).ready(function() {
                new PNotify({
                    title: '<?php echo $nTitle;?>',
                    text: '<?php echo $message;?>.',
                    type: '<?php echo $nType?>'
                }); 
        });
        </script>
        <?php }?>
    </head>
    <?php $data['current'] = @$current;?>
    <body class="nav-md">
        
        <div class="container body">
            <div class="main_container">
                <?php $this->load->view('common/header',$data);?>
                <?php $this->load->view('common/left_sidebar',$data);?>
                
                <div class="right_col" role="main">
                    <?php echo $contents;?>
                    <?php //$this->load->view('common/footer',$data);?>
                </div>
                
                <div id="custom_notifications" class="custom-notifications dsp_none">
                    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
                    </ul>
                    <div class="clearfix"></div>
                    <div id="notif-group" class="tabbed_notifications"></div>
                </div>
            </div>
        </div>
    </body>

<!--JQuery-->
    
    <!-- select2 -->
    <script src="<?php echo base_url();?>gears/admin/js/select/select2.full.js"></script>
    <!-- nicescroll-->
    <script src="<?php echo base_url();?>gears/admin/js/nicescroll/jquery.nicescroll.min.js"  type="text/javascript"></script>
    <!-- icheck -->
    <script src="<?php echo base_url();?>gears/admin/js/icheck/icheck.min.js"  type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url();?>gears/admin/js/moment.min.js"  type="text/javascript"></script>
    <script src="<?php echo base_url();?>gears/admin/js/datepicker/daterangepicker.js"  type="text/javascript"></script>

    <script src="<?php echo base_url();?>gears/admin/js/custom.js"></script>
    <!-- PNotify -->
    <script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/notify/pnotify.buttons.js"></script>
    <script>
        $(function () {
            var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
            TabbedNotification = function(options){
                var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title + "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

                if(document.getElementById('custom_notifications') == null){
                    alert('doesnt exists');
                }else{
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
                $('.notifications a').click(function (e){
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
</html>
