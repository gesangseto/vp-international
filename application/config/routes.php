<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// request fingerprint solution
$route['iclock/cdata'] = 'fingerprint/iclock/cdata';
$route['iclock/getrequest'] = 'fingerprint/iclock/getrequest';
