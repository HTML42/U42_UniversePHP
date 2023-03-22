<?php

// Create necessary directories
$dirs = ['_cache', 'controller', 'handler', 'supermodels', 'views', 'templates'];
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
$json = '{
    "name": "IndexController",
    "routes": [
        {
            "id": 1,
            "method": "GET",
            "path": "index/index",
            "handler": "IndexHandler::index",
            "view": "views/index/index"
        },
        {
            "id": 2,
            "method": "*",
            "path": "",
            "redirect": "index/index"
        },
        {
            "id": 3,
            "method": "*",
            "path": "index",
            "redirect": "index/index"
        },
        {
            "id": 4,
            "method": "*",
            "path": "index.html",
            "redirect": "index/index"
        }
    ],
    "supermodels": ["IndexSupermodel"]
}';
$json = str_replace('\/', '/', $json); // Fix the path in JSON
file_put_contents('../controller/index.controller.json', $json);

// Create /handler/index.handler.php
if (!file_exists('../handler')) {
    mkdir('../handler');
}

if (!file_exists('../handler/index.handler.php')) {
    $index_handler_content = "<?php\nclass IndexHandler {\n\n    public static function index() {\n\n    }\n\n}";
    file_put_contents('../handler/index.handler.php', $index_handler_content);
}

// Create /supermodels/index.supermodel.php
if (!file_exists('../supermodels')) {
    mkdir('../supermodels');
}

if (!file_exists('../supermodels/index.supermodel.php')) {
    $index_supermodel_content = "<?php\nclass IndexSupermodel extends Supermodel {\n\n}";
    file_put_contents('../supermodels/index.supermodel.php', $index_supermodel_content);
}

// Create views/index/index.html
if (!file_exists('../views/index')) {
    mkdir('../views/index');
}

if (!file_exists('../views/index/index.html')) {
    $index_view_content = "<h1>Sinnvolle Webseite Standard Überschrift</h1>\n<h2>Lorem Ipsum</h2>\n<p>Lorem Ipsum</p>";
    file_put_contents('../views/index/index.html', $index_view_content);
}

echo "Installation complete.";
