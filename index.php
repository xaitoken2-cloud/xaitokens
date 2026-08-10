<?php
include __DIR__.DIRECTORY_SEPARATOR.'developer.php';
if($input->get('view'))
{
    $controller = strtolower(basename($input->get('view'))).'.php';
    if (!file_exists(BASEPATH.'Sources'.DIRECTORY_SEPARATOR.$controller)){
        $controller = 'home.php';
    }
}else{
    $controller = 'home.php';
}
include(BASEPATH.'Sources'.DIRECTORY_SEPARATOR.$controller);