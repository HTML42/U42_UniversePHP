<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

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

// Initialize handler method if available based on route configuration
if (is_object($handler_class) && $handler_method && method_exists($handler_class, $handler_method)) {
    $handler_class->$handler_method();
}


// Get the file content of the view based on route configuration
if (isset($route['view']) && is_string($route['view'])) {
    $try_list = File::_create_try_list($route['view'], ['php', 'html', 'htm', 'tpl', 'js', 'css', 'scss', 'less'], [DIR_VIEWS]);
    $view_file = File::instance_of_first_existing_file($try_list);
    Universe::$content = $view_file->get_content();
}

// Include mode-specific file if specified in route
if (isset($route['mode'])) {
    $mode_file = File::instance(DIR_MODES . $route['mode'] . '.php');
    if($mode_file->exists) {
        include $mode_file->path;
    }
}
