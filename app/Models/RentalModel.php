<?php

namespace App\Models;

use CodeIgniter\Model;

class RentalModel extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'car_id',
        'renter_id',
        'pickup_date',
        'dropoff_date',
        'pickup_location',
        'dropoff_location',
        'rental_price',
        'total_price',
        'status'
    ];

    protected $validationRules = [
        'car_id' => 'required',
        'renter_id' => 'required',
        'pickup_date' => 'required|valid_date',
        'dropoff_date' => 'required|valid_date',
        'pickup_location' => 'required',
        'dropoff_location' => 'required',
        'rental_price' => 'required|numeric',
        'total_price' => 'required|numeric',
        'status' => 'required'
    ];
}
