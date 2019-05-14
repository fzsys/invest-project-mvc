<?php

namespace application\controllers;

use application\core\Controller;

class MerchantController extends Controller
{

    public function perfectMoneyAction()
    {
        //only for testing!!
        /*
        $_POST['PAYMENT_AMOUNT'] = 4000;
        $_POST['PAYMENT_UNITS'] = 'USD';
        $_POST['PAYMENT_ID'] = '2-26';
        $_POST['PAYEE_ACCOUNT'] = '';
        $_POST['PAYMENT_BATCH_NUM'] = '';
        $_POST['PAYER_ACCOUNT'] = '';
        $_POST['TIMESTAMPGMT'] = '';
        */

        $data = $this->model->validatePerfectMoney($_POST, $this->tariffs);

        if (!$data) {
            $this->view->errorCode(403);
        }

        $this->model->createTariff($data, $this->tariffs[$data['tid']]);
    }

}