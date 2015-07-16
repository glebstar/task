<?php

class Controller_Task extends Controller
{
    public function allAction()
    {
        $this->_nav['tasks']['active'] = true;
        $this->_nav['tasks']['items']['all']['active'] = true;
        
        $this->_pageTitle['title'] = 'Все задачи';
        $this->_pageTitle['sub'] = 'Список всех задач';
    }
    
    public function addAction()
    {
        $this->_nav['tasks']['active'] = true;
        $this->_nav['tasks']['items']['add']['active'] = true;
        
        $this->_pageTitle['title'] = 'Создать задачу';
        $this->_pageTitle['sub'] = 'Новая задача';
    }
}
