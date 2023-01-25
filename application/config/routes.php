<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'backend/dashboard/';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['panel'] = 'backend/dashboard';
$route['panel/login'] = 'backend/login';
$route['panel/do-login'] = 'backend/login/do_login';
$route['panel/logout'] = 'backend/login/logout';
$route['panel/profile/(:num)'] = 'backend/profile/index/$1';
$route['panel/update-profile/(:num)'] = 'backend/profile/update/$1';
$route['panel/products'] = 'backend/products';
$route['panel/products/datatable'] = 'backend/products/datatable';
$route['panel/products/create-new-product'] = 'backend/products/new_form';
$route['panel/products/update-product/(:num)'] = 'backend/products/update_form/$1';
$route['panel/products/upload-product-image/(:num)'] = 'backend/products/upload_form/$1';
$route['panel/products/save'] = 'backend/products/save';
$route['panel/products/update/(:num)'] = 'backend/products/update/$1';
$route['panel/products/delete/(:num)'] = 'backend/products/delete/$1';

$route['panel/product-variations'] = 'backend/product_variations';
$route['panel/settings'] = 'backend/settings';
