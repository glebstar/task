<?php

class Controller {

    private $_template = 'index';
    private $_templateDir = 'View';
    private $_pars = array(
        'page_title' => 'Task Manager'
    );
    private $_layout = 'layout';
    
    private $_otherLayouts = array(
        'Controller_404'    => 'layout_small',
        'Controller_Login'  => 'layout_small'
    );


    private $_scripts = array();
    private $_styles  = array();
    
    protected $_nav = array(
        'tasks' => array(
            'active' => false,
            'icon' => 'icon-tasks',
            'title' => 'Задачи',
            'items' => array(
                'my' => array(
                    'active' => false,
                    'href' => '/',
                    'icon' => 'icol-lightbulb',
                    'title' => 'Мои задачи'
                ),
                'all' => array(
                    'active' => false,
                    'href' => '/task/all',
                    'icon' => 'icol-lightning',
                    'title' => 'Все задачи'
                ),
                'add' => array(
                    'active' => false,
                    'href' => '#newtaskmodal',
                    'icon' => 'icol-add',
                    'title' => 'Создать задачу',
                    'id' => 'newtaskmodalbtn'
                )
            )
        ),
        
        'users' => array(
            'active' => false,
            'icon' => 'icon-official',
            'title' => 'Пользователи',
            'items' => array(
                'all' => array(
                    'active' => false,
                    'href' => '/users',
                    'icon' => 'icol-group',
                    'title' => 'Все пользователи'
                ),
                'add' => array(
                    'active' => false,
                    'href' => '/users/add',
                    'icon' => 'icol-add',
                    'title' => 'Добавить пользователя'
                )
            )
        ),
        
        'messages' => array(
            'active' => false,
            'icon' => 'icon-comments',
            'title' => 'Сообщения',
            'items' => array(
                'my' => array(
                    'active' => false,
                    'href' => '/messages',
                    'icon' => 'icol-email',
                    'title' => 'Мои сообщения'
                )
            )
        )
    );
    
    protected $_pageTitle = array(
        'title' => '',
        'sub' => ''
    );

    public function run($action='index') {
        if (!$action) {
            $action = 'index';
        }
        
        $this->_template = $action;
        
        $action = $action . 'Action';
        if (!method_exists($this, $action)) {
            App::show404();
        }
        
        $class = get_class($this);
        $items = explode('_', $class);
        foreach ($items as $it) {
            if ($it != 'Controller') {
                $this->_templateDir .= '/' . $it;
            }
        }
        
        if ( isset($this->_otherLayouts[$class]) ) {
            $this->_layout = $this->_otherLayouts[$class];
        }
        
        $this->$action();
        
        $this->_preShow();
        
        $this->_render();
    }
    
    protected function _preShow() {
        $this->_addPar('allusers', Model_User::getUsers());
        $this->_addPar('userinfo', Model_User::getUserInfo());
        $this->_addPar('usertaskcount', Model_Task::getCountForUser($_SESSION['user_id']));
    }

    protected function _addScript($script) {
        $this->_scripts[] = $script;
    }
    
    protected function _addStyle($style) {
        $this->_styles[] = $style;
    }

    protected function _addPar($name, $value) {
        $this->_pars[$name] = $value;
    }

    private function _render() {
        global $mainCfg;
        $this->_addPar('script_version', $mainCfg['script_version']);

        require_once TASK_CODE_DIR . '/View/' . $this->_layout . '.php';
        exit;
    }

}
