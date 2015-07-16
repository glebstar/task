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
        $this->_render();
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
