<?php

$mainCfg = array(
    'db' => array(
        'dbname'    => 'task',
        'host'      => '127.0.0.1',
        'user'      => '*',
        'password'  => '*'
    ),
    'error_level'           => E_ALL,
    'display_errors'        => 'Off',
    'script_version'        => 5,
    'social_login_redirect' => 'http://task.mx'
);

if (file_exists(TASK_ROOT_DIR . '/cfg/config.local.php')) {
    require_once TASK_ROOT_DIR . '/cfg/config.local.php';
}
