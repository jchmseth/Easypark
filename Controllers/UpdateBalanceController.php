<?php

namespace App\Controllers;

use App\Models\UpdateBalanceModel;
use App\Models\UserModel;
use App\Models\TransactionHModel;
use CodeIgniter\Controller;

class UpdateBalanceController extends Controller
{
    public function index()
    {
        // Get user's current balance
        $session = session();
        $userId = session()->get('user_id'); // Replace with actual user ID
        $parkingModel = new UpdateBalanceModel();
        $userModel = new UserModel();
        $user = $userModel->find($userId); // Replace with actual method to get user
        $balance = $user['balance'];

        // Check if there is an ongoing parking session
        $sessionId = $parkingModel->getCurrentSessionId($userId); // Replace with actual method to get current session ID
        if ($sessionId == Null) {
            // No ongoing session found, return error message
            return 'No ongoing parking session found.';
        }
        echo $sessionId;

        // Get entry and exit timestamps for current session
        $session = $parkingModel->getSessionById($sessionId); // Replace with actual method to get session by ID
        $entryTime = strtotime($session['entry_time']);
        $exitTime = strtotime($session['exit_time']);

        // Calculate parking fee
        $duration = ($exitTime - $entryTime) / 60; // Get duration in minutes
        $rate = 0.50; // Replace with actual parking rate
        $fee = $duration * $rate;

        // Deduct fee from user's balance
        $newBalance = $balance - $fee;
        if ($newBalance < 0) {
            // Insufficient balance, return error message
            return 'Insufficient balance.';
        }
        $parkingModel->updateUserBalance($userId, $newBalance); // Replace with actual method to update user balance

        // Add transaction to history
        $transactionData = [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'fee' => $fee,
            'transaction_date' => date('Y-m-d H:i:s')
        ];
        $parkingModel->addTransaction($transactionData); // Replace with actual method to add transaction

        // Set flag to prevent same transaction from happening again
        $parkingModel->updateSessionFlag($sessionId, 1); // Replace with actual method to update session flag

        // Return success message with fee and transaction date
        $message = 'Parking fee calculated and deducted from balance. Fee: $' . number_format($fee, 2) . ', Transaction Date: ' . date('Y-m-d H:i:s');
        return $message;
    }
}