<?php

class Controller_Login extends Controller
{
    public function indexAction()
    {
        $this->_addStyle('/bootstrap/css/bootstrap-login.min.css');
        $this->_addStyle('/plugins/uniform/css/uniform.default.css');
        $this->_addStyle('/assets/css/login-style.css');
        $this->_addScript('/assets/js/login.js');
        $this->_addScript('/plugins/uniform/jquery.uniform.min.js');
        
        $this->_checkLogin();
    }
    
    private function _checkLogin()
    {
        $postLogin = Request::getVar('login');
        if ($postLogin) {
            $auth = new Auth();
            if ($auth->checkLogin($postLogin, Request::getVar('password'))) {
                App::showMain();
            }
            
            // логин или пароль неверны
            $this->_addPar('login_error', true);
        }
    }
}
