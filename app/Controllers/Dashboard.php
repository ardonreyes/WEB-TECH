<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CustomerModel;

class Dashboard extends BaseController
{
    private $metadata = [
        'titles' => [
            'Dashboard',
            'About',
            'Customers',
            'Users',
            'Customer Edit'
        ],
        'css' => [
            'css/main/home.css',
            'css/main/about.css',
            'css/main/customer_accs.css',
            'css/main/user_accs.css',
            'css/main/main_layout.css',
            'css/main/customer_edit.css',
        ],
        'js' => [
            'js/main/dashboard.js',
        ]
    ];

    protected CustomerModel $customerModel;
    protected UserModel $userModel;

    public function __construct () 
    {
        $this->customerModel = new CustomerModel();
        $this->userModel = new UserModel();
    }

    # Views
    public function home()
    {
        return view('pages/main/home', [
            'titles' => $this->metadata['titles'][0],
            'stylesheet' => $this->metadata['css'][0],
            'layout' => $this->metadata['css'][4],
            'data' => [
                'customers' => $this->customerModel->totalAll(),
                'users' => $this->userModel->totalAll(),
            ],
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function about()
    {
        return view('pages/main/about', [
            'titles' => $this->metadata['titles'][1],
            'stylesheet' => $this->metadata['css'][1],
            'layout' => $this->metadata['css'][4],
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function customers()
    {
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'js' => $this->metadata['js'][0],
        ]);
    }
    
    public function users()
    {
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'js' => $this->metadata['js'][0],
        ]);
    }

    # Forms
    public function customerEdit(int $id)
    {
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'openModal' => 'customer-edit-modal-' . $id,
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function customerAdd()
    {
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'openModal' => 'customer-add-modal',
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function userEdit(int $id)
    {
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'openModal' => 'user-edit-modal-' . $id,
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function userAdd()
    {
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'openModal' => 'user-add-modal',
            'js' => $this->metadata['js'][0],
        ]);
    }
}
