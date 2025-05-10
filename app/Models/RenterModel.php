<?php 

namespace App\Models;

use CodeIgniter\Model;

class RenterModel extends Model
{
    protected $table = 'renter_details';
    protected $primaryKey = 'renter_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'name',
        'birthdate',
        'gender',
        'email',
        'phone',
        'address',
        'license_no',
        'status'
    ];
}