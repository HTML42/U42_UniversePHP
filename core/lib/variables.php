<?php

// Define path constants
define('DIR_FRAMEWORK', str_replace('\\', '/', dirname(dirname(__DIR__))) . '/');
define('DIR_PROJECT', str_replace('\\', '/', dirname(dirname(dirname(__DIR__)))) . '/');
define('DIR_CORE', DIR_FRAMEWORK . '/core/');
define('DIR_PLUGINS', DIR_FRAMEWORK . '/plugins/');
define('DIR_CLASSES', DIR_CORE . 'classes/');
define('DIR_LIB', DIR_CORE . 'lib/');
define('DIR_HANDLERS', DIR_PROJECT . '/handlers/');
define('DIR_MODELS', DIR_PROJECT . '/models/');
define('DIR_VIEWS', DIR_PROJECT . '/views/');
define('DIR_CONTROLLERS', DIR_PROJECT . '/controllers/');

$routes = array();
$controller_files = glob(DIR_CONTROLLERS . '/*.json');
foreach ($controller_files as $controller_file) {
    $controller_data = json_decode(file_get_contents($controller_file), true);
    $controller_routes = $controller_data['routes'];

    foreach ($controller_routes as $route) {
        $routes[] = $route;
    }
}

define('ROUTES', $routes);
