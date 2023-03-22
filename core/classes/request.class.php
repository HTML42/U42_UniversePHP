<?php

class Request {

    public static $url;
    public static $path;
    public static $clean_path;
    public static $method;
    public static $params = array();

    public static function init() {
        self::$url = self::getCurrentUrl();
        self::$path = self::getCurrentPath();
        self::$clean_path = self::getCurrentCleanPath();
        self::$method = $_SERVER['REQUEST_METHOD'];
        self::$params = self::getCurrentParams();
    }

    public static function getCurrentUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

    public static function getCurrentPath() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        return $path;
    }

    public static function getCurrentParams() {
        $params = array();
        parse_str($_SERVER['QUERY_STRING'], $params);
        return $params;
    }

    public static function getCurrentCleanPath() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $baseUrl = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        $cleanPath = str_replace($baseUrl, '', $path);
        $cleanPath = explode('?', $cleanPath)[0]; // remove query string
        $cleanPath = trim($cleanPath, '/');
        return $cleanPath;
    }

}

Request::init();
