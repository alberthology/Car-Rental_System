<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Register extends Controller
{
    public function registerRenter()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Insert into users table
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => 'Renter'
            ];

            $db->table('users')->insert($userData);
            $userId = $db->insertID();

            // Insert into renter_details with pending status
            $renterData = [
                'user_id' => $userId,
                'name' => $this->request->getPost('name'),
                'birthdate' => $this->request->getPost('dob'),
                'gender' => $this->request->getPost('gender'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'license_no' => $this->request->getPost('license'),
                'status' => 'pending' // Set default status as pending
            ];

            $db->table('renter_details')->insert($renterData);
            $db->transComplete();

            return redirect()->to('/loginpage')
                ->with('message', 'Registration successful. Please wait for admin approval before logging in.');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
}
