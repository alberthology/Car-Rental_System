<?php

namespace App\Controllers;

use App\Models\CarsModel;
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
            'company_id' => 'required|numeric',
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

        $data = [
            'company_id' => $this->request->getPost('company_id'),
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'year' => $this->request->getPost('year'),
            'status' => $this->request->getPost('status')
        ];

        try {
            // Log the data being inserted
            log_message('debug', 'Attempting to insert car data: ' . json_encode($data));

            $carId = $this->carsModel->insert($data);
            
            if ($carId === false) {
                // Log database errors
                log_message('error', 'Database Error: ' . print_r($this->carsModel->errors(), true));
                throw new \Exception('Failed to insert car data');
            }

            $car = $this->carsModel->find($carId);
            
            if (!$car) {
                throw new \Exception('Car was inserted but could not be retrieved');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Car added successfully',
                'car' => $car
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error adding car: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to add car to database',
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
