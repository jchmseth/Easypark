<?php 

namespace App\Controllers;
use App\Models\ParkingModel;
use App\Models\ParkingSlotModel;
use CodeIgniter\Controller;


class Parking extends Controller{

    public function index()
    {
        $data['title'] = 'Parking Slots';
        $model = new ParkingSlotModel();
        $data['parking_slots'] = $model->findAll();
   
        $model = new ParkingModel();
        $data['cars'] = $model->orderBy('time_in', 'DESC')->findAll();

        return view('parking_view', $data);
    }
   
    public function updateSlotStatus()
    {
        echo 'hello world';
        $request = $this->request->getJSON();
        $model = new ParkingSlotModel();
        $parking_slot = $model->find($request->id);
    
        // Toggle the parking slot status
        $status = $request->status == 'free' ? 'taken' : 'free';
    
        // Update the parking slot status in the database
        $model->update($request->id, ['status' => $status]);
    
        // Return the updated slot information
        $parking_slot['status'] = $status;
        return $this->response->setJSON($parking_slot);
    }
}
