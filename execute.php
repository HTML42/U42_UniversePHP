<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

require_once(DIR_CLASSES . 'utilities.class.php');
require_once(DIR_CLASSES . 'request.class.php');
require_once(DIR_CLASSES . 'response.class.php');
require_once(DIR_CLASSES . 'supermodel.class.php');
require_once(DIR_CLASSES . 'universe.class.php');

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);
define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

$route = Universe::match_route(ROUTES, Request::$requested_clean_path);

if (isset($route['redirect']) && is_string($route['redirect'])) {
    Utilities::redirect(BASEURL . $route['redirect'], $route['code']);
}

#Todo: load handler class based on $route configuration
#Todo: initialize handler method if available based on $route configuration
#Todo: get the file content of the view based on $route configuration
