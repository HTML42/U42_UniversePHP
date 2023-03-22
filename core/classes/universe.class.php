<?php

class Universe {

    function match_route($url) {
        foreach (ROUTES as $route) {
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
        }
        return null;
    }

}
