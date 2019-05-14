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

        $this->view->render('History page', $vars);
    }

    public function tariffsAction()
    {
        $this->view->render('Tariffs page');
    }



    public function referralsAction()
    {
        $this->view->render('Referrals page');
    }




}