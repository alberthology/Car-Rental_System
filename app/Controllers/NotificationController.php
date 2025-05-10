<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NotificationController extends BaseController
{
    public function notif(): string
    {
        return view('RentalCompany/notification');
    }
}
