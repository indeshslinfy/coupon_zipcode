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

$route['default_controller'] = 'home';

$route['404_override'] = 'error/show_404';

$route['404'] = 'error/show_404';

$route['translate_uri_dashes'] = FALSE;



// HOME CONTROLLER

$route['/'] = 'Home';



// AUTH CONTROLLER

$route['login'] = 'auth/login';

$route['signup'] = 'auth/signup';

$route['logout'] = 'auth/logout';

$route['signup-thankyou'] = 'auth/signup_thankyou';



// INDEX CONTROLLER

$route['advertise'] = 'index/contact_us';

$route['contact-us'] = 'index/contact_us';



$route['how-it-works'] = 'index/static_page';

$route['terms-of-use'] = 'index/static_page';

$route['privacy-policy'] = 'index/static_page';

$route['knowledge-base'] = 'index/static_page';



// COUPONS CONTROLLER - FRONTEND

$route['category'] = 'coupons/list_categories';

$route['category/(:any)'] = 'coupons/list_deals';



$route['deals'] = 'coupons/list_deals';

$route['coupon/(:any)'] = 'coupons/coupon_details/$1';

$route['print-coupon/(:any)'] = 'coupons/coupon_print/$1';



// TICKET CONTROLLER

$route['tickets/(:any)'] = 'tickets/ticket_details/$1';

$route['save-ticket/(:any)'] = 'tickets/ticket_save/$1';





/******************** ADMIN PANEL ********************/

// INDEX CONTROLLER

$route[ADMIN_PREFIX] = ADMIN_PREFIX . '/index';



// AUTH CONTROLLER

$route[ADMIN_PREFIX . '/login'] = ADMIN_PREFIX . '/auth/login';

$route[ADMIN_PREFIX . '/logout'] = ADMIN_PREFIX . '/auth/logout';



// USER CONTROLLER

$route[ADMIN_PREFIX . '/users'] = ADMIN_PREFIX . '/user';

$route[ADMIN_PREFIX . '/add-user'] = ADMIN_PREFIX . '/user/user_edit';

$route[ADMIN_PREFIX . '/edit-user/(:any)'] = ADMIN_PREFIX . '/user/user_edit/$1';

$route[ADMIN_PREFIX . '/save-user'] = ADMIN_PREFIX . '/user/user_save/';

$route[ADMIN_PREFIX . '/save-user/(:any)'] = ADMIN_PREFIX . '/user/user_save/$1';

$route[ADMIN_PREFIX . '/delete-user'] = ADMIN_PREFIX . '/user/user_delete';



// STORES CONTROLLER

$route[ADMIN_PREFIX . '/stores'] = ADMIN_PREFIX . '/stores';

$route[ADMIN_PREFIX . '/add-store'] = ADMIN_PREFIX . '/stores/store_edit';

$route[ADMIN_PREFIX . '/edit-store/(:any)'] = ADMIN_PREFIX . '/stores/store_edit/$1';

$route[ADMIN_PREFIX . '/save-store'] = ADMIN_PREFIX . '/stores/store_save/';

$route[ADMIN_PREFIX . '/save-store/(:any)'] = ADMIN_PREFIX . '/stores/store_save/$1';

$route[ADMIN_PREFIX . '/delete-store'] = ADMIN_PREFIX . '/stores/store_delete';



// STORES CATEGORY CONTROLLER

$route[ADMIN_PREFIX . '/stores-category'] = ADMIN_PREFIX . '/Stores_Category';

$route[ADMIN_PREFIX . '/add-store-category'] = ADMIN_PREFIX . '/Stores_Category/stores_cat_edit';

$route[ADMIN_PREFIX . '/edit-store-category/(:any)'] = ADMIN_PREFIX . '/Stores_Category/stores_cat_edit/$1';

$route[ADMIN_PREFIX . '/save-store-category'] = ADMIN_PREFIX . '/Stores_Category/stores_cat_save/';

$route[ADMIN_PREFIX . '/save-store-category/(:any)'] = ADMIN_PREFIX . '/Stores_Category/stores_cat_save/$1';

$route[ADMIN_PREFIX . '/delete-store-category'] = ADMIN_PREFIX . '/Stores_Category/store_cat_delete';



// COUPONS CONTROLLER

$route[ADMIN_PREFIX . '/coupons'] = ADMIN_PREFIX . '/coupons';

$route[ADMIN_PREFIX . '/add-coupon'] = ADMIN_PREFIX . '/coupons/coupon_edit';

$route[ADMIN_PREFIX . '/edit-coupon/(:any)'] = ADMIN_PREFIX . '/coupons/coupon_edit/$1';

$route[ADMIN_PREFIX . '/save-coupon'] = ADMIN_PREFIX . '/coupons/coupon_save/';

$route[ADMIN_PREFIX . '/save-coupon/(:any)'] = ADMIN_PREFIX . '/coupons/coupon_save/$1';

$route[ADMIN_PREFIX . '/delete-coupon'] = ADMIN_PREFIX . '/coupons/coupon_delete';



// REVIEWS CONTROLLER

$route[ADMIN_PREFIX . '/store-reviews/(:any)'] = ADMIN_PREFIX . '/reviews/index/$1';

$route[ADMIN_PREFIX . '/update-review'] = ADMIN_PREFIX . '/reviews/update_review';



// TICKETS CONTROLLER

$route[ADMIN_PREFIX . '/tickets'] = ADMIN_PREFIX . '/tickets';

$route[ADMIN_PREFIX . '/edit-ticket/(:any)'] = ADMIN_PREFIX . '/tickets/ticket_edit/$1';

$route[ADMIN_PREFIX . '/save-ticket/(:any)'] = ADMIN_PREFIX . '/tickets/ticket_save/$1';

$route[ADMIN_PREFIX . '/delete-ticket'] = ADMIN_PREFIX . '/tickets/ticket_delete';



// SETTINGS CONTROLLER

$route[ADMIN_PREFIX . '/settings'] = ADMIN_PREFIX . '/settings';

$route[ADMIN_PREFIX . '/save-settings'] = ADMIN_PREFIX . '/settings/save_settings';



// FEATURED CONTROLLER

$route[ADMIN_PREFIX . '/featured-stores'] = ADMIN_PREFIX . '/featured/featured_stores';

$route[ADMIN_PREFIX . '/popular-categories'] = ADMIN_PREFIX . '/featured/featured_categories';