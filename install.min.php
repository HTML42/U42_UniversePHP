<?php

$dirs=['_cache','controller','handler','supermodels','views','templates'];
foreach($dirs as $d){if(!file_exists('../'.$d)){mkdir('../'.$d);$i='../'.$d.'/.gitkeep';file_put_contents($i,'');}}
$ignores=['_cache'];
foreach($ignores as $i){if(!file_exists('../'.$i.'/.gitignore')){file_put_contents('../'.$i.'/.gitignore',"*\n!.gitignore");}}
if(!file_exists('../.gitignore')){file_put_contents('../.gitignore',"_cache/\n");}
$htaccess="<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule .* universephp/execute.php [L]\n</IfModule>\n";
file_put_contents('../.htaccess',$htaccess);
$json='{"name":"IndexController","routes":[{"id":1,"method":"GET","path":"index/index","handler":"IndexHandler::index","view":"views/index/index"},{"id":2,"method":"*","path":"","redirect":"index/index"},{"id":3,"method":"*","path":"index","redirect":"index/index"},{"id":4,"method":"*","path":"index.html","redirect":"index/index"}],"supermodels":["IndexSupermodel"]}';
$json=str_replace('\/','/',$json);
file_put_contents('../controller/index.controller.json', json_encode(json_decode($json, true), JSON_PRETTY_PRINT));
if(!file_exists('../handler')){mkdir('../handler');}
if(!file_exists('../handler/index.handler.php')){$c="<?php\nclass IndexHandler {\n\npublic static function index() {\n\n}\n\n}";file_put_contents('../handler/index.handler.php',$c);}
if(!file_exists('../supermodels')){mkdir('../supermodels');}
if(!file_exists('../supermodels/index.supermodel.php')){$c="<?php\nclass IndexSupermodel extends Supermodel {\n\n}";file_put_contents('../supermodels/index.supermodel.php',$c);}
if(!file_exists('../views/index')){mkdir('../views/index');}
if(!file_exists('../views/index/index.html')){$c="<h1>Sinnvolle Webseite Standard Überschrift</h1>\n<h2>Lorem Ipsum</h2>\n<p>Lorem Ipsum</p>";file_put_contents('../views/index/index.html',$c);}

echo "Installation complete.";
