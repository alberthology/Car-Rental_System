<?php

namespace App\Models;

use CodeIgniter\Model;

class RenterModel extends Model
{
    protected $table = 'renters';
    protected $primaryKey = 'renter_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'birthdate',
        'gender',
        'phone',
        'address',
        'license_no',
        'status'
    ];


    public function updateStatus($renterId, $status)
    {
        return $this->update($renterId, ['status' => $status]);
    }

    public function getPendingRenters()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function getApprovedRenters()
    {
        return $this->where('status', 'approved')->findAll();
    }
}
