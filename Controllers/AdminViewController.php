<?php

namespace App\Controllers;

use App\Models\ParkingMonitorModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminViewController extends Controller
{
    public function index()
    {
        
        $pager = \Config\Services::pager();
        $pager->setPath('public/AdminViewController');
        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('user_id');
        
        if($role == 'user'){
            return redirect()->to(base_url('public/'));
        }
        else if($user_id == NULL){
             return redirect()->to(base_url('public/'));
        }
        else{
             $parkingMonitorModel = new ParkingMonitorModel();
            $usersModel = new UserModel();
            $infos = $parkingMonitorModel->findAll();
            $infos = $parkingMonitorModel->paginate(12);
        
            // Loop through each info to retrieve the user's rfid_no from the users database
         foreach ($infos as &$info) {
            $user = $parkingMonitorModel->find($info['user_id']);
            $userDetails = $usersModel->find($info['user_id']);
            $info['rfid_no'] = $userDetails['rfid_no'];
            
        }
            $data['info'] =  $infos;
            $data['pager'] = $parkingMonitorModel->pager;
            return view('AdminViewMonitor', $data);
            
           
        }
    }
}