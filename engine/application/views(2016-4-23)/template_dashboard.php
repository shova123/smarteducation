<?php
@session_start();
if ($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) {
    $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead = 'error';$alertclass = 'success';$color = '#fff';
    if ($this->session->flashdata('success_message')) {
        $message = $this->session->flashdata('success_message');
    } else if ($this->session->flashdata('message')) {
        $message = $this->session->flashdata('message');
    } else if ($message) {
        $message = $message;
    }
} elseif (($this->session->flashdata('error_message')) || (@$error_message)) {
    $display = 'in';$formClass = 'error';$formOuter = 'outererror';$formHead = 'error';$alertclass = 'danger';$color = '#fff';
    if ($this->session->flashdata('error_message')) {
        $message = $this->session->flashdata('error_message');
    } else {
        $message = @$error_message;
    }
} else {
    $display = '';$formClass = '';$formOuter = 'outer';$formHead = 'head';$alertclass = 'danger';$color = '#000';
    $message = $this->session->flashdata('error_message');
}
?>
<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link type="image/x-icon" href="<?php echo base_url(); ?>gears/front_dashboard/images/favicon.ico" rel="shortcut icon">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Kontext Landing Page</title>
        <meta name="keywords" content="" />
        <meta name="description" content=""/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/plugins/itoolbar/jquery.toolbar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/jquery.classyscroll.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/bootstro/bootstro.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/admin/css/tags-input.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/admin/css/progress.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/admin/css/plugins/tagsinput/jquery.tagsinput.css">

        <style type="text/css">
            .help{position: fixed;bottom:0px;right:10px;}
            .help a{display: block;text-align: center;line-height: 29px;font-size: 11px;height: 30px;width: 30px;background: #000;border-radius: 50%;color:#FFF;margin-bottom:7px;text-decoration: none;}
            .help a i{font-size: 18px;}
            .mystyle{background-color: #90b941;background-image: linear-gradient(90deg, transparent 50%, rgba(152, 195, 68, 1) 50%);background-size: 3px 3px;border-bottom: 1px dashed #d2d3cf;border-top: 1px dashed #d2d3cf;box-shadow: 0 0 0 5px #90b941, 2px 1px 6px 4px rgba(10, 10, 0, 0.3);color: #fff;font-size: 14px;height: auto;line-height: 1em;margin: 15px auto;padding: 9px 0 !important;text-align: center;width: 100%;}
        </style>

        <script type="text/javascript" src="<?php echo config_item('admin_js'); ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo config_item('admin_js'); ?>plugins/validation/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo config_item('admin_js'); ?>plugins/validation/additional-methods.js"></script>
        <script type="text/javascript" src="<?php echo config_item('admin_js'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/eakroko.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/plugins/itoolbar/jquery.toolbar.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/modernizr.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/js/plugins/complexify/jquery.complexify.min.js"></script>

        <script>
            var site_name = '<?php echo $this->config->item('site_name') ?>';
            var base_url = '<?php echo base_url(); ?>';
            var webpath = '<?php echo base_url(); ?>';
        </script>

        <script>
            $(function () {
                $('.tutorial_help a').click(function () {
                    var _id = $(this).attr('id');
                    var _status = $(this).text();
                    $('a#' + _id + '').removeClass(_status);
                    $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
                    var _this = $(this);
                    $.get('<?php echo base_url("signin/update_view_tutorial"); ?>', {id: _id, status: _status},
                    //alert(data);
                            function (data) {
                                _this.text(data);
                                $('a#' + _id + '').addClass(data);
                                //$('.cross').hide();
                            });
                });
            });


            function theFunction() {
                var _id = document.getElementById("tour_val").value;

            }
//            $(function () {
//                $.ajax({
//                    type: "POST",
//                    url: <?php echo base_url("signin/update_view_tutorial_one"); ?>
//                    data: {"id": _id},  // fix: need to append your data to the call
//                    success: function (data) {
//                    }
//                });
//            });

        </script>

        <?php if (@$message) { ?>
            <script>
                window.onload = function () {
                    $(".alert").delay(200).addClass("in");//.fade(10000);
                };
                window.setTimeout(function () {
                    $(".alert").removeClass('in');
                }, 10000);
            </script>
        <?php } ?>

    </head>
    <body>
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

        <section class="dashboard">
            <div class="container">
                <?php
                    $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type']; 
                    $loginUser_Id = $this->ion_auth->get_user_id();
                
                    $user_details = $this->ion_auth->login_user_details();
                    $view_tutorial = $user_details->view_tutorial;
                    if ($view_tutorial == 1) {
                        $viewTutorials = "ON";
                        $titles = "Click to OFF the Tour";
                    } else {
                        $viewTutorials = "OFF";
                        $titles = "Click to ON the Tour";
                    }
                ?>

                <?php $this->load->view("include_dashboard/$groupTypeDashboardName-header", $data); ?>

                <?php echo $contents; ?>
            </div>
        </section>
        <div class="clearfix"></div>

        <?php $this->load->view('include_dashboard/footer', $data); ?>


        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/jquery.classyscroll.js"></script>
        <script type="text/javascript">var loggedinId = <?php echo @$loginUser_Id ?>;</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/bootstro/bootstro.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->item('ckeditor') ?>ckeditor.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                //open the lateral panel
                $('.cd-btn').on('click', function (event) {
                    event.preventDefault();
                    $('.cd-panel').addClass('is-visible');
                    $('body').addClass('hide-y');
                });
                //clode the lateral panel
                $('.cd-panel').on('click', function (event) {
                    if ($(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close')) {
                        $('.cd-panel').removeClass('is-visible');
                        $('body').removeClass('hide-y');
                        event.preventDefault();
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.sample').ClassyScroll();
                $('[data-toggle="tooltip"]').tooltip();
                $("[data-toggle=popover]").popover({html: true});
            });
<?php if (!empty($view_tutorial)) { ?>
                $("document").ready(function () {
                    bootstro.start(".bootstro", {
                    });
                });
<?php } ?>
            $("document").ready(function () {
                $("#demo").click(function () {
                    bootstro.start(".bootstro", {
                    });
                });
            });

        </script>
        <!-- help center-->
        <div class="help">

            <div class="tutorial_help">
                <a href="javascript:;" id="<?php echo @$loginUser_Id; ?>" data-toggle="tooltip" title="<?php echo @$titles; ?>">
                    <?php echo @$viewTutorials; ?>
                    <!--<i class="fa fa-check"></i>-->
                </a>
            </div>

            <a href="#" id="demo" data-toggle="tooltip" title="View Tutorial">
                <i class="fa fa-question"></i>
            </a>
            <a href="#0" class="cd-btn">
                Help Center
            </a>
        </div>
        <!--offscreen div for displaying help content-->
        <div class="cd-panel from-right">
            <?php
            $this->db->select("*");
            $this->db->where('status', '1');
            $this->db->like("group_type", "$groupTypeDashboardName");
            $this->db->order_by('order', 'ASC');
            $queryHelpGroups = $this->db->get("tbl_help");
            $resultHelpGroups = $queryHelpGroups->result();
            ?>
            <header class="cd-panel-header">
                <h1><strong>WELCOME !</strong><small> to (<?php echo ucfirst($groupTypeDashboardName); ?>) Help Center</small></h1>

                <a href="#0" class="cd-panel-close"><i class="fa fa-times"></i></a>
            </header>
            <div class="cd-panel-container">
                <div class="cd-panel-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="list-group">
                                <ul class="list-unstyled">
                                    <li class="active">
                                        <a type="button" href="#tutorial" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">What is Kontext?
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a type="button" href="#desc" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">ABC of Kontext</a>
                                    </li>-->
                                    <li>
                                        <a type="button" href="#faq" aria-controls="home" role="tab" data-toggle="tab" class="list-group-item">FAQ of using it.</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/END of menu side hlep-->
                        <div class="col-sm-9 help-content">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php if (!empty($resultHelpGroups)) { ?>
                                    <!--first menu content-->

                                    <div role="tabpanel" class="tab-pane active" id="tutorial">
                                        <div class="jumbotron">
                                            <h1>What is Kontext? -<small>Some brief introduction about the kontext</small></h1>
                                        </div>
                                        <?php
                                        foreach ($resultHelpGroups as $helpCenter) {
                                            $type = $helpCenter->type;
                                            $youtube_link = $helpCenter->youtube_link;
                                            $video_id = $helpCenter->video_id;
                                            $media = $helpCenter->media;
                                            $title = $helpCenter->title;
                                            $content = $helpCenter->content;
                                            $date = $helpCenter->date;

                                            if ($type == "tutorial") {
                                                ?>
                                                <h3><?php echo $title; ?></h3>
                                                <!--<object width="515" height="315" data="http://www.youtube.com/v/<?php echo $video_id; ?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $video_id; ?>" /></object>-->
                                                <iframe width="515" height="315" src="https://www.youtube.com/embed/<?php echo $video_id; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                                <!--<iframe width="515" height="315" src="<?php echo $youtube_link; ?>" frameborder="0" allowfullscreen></iframe>-->
                                                <?php if (!empty($content)) { ?><p><?php echo $content; ?></p><?php } ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="faq">
                                        <div class="jumbotron">
                                            <h1>faq of Kontext? -<small>have questions? read faq first</small></h1>
                                        </div>
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <?php
                                            $countFaq = 1;
                                            foreach ($resultHelpGroups as $helpCenter) {
                                                $type = $helpCenter->type;
                                                $youtube_link = $helpCenter->youtube_link;
                                                $video_id = $helpCenter->video_id;
                                                $media = $helpCenter->media;
                                                $title = $helpCenter->title;
                                                $content = $helpCenter->content;
                                                $date = $helpCenter->date;

                                                if ($type == "faq") {
                                                    ?>
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading" role="tab" id="heading<?php echo $countFaq; ?>">
                                                            <h4 class="panel-title">
                                                                <a <?php if ($countFaq != 1) { ?>class="collapsed"<?php } ?> role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $countFaq; ?>" aria-expanded="true" aria-controls="collapse<?php echo $countFaq; ?>">
                                                                    <?php echo $title; ?> 
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?php echo $countFaq; ?>" class="panel-collapse collapse <?php if ($countFaq == 1) { ?>in<?php } ?>" role="tabpanel" aria-labelledby="heading<?php echo $countFaq; ?>">
                                                            <div class="panel-body">
                                                                <?php echo $content; ?> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $countFaq++;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--/END of menu content here-->
                    </div>
                </div> <!-- cd-panel-content -->
            </div> <!-- cd-panel-container -->
        </div> <!-- cd-panel -->


    </body>
</html>