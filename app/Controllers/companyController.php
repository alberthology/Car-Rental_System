<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompanyModel;

use App\Models\CarsModel; // Import your CarModel

class CompanyController extends BaseController
{
    public function company()
    {
        $carsModel = new \App\Models\CarsModel();

        $counts = $carsModel
            ->select('status, COUNT(*) as total')
            ->whereIn('status', ['Available', 'Rented', 'Damaged', 'Unavailable'])
            ->groupBy('status')
            ->findAll();

        $data = [
            'availableCount'   => 0,
            'rentedCount'      => 0,
            'damagedCount'     => 0,
            'unavailableCount' => 0,
        ];

        foreach ($counts as $row) {
            switch ($row['status']) {
                case 'Available':
                    $data['availableCount'] = $row['total'];
                    break;
                case 'Rented':
                    $data['rentedCount'] = $row['total'];
                    break;
                case 'Damaged':
                    $data['damagedCount'] = $row['total'];
                    break;
                case 'Unavailable':
                    $data['unavailableCount'] = $row['total'];
                    break;
            }
        }

        return view('RentalCompany/company', $data);
    }


    public function register()
    {
        return view('RentalCompany/Register'); // Make sure the view file exists in app/Views/
    }

    public function manage()
    {
        $session = session();
        $userId = $session->get('user_id');
        $userRole = $session->get('role');

        if ($userRole !== 'Company') {
            return redirect()->to('/unauthorized'); // Optional: redirect non-company users
        }

        $companyModel = new CompanyModel();
        $company = $companyModel->where('user_id', $userId)->first();

        if (!$company) {
            return view('RentalCompany/managecars', ['cars' => [], 'error' => 'Company not found']);
        }

        $companyId = $company['company_id'];
        $carModel = new CarsModel(); // Load the model
        $cars = $carModel->where('company_id', $companyId)->findAll();


        return view('RentalCompany/managecars', ['cars' => $cars]);
    }

    // car company dashboard - roy:

    /*    public function dashboardStats()
    {
        $carsModel = new \App\Models\CarsModel();


        $counts = $carsModel
            ->select('status, COUNT(*) as total')
            ->whereIn('status', ['Available', 'Rented', 'Damaged', 'Unavailable'])
            ->groupBy('status')
            ->findAll();


        $data = [
            'availableCount' => 0,
            'rentedCount'    => 0,
            'damagedCount'   => 0,
            'unavailableCount' => 0,
        ];


        foreach ($counts as $row) {
            switch ($row['status']) {
                case 'Available':
                    $data['availableCount'] = $row['total'];
                    break;
                case 'Rented':
                    $data['rentedCount'] = $row['total'];
                    break;
                case 'Damaged':
                    $data['damagedCount'] = $row['total'];
                    break;
                case 'Unavailable':
                    $data['unavailableCount'] = $row['total'];
                    break;
            }
        }

        return view('RentalCompany/company', $data);
    } */
}
