<?php
namespace App\Models;

use CodeIgniter\Model;

class SlotsModel extends Model
{
    protected $table      = 'parking_slots';
    protected $primaryKey = 'id';
    protected $allowedFields = ['slot_name', 'status']; //add all the columns of the table you want to display

    public function getAllData()
    {
        return $this->findAll();
    }
}
