<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CardetailsController extends BaseController
{
    public function index()
    {
        return view('Renter/carlist'); // Make sure the view file exists in app/Views/
    }
}
