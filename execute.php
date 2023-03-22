<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

require_once(DIR_CLASSES . 'utilities.class.php');
require_once(DIR_CLASSES . 'request.class.php');

$route = matchRoute(ROUTES, Request::$requested_clean_path);

var_dump($route);
if (isset($route['redirect']) && is_string($route['redirect'])) {
    Utilities::redirect(BASEURL . $route['redirect'], $route['code']);
}

function matchRoute($routes, $url) {
    foreach ($routes as $route) {
        $pattern = '#' . $route['path'] . '#U';
        $pattern_match = strstr($route['path'], '(') && strstr($route['path'], ')') && preg_match($pattern, $url, $params);
        $exact_match = $route['path'] == Request::$requested_clean_path;
        if ($exact_match || $pattern_match) {
            @list($handler_class, $handler_method) = explode('::', @$route['handler']);
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
