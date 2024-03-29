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
//Sets the "index" controller, aka what's loaded in first (in this case it's the login controller)
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//User Routes

//Route['what you want the link to be called'] = "controller-name (in this case User) / function in controller (in this case vetList)
$route['user'] = 'User/vetList'; //User Home screen
$route['vetList/:num'] = 'User/vetList';
$route['vetView/:num'] = 'User/vetView'; 
$route['mission_documents'] = 'User/fileView'; 
$route['mission_itinerary'] = 'User/itineraryView'; 

//Admin Routes

$route['teams'] = 'Admin/teamView'; //admin home screen
$route['documents'] = 'Admin/docView';
$route['reservations'] = 'Admin/resView';
$route['users'] = 'Admin/userView';
$route['veterans'] = 'Admin/vetView';
$route['guardians'] = 'Admin/guardView';
$route['busbook'] = 'Admin/busBookView';



