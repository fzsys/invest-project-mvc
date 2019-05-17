<?php

namespace application\models;

use application\core\Model;

class AdminModel extends Model
{
    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $_POST['login'] or $config['password'] != $_POST['password']) {
            $this->error = 'login or pass is incorrect';
            return false;
        }
        return true;
    }

    public function historyCount()
    {
        return $this->db->col('SELECT COUNT(id) FROM history');
    }

    public function historyList($route)
    {
        // the same value as in  Pagination limit from Controller
        $max = 5;

        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        $arr = [];
        $result = $this->db->all('SELECT * FROM history ORDER BY id DESC LIMIT :start, :max', $params);
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $arr[$key] = $val;
                $params = [
                    'id' => $val['uid'],
                ];
                $account = $this->db->all('SELECT login, email FROM accounts WHERE id = :id', $params)[0];
                $arr[$key]['login'] = $account['login'];
                $arr[$key]['email'] = $account['email'];
            }
        }
        return $arr;
    }

    public function withdrawRefList()
    {
        $arr = [];
        $result = $this->db->all('SELECT * FROM ref_withdrawals ORDER BY id DESC');
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $arr[$key] = $val;
                $params = [
                    'id' => $val['uid'],
                ];
                $account = $this->db->all('SELECT login, wallet FROM accounts WHERE id = :id', $params)[0];
                $arr[$key]['login'] = $account['login'];
                $arr[$key]['wallet'] = $account['wallet'];
            }
        }
        return $arr;
    }

    public function withdrawRefComplete($id)
    {
        $params = [
            'id' => $id,
        ];
        $data = $this->db->all('SELECT uid, amount FROM ref_withdrawals WHERE id = :id', $params);
        if (!$data) {
            return false;
        }
        $this->db->query('DELETE FROM ref_withdrawals WHERE id = :id', $params);
        $data = $data[0];
        $params = [
            'id' =>  null,
            'uid' =>  $data['uid'],
            'unixTime' =>  time(),
            'description' =>  'Referral withdrawal complete. Amount: ' . $data['amount'] . ' $',
        ];
        $this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
        return true;
    }

    public function withdrawTariffsList()
    {
        $arr = [];
        $result = $this->db->all('SELECT * FROM tariffs WHERE UNIX_TIMESTAMP() >= unixTimeFinish and sumOut != 0 ORDER BY id DESC');
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $arr[$key] = $val;
                $params = [
                    'id' => $val['uid'],
                ];
                $account = $this->db->all('SELECT login, wallet FROM accounts WHERE id = :id', $params)[0];
                $arr[$key]['login'] = $account['login'];
                $arr[$key]['wallet'] = $account['wallet'];
            }
        }
        return $arr;
    }

    public function withdrawTariffComplete($id)
    {
        $params = [
            'id' => $id,
        ];
        $data = $this->db->all('SELECT uid, sumOut FROM tariffs WHERE id = :id', $params);
        if (!$data) {
            return false;
        }
        $this->db->query('UPDATE tariffs SET sumOut = 0 WHERE id = :id', $params);
        $data = $data[0];
        $params = [
            'id' =>  null,
            'uid' =>  $data['uid'],
            'unixTime' =>  time(),
            'description' =>  'Invest withdrawal complete. Amount: ' . $data['sumOut'] . ' $',
        ];
        $this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
        return true;
    }

    public function investCount()
    {
        return $this->db->col('SELECT COUNT(id) FROM tariffs');
    }

    public function investList($route)
    {
        // the same value as in  Pagination limit from Controller
        $max = 10;

        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];

        $arr = [];
        $result = $this->db->all('SELECT * FROM tariffs ORDER BY id DESC LIMIT :start, :max', $params);
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $arr[$key] = $val;
                $params = [
                    'id' => $val['uid'],
                ];
                $account = $this->db->all('SELECT login, email FROM accounts WHERE id = :id', $params)[0];
                $arr[$key]['login'] = $account['login'];
                $arr[$key]['email'] = $account['email'];
            }
        }
        return $arr;
    }




}