<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class DashboardController extends Controller
{
    public function investAction()
    {
        $vars = [
            'tariffs' => $this->tariffs[$this->route['id']],
        ];

        $this->view->render('Invest page', $vars);
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

    public function referralsAction()
    {
        if (!empty($_POST)) {
            if ($_SESSION['account']['refBalance'] <= 0) {
                $this->view->message('error', 'your are too poor to withdraw');
            } else {
                $this->model->createRefWithdraw();
                $this->view->message('success', 'Request for withdrawal was send');
            }

        }

        $pagination = new Pagination($this->route, $this->model->refsCount(), 5);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->refsList($this->route),
        ];

        $this->view->render('Referrals', $vars);

    }

    public function tariffsAction()
    {
        $pagination = new Pagination($this->route, $this->model->investCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->investList($this->route),
        ];

        $this->view->render('Investment', $vars);
    }

}