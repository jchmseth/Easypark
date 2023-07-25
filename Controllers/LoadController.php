<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ParkingMonitorModel;
use App\Models\TransactionHModel;
use CodeIgniter\Controller;

class LoadController extends Controller
{
    public function index()
    {
        return view('Loadview');
    }

    public function load()
    {
        $rfid_data = $this->request->getPost('rfid_data');
        $userModel = new UserModel();
        $user = $userModel->where('rfid_no', $rfid_data)->first();

        if ($user) {
            // User found in the users table
            $rfid_no = $user['rfid_no'];
            $userId = $user['id'];
            $password = $user['password'];
            $datetime = date('Y-m-d H:i:s');

            // Validate and sanitize input values
            $Load = filter_var($this->request->getPost('Load'), FILTER_SANITIZE_NUMBER_INT);
            $verify_password = filter_var($this->request->getPost('password'), FILTER_SANITIZE_STRING);

            if ($verify_password === $password) {
                // Check if user has sufficient balance
                $balance = $user['balance'];
                $newBalance = $balance + $Load;

                // Update user's balance in the database
                if (!$userModel->update($userId, ['balance' => $newBalance])) {
                    // Error updating user balance
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Unable to update balance']);
                }
                 
                $transactionModel = new TransactionHModel();

                // Add transaction to history
                $transactionData = [
                    'user_id' => $userId,
                    'Load' => $Load,
                    'transaction_date' => $datetime,
                ];
              

                if (!$transactionModel->insert($transactionData)) {
                    // Error adding transaction to history
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Unable to add transaction']);
                }

                // Prepare data to pass to the view
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Load successful',
                    'Load' => $Load,
                    'date_time' => $datetime,
                    'newBalance' => $newBalance,
                ]);
            } else {
                // Incorrect password
                return $this->response->setJSON(['status' => 'error', 'message' => 'Incorrect password']);
            }

        } else {
            // User not found
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not registered']);
        }
    }
}