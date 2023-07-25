<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserDashboard extends Controller
{
    public function index()
    {
        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('user_id');
        $rfid_no = $session->get('rfid_no');
        
        if($role == 'admin'){
            return redirect()->to(base_url('public/'));
        }
        else if($user_id == Null){
            return redirect()->to(base_url('public/'));
        }
        else{
        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'DESC')->findAll();
        return view('DashboardUser', $data);
        }
    }
    public function logout(){
        $session = session();
        $session->remove('user_id');
        $session->remove('user_name');
        $session->remove('rfid_no');
        return redirect()->to(base_url('public/'));
        
    }
}

