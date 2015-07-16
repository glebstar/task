<?php
session_start();

define('TASK_ROOT_DIR', dirname(__FILE__) . '/..');
define('TASK_CODE_DIR', TASK_ROOT_DIR . '/code');

// загружаем конфиги
require_once TASK_ROOT_DIR . '/cfg/config.php';

error_reporting($mainCfg['error_level']);
ini_set('display_errors', $mainCfg['display_errors']);

require_once TASK_ROOT_DIR . '/lib/Autoload.php';

App::run();
