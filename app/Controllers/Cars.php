<?php

namespace App\Controllers;

use App\Models\CarsModel;
use CodeIgniter\RESTful\ResourceController;

class Cars extends ResourceController
{
    protected $carsModel;

    public function __construct()
    {
        $this->carsModel = new CarsModel();
    }

    // List all cars
    public function index()
    {
        $data['cars'] = $this->carsModel->findAll();
        return view('cars/index', $data);
    }

    // Show car details
    public function show($id = null)
    {
        $data['car'] = $this->carsModel->find($id);
        if (empty($data['car'])) {
            return redirect()->to('/cars')->with('error', 'Car not found');
        }
        return view('cars/show', $data);
    }

    // Create new car
    public function create()
    {
        return view('cars/create');
    }

    // Store new car
    public function store()
    {
        $rules = [
            'company_id' => 'required|numeric',
            'model' => 'required|min_length[2]',
            'brand' => 'required|min_length[2]',
            'year' => 'required|numeric',
            'status' => 'required',
            'location' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'company_id' => $this->request->getPost('company_id'),
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'year' => $this->request->getPost('year'),
            'status' => $this->request->getPost('status'),
            'location' => $this->request->getPost('location')
        ];

        if ($this->carsModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Car added successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['database' => 'Failed to add car to database']
            ]);
        }
    }

    // Show edit form
    public function edit($id = null)
    {
        $data['car'] = $this->carsModel->find($id);
        if (empty($data['car'])) {
            return redirect()->to('/cars')->with('error', 'Car not found');
        }
        return view('cars/edit', $data);
    }

    // Update car
    public function update($id = null)
    {
        $rules = [
            'company_id' => 'required|numeric',
            'model' => 'required|min_length[2]',
            'brand' => 'required|min_length[2]',
            'year' => 'required|numeric',
            'status' => 'required',
            'location' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'company_id' => $this->request->getPost('company_id'),
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'year' => $this->request->getPost('year'),
            'status' => $this->request->getPost('status'),
            'location' => $this->request->getPost('location')
        ];

        $this->carsModel->update($id, $data);
        return redirect()->to('/cars')->with('success', 'Car updated successfully');
    }

    // Delete car
    public function delete($id = null)
    {
        $this->carsModel->delete($id);
        return redirect()->to('/cars')->with('success', 'Car deleted successfully');
    }

    // Search cars
    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $data['cars'] = $this->carsModel->like('model', $keyword)
                                      ->orLike('brand', $keyword)
                                      ->orLike('location', $keyword)
                                      ->findAll();
        return view('cars/index', $data);
    }
} 