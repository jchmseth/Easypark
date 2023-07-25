<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateBalanceModel extends Model
{
    protected $table = 'parking_users'; // Replace with actual table name
    protected $primaryKey = 'id'; // Replace with actual primary key
    protected $allowedFields = ['user_id', 'entry_time', 'exit_time', 'flag']; // Replace with actual allowed fields

    public function getUserById($userId)
    {
        return $this->db->table('users')->where('id', $userId)->get()->getRowArray();
    }

    public function getCurrentSessionId($userId)
    {
        try {
            $session = $this->db->table($this->table)->select('id')->where(['user_id' => $userId, 'flag' => 0])->get()->getRowArray()['id'];
            return $session;
        } catch (\Exception $e) {
            return NULL;
        } 
    }

    public function getSessionById($sessionId)
    {
        return $this->db->table($this->table)->where('id', $sessionId)->get()->getRowArray();
    }

    public function updateUserBalance($userId, $newBalance)
    {
        $this->db->table('users')->where('id', $userId)->update(['balance' => $newBalance]);
    }

    public function addTransaction($transactionData)
    {
        $this->db->table('transactions')->insert($transactionData);
    }

    public function updateSessionFlag($sessionId, $flag)
    {
        $this->db->table($this->table)->where('id', $sessionId)->update(['flag' => $flag]);
    }
}