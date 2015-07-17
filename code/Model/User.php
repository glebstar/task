<?php

class Model_User
{
    public static function getUsers()
    {
        return Db::getAll('SELECT id, firstname, lastname FROM user ORDER BY lastname');
    }
    
    public static function getUserInfo()
    {
        return Auth::getUserInfo($_SESSION['user_id']);
    }
}
