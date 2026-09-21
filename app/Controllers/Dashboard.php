<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    private $metadata = [
        'titles' => [
            'Dashboard',
            'About',
            'Customers',
            'Users'
        ],
        'css' => [
            'css/main/home.css',
            'css/main/about.css',
            'css/main/customer_accs.css',
            'css/main/user_accs.css',
            'css/main/main_layout.css',
        ],
        'js' => [
            'js/main/dashboard.js',
        ]
    ];

    public function home(): string
    {
        return view('pages/main/home', [
            'titles' => $this->metadata['titles'][0],
            'stylesheet' => $this->metadata['css'][0],
            'layout' => $this->metadata['css'][4],
            'js' => $this->metadata['js'][0],
        ]);
    }
    public function about(): string
    {
        return view('pages/main/about', [
            'titles' => $this->metadata['titles'][1],
            'stylesheet' => $this->metadata['css'][1],
            'layout' => $this->metadata['css'][4],
            'js' => $this->metadata['js'][0],
        ]);
    }
    public function customers(): string
    {
        $userModel = new UserModel();

        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $userModel->findAll(),
            'js' => $this->metadata['js'][0],
        ]);
    }
    public function users(): string
    {
        $userModel = new UserModel();
        
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $userModel->findAll(),
            'js' => $this->metadata['js'][0],
        ]);
    }
}
