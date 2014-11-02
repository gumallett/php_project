<?php

function framework_load($class) {
    //$class = 'phporm\\'.$class;
    file_put_contents("php://stderr", 'Loading class: '.$class."\n");
    require_once $class . '.php';
}

function model_load($class) {
    file_put_contents("php://stderr", 'Loading model class: '.$class."\n");
    require_once __DIR__.'\\..\\'.$class . '.php';
}

framework_load('annotation\Annotations');
framework_load('annotation\Annotation');
framework_load('Identifiable');
framework_load('DAO');
framework_load('Logger');
framework_load('Record');
framework_load('TableModel');

define('DB_NAME', 'gregmallettdatabase');
define('DB_USER', 'gregmallett');
define('DB_PASSWORD', 'gregmallettpass');