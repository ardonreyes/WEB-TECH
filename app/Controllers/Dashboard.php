<?php

namespace App\Controllers;

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

    protected $data = [
        [
            'Ardon Reyes',
            '@ardonreyes',
            '123-456-7891',
            'ardon.reyes@gmail.com',
            'Admin'
        ],
        [
            'Samantha Ching',
            '@samanthaching',
            '123-456-7891',
            'samantha.ching@gmail.com',
            'Admin'
        ],
        [
            'Carl Eugenio',
            '@carleugenio',
            '123-456-7891',
            'carl.eugenio@gmail.com',
            'User'
        ],
        [
            'Ayeza Arcilla',
            '@ayezaarcilla',
            '123-456-7891',
            'ayeza.arcilla@gmail.com',
            'User'
        ],
        [
            'Diongeles Vanderbilt',
            '@diongelesvanderbilt',
            '123-456-7891',
            'diongeles.vanderbilt@gmail.com',
            'User'
        ],
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
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->data,
            'js' => $this->metadata['js'][0],
        ]);
    }
    public function users(): string
    {
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->data,
            'js' => $this->metadata['js'][0],
        ]);
    }
}
