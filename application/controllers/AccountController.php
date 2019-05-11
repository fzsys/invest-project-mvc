<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    //registration
    public function registerAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['email', 'login', 'wallet', 'password', 'ref'], $_POST)) {
                $this->view->message('error', $this->model->error);

            } elseif (!$this->model->emailExists($_POST['email'])) {
                $this->view->message('error', $this->model->error);

            } elseif (!$this->model->loginExists($_POST['login'])) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->register($_POST);
            $this->view->message('success', 'registration success');

        }

        $this->view->render('Register page');

    }
    public function confirmAction()
    {
        if(!$this->model->tokenExists($this->route['token'])) {
            $this->view->redirect('/account/login');
        }

        $this->model->activate($this->route['token']);
        $this->view->render('Register success');
    }

    //login

    public function loginAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);

            } elseif (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                $this->view->message('error', 'login or password is incorrect');
            } elseif (!$this->model->checkStatus('login', $_POST['login'])) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->login($_POST['login']);
            $this->view->location('account/profile');

        }

        $this->view->render('Login page');
    }

    //profile

    public function profileAction()
    {
        $this->view->render('Profile');
    }

    public function recoveryAction()
    {
        $this->view->render('Recovery page');
    }


}
