<?php

class Controller_Registration extends Controller
{
    public function indexAction()
    {
        $auth = new Auth();
        if ($auth->checkAuth()) {
            Request::redirect('/');
            exit;
        }
        
        $data = array(
            'status' => 'ok',
            'error' => ''
        );
        
        if (isset($_POST['login'])) {
            try {
                $userId = Model_User::addUser();
                $_SESSION['user_id'] = $userId;
            } catch (Model_User_Exception $e) {
                $data['status'] = 'err';
                $data['error'] = $e->getMessage();
            }
        }
        
        echo json_encode($data);
        exit;
    }
}
