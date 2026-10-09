<?php

namespace App\Models;

use CodeIgniter\Model;

abstract class BaseModel extends Model 
{
    # SQL Queries

    public function totalAll ()
    {
        return $this->countAll();
    }

    public function getAll ()
    {
        return $this->orderBy('full_name', 'ASC')->findAll();
    }

    public function findAccount (int $id)
    {
        return $this->find($id);
    }

    public function insertAnAccount(array $data) {
        if($this->insert($data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateAnAccount (int $id, array $data)
    {
        if($this->update($id, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
};