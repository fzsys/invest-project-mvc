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

            } elseif ($this->model->getIdByEmail($_POST['email'])) {
                $this->view->message('error', 'this email already registered');

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
        if (!$this->model->tokenExists($this->route['token'])) {
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

    public function logoutAction()
    {
        unset($_SESSION['account']);
        $this->view->redirect('/account/login');
    }

    //password recovery

    public function recoveryAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['email'], $_POST)) {
                $this->view->message('error', $this->model->error);

            } elseif (!$this->model->getIdByEmail($_POST['email'])) {
                $this->view->message('error', 'email not found');
            } elseif (!$this->model->checkStatus('email', $_POST['email'])) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->recovery($_POST);
            $this->view->message('success', 'recovery link was send to you email');

        }

        $this->view->render('Recovery page');

    }

    public function resetAction()
    {
        if (!$this->model->tokenExists($this->route['token'])) {
            $this->view->redirect('/account/login');
        }

        $password = $this->model->reset($this->route['token']);
        $vars = [
            'password' => $password,
        ];
        $this->view->render('password reset', $vars);
    }

    public function profileAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validate(['email', 'wallet'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $id = $this->model->getIdByEmail($_POST['email']);

            if ($id and $id != $_SESSION['account']['id']) {
                $this->view->message('error', 'this email already registered');
            }

            if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->save($_POST);
            $this->view->message('success', 'ok');

        }

        $this->view->render('Profile page');
    }


}
