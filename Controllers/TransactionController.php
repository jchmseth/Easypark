<?php namespace App\Controllers;

use App\Models\TransactionHModel;

class TransactionController extends BaseController
{
    public function index()
    {
       
        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('user_id');
        
        $userId = session()->get('user_id'); 
         if($role == 'user'){
             $transactionModel = new TransactionHModel();
        $transactions = $transactionModel->getTransactionsByUserId($userId);  // Get user's current balance
        return view('Update_view', ['transactions' => $transactions]);
           
        }
        else if($user_id == Null){
            return redirect()->to(base_url('public/'));
        }
       else{
         return redirect()->to(base_url('public/'));
       }
    }
}