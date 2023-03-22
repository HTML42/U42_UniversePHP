<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

$classes = array_diff(scandir(DIR_CLASSES), array('.', '..'));

foreach ($classes as $class) {
    if (is_file(DIR_CLASSES . $class)) {
        require_once(DIR_CLASSES . $class);
    }
}
$route = matchRoute(ROUTES, $_SERVER['REQUEST_URI']);
var_dump(Request::$url);
var_dump(Request::$path);
var_dump(Request::$clean_path);
var_dump($route);

function matchRoute($routes, $url) {
    foreach ($routes as $route) {
        $pattern = '#' . $route['path'] . '#U';
        $pattern_match = strstr($route['path'], '(') && strstr($route['path'], ')') && preg_match($pattern, $url, $params);
        $exact_match = $route['path'] == Request::$clean_path;
        if ($exact_match || $pattern_match) {
            array_shift($params);
            list($handler_class, $handler_method) = explode('::', $route['handler']);
            return [
                'handler' => $route['handler'],
                'view' => $route['view']
            ];
        }
        echo "Route not matched: " . $route['path'] . PHP_EOL;
    }
    return null;
}
