<?php

namespace App\Controllers;

use App\Models\UserModel;

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

    private $registerValidationRules = [
        'first_name' => 'required|alpha|max_length[255]',
        'last_name' => 'required|alpha|max_length[255]',
        'email' => 'required|valid_email|max_length[255]|is_unique[user.email]',
        'password' => 'required|min_length[8]|max_length[255]',
        'address' => 'required|string|max_length[255]',
        'contact' => 'required|regex_match[/^09\d{9}$/]|max_length[255]',
    ];

    private $loginValidationRules = [
        'email' => 'required|valid_email|max_length[255]',
        'password' => 'required|min_length[8]|max_length[255]',
    ];

    public function loginPage(): string
    {
        return view('pages/auth/auth_login', [
            'title' => $this->metadata['titles'][0],
            'stylesheet' => $this->metadata['css'][0]
            ]);
    }

    public function login()
    {
        if (!$this->validate($this->loginValidationRules)) {
            return redirect()->back()->WithInput()
        }
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
            'title' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][1]
        ]);
    }
}
