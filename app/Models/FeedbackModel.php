<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    protected $allowedFields = ['renter_id', 'rental_id', 'rating', 'comment', 'date_submitted'];

    public function getFeedbackByRental($rental_id)
    {
        return $this->where('rental_id', $rental_id)->findAll();
    }
}
