<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    //============================== login Action
    public function loginAction()
    {

        if (!empty($_SESSION) and $_SESSION['admin'] == 1) {
            $this->view->redirect('/admin/history');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = 1;

            $this->view->location('admin/history');

        }

        $this->view->render('Login page');
    }

    //============================== logout Action
    public function logoutAction()
    {
        $_SESSION['admin'] = 0;
        $this->view->redirect('/admin/login');
    }


    public function withdrawalAction()
    {
        $this->view->render('Withdrawals');
    }

    public function historyAction()
    {
        $pagination = new Pagination($this->route, $this->model->historyCount(), 5);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->historyList($this->route),
        ];

        $this->view->render('History', $vars);
    }

    public function tariffsAction()
    {
        $this->view->render('Tariffs');
    }


}