<?php namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','fee', 'transaction_date','Load'];

    public function addTransaction($data)
    {
        $this->insert($data);
    }
}