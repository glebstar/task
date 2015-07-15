<?php

if (!defined("PATH_SEPARATOR")) {
    define('PATH_SEPARATOR', getenv("COMSPEC")? ";" : ":");
}

ini_set("include_path", ini_get("include_path") .
    PATH_SEPARATOR . dirname(__FILE__) .
    PATH_SEPARATOR . TASK_CODE_DIR
    );

if ( !function_exists('__autoload') ) {
    function __autoload($class)
    {
        $class = str_replace('_', '/', $class);
        require_once($class . '.php');
    }
}
