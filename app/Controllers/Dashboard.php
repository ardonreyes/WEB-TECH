<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $metadata = [
        'titles' => [
            'Dashboard',
            'About',
            'Accounts',
            'Profile'
        ],
        'css' => [
            'main/css/dashboard'
        ]
    ];
    public function home(): string
    {
        return view('pages/main/home');
    }
}
