<?php

namespace App\Models;

use CodeIgniter\Model;

class ParkingTransactionHistoryModel extends Model
{
    protected $table = 'parking_transaction_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'parking_start_time', 'parking_end_time', 'parking_duration', 'parking_fee'];
}