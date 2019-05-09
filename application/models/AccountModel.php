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
            'password' => [
                'pattern' => '#^[a-z0-9]{10,20}$#',
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

        return true;
    }
}