<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends BaseModel
{
    protected $table = "users";
    protected $primaryKey = "id";

    protected $allowedFields = [
        'id',   
        'username',
        'password',
        'full_name',
        'profile'
    ];
}