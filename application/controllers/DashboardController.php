<?php

namespace application\controllers;

use application\core\Controller;

class DashboardController extends Controller
{
    public function investAction()
    {
        $vars = [
            'tariffs' => $this->tariffs[$this->route['id']],
        ];

        $this->view->render('Invest page', $vars);
    }

    public function tariffsAction()
    {
        $this->view->render('Tariffs page');
    }

    public function historyAction()
    {
        $this->view->render('History page');
    }

    public function referralsAction()
    {
        $this->view->render('Referrals page');
    }




}