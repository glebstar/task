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
        
        return false;
    }
    
    public function checkLogin($login, $password)
    {
        if ($this->checkAuth()) {
            return true;
        }
        
        $salt = Db::getOne('SELECT salt FROM user WHERE login=?', array($login));
        if ($salt) {
            $userId = Db::getOne('SELECT id FROM user WHERE login=? AND password=?', array($login, $this->_getHashPassword($password, $salt)));
            
            if ($userId) {
                $_SESSION['user_id'] = $userId;
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
    }
    
    private function _getHashPassword($password, $salt)
    {   
        return md5($password . $salt);
    }

    private function _getNewSalt()
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
}
