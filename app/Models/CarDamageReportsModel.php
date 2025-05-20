<?php

namespace App\Models;

use CodeIgniter\Model;

class CarDamageReportsModel extends Model
{
    protected $table            = 'car_damage_reports';
    protected $primaryKey       = 'car_damage_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // ✅ FIXED: Removed spaces in field names (this breaks insert/update!)
    protected $allowedFields    = [
        'car_id',
        'rental_id',
        'reported_by',
        'description',
        'damage_date',
        'estimated_repair_cost',
        'status',
        'photo_path'
    ];

    // Insert behavior
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Data type casting (optional, useful if using Entity)
    /* protected array $casts = [
        'damage_date' => 'date',
        'estimated_repair_cost' => 'float',
    ]; */
    protected array $castHandlers = [];

    // ✅ Optional if you decide to use timestamps later
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation (you can customize this later)
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks (empty by default, ready to customize)
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getDamageReportWithCarDetails($carIds)
    {
        return $this->select('car_damage_reports.*, cars.model, cars.brand, cars.plate_no')
            ->join('cars', 'car_damage_reports.car_id = cars.car_id')
            ->join('rentals', 'car_damage_reports.rental_id = rentals.rental_id')
            ->whereIn('car_damage_reports.car_id', $carIds)
            ->findAll();
    }
}
