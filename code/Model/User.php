<?php

class Model_User
{
    public static function getUsers($orderBy=false)
    {
        if (!$orderBy) {
            $orderBy = 'lastname';
        }
        
        return Db::getAll('SELECT id, login, firstname, lastname FROM user ORDER BY ' . $orderBy);
    }
    
    public static function getUserInfo()
    {
        return Auth::getUserInfo($_SESSION['user_id']);
    }
}
