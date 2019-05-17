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
        if (!empty($_POST)) {
            if ($_POST['type'] == 'ref') {
                $result = $this->model->withdrawRefComplete($_POST['id']);
                if ($result) {
                    $this->view->location('admin/withdrawal');
                } else {
                    $this->view->message('error', 'request error');
                }

            } elseif ($_POST['type'] == 'invest') {
                $result = $this->model->withdrawTariffComplete($_POST['id']);
                if ($result) {
                    $this->view->location('admin/withdrawal');
                } else {
                    $this->view->message('error', 'request error');
                }
            }
        }
        $vars = [
            'listRef' => $this->model->withdrawRefList(),
            'listTariffs' => $this->model->withdrawTariffsList(),
        ];
        $this->view->render('Withdrawals', $vars);
    }

    public function historyAction()
    {
        $pagination = new Pagination($this->route, $this->model->historyCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->historyList($this->route),
        ];

        $this->view->render('History', $vars);
    }

    public function tariffsAction()
    {
        $pagination = new Pagination($this->route, $this->model->investCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->investList($this->route),
        ];

        $this->view->render('Tariffs', $vars);
    }


}