<?php

// Define path constants
define('DIR_FRAMEWORK', str_replace('\\', '/', dirname(dirname(__DIR__))) . '/');
define('DIR_PROJECT', str_replace('\\', '/', dirname(dirname(dirname(__DIR__)))) . '/');
define('DIR_CORE', DIR_FRAMEWORK . 'core/');
define('DIR_PLUGINS', DIR_FRAMEWORK . 'plugins/');
define('DIR_CLASSES', DIR_CORE . 'classes/');
define('DIR_LIB', DIR_CORE . 'lib/');
define('DIR_HANDLER', DIR_PROJECT . 'handler/');
define('DIR_SUPERMODELS', DIR_PROJECT . 'supermodels/');
define('DIR_VIEWS', DIR_PROJECT . 'views/');
define('DIR_CONTROLLER', DIR_PROJECT . 'controller/');
define('DIR_MODES', DIR_FRAMEWORK . 'modes/');

define('HOUR', 3600);
define('DAY', HOUR * 24);
define('WEEK', DAY * 7);

require_once(DIR_CLASSES . 'utilities.class.php');
require_once(DIR_CLASSES . 'request.class.php');
require_once(DIR_CLASSES . 'response.class.php');
require_once(DIR_CLASSES . 'supermodel.class.php');
require_once(DIR_CLASSES . 'universe.class.php');
require_once(DIR_CLASSES . 'file.class.php');

$routes = array();
$controller_files = glob(DIR_CONTROLLER . '/*.json');
foreach ($controller_files as $controller_file) {
    $controller_data = json_decode(file_get_contents($controller_file), true);
    $controller_routes = $controller_data['routes'];

    foreach ($controller_routes as $route) {
        $routes[] = $route;
    }
}

define('ROUTES', $routes);

foreach (glob(DIR_HANDLER . '*.handler.php') as $handler_class_filepath) {
    require_once $handler_class_filepath;
}

foreach (glob(DIR_SUPERMODELS . '*.supermodel.php') as $handler_class_filepath) {
    require_once $handler_class_filepath;
}

define('FILE_ENVIRONMENT', DIR_PROJECT . 'env');

define('ENV', is_file(FILE_ENVIRONMENT) ? strtolower(trim(file_get_contents(FILE_ENVIRONMENT))) : 'DEV');

// Set asset prefix based on requested URL path
$asset_prefix = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $asset_prefix .= '../';
}
define('ASSET_PREFIX', $asset_prefix);

// Define base URL
define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);
