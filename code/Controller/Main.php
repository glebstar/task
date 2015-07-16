<?php

class Controller_Main extends Controller
{
    public function indexAction()
    {
        $this->_nav['tasks']['active'] = true;
        $this->_nav['tasks']['items']['my']['active'] = true;
        
        $this->_pageTitle['title'] = 'Мои задачи';
        $this->_pageTitle['sub'] = 'Список моих активных задач';
    }
}
