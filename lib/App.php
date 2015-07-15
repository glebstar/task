<?php

class App
{
    public static function run()
    {
        /* redirect to lower case */
        if ( isset($_SERVER['REDIRECT_URL']) ) {
            if ( preg_match('~[A-Z]~', $_SERVER['REDIRECT_URL']) ) {
                Request::redirect301(strtolower($_SERVER['REDIRECT_URL']));
            }
        }

        $obj = null;
        $action = false;
        $pathCtrl = TASK_CODE_DIR . '/Controller/';
        $classCtrl = 'Controller_';

        $redirect = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
        if (empty($redirect)) {
            $obj = new Controller_Main();
            $obj->run();
            exit;
        }

        $items = explode('/', $redirect);
        $els = array();

        for ($i=0; $i < count($items); $i++) {
            if ( !empty($items[$i]) ) {
                if ( !preg_match('/^[a-zA-Z0-9\-]+$/', $items[$i]) ) {
                    self::show404();
                }
                $els[] = ucfirst(strtolower($items[$i]));
            }
        }

        $cnt = count($els);
        for ($i=0; $i < $cnt; $i++) {
            if ( $i < ($cnt - 1) ) {
                $pathCtrl  .= $els[$i] . '/';
                $classCtrl .= $els[$i] . '_';
            } else {
                $pathCtrl .= $els[$i] . '.php';
                $classCtrl .= $els[$i];
            }
        }

        if ( file_exists($pathCtrl) && !is_dir($pathCtrl) ) {
            $obj = new $classCtrl();
        } else {
            // проверка наличия экшна в родительском контроллере
            preg_match('~(^.+)_([^_]+)$~', $classCtrl, $_crm);
            if ( isset($_crm[1]) && isset($_crm[2]) ) {
                $pathCtrl = preg_replace("~\/{$_crm[2]}\.php$~", '.php', $pathCtrl);

                if ( file_exists($pathCtrl) && !preg_match('/Controller\.php$/', $pathCtrl) ) {
                    $action = strtolower($_crm[2]);
                    $obj = new $_crm[1]();
                }
            }
        }

        if ( empty($obj) ) {
            self::show404();
        }

        $obj->run($action);
    }
    
    public static function show404()
    {
        $obj = new Controller_404();
        $obj->run();
        exit;
    }
}
