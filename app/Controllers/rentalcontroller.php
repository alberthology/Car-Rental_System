<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\CarsModel;
use App\Models\RenterModel;
use App\Models\RentalModel;
use App\Models\UserModel;
use App\Models\FeedbackModelModel;

class RentalController extends BaseController
{
    public function managerent()
    {

        $companyModel = new CompanyModel();
        $carModel = new CarsModel();

        $renterModel = new RenterModel();
        $rentalModel = new RentalModel();

        $session = session();
        $userId = $session->get('user_id');

        $company = $companyModel->where('user_id', $userId)->first();
        $companyId = $company['company_id'];
        $rentals = $rentalModel->getCompanyRentals($companyId);

        $data = [
            'rentals' => $rentals
        ];

        return view('RentalCompany/managerent', $data);
    }

    public function approveRental($id)
    {
        $rentalModel = new RentalModel();
        $rentalModel->update($id, ['status' => 'approved']);
        return redirect()->to('/RentalCompany/managerent')->with('success', 'Rental approved successfully');
    }

    public function rejectRental($id)
    {
        $rentalModel = new RentalModel();
        $rentalModel->update($id, ['status' => 'rejected']);
        return redirect()->to('/RentalCompany/managerent')->with('success', 'Rental rejected successfully');
    }
}
