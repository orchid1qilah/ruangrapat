<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik', 'password', 'company'];

    public function validateUser($nik, $password, $company)
    {
        return $this->where('nik', $nik)
                    ->where('password', md5($password))
                    ->where('company', $company)
                    ->first();
    }
}
