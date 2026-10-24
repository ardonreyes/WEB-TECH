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
        if (session()->get('status') !== true) {
            return redirect()->to('/')->with('loginFeedback', ['messages' => 'Please log in first.']);
        }
        
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
        if (session()->get('status') !== true) {
            return redirect()->to('/')->with('loginFeedback', ['messages' => 'Please log in first.']);
        }

        return view('pages/main/about', [
            'titles' => $this->metadata['titles'][1],
            'stylesheet' => $this->metadata['css'][1],
            'layout' => $this->metadata['css'][4],
            'js' => $this->metadata['js'][0],
        ]);
    }

    public function customers()
    {
        if (session()->get('status') !== true) {
            return redirect()->to('/')->with('loginFeedback', ['messages' => 'Please log in first.']);
        }
 
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
        if (session()->get('status') !== true) {
            return redirect()->to('/')->with('loginFeedback', ['messages' => 'Please log in first.']);
        }

        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'js' => $this->metadata['js'][0],
        ]);
    }
}
