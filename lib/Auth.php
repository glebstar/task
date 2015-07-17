<?php

class Auth {
    public function checkAuth() {
        $logout = Request::getInt('logout', false);
        if ($logout) {
            $this->_logout();
            return false;
        }
        
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        
        // check remember
        if (isset($_COOKIE['auth_rememberid']) && isset($_COOKIE['auth_remembers'])) {
            $salt = Db::getOne('SELECT salt FROM user WHERE id=?', array($_COOKIE['auth_rememberid']));
            if (!$salt) {
                return false;
            }
            
            if ($_COOKIE['auth_remembers'] = md5($salt . Request::getUserAgent())) {
                $_SESSION['user_id'] = $_COOKIE['auth_rememberid'];
                return true;
            }
            
            return false;
        }
        
        return false;
    }
    
    public function checkLogin($login, $password)
    {
        if ($this->checkAuth()) {
            return true;
        }
        
        $salt = Db::getOne('SELECT salt FROM user WHERE login=?', array($login));
        if ($salt) {
            $userId = Db::getOne('SELECT id FROM user WHERE login=? AND password=?', array($login, $this->getHashPassword($password, $salt)));
            
            if ($userId) {
                $_SESSION['user_id'] = $userId;
                
                // remember
                if(Request::getCheckBox('remember')) {
                    setcookie('auth_rememberid', $userId, time() + 3600*24*30, '/', $_SERVER['HTTP_HOST']);
                    setcookie('auth_remembers', md5($salt . Request::getUserAgent()), time() + 3600*24*30, '/', $_SERVER['HTTP_HOST']);
                } else {
                    $this->_unsetCookie('auth_rememberid');
                    $this->_unsetCookie('auth_remembers');
                }
                
                return true;
            }
            
            return false;
        } else {
            return false;
        }
    }

    private function _logout()
    {
        $_SESSION['user_id'] = null;
        $this->_unsetCookie('auth_rememberid');
        $this->_unsetCookie('auth_remembers');
    }
    
    public function getHashPassword($password, $salt)
    {   
        return md5($password . $salt);
    }

    public function getNewSalt()
    {
        $chars = array(
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
            '0123456789'
        );
        
        $res = '';
        
        for ($i=0; $i<=4; $i++) {
            $s = $chars[ rand(0, 1) ];
            $res .= $s[ rand(0, strlen($s)-1) ];
        }
        
        return $res;
    }
    
    private function _unsetCookie($name)
    {
        setcookie($name, false, (time() - 2592000), '/', $_SERVER['HTTP_HOST']);
        unset($_COOKIE[$name]);
        unset($_REQUEST[$name]);
    }
    
    public static function getUserInfo($userId)
    {
        return Db::getRow('SELECT id, login, firstname, lastname FROM user WHERE id=?', array($userId));
    }
}
