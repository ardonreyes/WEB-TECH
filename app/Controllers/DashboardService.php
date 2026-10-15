<?php

namespace App\Controllers;

class DashboardService extends Dashboard {

    private DashboardValidation $dashboardValidation;

    #temp metadata for feedback--upto module 3 restrictions
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

    public function __construct() {
        parent::__construct();
        $this->dashboardValidation = new DashboardValidation();
    }

    public function insertCustomerData () {
        $request = $this->request->getPost();

        if (!$this->dashboardValidation->validationCustomerForInsertAndUpdate($request)){
            return view('pages/main/customer_accs', [
                'titles' => $this->metadata['titles'][2],
                'stylesheet' => $this->metadata['css'][2],
                'layout' => $this->metadata['css'][4],
                'data' => $this->customerModel->getAll(),
                'formData' => $request,
                'openModal' => 'customer-add-modal',
                'js' => $this->metadata['js'][0],
                'messages' => $this->dashboardValidation->errorMsg(),
            ]);
        }

        $this->customerModel->insertAnAccount($request);
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" =>"Successfully added account."],
        ]);
    }

    public function updateCustomerData (int $id) {
        $request = $this->request->getPost();

        if (!$this->dashboardValidation->validationCustomerForInsertAndUpdate($request, $id)){
            return view('pages/main/customer_accs', [
                'titles' => $this->metadata['titles'][2],
                'stylesheet' => $this->metadata['css'][2],
                'layout' => $this->metadata['css'][4],
                'data' => $this->customerModel->getAll(),
                'formData' => $request,
                'openModal' => 'customer-edit-modal-' . $id,
                'js' => $this->metadata['js'][0],
                'messages' => $this->dashboardValidation->errorMsg(),
            ]);
        }

        $this->customerModel->updateAnAccount($id, $request);
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" =>"Successfully updated information."],
        ]);
    }

    public function deleteCustomerData (int $id) {

        if (!$id) {
            return view('pages/main/customer_accs', [
                'titles' => $this->metadata['titles'][2],
                'stylesheet' => $this->metadata['css'][2],
                'layout' => $this->metadata['css'][4],
                'data' => $this->customerModel->getAll(),
                'js' => $this->metadata['js'][0],
                'messages' => ["Account was not deleted.\nSomething went wrong."],
            ]);
        }

        $this->customerModel->delete($id);
        return view('pages/main/customer_accs', [
            'titles' => $this->metadata['titles'][2],
            'stylesheet' => $this->metadata['css'][2],
            'layout' => $this->metadata['css'][4],
            'data' => $this->customerModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" => "Successfully deleted."],
        ]);
    }

    public function insertUserData () {
        $request = [
            'full_name' => $this->request->getPost('full_name'),
            'username' => $this->request->getPost('username'),
        ];

        $profile = $this->request->getFile('profile');

        if (!$this->dashboardValidation->validationUserForInsertAndUpdate($request)){
            return view('pages/main/user_accs', [
                'titles' => $this->metadata['titles'][3],
                'stylesheet' => $this->metadata['css'][3],
                'layout' => $this->metadata['css'][4],
                'data' => $this->userModel->getAll(),
                'formData' => $request,
                'openModal' => 'user-add-modal',
                'js' => $this->metadata['js'][0],
                'messages' => $this->dashboardValidation->errorMsg(),
            ]);
        }

        if ($profile !== null && $profile->isValid() && ! $profile->hasMoved()) {
            $profileNewName = $profile->getRandomName();

            $profile->move(
                FCPATH . 'img/',
                $profileNewName
            );

            $request['profile'] = $profileNewName;
        }

        $this->userModel->insertAnAccount($request);
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" =>"Successfully added account."],
        ]);
    }

    public function updateUserData (int $id) {
        $request = [
            'full_name' => $this->request->getPost('full_name'),
            'username' => $this->request->getPost('username'),
        ];

        $oldUser = $this->userModel->findAccount($id);
        $profile = $this->request->getFile('profile');
        $newProfilePath = null;

        if (!$this->dashboardValidation->validationUserForInsertAndUpdate($request, $id)){
            return view('pages/main/user_accs', [
                'titles' => $this->metadata['titles'][3],
                'stylesheet' => $this->metadata['css'][3],
                'layout' => $this->metadata['css'][4],
                'data' => $this->userModel->getAll(),
                'formData' => $request,
                'openModal' => 'user-edit-modal-' . $id,
                'js' => $this->metadata['js'][0],
                'messages' => $this->dashboardValidation->errorMsg(),
            ]);
        }

        if ($profile !== null && $profile->isValid() && ! $profile->hasMoved()) {
            $profileNewName = $profile->getRandomName();

            $profile->move(
                FCPATH . 'img/',
                $profileNewName
            );

            $request['profile'] = $profileNewName;
            $newProfilePath = FCPATH . 'img/' . $profileNewName;
        }

        if (!$this->userModel->updateAnAccount($id, $request)) {
            if ($newProfilePath !== null && is_file($newProfilePath)) {
                @unlink($newProfilePath);
            }

            unset($request['profile']);

            return view('pages/main/user_accs', [
                'titles' => $this->metadata['titles'][3],
                'stylesheet' => $this->metadata['css'][3],
                'layout' => $this->metadata['css'][4],
                'data' => $this->userModel->getAll(),
                'formData' => $request,
                'openModal' => 'user-edit-modal-' . $id,
                'js' => $this->metadata['js'][0],
                'messages' => ["Account was not updated.\nSomething went wrong."],
            ]);
        }

        if ($newProfilePath !== null) {
            $storedOldProfile = (string) ($oldUser['profile'] ?? '');
            $oldProfileName = basename($storedOldProfile);

            if (
                $storedOldProfile === $oldProfileName
                && $oldProfileName !== ''
                && $oldProfileName !== 'default-profile.jpg'
                && $oldProfileName !== $request['profile']
            ) {
                $oldProfilePath = FCPATH . 'img/' . $oldProfileName;

                if (is_file($oldProfilePath) && ! @unlink($oldProfilePath)) {
                    log_message('warning', 'Could not remove old user profile image: {path}', [
                        'path' => $oldProfilePath,
                    ]);
                }
            }
        }

        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" =>"Successfully updated information."],
        ]);
    }

    public function deleteUserData (int $id) {

        if (!$id) {
            return view('pages/main/user_accs', [
                'titles' => $this->metadata['titles'][3],
                'stylesheet' => $this->metadata['css'][3],
                'layout' => $this->metadata['css'][4],
                'data' => $this->userModel->getAll(),
                'js' => $this->metadata['js'][0],
                'messages' => ["Account was not deleted.\nSomething went wrong."],
            ]);
        }

        $this->userModel->delete($id);
        return view('pages/main/user_accs', [
            'titles' => $this->metadata['titles'][3],
            'stylesheet' => $this->metadata['css'][3],
            'layout' => $this->metadata['css'][4],
            'data' => $this->userModel->getAll(),
            'js' => $this->metadata['js'][0],
            'messages' => ["success" => "Successfully deleted."],
        ]);
    }
}
