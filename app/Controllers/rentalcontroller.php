<?php

namespace App\Controllers;

use App\Models\RentalModel;

class RentalController extends BaseController
{
    public function managerent()
    {
        $rentalModel = new RentalModel();
        $data['rentals'] = $rentalModel->findAll();
        
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
