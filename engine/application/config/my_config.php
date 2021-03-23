<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI = &get_instance();
$CI->config->load();

$config['site_name'] = 'Smartsikshya';
$config['site_link'] = 'http://localhost/smart/';//'http://52.64.20.207/';
$config['site_email'] = 'menson.sundash@hotmail.com';

$config['site_path'] = $CI->config->item('base_url');	//base url path
$config['admin_dir'] = 'admin';
$config['admin_path'] = $config['site_path'].$config['admin_dir'].'/';

$config['site_root'] = $_SERVER['DOCUMENT_ROOT'].'smart/';//E:/wamp/www/smart/
$config['main_root'] = $_SERVER['DOCUMENT_ROOT'].'/smart/';//E:/wamp/www/
// Define gears path
$config['gears'] = $config['site_path'].'gears/';
$config['gears_admin'] = $config['site_path'].'gears/admin/';
$config['gears_front'] = $config['site_path'].'gears/front/';
$config['uploads'] = $config['site_root'].'uploads/';


//$config['site_js'] = $config['js'].'site_js/';
// front pages
$config['front_css'] = $config['gears_front'].'css/';
$config['front_js'] = $config['gears_front'].'js/';
$config['front_images'] = $config['gears_front'].'images/';
$config['front_plugins'] = $config['gears_front'].'plugins/';
$config['front_bootstrap'] = $config['gears_front'].'bootstrap/';

// admin pages
//$config['admin_gears'] = $config['gears_admin'];
$config['admin_css'] = $config['gears_admin'].'css/';
$config['admin_js'] = $config['gears_admin'].'js/';
$config['admin_bootstrap'] = $config['gears_admin'].'bootstrap/';
$config['admin_images'] = $config['gears_admin'].'images/';

//$config['site_gears'] = $config['gears'].'site/';
//$config['site_css'] = $config['site_gears'].'css/';
//$config['site_images'] = $config['site_gears'].'images/';

// path to jquery Uploadify
$config['uploadify'] = $config['gears'].'uploadify/';
$config['uploadifive'] = $config['gears'].'uploadifive/';
//path to Ckeditor
$config['ckeditor'] = $config['gears'].'admin/editor/ckeditor/';
$config['ckfinder'] = $config['gears'].'admin/editor/ckfinder/';

//Uploads Files

//$config['banner_images_root'] = $config['site_root'].'uploads/banner_images/';
//$config['banner_images_path'] = $config['uploads'].'banner_images/';

$config['rows_per_page'] = '10';

