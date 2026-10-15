<?php

namespace App\Controllers;

class DashboardValidation extends BaseController {

    public function validationCustomerForInsertAndUpdate (array $data, ?int $id = null): bool {
        $fullNameRule = $id !== null
            ? [ 
                'requiredOrNot' => 'permit_empty',
                'uniqueSpecificOrNot' => "is_unique[customers.full_name,id,{$id}]",
            ]
            : [ 
                'requiredOrNot' => 'required',
                'uniqueSpecificOrNot' => "is_unique[customers.full_name]",
            ];

        $emailRule = $id !== null
            ? [ 
                'requiredOrNot' => 'permit_empty',
                'uniqueSpecificOrNot' => "is_unique[customers.email,id,{$id}]",
            ]
            : [ 
                'requiredOrNot' => 'required',
                'uniqueSpecificOrNot' => "is_unique[customers.email]",
            ];

        $phoneRule = $id !== null
            ? [ 
                'requiredOrNot' => 'permit_empty',
                'uniqueSpecificOrNot' => "is_unique[customers.phone,id,{$id}]",
            ]
            : [ 
                'requiredOrNot' => 'required',
                'uniqueSpecificOrNot' => "is_unique[customers.phone]",
            ];

        $validationForCustomer = [
            'full_name' => [
                $fullNameRule['requiredOrNot'],
                'string',
                'regex_match[/^\p{L}+(?: \p{L}+)*$/u]',
                'min_length[2]',
                'max_length[100]',
                $fullNameRule['uniqueSpecificOrNot'],
            ],

            'email' => [
                $emailRule['requiredOrNot'],
                'string',
                'valid_email',
                'max_length[255]',
                $emailRule['uniqueSpecificOrNot'],
            ],

            'phone' => [
                $phoneRule['requiredOrNot'],
                'string',
                'regex_match[/^[0-9]+$/]',
                'exact_length[10]',
                $phoneRule['uniqueSpecificOrNot'],
            ],
        ];
        
        if (!$this->validateData($data, $validationForCustomer)) {
            return false;
        }

        return true;
    }

    public function validationUserForInsertAndUpdate (array $data, ?int $id = null): bool {
        $fullNameRule = $id !== null
            ? [ 
                'requiredOrNot' => 'permit_empty',
                'uniqueSpecificOrNot' => "is_unique[users.full_name,id,{$id}]",
            ]
            : [ 
                'requiredOrNot' => 'required',
                'uniqueSpecificOrNot' => "is_unique[users.full_name]",
            ];

        $userNameRule = $id !== null
            ? [ 
                'requiredOrNot' => 'permit_empty',
                'uniqueSpecificOrNot' => "is_unique[users.username,id,{$id}]",
            ]
            : [ 
                'requiredOrNot' => 'required',
                'uniqueSpecificOrNot' => "is_unique[users.username]",
            ];

        $validationForUser = [
            'profile' => [
                'permit_empty',
                'max_size[profile,2048]',
                'mime_in[profile,image/jpeg,image/png]',
            ],

            'full_name' => [
                $fullNameRule['requiredOrNot'],
                'string',
                'regex_match[/^\p{L}+(?: \p{L}+)*$/u]',
                'min_length[2]',
                'max_length[100]',
                $fullNameRule['uniqueSpecificOrNot'],
            ],
            
            'username' => [
                $userNameRule['requiredOrNot'],
                'string',
                'regex_match[/^[\p{L}\p{N}_-]+$/u]',
                'min_length[2]',
                'max_length[100]',
                $userNameRule['uniqueSpecificOrNot'],
            ]
        ];
        
        if (!$this->validateData($data, $validationForUser)) {
            return false;
        }

        return true;
    }

    public function errorMsg(): array {
        return $this->validator->getErrors();
    }
}