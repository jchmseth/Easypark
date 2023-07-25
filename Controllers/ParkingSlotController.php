<?php

namespace App\Controllers;

use App\Models\ParkingSlotModel;
use CodeIgniter\Controller;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('user_id');
        
        if($role == 'user'){
            return redirect()->to(base_url('public/'));
        }
        else if($user_id == Null){
            return redirect()->to(base_url('public/'));
        }
        else{
            $data['slots'] = (new ParkingSlotModel())->findAll();
            return view('ParkingSlotView', $data);
        }
    }
    
     public function getSlots()
    {
        
        $data['result'] = (new ParkingSlotModel())->findAll();
        return $this->response->setJSON($data); // Return JSON data
    }
    
    public function updateStatus($id)
    {
        $slot = (new ParkingSlotModel())->find($id);
        if (!$slot) {
            return redirect()->to(base_url('public/ParkingSlotController/'));
        }

        $status = $slot['status'] == 'free' ? 'taken' : 'free';
        (new ParkingSlotModel())->update($id, ['status' => $status]);
        return redirect()->to(base_url('public/ParkingSlotController'));
    }
}