<?php

namespace App\Models;

use CodeIgniter\Model;

class SpeedMonitoringModel extends Model
{
    protected $table = 'speed_monitoring';
    protected $primaryKey = 'tracking_id';
    protected $allowedFields = ['rental_id', 'speed', 'location', 'timestamp'];

    public function getTrackingByRental($rental_id)
    {
        return $this->where('rental_id', $rental_id)->orderBy('timestamp', 'DESC')->findAll();
    }
}
