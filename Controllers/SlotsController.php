<?php
namespace App\Controllers;

use App\Models\ParkingSlotModel;
use CodeIgniter\Controller;

class SlotsController extends Controller
{
    public function index()
    {
        
        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('user_id');
        if($role == 'admin'){
            return redirect()->to(base_url('public/UserDashboard'));
        }
        else if($user_id == Null){
            return redirect()->to(base_url('public/'));
        }
        else{
        $data['result'] = (new ParkingSlotModel())->findAll();
        return view('SlotsView', $data); // Load and return the view with data 
       }
        
        
    }
     public function getSlots()
    {
        
        $data['result'] = (new ParkingSlotModel())->findAll();
        return $this->response->setJSON($data); // Return JSON data
    }
}