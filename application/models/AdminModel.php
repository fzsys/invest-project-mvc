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



}