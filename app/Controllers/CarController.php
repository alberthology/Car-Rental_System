<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\CarsModel;
use \App\Models\CarPhotosModel;
use CodeIgniter\Controller;

class CarController extends Controller
{
    protected $carsModel;

    public function __construct()
    {
        $this->carsModel = new CarsModel();
    }

    // Show Cars Page
    public function index()
    {
        $data['cars'] = $this->carsModel->findAll();
        return view('RentalCompany/managecars', $data);
    }

    // Add Car
    public function addCar()
    {
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Log the incoming request data
        log_message('debug', 'Add Car Request Data: ' . json_encode($this->request->getPost()));

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        $rules = [
            'model' => 'required|min_length[2]',
            'brand' => 'required|min_length[2]',
            'year' => 'required|numeric',
            'status' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $session = session();
        $userId = $session->get('user_id');
        // $userRole = $session->get('role');

        $companyModel = new CompanyModel();
        $company = $companyModel->where('user_id', $userId)->first();


        $companyId = $company['company_id'];

        $data = [
            'company_id' => $companyId,
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'plate_no' => $this->request->getPost('plate_no'),
            'price_per_day' => $this->request->getPost('price_per_day'),
            'year' => $this->request->getPost('year'),
            'status' => $this->request->getPost('status')
        ];

        try {
            // Log the data being inserted
            log_message('debug', 'Attempting to insert car data: ' . json_encode($data));

            // Save the car data
            $carId = $this->carsModel->insert($data);

            if ($carId === false) {
                log_message('error', 'Database Error: ' . print_r($this->carsModel->errors(), true));
                throw new \Exception('Failed to insert car data');
            }

            // ✅ Handle image upload
            $img = $this->request->getFile('car_photo');
            if ($img && $img->isValid() && !$img->hasMoved()) {

                // ✅ Make sure upload directory exists
                if (!is_dir('uploads/cars')) {
                    mkdir('uploads/cars', 0777, true);
                }

                // ✅ Move file to uploads folder
                $newName = $img->getRandomName();
                $img->move('uploads/cars/', $newName);

                // Save image path to car_photos table
                $photoModel = new \App\Models\CarPhotosModel(); // Make sure this model exists
                $photoModel->insert([
                    'car_id'     => $carId,
                    'photo_path' => 'uploads/cars/' . $newName,
                    'caption'    => null
                ]);
            }

            $car = $this->carsModel->find($carId);

            if (!$car) {
                throw new \Exception('Car was inserted but could not be retrieved');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Car and photo added successfully',
                'car' => $car
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error adding car: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Duplicate plate number or other error occurred',
                'error' => $e->getMessage(),
                'debug_info' => [
                    'post_data' => $this->request->getPost(),
                    'validation_errors' => $this->validator->getErrors(),
                    'db_error' => $this->carsModel->errors()
                ]
            ]);
        }
    }

    // Update Car Status (Damaged or Unavailable)
    public function updateStatus()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $carId = $this->request->getPost('car_id');
        $status = $this->request->getPost('status');

        if (!$carId || !$status) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required parameters'
            ]);
        }

        try {
            $this->carsModel->update($carId, ['status' => $status]);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status',
                'error' => $e->getMessage()
            ]);
        }
    }
}
