<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ParkingMonitorModel;

class EntryController extends Controller
{
    public function index()
    {
        return view('Entryview');
    }

   public function read()
    {
        // Get the RFID data from the POST request
        $rfid_data = $this->request->getPost('rfid_data');
    
        // Get the user with the matching RFID tag ID from the database
        $userModel = new UserModel();
        $user = $userModel->where('rfid_no', $rfid_data)->first();
    
        if ($user) {
            $parkingModel = new ParkingMonitorModel();
            $datetime = date('Y-m-d H:i:s');
    
            $parking = $parkingModel->where([
                'user_id' => $user['id'],
                'exit_time' => null,
                'flag' => 0
            ])->first();
    
            $entry_time = null;
            if (!$parking) {
                // User has not entered the parking lot
                // Insert the entry record in the parking_users table
    
                $entry_time = $datetime;
    
                $parkingModel->insert([
                    'user_id' => $user['id'],
                    'rfid_no' => $rfid_data,
                    'entry_time' => $datetime,
                    'exit_time' => null,
                    'flag' => 0
                ]);
    
                // Set the entry time in the success response
                $entry_time = $entry_time;
                $response = [
                    'status' => 'success',
                    'message' => 'User entered the parking lot',
                    'entry_time' => $entry_time
                ];
            } else {
                // User has already entered the parking lot and not exited
                // Send an error response back to the client
                $response = [
                    'status' => 'error',
                    'message' => 'User has already entered the parking lot'
                ];
            }
        } else {
            // User not found in the users table
            // Send an error response back to the client
            $response = [
                'status' => 'invalid',
                'message' => 'RFID tag not associated with a user'
            ];
        }
    
        // Send the JSON response back to the client
        return $this->response->setJSON($response);
    }

}