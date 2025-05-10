<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CarsModel; // Import your CarModel

class CompanyController extends BaseController
{
    public function company()
    {
        return view('RentalCompany/company'); // Make sure the view file exists in app/Views/
    }

    public function register()
    {
        return view('RentalCompany/Register'); // Make sure the view file exists in app/Views/
    }

    public function manage()
    {
        $carModel = new CarsModel(); // Load the model
        $cars = $carModel->findAll(); // Fetch all cars from the database

        return view('RentalCompany/managecars', ['cars' => $cars]); // Pass $cars to the view
    }


    
}
