<?php

namespace application\models;

use application\core\Model;

class DashboardModel extends Model
{
    public function historyCount()
    {
    $params = [
        'uid' => $_SESSION['account']['id'],
    ];

    return $this->db->col('SELECT COUNT(id) FROM history WHERE uid = :uid', $params);

    }

    public function historyList($route)
    {
        // the same value as in  Pagination limit from Controller
        $max = 5;

        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
            'uid' => $_SESSION['account']['id'],
        ];
        return $this->db->all('SELECT * FROM history WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function refsCount()
    {
        $params = [
            'uid' => $_SESSION['account']['id'],
        ];

        return $this->db->col('SELECT COUNT(id) FROM accounts WHERE ref = :uid', $params);

    }

    public function refsList($route)
    {
        // the same value as in  Pagination limit from Controller
        $max = 5;

        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
            'uid' => $_SESSION['account']['id'],
        ];
        return $this->db->all('SELECT login, email FROM accounts WHERE ref = :uid ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function investCount()
    {
        $params = [
            'uid' => $_SESSION['account']['id'],
        ];

        return $this->db->col('SELECT COUNT(id) FROM tariffs WHERE uid = :uid', $params);

    }

    public function investList($route)
    {
        // the same value as in  Pagination limit from Controller
        $max = 10;

        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
            'uid' => $_SESSION['account']['id'],
        ];
        return $this->db->all('SELECT * FROM tariffs WHERE uid = :uid ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function createRefWithdraw()
    {
        $amount = $_SESSION['account']['refBalance'];
        $_SESSION['account']['refBalance'] = 0;

        $params = [
            'id' => $_SESSION['account']['id'],
        ];
        $this->db->query('UPDATE accounts SET refBalance = 0 WHERE id = :id', $params);

        $params = [
            'id' => null,
            'amount' => $amount,
            'uid' => $_SESSION['account']['id'],
            'unixTime' => time(),
        ];
        $this->db->query('INSERT INTO ref_withdrawals VALUES (:id, :uid, :unixTime, :amount)', $params);

        $params = [
            'id' => null,
            'description' => 'Withdrawal. Amount: ' . $amount . ' $',
            'uid' => $_SESSION['account']['id'],
            'unixTime' => time(),
        ];
        $this->db->query('INSERT INTO history VALUES (:id, :uid, :unixTime, :description)', $params);
    }
}