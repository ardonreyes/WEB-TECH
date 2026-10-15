<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthService extends Auth {
    // private $registerValidationRules = [
    //     'first_name' => 'required|alpha|max_length[255]',
    //     'last_name' => 'required|alpha|max_length[255]',
    //     'email' => 'required|valid_email|max_length[255]|is_unique[user.email]',
    //     'password' => 'required|min_length[8]|max_length[255]',
    //     'address' => 'required|string|max_length[255]',
    //     'contact' => 'required|regex_match[/^09\d{9}$/]|max_length[255]',
    // ];

    protected UserModel $userModel;

    public function __construct () {
        $this->userModel = new UserModel();
    }

    public function login () {
        $loginValidationRules = [
            'username' => [
                'required',
                'string',
                'regex_match[/^\p{L}+(?: \p{L}+)*$/u]',
                'max_length[100]',
            ],
            'password' => [
                'required',
                'string',
                'max_length[255]',
            ],
        ];

        $data = $this->request->getPost();

        if (!$this->validateData($data, $loginValidationRules)) {
            return redirect()->
                to('/')->
                with('username', $data['username'] ?? '')->
                with('errors', $this->validator->getErrors());
        }
        
        $user = $this->
            userModel->
            where('username', $data['username'])->
            first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return redirect()->
                to('/')->
                with('username', $data['username'] ?? '')->
                with('loginFeedback', ['messages' => 'Invalid credentials.']);
        }

        $session = session();
        $session->regenerate(true);
        $session->set([
            'id' => $user['id'],
            'status' => true
        ]);

        return redirect()->to('/home');
    }

    public function logout () {
        session()->destroy();
        return redirect()->to('/');
    }
}