<?php namespace App\Models;

use CodeIgniter\Model;

class TransactionHModel extends Model
{
    protected $table = 'transactions'; // Replace with actual table name
    protected $primaryKey = 'id'; // Replace with actual primary key
    protected $allowedFields = ['user_id', 'session_id', 'fee', 'transaction_date','Load']; // Replace with actual allowed fields

    public function getTransactionsByUserId($userId)
    {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }
}