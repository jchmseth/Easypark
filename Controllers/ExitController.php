<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ParkingMonitorModel;
use App\Models\TransactionModel;
use CodeIgniter\Controller;

class ExitController extends Controller
{
    public function index()
    {
        return view('Exitview');
    }
    
    public function read()
    {
        // Get the RFID data from the POST request
        $rfid_data = $this->request->getPost('rfid_data');
        $userModel = new UserModel();
        $user = $userModel->where('rfid_no', $rfid_data)->first();

        if ($user) {
            // User found in the users table
            $rfid_no = $user['rfid_no'];
            $userId = $user['id'];
            $time = date('H:i:s');
            $date = date('Y-m-d');
            $datetime = date('Y-m-d H:i:s');

            // Check if the user has already entered the parking lot and not exited
            $parkingModel = new ParkingMonitorModel();
            $parking = $parkingModel->where([
                'user_id' => $userId,
                'exit_time' => null,
                'flag' => 0
            ])->first();

            if ($parking) {
                // User has already entered the parking lot and not exited

                $entryTime = strtotime($parking['entry_time']);
                $exitTime = strtotime($datetime);
                
                // Calculate parking fee
                $duration = ($exitTime - $entryTime) / 60; // Get duration in minutes
                $fixedRateHours = 3; // The number of hours with a fixed rate
                $fixedRate = 10.0; // The fixed rate for the first $fixedRateHours hours
                $hourlyRate = 20; // The hourly rate for hours after $fixedRateHours
                
                if ($duration <= $fixedRateHours * 60) {
                    // Duration is within the fixed rate period
                    $fee = $fixedRate;
                } else {
                    // Duration is after the fixed rate period
                    $hourlyDuration = ceil(($duration - $fixedRateHours * 60) / 60); // Get the number of hours after the fixed rate period
                    $hourlyFee = $hourlyDuration * $hourlyRate; // Calculate the fee for the hourly rate period
                    $fee = $fixedRate + $hourlyFee; // Add the fixed rate fee and the hourly rate fee
                }

                // Check if user has sufficient balance
                $balance = $user['balance'];
                $newBalance = $balance - $fee;
                if ($newBalance < 0) {
                    // Insufficient balance, return error message
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Insufficient balance.']);
                }

                // Update user's balance in the database
                $userModel->update($userId, ['balance' => $newBalance]);

                // Add transaction to history
                $transactionData = [
                    'user_id' => $userId,
                    'fee' => $fee,
                    'transaction_date' => date('Y-m-d H:i:s')
                ];
                $transactionModel = new TransactionModel();

                $transactionModel->addTransaction($transactionData);

                // Update parking record in the database
                $parkingModel->update($parking['id'], [
                    'exit_time' => $datetime,
                    'flag' => 1
                ]);

                // Prepare data to pass to the view
                $exit_time = date('Y-m-d H:i:s', $exitTime);
                $duration_formatted = sprintf("%d hours, %d minutes", floor($duration / 60), $duration % 60);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'User exited the parking lot',
                    'fee' => $fee,
                    'duration' => $duration_formatted,
                    'exit_time' => $exit_time
                ]);
            } else {
                // User already exited
                return $this->response->setJSON(['status' => 'error', 'message' => 'User has already left the parking.']);
            }
        } else{
                return $this->response->setJSON(['status' => 'invalid', 'message' => 'RFID tag not associated with a user']);
        }
    }
}        