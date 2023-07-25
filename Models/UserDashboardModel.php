<?php namespace App\Models;

use CodeIgniter\Model;

class UserDashboardModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone','rfid_no','Balance'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getUser($id)
    {
        return $this->find($id);
    }

    public function updateUser($id, $data)
    {
        $this->update($id, $data);
        return true;
    }
}

