<?php

class Controller_Task extends Controller
{
    public function indexAction()
    {
        $taskId = Request::getInt('id', false);
        if ( !$taskId ) {
            App::show404();
        }
        
        $task = Model_Task::getOne($taskId);
        if (!$task) {
            App::show404();
        }
        
        $this->_addStyle('/css/task.css');
        $this->_addScript('/js/task.js');
        
        $this->_nav['tasks']['active'] = true;
        
        $this->_pageTitle['title'] = $task['task_subject'];
        $this->_pageTitle['sub'] = 'Просмотр и изменение задачи';
        
        $this->_addPar('task', $task);
        $this->_addPar('task_comments', Model_Task::getComments($taskId));
    }

    public function allAction()
    {
        $this->_nav['tasks']['active'] = true;
        $this->_nav['tasks']['items']['all']['active'] = true;
        
        $this->_pageTitle['title'] = 'Все задачи';
        $this->_pageTitle['sub'] = 'Список всех задач';
        
        $this->_addPar('tasks', Model_Task::getAll());
    }
    
    public function addAction()
    {
        $data = array(
            'status' => 'ok',
            'error' => ''
        );
        
        try {
            Model_Task::add($_POST);
        } catch(Model_Task_Exception $e) {
            $data['status'] = 'err';
            $data['error'] = $e->getMessage();
        }
        
        echo json_encode($data);
        exit;
    }
    
    public function setstatusAction()
    {
        Model_Task::setStatus($_POST['id'], $_POST['statusid']);
        
        echo json_encode(array());
        exit;
    }
    
    public function addcommentAction()
    {
        $data = array(
            'status' => 'ok',
            'error' => ''
        );
        
        try {
            Model_Task::addComment($_POST);
        } catch(Model_Task_Exception $e) {
            $data['status'] = 'err';
            $data['error'] = $e->getMessage();
        }
        
        echo json_encode($data);
        exit;
    }
}
