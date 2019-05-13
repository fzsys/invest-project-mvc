<?php

namespace application\controllers;

use application\core\Controller;

class MerchantController extends Controller
{

    public function perfectMoneyAction()
    {
        $_POST['PAYMENT_AMOUNT'] = 10000;
        $_POST['PAYMENT_UNITS'] = 'USD';
        $_POST['PAYMENT_ID'] = '3-25';
        $_POST['PAYEE_ACCOUNT'] = '';
        $_POST['PAYMENT_BATCH_NUM'] = '';
        $_POST['PAYER_ACCOUNT'] = '';
        $_POST['TIMESTAMPGMT'] = '';

        $data = $this->model->validatePerfectMoney($_POST, $this->tariffs);

        if (!$data) {
            $this->view->errorCode(403);
        } elseif (!$this->model->createTariff($data, $this->tariffs[$data['tid']])) {
            $this->view->errorCode(403);
        }
        $this->model->createTariff($data, $this->tariffs[$data['tid']]);
    }

}