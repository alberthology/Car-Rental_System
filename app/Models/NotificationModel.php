<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
    protected $allowedFields = ['user_id', 'message', 'timestamp'];

    public function getNotificationsByUser($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('timestamp', 'DESC')->findAll();
    }
}
