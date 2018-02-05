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

$route['default_controller']        = "pages/index";
$route['404_override']              = 'error_404';

/*
| -------------------------------------------------------------------------
ћульти¤зычность
| -------------------------------------------------------------------------
/   к любому методу, любого контроллера можем обращ¤тс¤ 4 способами:
/   www.sitename/controller/action
/   www.sitename/ru/controller/action
/   www.sitename/ua/controller/action
/   www.sitename/en/controller/action
*/
$route['(ru|ua|en|cz)']             = $route['default_controller'];

$route['calendar/(:num)/(:num)']    = "calendar/index/$1/$2";
$route['calendar/(:num)/(:num)/(:num)']    = "calendar/index/$1/$2/$3";
$route['events/(:num)']             = "events/view/$1";
$route['search']					= "pages/search";
$route['search/(:num)']				= "pages/search/$1";
$route['tagsearch']					= "pages/tagsearch";
$route['tagsearch/(:num)']			= "pages/tagsearch/$1";
$route['author']					= "authors/index";
$route['author/(:any)']				= "authors/index/$1";

$route['rss']	                    = "rss/index";
$route['rss/(:num)']	            = "rss/index/$1";
$route['cz/rss/(:num)']	            = "rss/index/$1";
$route['rss/(:num)/(:num)']	        = "rss/index/$1/$2";
$route['cz/rss/(:num)/(:num)']	    = "rss/index/$1/$2";
$route['rss/(:num)/(:num)/(:any)']	= "rss/index/$1/$2/$3";
$route['cz/rss/(:num)/(:num)/(:any)']	= "rss/index/$1/$2/$3";

/* End of file routes.php */
/* Location: ./application/config/routes.php */