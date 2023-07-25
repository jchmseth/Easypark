<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\UserModel;

class Transaction extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $userModel = new UserModel();
        
        $transactions = $transactionModel->findAll();
        $data = [];
        
        foreach ($transactions as $transaction) {
            $rfidAccount = $userModel->find($transaction['rfid_no']);
            $data[] = [
                'rfid_account' => $rfidAccount['rfid_acc'],
                'price' => $transaction['price'],
                'date_time' => $transaction['date_time']
            ];
        
            // Deduct transaction in the RFID account balance
            $prevBalance = $rfidAccount['Balance'];
            $newBalance = $prevBalance - $transaction['price'];
        
            if ($prevBalance != $newBalance) {
                $userModel->update($rfidAccount['rfid_acc'], [
                    'Balance' => $newBalance,
                    'processed' => 1
                ]);
            }
        }
        $data = ['transactions' => $data];
        
        echo view('TransactionView', $data);
    }
}