<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

$classes = array_diff(scandir(DIR_CLASSES), array('.', '..'));

foreach ($classes as $class) {
    if (is_file(DIR_CLASSES . $class)) {
        require_once(DIR_CLASSES . $class);
    }
}
$route = matchRoute(ROUTES, Request::$requested_clean_path);
var_dump(ROUTES);
var_dump(get_class_vars('Request'));
var_dump($route);

function matchRoute($routes, $url) {
    foreach ($routes as $route) {
        $pattern = '#' . $route['path'] . '#U';
        $pattern_match = strstr($route['path'], '(') && strstr($route['path'], ')') && preg_match($pattern, $url, $params);
        $exact_match = $route['path'] == Request::$requested_clean_path;
        if ($exact_match || $pattern_match) {
            list($handler_class, $handler_method) = explode('::', $route['handler']);
            return [
                'handler' => isset($route['handler']) ? $route['handler'] : null,
                'view' => isset($route['view']) ? $route['view'] : null,
                'redirect' => isset($route['redirect']) ? $route['redirect'] : null,
                'code' => isset($route['code']) ? $route['code'] : 200,
            ];
        }
        echo "Route not matched: " . $route['path'] . PHP_EOL;
    }
    return null;
}
