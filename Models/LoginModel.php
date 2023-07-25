<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'rfid_no','name','phone','role'];

    public function registerUser($data)
    {
        return $this->insert($data);
    }

    public function checkUser($email)
    {
        $query = $this->where('email', $email)
                      ->get();
        return $query->getRow();
    }
}