<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

require_once(DIR_CLASSES . 'utilities.class.php');
require_once(DIR_CLASSES . 'request.class.php');

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);
define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

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
