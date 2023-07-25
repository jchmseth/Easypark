<?php namespace App\Models;

use CodeIgniter\Model;

class ParkingModel extends Model
{
    protected $table = 'Parking_users';
    protected $primaryKey = 'RFID_NO';
    protected $allowedFields = ['RFID_NO', 'Plate_NO', 'time_in'];

    public function getSortedParking()
    {
        return $this->orderBy('time_in', 'desc')->findAll();
    }
}