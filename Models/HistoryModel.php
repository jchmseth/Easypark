<?php namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'transaction_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user', 'rfidnum', 'newbalance','status','date'];

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

