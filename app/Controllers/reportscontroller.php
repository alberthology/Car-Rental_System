<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ReportsController extends BaseController
{

public function reports()
    {
        return view('RentalCompany/reports'); // Make sure the view file exists in app/Views/
    }
}