<?php 

namespace App\Controllers;
use App\Models\ParkingMonitorModel;
use CodeIgniter\Controller;


class ParkingMonitor extends Controller{

    public function index()
    {
        $model = new ParkingMonitorModel();
        $data['entries'] = $model->orderBy('time_in', 'DESC')->findAll();
        $data['exits'] = $model->orderBy('time_out', 'DESC')->findAll();

        return view('ParkingMonitorView', $data);
    }

}