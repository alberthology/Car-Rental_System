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

    public function getRentalWithCarAndCompany($renterId)
    {
        return $this->select('rentals.*, cars.model, cars.brand, cars.plate_no, company.company_name, company.address')
            ->join('cars', 'rentals.car_id = cars.car_id')
            ->join('company', 'cars.company_id = company.company_id')
            ->where('rentals.renter_id', $renterId)
            ->findAll();
    }

    public function getCompanyRentals($companyId)
    {
        return $this->select('rentals.*, cars.model, cars.plate_no, renters.renter_id, renters.gender, renters.phone, renters.address, renters.license_no')
            ->join('cars', 'rentals.car_id = cars.car_id')
            ->join('renters', 'rentals.renter_id = renters.renter_id')
            ->where('cars.company_id', $companyId)
            ->findAll();
    }
}
