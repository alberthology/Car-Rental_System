<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompanyModel;
use App\Models\CarsModel;
use App\Models\RenterModel;
use App\Models\RentalModel;
use App\Models\UserModel;
use App\Models\FeedbackModelModel;
use \App\Models\CarPhotosModel;



class RenterController extends BaseController
{


    /* public function companylist() // ================= future proofing
    {
        $status = 'Approved';

        $companyModel = new CompanyModel();
        return $companyModel->where('status', $status)->findAll();
    } */

    public function cars()
    {
        $companyModel = new CompanyModel();
        $carModel = new CarsModel();
        $photoModel = new CarPhotosModel();

        $status = 'Approved';

        $companies = $companyModel->where('status', $status)->findAll();
        $cars = $carModel->where('status', 'Available')->findAll();

        // Fetch all photos and group them by car_id
        $photos = $photoModel->findAll();
        $photosByCarId = [];

        foreach ($photos as $photo) {
            $photosByCarId[$photo['car_id']][] = $photo;
        }

        $data = [
            'companies' => $companies,
            'cars' => $cars,
            'photosByCarId' => $photosByCarId
        ];

        return view('Renter/companycars', $data);
    }



    public function submitRental()
    {
        helper(['form']);

        // $carName = $this->request->getPost('carName');
        $car_id = $this->request->getPost('car_id');
        $carPrice = $this->request->getPost('carPrice');
        $rentStartDate = $this->request->getPost('rentStartDate');
        $rentEndDate = $this->request->getPost('rentEndDate');
        $pickupLocation = $this->request->getPost('pickupLocation');
        $dropoffLocation = $this->request->getPost('dropoffLocation');
        // $totalDays = $this->request->getPost('totalDays');
        $totalCost = $this->request->getPost('totalCost');
        // $paymentMethod = $this->request->getPost('paymentMethod');

        $session = session();
        $userId = $session->get('user_id');


        $renterModel = new RenterModel();
        $renter = $renterModel->where('user_id', $userId)->first();

        $renterId = $renter['renter_id'];
        $status = 'Pending';


        $data = [
            'car_id'       => $car_id,
            'renter_id'       => $renterId,
            'pickup_date'     => $rentStartDate,
            'pickup_location' => $pickupLocation,
            'dropoff_location' => $dropoffLocation,
            'dropoff_date'       => $rentEndDate,
            'rental_price'      => $carPrice,
            'total_price'     => $totalCost,
            'status'     => $status,
            // 'payment_method' => $paymentMethod,
            // 'created_at'     => date('Y-m-d H:i:s')
        ];
        log_message('debug', 'Rental Data: ' . json_encode($data));
        $rentalModel = new \App\Models\RentalModel();
        if ($rentalModel->insert($data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to insert record.']);
        }
    }



    public function renter()
    {

        return view('renterpage'); // Make sure the view file exists in app/Views/

    }



    public function rent()
    {
        $companyModel = new CompanyModel();
        $carModel = new CarsModel();

        $renterModel = new RenterModel();
        $rentalModel = new RentalModel();

        $session = session();
        $userId = $session->get('user_id');

        $renter = $renterModel->where('user_id', $userId)->first();
        $renterId = $renter['renter_id'];


        $data = [
            'companies' => $companyModel->findAll(),
            'rentals' => $rentalModel->getRentalWithCarAndCompany($renterId),
            'cars' => $carModel->where('status', 'Available')->findAll()
        ];

        return view('Renter/rent', $data);
    }

    public function profile()
    {
        return view('Renter/profile'); // Make sure the view file exists in app/Views/
    }

    public function logout()
    {
        return view('loginpage'); // Make sure the view file exists in app/Views/
    }







    public function europcar()
    {
        return view('Renter/cars/europcar'); // Make sure the view file exists in app/Views/
    }


    public function bookNow()
    {
        // Here you would add the booking details to the database
        session()->setFlashdata('success', 'Your car rental has been successfully booked!');
        redirect('Renter/companycars'); // Redirect back after booking
    }

    //europcar
    public function confirmBooking()
    {
        $data['car'] = $this->request->getGet('car');
        $data['price'] = $this->request->getGet('price');
        $data['start'] = $this->request->getGet('start');
        $data['end'] = $this->request->getGet('end');
        $data['total'] = $this->request->getGet('total');

        return view('confirm_booking', $data);
    }
}
