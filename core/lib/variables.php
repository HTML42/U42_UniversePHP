<?php

// Define path constants
define('DIR_FRAMEWORK', str_replace('\\', '/', dirname(dirname(__DIR__))) . '/');
define('DIR_PROJECT', str_replace('\\', '/', dirname(dirname(dirname(__DIR__)))) . '/');
define('DIR_CORE', DIR_FRAMEWORK . '/core/');
define('DIR_PLUGINS', DIR_FRAMEWORK . '/plugins/');
define('DIR_CLASSES', DIR_CORE . 'classes/');
define('DIR_LIB', DIR_CORE . 'lib/');
define('DIR_HANDLER', DIR_PROJECT . '/handler/');
define('DIR_SUPERMODELS', DIR_PROJECT . '/supermodels/');
define('DIR_VIEWS', DIR_PROJECT . '/views/');
define('DIR_CONTROLLER', DIR_PROJECT . '/controller/');

define('HOUR', 3600);
define('DAY', HOUR * 24);
define('WEEK', DAY * 7);

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

define('FILE_ENVIRONMENT', DIR_PROJECT . 'env');

define('ENV', is_file(FILE_ENVIRONMENT) ? strtolower(trim(file_get_contents(FILE_ENVIRONMENT))) : 'DEV');

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);
