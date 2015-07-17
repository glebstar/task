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
    
    public static function addUser() {
        $data = array();
        
        $data['login'] = $_POST['login'];
        if ($data['login'] == '') {
            throw new Model_User_Exception($langCfg['emess']['reg_login_r']);
        }

        if (!preg_match('/[a-z0-9]/', $data['login'])) {
            throw new Model_User_Exception('Логин должен содержать только буквы латинского алфавита и цифры');
        }

        if (strlen($data['login']) > 20) {
            throw new Model_User_Exception('Максимальная длина логина 20 символов');
        }

        if (Db::getOne("SELECT id FROM user WHERE login=?", array($data['login']))) {
            throw new Model_User_Exception('Логин ' . $data['login'] . ' уже занят');
        }

        $data['password'] = $_POST['password'];
        if ($data['password'] == '') {
            throw new Model_User_Exception('Не указан пароль');
        }

        if ($data['password'] != $_POST['c_password']) {
            throw new Model_User_Exception('Пароли не совпадают');
        }
        
        $data['salt'] = Auth::getNewSalt();

        $data['password'] = Auth::getHashPassword($data['password'], $data['salt']);

        $data['firstname'] = $_POST['firstname'];
        if ($data['firstname'] == '') {
            throw new Model_User_Exception('Не указана фамилия');
        }

        if (strlen($data['firstname']) > 30) {
            throw new Model_User_Exception('Максимальная длина фамилии 30 символов');
        }

        $data['lastname'] = $_POST['lastname'];
        if ($data['lastname'] == '') {
            throw new Model_User_Exception('Не указано имя');
        }

        if ($data['lastname'] > 30) {
            throw new Model_User_Exception('Максимальная длина имени 30 символов');
        }
        
        Db::insertArray('user', $data);
        $userId = Db::getOne('SELECT id FROM user WHERE login=?', array($data['login']));

        return $userId;
    }
}
