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
$route['cost-calculator.html']      = 'home/cost_calc';
$route['about-us.html']             = 'home/about_us/about-us';
$route['news/(:any)']    = 'home/news/$1';
$route['know_us']        ='home/content_details/know_us';
$route['about_company']        ='home/content_details/about_company';

$route['contact_us'] = 'home/contact_us';
$route['sign-up.html'] = 'signup/create_user';
$route['search-result.html'] = 'home/search_result';
$route['details/([a-zA-Z0-9_-]+)'] = 'home/job_details/$1';
$route['([a-zA-Z0-9_-]+).html'] = 'home/content_details/$1';
$route['signin/view_profile/(:any)']    = 'signin/signin/view_profile/$1';

$route['users/templates_add'] = 'templates/templates_add';

$route['courses/(:any)'] ="home/courses/$1";
$route['materials'] ="signin/student/material";
$route['chapter/(:any)/(:any)'] ="signin/student/chapter/$1/$2";
$route['subject/(:any)'] ="signin/student/subject/$1";
$route['questions/(:any)'] ="home/subject/$1";
$route['search'] ="home/chapter";
$route['question_detail/(:any)'] ="signin/student/question_detail/$1";
$route['question_view/(:any)'] ="home/question_detail/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */
?>