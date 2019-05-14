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
}