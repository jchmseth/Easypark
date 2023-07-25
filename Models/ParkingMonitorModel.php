<?php namespace App\Models;

use CodeIgniter\Model;

class ParkingMonitorModel extends Model
{
    protected $table = 'parking_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'Plate_NO', 'entry_time','exit_time','flag'];

    public function getSortedParkingIn()
    {
        return $this->orderBy('time_in', 'desc')->findAll();
    }
    public function getSortedParkingOout()
    {
        return $this->orderBy('time_out', 'desc')->findAll();
    }
}