<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

require_once(DIR_CLASSES . 'utilities.class.php');
require_once(DIR_CLASSES . 'request.class.php');
require_once(DIR_CLASSES . 'response.class.php');
require_once(DIR_CLASSES . 'supermodel.class.php');
require_once(DIR_CLASSES . 'universe.class.php');
require_once(DIR_CLASSES . 'file.class.php');
foreach (glob(DIR_HANDLER . '*.handler.php') as $handler_class_filepath) {
    require_once $handler_class_filepath;
}

// Set asset prefix based on requested URL path
$asset_prefix = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $asset_prefix .= '../';
}
define('ASSET_PREFIX', $asset_prefix);

// Define base URL
define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

// Match requested route and redirect if necessary
$route = Universe::match_route(ROUTES, Request::$requested_clean_path);
if (isset($route['redirect']) && is_string($route['redirect'])) {
    Utilities::redirect(BASEURL . $route['redirect'], $route['code']);
}

// Load handler class based on route configuration
$handler_class = null;
$handler_method = null;
if (isset($route['handler']) && is_string($route['handler'])) {
    $handler_class_parts = explode('::', $route['handler']);
    $handler_classname = $handler_class_parts[0];
    $handler_method = $handler_class_parts[1] ?? null;
    $handler_class = new $handler_classname();
}
var_dump($handler_class);
var_dump($handler_method);
// Initialize handler method if available based on route configuration
if (is_object($handler_class) && $handler_method && method_exists($handler_class, $handler_method)) {
    $handler_class->$handler_method();
}


// Get the file content of the view based on route configuration
if (isset($route['view']) && is_string($route['view'])) {
    $try_list = File::_create_try_list($route['view'], ['php', 'html', 'htm', 'tpl'], [DIR_VIEWS]);
    $view_file = File::instance_of_first_existing_file($try_list);
    echo $view_file->get_content();
}
