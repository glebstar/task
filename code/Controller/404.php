<?php

class Controller_404 extends Controller
{
    public function indexAction()
    {
        $this->_addStyle('/assets/css/error.css');
        $this->_addScript('/js/404.js');
    }
}
