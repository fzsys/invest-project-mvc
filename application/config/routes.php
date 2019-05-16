<?php

return [
    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    //AccountController
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'account/register/{ref:\w+}' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'account/recovery' => [
        'controller' => 'account',
        'action' => 'recovery',
    ],

    'account/confirm/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'confirm',
    ],

    'account/reset/{token:\w+}' => [
        'controller' => 'account',
        'action' => 'reset',
    ],

    'account/profile' => [
        'controller' => 'account',
        'action' => 'profile',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

    //DashboardController
    'dashboard/tariffs' => [
        'controller' => 'dashboard',
        'action' => 'tariffs',
    ],

    'dashboard/tariffs/{page:\d+}' => [
        'controller' => 'dashboard',
        'action' => 'tariffs',
    ],

    'dashboard/invest/{id:\d+}' => [
        'controller' => 'dashboard',
        'action' => 'invest',
    ],

    'dashboard/history' => [
        'controller' => 'dashboard',
        'action' => 'history',
    ],

    'dashboard/history/{page:\d+}' => [
        'controller' => 'dashboard',
        'action' => 'history',
    ],

    'dashboard/referrals' => [
        'controller' => 'dashboard',
        'action' => 'referrals',
    ],

    'dashboard/referrals/{page:\d+}' => [
        'controller' => 'dashboard',
        'action' => 'referrals',
    ],

    //MerchantController
    'merchant/perfectMoney' => [
        'controller' => 'merchant',
        'action' => 'perfectMoney',
    ],

    //AdminController
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],

    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],

    'admin/history' => [
        'controller' => 'admin',
        'action' => 'history',
    ],

    'admin/history/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'history',
    ],

    'admin/tariffs' => [
        'controller' => 'admin',
        'action' => 'tariffs',
    ],

    'admin/tariffs/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'tariffs',
    ],

    'admin/withdrawal' => [
        'controller' => 'admin',
        'action' => 'withdrawal',
    ],

    'admin/withdrawal/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'withdrawal',
    ],

];
