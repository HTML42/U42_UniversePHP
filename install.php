<?php

// Create environment file
if (!file_exists('../env')) {
    file_put_contents('../env', 'DEV');
} else {
    echo "Environment file already exists.";
    exit;
}

// Create necessary directories
$dirs = ['_cache', 'controller', 'handler', 'supermodels', 'views'];
foreach ($dirs as $dir) {
    if (!file_exists('../' . $dir)) {
        mkdir('../' . $dir);
        file_put_contents('../' . $dir . '/.gitkeep', '');
    }
}

// Create .gitignore files in necessary directories
$ignores = ['_cache'];
foreach ($ignores as $ignore) {
    if (!file_exists('../' . $ignore . '/.gitignore')) {
        file_put_contents('../' . $ignore . '/.gitignore', "*\n!.gitignore");
    }
}

// Create .gitignore file in root directory
if (!file_exists('../.gitignore')) {
    file_put_contents('../.gitignore', "_cache/\n");
}

// Create .htaccess file
$htaccess = "<IfModule mod_rewrite.c>\n";
$htaccess .= "RewriteEngine On\n";
$htaccess .= "RewriteRule .* universephp/execute.php [L]\n";
$htaccess .= "</IfModule>\n";
file_put_contents('../.htaccess', $htaccess);

// Create /controller/index.controller.json
$index_controller = ["name" => "IndexController", "routes" => [
        ["id" => 1, "method" => "GET", "path" => "/index/index", "handler" => "IndexHandler::index", "view" => "/views/index/index"],
        ["id" => 2, "method" => "*", "path" => "/", "redirect" => "/index/index"],
        ["id" => 3, "method" => "*", "path" => "/index", "redirect" => "/index/index"],
        ["id" => 4, "method" => "*", "path" => "/index.html", "redirect" => "/index/index"]
    ],
    "supermodels" => ["IndexSupermodel"]
];

$json = json_encode($index_controller, JSON_PRETTY_PRINT);
file_put_contents('../controller/index.controller.json', $json);

