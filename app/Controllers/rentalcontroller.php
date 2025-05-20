<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\CarsModel;
use App\Models\RenterModel;
use App\Models\RentalModel;
use App\Models\UserModel;
use App\Models\FeedbackModelModel;
use \App\Models\CarPhotosModel;
use App\Models\CarDamageReportsModel; // Import your damage report model

class RentalController extends BaseController
{
    public function managerent()
    {
        $companyModel = new CompanyModel();
        $carModel = new CarsModel();
        $renterModel = new RenterModel();
        $rentalModel = new RentalModel();
        $damageModel = new CarDamageReportsModel();

        $session = session();
        $userId = $session->get('user_id');

        $company = $companyModel->where('user_id', $userId)->first();
        $companyId = $company['company_id'];
        $rentals = $rentalModel->getCompanyRentals($companyId);

        // Fetch all cars for this company
        $companyCars = $carModel->where('company_id', $companyId)->findAll();
        $carIds = array_column($companyCars, 'car_id');

        // Fetch damage reports for these cars
        $damageReports = [];
        if (!empty($carIds)) {
            $damageReports = $damageModel->getDamageReportWithCarDetails($carIds);
        }

        $data = [
            'rentals' => $rentals,
            'damageReports' => $damageReports
        ];

        return view('RentalCompany/managerent', $data);
    }

    public function updateDropoffDate()
    {
        $request = $this->request->getJSON();
        $rentalId = $request->rental_id ?? null;
        $dropoffDate = $request->dropoff_date ?? null;

        if (!$rentalId || !$dropoffDate) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid input.']);
        }

        $rentalModel = new \App\Models\RentalModel();
        $updated = $rentalModel->update($rentalId, ['dropoff_date' => $dropoffDate]);

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Database update failed.']);
        }
    }

    public function returnCar()
    {
        helper(['form']);

        $carModel = new CarsModel();
        $rentalModel = new RentalModel();
        $damageModel = new CarDamageReportsModel(); // your damage table model

        $carId = $this->request->getPost('car_id');
        $rentalId = $this->request->getPost('rental_id');
        $status = $this->request->getPost('car_status');

        // Update car status
        $carModel->update($carId, ['status' => $status]);
        $rentalModel->update($rentalId, ['status' => 'Returned']);

        // If car is damaged, insert damage report
        if ($status === 'Damaged') {
            $description = $this->request->getPost('description');
            $repairCost = $this->request->getPost('estimated_repair_cost');
            $damageDate = $this->request->getPost('damage_date');

            $photo = $this->request->getFile('photo');
            $photoPath = null;

            if ($photo && $photo->isValid()) {
                $photoName = $photo->getRandomName();
                $photo->move(ROOTPATH . 'public/uploads/damage_photos/', $photoName);
                $photoPath = 'uploads/damage_photos/' . $photoName;
            }

            $damageModel->insert([
                'car_id' => $carId,
                'rental_id' => $rentalId,
                'description' => $description,
                'estimated_repair_cost' => $repairCost,
                'damage_date' => $damageDate,
                'photo_path' => $photoPath,
                'status' => 'Pending',
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Car return processed.'
        ]);
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
