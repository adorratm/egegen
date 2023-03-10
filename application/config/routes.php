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
/**
 * User Routes
 */
$route['panel/login'] = 'backend/login';
$route['panel/do-login'] = 'backend/login/do_login';
$route['panel/logout'] = 'backend/login/logout';
$route['panel/profile/(:num)'] = 'backend/profile/index/$1';
$route['panel/update-profile/(:num)'] = 'backend/profile/update/$1';
/**
 * #User Routes
 */

/**
 * Product Routes
 */
$route['panel/products'] = 'backend/products';
$route['panel/products/datatable'] = 'backend/products/datatable';
$route['panel/products/create-new-product'] = 'backend/products/new_form';
$route['panel/products/update-product/(:num)'] = 'backend/products/update_form/$1';
$route['panel/products/upload-product-image/(:num)'] = 'backend/products/upload_form/$1';
$route['panel/products/save'] = 'backend/products/save';
$route['panel/products/update/(:num)'] = 'backend/products/update/$1';
$route['panel/products/delete/(:num)'] = 'backend/products/delete/$1';
$route['panel/products/image-datatable/(:num)'] = 'backend/products/image_datatable/$1';
$route['panel/products/file-delete/(:num)'] = 'backend/products/file_delete/$1';
$route['panel/products/file-cover/(:num)'] = 'backend/products/file_is_cover_setter/$1';
$route['panel/products/file-upload/(:num)'] = 'backend/products/file_upload/$1';
/**
 * #Product Routes
 */

/**
 * Product Variation Routes
 */
$route['panel/product-variations'] = 'backend/product_variations';
$route['panel/product-variations/datatable'] = 'backend/product_variations/datatable';
$route['panel/product-variations/create-new-product-variation'] = 'backend/product_variations/new_form';
$route['panel/product-variations/update-product-variation/(:num)'] = 'backend/product_variations/update_form/$1';
$route['panel/product-variations/save'] = 'backend/product_variations/save';
$route['panel/product-variations/update/(:num)'] = 'backend/product_variations/update/$1';
$route['panel/product-variations/delete/(:num)'] = 'backend/product_variations/delete/$1';
/**
 * #Product Variation Routes
 */

/**
 * Settings Routes
 */
$route['panel/settings'] = 'backend/settings';
$route['panel/settings/datatable'] = 'backend/settings/datatable';
$route['panel/settings/update-settings/(:num)'] = 'backend/settings/update_form/$1';
$route['panel/settings/update/(:num)'] = 'backend/settings/update/$1';
$route['panel/settings/delete-image/(:num)'] = 'backend/settings/delete_settings_image/$1';
/**
 * #Settings Routes
 */
