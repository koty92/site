<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['signup'] = 'user_controller/signup';
$route['campaign'] = 'campaign_controller/show_create_campaign';

// User
$route['user'] = 'user_controller/show_dashboard';
$route['user/(:any)'] = 'user_controller/route_view/$1';
$route['user/(:any)/content'] = 'user_controller/route_view/$1/content';
$route['signup_profile'] = 'user_controller/signup_profile';

// Company
$route['company/(:num)/(:any)'] = 'company_controller/route_view/$2/$1';
$route['company/(:num)/(:any)/content'] = 'company_controller/route_view/$2/$1/content';

// Mobile
$route['m/(:any)'] = 'main_controller/show_mobile/$1';

$route['api/(:any)/(:any)'] = 'api_controller/$1/$2';
$route['api/(:any)'] = 'api_controller/$1';
$route['admin'] = 'admin_controller';
$route['privacy-policy'] = 'main_controller/show/policy';
$route['terms-and-conditions'] = 'main_controller/show/terms';
$route['faq'] = 'main_controller/show/faq';
$route['about-us'] = 'main_controller/show_home3/about-us';
$route['contact-us'] = 'main_controller/show_home3/contact-us';
$route['download'] = 'main_controller/show_home3/download';

// API
$route['api_/(:any)/(:any)'] = 'api/v$1/api_controller/$2';