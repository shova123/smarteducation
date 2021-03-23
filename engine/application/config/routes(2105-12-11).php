<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 		= "home";
$route['404_override'] 		 	= 'page/nopagefound';

$route['admin/([a-zA-Z_-]+)/(:any)']    = '$1/admin/$2';
$route['admin/([a-zA-Z_-]+)']           = '$1/admin/index';

$route['([a-zA-Z_-]+)/(:any)/dashboard']    = '$1/dashboard/$2';

$route['home.html'] = 'home';
$route['cost-calculator.html'] = 'home/cost_calc';
$route['about-us.html'] = 'home/about_us/about-us';
$route['contact-us.html'] = 'home/contact_us';
$route['sign-up.html'] = 'signup/create_user';
$route['search-result.html'] = 'home/search_result';
$route['details/([a-zA-Z0-9_-]+)'] = 'home/job_details/$1';
$route['([a-zA-Z0-9_-]+).html'] = 'home/content_details/$1';

$route['users/templates_add'] = 'templates/templates_add';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
?>