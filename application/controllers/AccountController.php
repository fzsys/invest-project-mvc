<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    public function registerAction()
    {
        if (!empty($_POST)) {
            if(!$this->model->validate(['email', 'login', 'wallet', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $this->view->message('success', 'registration is ok');
        }
        $this->view->render('Register page');
    }

    public function loginAction()
    {
        $this->view->render('Login page');
    }

    public function recoveryAction()
    {
        $this->view->render('Recovery page');
    }
}
