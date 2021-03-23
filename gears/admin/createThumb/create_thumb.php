<?php
include_once(dirname(__FILE__)."/thumb.php");	
$_GET['src'] = isset($_GET['src'])?$_GET['src']:'';
$_GET['w'] = isset($_GET['w'])?$_GET['w']:150;
$_GET['h'] = isset($_GET['h'])?$_GET['h']:150;
$_GET['border'] = isset($_GET['border'])?$_GET['border']:0;
$_GET['position'] = isset($_GET['position'])?$_GET['position']:'center';
imagecopyresampledselection($_GET['src'], $_GET['w'], $_GET['h'], $_GET['border'], $_GET['position']);
?>