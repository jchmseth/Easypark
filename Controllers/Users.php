<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $pager->setPath('public/Users');
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
            $model = new UserModel();
            $data['users'] = $model->orderBy('id', 'DESC')->findAll();
            $data['users'] = $model->paginate(5);
            $data['pager'] = $model->pager;
            return view('users', $data);
        }
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
         $data['user'] = $model->find($id);
        $data = [
        'rfid_no' => $this->request->getPost('rfid_no'),
        'name' => $this->request->getPost('name'),
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'phone' => $this->request->getPost('phone')
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('public/Users'));
    }
}