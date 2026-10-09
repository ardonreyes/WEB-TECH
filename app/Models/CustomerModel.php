<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends BaseModel
{
    protected $table = "customers";
    protected $primaryKey = "id";

    protected $allowedFields = [
        'id',
        'full_name',
        'email',
        'phone',
    ];
}