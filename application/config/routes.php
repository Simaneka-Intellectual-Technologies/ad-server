<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'main/view';
$route['admin'] = 'admin/login';
$route['action/(:any)'] = 'main/$1';

$url = $this->uri->segment(1);

if ($url == 'api') {
    $route[''] = 'api/index';
    $route['get/(:any)'] = 'api/$1';;
    $route['track/(:any)'] = 'api/track/$1';;
}



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
