<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Homepage extends Controller{

    public function index(){
        $session = session();
        $user_id = $session->get('user_id');
        $role = $session->get('role');
        if($user_id == Null){
            echo view('HomepageView');
        }
        else{
            if($role == 'user'){
                 return redirect()->to(base_url('public/UserDashboard'));
            }
            else{
                 return redirect()->to(base_url('public/Dashboard'));
            }
        }
    }
}