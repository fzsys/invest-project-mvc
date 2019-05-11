<?php

namespace application\models;

use application\core\Model;

class AccountModel extends Model
{

    public function validate($input, $post)
    {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-@]+)\.([a-z\.]{2,10})$#',
                'message' => 'e-mail is incorrect',
            ],
            'login' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'login is incorrect',
            ],
            'ref' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'referral login is incorrect',
            ],
            'password' => [
                'pattern' => '#^[a-z0-9]{3,20}$#',
                'message' => 'password is incorrect',
            ],
            'wallet' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'wallet number is incorrect',
            ],
        ];

        foreach ($input as $val) {
            if(!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }

        if(isset($_POST['ref'])) {
            if($post['login'] == $post['ref']) {
                $this->error = 'referral is wrong';
                return false;
            }
        }

        return true;
    }

    public function emailExists($email)
    {
        $params = [
            'email' => $email,
        ];
        if($this->db->col('SELECT id FROM accounts WHERE email = :email', $params)){
            $this->error = 'this email already exists';
            return false;
        }
        return true;
    }

    public function loginExists($login)
    {
        $params = [
            'login' => $login,
        ];
        if($this->db->col('SELECT id FROM accounts WHERE login = :login', $params)){
            $this->error = 'this login already exists';
            return false;
        }
        return true;
    }
    public function tokenExists($token)
    {
        $params = [
            'token' => $token,
        ];
        return $this->db->col('SELECT id FROM accounts WHERE token = :token', $params);
    }
    public function refExists($ref)
    {
        $params = [
            'ref' => $ref,
        ];
        return $this->db->col('SELECT id FROM accounts WHERE login = :ref', $params);
    }

    public function createToken()
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
    }

    public function register($post)
    {
        $token = $this->createToken();

        if($post['ref'] == 'none') {
            $ref = 0;
        } else {
            $ref = $this->refExists($post['ref']);
            if(!$ref) {
                $ref = 0;
            }
        }

        $params = [
            'id' => null,
            'email' => $post['email'],
            'login' => $post['login'],
            'wallet' => $post['wallet'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'ref' => $ref,
            'token' => $token,
            'status' => 0,
        ];

        $this->db->query('INSERT INTO accounts VALUES (:id, :email, :login, :wallet, :password, :ref, :token, :status)', $params);
        $id = $this->db->getLastInsertId();
        //mail($post['email'], 'Register', 'Confirm registration: WEBSITE URL/account/confirm/' . $token);
        file_put_contents('test/' . $id . '.txt', 'Confirm registration: WEBSITE http://invest-proj-mvc/account/confirm/' . $token);

    }

    public function activate($token)
    {
        $params = [
            'token' => $token,
        ];
        $this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
    }

    public function checkData($login, $password)
    {
        $params = [
            'login' => $login,
            //'password' => $password,
        ];

        $hash = $this->db->col('SELECT password FROM accounts WHERE login = :login', $params);
        if(!$hash or !password_verify($password, $hash)) {
            return false;
        }
        return true;
    }

    public function checkStatus($type, $data)
    {
        $params = [
            $type => $data,
        ];

        $status = $this->db->col('SELECT status FROM accounts WHERE ' . $type . ' = :' . $type, $params);
        if($status != 1) {
            $this->error = 'account wasn\'t confirmed via email';
            return false;
        }
        return true;
    }

    public function login($login)
    {
        $params = [
            'login' => $login
        ];

        $data = $this->db->all('SELECT * FROM accounts WHERE login = :login', $params);
        $_SESSION['account'] = $data[0];
    }

}