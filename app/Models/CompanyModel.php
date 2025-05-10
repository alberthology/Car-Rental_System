<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $allowedFields = ['user_id', 'company_name', 'address', 'year_established', 'email', 'status'];
    protected $returnType = 'array';

    public function updateStatus($companyId, $status)
    {
        return $this->update($companyId, ['status' => $status]);
    }

    public function getPendingCompanies()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function getApprovedCompanies()
    {
        return $this->where('status', 'approved')->findAll();
    }
}
