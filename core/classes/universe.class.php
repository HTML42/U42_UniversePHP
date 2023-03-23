<?php

class Universe {
    
    public static $content = null;

    function match_route($url) {
        $default_view = [
            'view' => 'views/errorpages/404',
            'mime' => 'text/plain',
            'encoding' => 'utf-8',
            'html_base' => 'templates/base.html',
            'mode' => 'html'
        ];
        foreach (ROUTES as $route) {
            $pattern = '#' . $route['path'] . '#U';
            $pattern_match = strstr($route['path'], '(') && strstr($route['path'], ')') && preg_match($pattern, $url, $params);
            $exact_match = $route['path'] == Request::$requested_clean_path;
            if ($exact_match || $pattern_match) {
                @list($handler_class, $handler_method) = explode('::', @$route['handler']);
                $view = isset($route['view']) ? $route['view'] : $default_view['view'];
                $mime = isset($route['mime']) ? $route['mime'] : $default_view['mime'];
                $encoding = isset($route['encoding']) ? $route['encoding'] : $default_view['encoding'];
                $html_base = isset($route['html_base']) ? $route['html_base'] : $default_view['html_base'];
                $mode = isset($route['mode']) ? $route['mode'] : $default_view['mode'];
                return [
                    'handler' => isset($route['handler']) ? $route['handler'] : null,
                    'view' => $view,
                    'redirect' => isset($route['redirect']) ? $route['redirect'] : null,
                    'code' => isset($route['code']) ? $route['code'] : 200,
                    'mime' => $mime,
                    'encoding' => $encoding,
                    'html_base' => $html_base,
                    'mode' => $mode
                ];
            }
        }
        return null;
    }

}
