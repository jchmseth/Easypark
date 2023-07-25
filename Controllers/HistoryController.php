<?php namespace App\Controllers;

use App\Models\HistoryModel;
use CodeIgniter\Controller;

class HistoryController extends Controller
{
    public function index()
    {
        $session = session();
        $user_name = $session->get('user_name');
        $model = new HistoryModel();
        $data['users'] = $model->orderBy('id', 'DESC')->findAll();
        return view('HistoryView', $data);
    }
}

