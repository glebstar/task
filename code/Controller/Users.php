<?php

class Controller_Users extends Controller
{
    public function indexAction()
    {
        $this->_nav['users']['active'] = true;
        $this->_nav['users']['items']['all']['active'] = true;
        
        $this->_pageTitle['title'] = 'Все пользователи';
        $this->_pageTitle['sub'] = 'Список всех пользователей';
        
        $this->_addPar('users', Model_User::getUsers('id'));
    }
}
