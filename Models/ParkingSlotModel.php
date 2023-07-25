<?php

namespace App\Models;

use CodeIgniter\Model;

class ParkingSlotModel extends Model
{
    protected $table = 'parking_slots';
    protected $allowedFields = ['slot_name', 'status'];
    protected $useTimestamps = true;
}