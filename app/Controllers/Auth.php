<?php

namespace App\Controllers;

class Auth extends BaseController
{
    private $metadata = [
        'titles' => [
            'Log In', 
            'Registration', 
            'Forget Password', 
        ],
        'css' => [
            'css/auth/auth_login.css',
            'css/auth/auth_layout.css',
            'css/auth/auth_register.css',
            'css/auth/auth_forget.css',
        ]
    ];

    public function loginPage(): string
    {
        return view('pages/auth/auth_login', [
            'title' => $this->metadata['titles'][0],
            'stylesheet' => $this->metadata['css'][0]
        ]);
    }
    public function registerPage(): string
    {
        return view('pages/auth/auth_register', [
            'title' => $this->metadata['titles'][1],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][1]
        ]);
    }
    public function forgetPage(): string 
    {
        return view('pages/auth/auth_forget', [
            'title' => $this->metadata['titles'][1],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][1]
        ]);
    }
}
