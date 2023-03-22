<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'variables.php';

$classes = array_diff(scandir(DIR_CLASSES), array('.', '..'));

foreach ($classes as $class) {
    if (is_file(DIR_CLASSES . $class)) {
        require_once(DIR_CLASSES . $class);
    }
}