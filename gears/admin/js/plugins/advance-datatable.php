<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>FLAT - New dataTables</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- jQuery UI -->
	<!--<link rel="stylesheet" href="css/plugins/jquery-ui/jquery-ui.min.css">-->
	<!-- dataTables -->
	<link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
	<!-- chosen -->
	<!--<link rel="stylesheet" href="css/plugins/chosen/chosen.css">-->
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<!--<link rel="stylesheet" href="css/themes.css">-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<!--<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>-->
	<!-- imagesLoaded -->
	<!--<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>-->
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- slimScroll -->
	<!--<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>-->
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<!--<script src="js/plugins/bootbox/jquery.bootbox.js"></script>-->
	<!-- New DataTables -->
	<script src="js/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="js/plugins/momentjs/moment-range.min.js"></script>
	<script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="js/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="js/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="js/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
	<script src="js/plugins/datatables/extensions/dataTables.scroller.min.js"></script>

	<!-- Chosen -->
	<!--<script src="js/plugins/chosen/chosen.jquery.min.js"></script>-->

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
<!--	<script src="js/application.min.js"></script>
	 Just for demonstration 
	<script src="js/demonstration.min.js"></script>-->

	<!--[if lte IE 9]>
	<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
	<script>
		$(document).ready(function () {
			$('input, textarea').placeholder();
		});
	</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3>
                    Advanced filtering
                </h3>
            </div>
            <div class="box-content nopadding">
                <table class="table table-hover table-nomargin table-bordered dataTable dataTable-column_filter" data-column_filter_types="null,select,text,select,daterange,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
                    <thead>
                        <tr>
                            <th class='with-checkbox'>
                                <input type="checkbox" name="check_all" class="dataTable-checkall">
                            </th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class='hidden-350'>Status</th>
                            <th class='hidden-1024'>Member since</th>
                            <th class='hidden-480'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>John Doe</td>
                            <td>john.doe@johndoe.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>03-07-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Jane Doe</td>
                            <td>jane.doe@johndoe.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>02-07-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Max Mustermann</td>
                            <td>max.mustermann@maxmustermann.com</td>
                            <td class='hidden-350'>
                                Inactive
                            </td>
                            <td class='hidden-1024'>01-07-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Mary P. Hendrix</td>
                            <td>mary.p@maryhendrix.com</td>
                            <td class='hidden-350'>
                                Disabled
                            </td>
                            <td class='hidden-1024'>30-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>John J. Rodriquez</td>
                            <td>mary.p@maryhendrix.com</td>
                            <td class='hidden-350'>
                                Disabled
                            </td>
                            <td class='hidden-1024'>30-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Rochelle J. Worsham</td>
                            <td>RochelleJWorsham@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>28-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Scott J. Fountain</td>
                            <td>ScottJFountain@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>27-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Rita J. Lima</td>
                            <td>RitaJLima@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>26-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Beth B. Tabb</td>
                            <td>BethBTabb@einrot.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>26-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Grace J. McClelland</td>
                            <td>GraceJMcClelland@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>24-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Michael J. Puente</td>
                            <td>MichaelJPuente@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>23-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Jeffery B. Barnard</td>
                            <td>JefferyBBarnard@einrot.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>22-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Johanna R. Lewis</td>
                            <td>JohannaRLewis@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>21-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Rochelle J. Worsham</td>
                            <td>RochelleJWorsham@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>21-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Rudolph B. Beaty</td>
                            <td>RudolphBBeaty@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>21-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>John T. Medina</td>
                            <td>JohnTMedina@einrot.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>20-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Dwayne D. Bender</td>
                            <td>DwayneDBender@einrot.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>20-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Peter C. Thomas</td>
                            <td>PeterCThomas@einrot.com</td>
                            <td class='hidden-350'>
                                Disabled
                            </td>
                            <td class='hidden-1024'>19-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Dolores R. Anderson</td>
                            <td>DoloresRAnderson@einrot.com</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>19-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Cathleen K. King</td>
                            <td>CathleenKKing@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>30-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Leslie M. Martinez</td>
                            <td>LeslieMMartinez@cuvox.de</td>
                            <td class='hidden-350'>
                                Active
                            </td>
                            <td class='hidden-1024'>18-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="with-checkbox">
                                <input type="checkbox" name="check" value="1">
                            </td>
                            <td>Rochelle J. Worsham</td>
                            <td>RochelleJWorsham@cuvox.de</td>
                            <td class='hidden-350'>
                                Inactive
                            </td>
                            <td class='hidden-1024'>16-06-2014</td>
                            <td class='hidden-480'>
                                <a href="#" class="btn" rel="tooltip" title="View">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
</body>

</html>