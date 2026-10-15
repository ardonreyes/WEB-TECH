<?php

namespace App\Controllers;

class DashboardService extends Dashboard {

    private DashboardValidation $dashboardValidation;

    public function __construct() {
        parent::__construct();
        $this->dashboardValidation = new DashboardValidation();
    }

    public function insertCustomerData () {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }

        $request = $this->request->getPost(['full_name', 'email', 'phone']);

        if (!$this->dashboardValidation->validationCustomerForInsertAndUpdate($request)){
            return redirect()->to('/customers')->with('customerFeedback', [
                'messages' => $this->dashboardValidation->errorMsg(),
                'formData' => $request,
                'openModal' => 'customer-add-modal',
            ])->withCookies();
        }

        $this->customerModel->insertAnAccount($request);
        return redirect()->to('/customers')->with('customerFeedback', [
            'messages' => ["success" =>"Successfully added account."],
        ])->withCookies();
    }

    public function updateCustomerData (int $id) {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }
        $request = $this->request->getPost(['full_name', 'email', 'phone']);

        if (!$this->dashboardValidation->validationCustomerForInsertAndUpdate($request, $id)){
            return redirect()->to('/customers')->with('customerFeedback', [
                'messages' => $this->dashboardValidation->errorMsg(),
                'formData' => $request,
                'openModal' => 'customer-edit-modal-' . $id,
            ])->withCookies();
        }

        $this->customerModel->updateAnAccount($id, $request);
        return redirect()->to('/customers')->with('customerFeedback', [
            'messages' => ["success" =>"Successfully updated information."],
        ])->withCookies();
    }

    public function deleteCustomerData (int $id) {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }

        if (!$id) {
            return redirect()->to('/customers')->with('customerFeedback', [
                'messages' => ["Account was not deleted.\nSomething went wrong."],
            ])->withCookies();
        }

        $this->customerModel->delete($id);
        return redirect()->to('/customers')->with('customerFeedback', [
            'messages' => ["success" => "Successfully deleted."],
        ])->withCookies();
    }

    public function insertUserData () {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }

        $request = [
            'full_name' => $this->request->getPost('full_name'),
            'username' => $this->request->getPost('username'),
        ];

        $profile = $this->request->getFile('profile');

        if (!$this->dashboardValidation->validationUserForInsertAndUpdate($request)){
            return redirect()->to('/users')->with('userFeedback', [
                'messages' => $this->dashboardValidation->errorMsg(),
                'formData' => $request,
                'openModal' => 'user-add-modal',
            ])->withCookies();
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
        return redirect()->to('/users')->with('userFeedback', [
            'messages' => ["success" =>"Successfully added account."],
        ])->withCookies();
    }

    public function updateUserData (int $id) {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }
        
        $request = [
            'full_name' => $this->request->getPost('full_name'),
            'username' => $this->request->getPost('username'),
        ];

        $oldUser = $this->userModel->findAccount($id);
        $profile = $this->request->getFile('profile');
        $newProfilePath = null;

        if (!$this->dashboardValidation->validationUserForInsertAndUpdate($request, $id)){
            return redirect()->to('/users')->with('userFeedback', [
                'messages' => $this->dashboardValidation->errorMsg(),
                'formData' => $request,
                'openModal' => 'user-edit-modal-' . $id,
            ])->withCookies();
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

            return redirect()->to('/users')->with('userFeedback', [
                'messages' => ["Account was not updated.\nSomething went wrong."],
                'formData' => $request,
                'openModal' => 'user-edit-modal-' . $id,
            ])->withCookies();
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

        return redirect()->to('/users')->with('userFeedback', [
            'messages' => ["success" =>"Successfully updated information."],
        ])->withCookies();
    }

    public function deleteUserData (int $id) {
        if (session()->get('status') !== true) {
            return redirect()->to('/');
        }

        if (!$id) {
            return redirect()->to('/users')->with('userFeedback', [
                'messages' => ["Account was not deleted.\nSomething went wrong."],
            ])->withCookies();
        }

        $this->userModel->delete($id);
        return redirect()->to('/users')->with('userFeedback', [
            'messages' => ["success" => "Successfully deleted."],
        ])->withCookies();
    }
}
