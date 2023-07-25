<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ParkingSlotModel;

class Dashboard extends BaseController
{
    public function index()
    {
    
        $userModel = new UserModel();
        $parkingSlotModel = new ParkingSlotModel();
        
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
        $data['num_users'] = $userModel->countAll();
        $data['num_slots'] = $parkingSlotModel->countAll();
        return view('DashboardView', $data); 
       }
        
    }
}