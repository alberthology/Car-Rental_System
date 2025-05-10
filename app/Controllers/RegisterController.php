<?php
namespace App\Controllers;

class RegisterController extends BaseController
{
    public function register()
    {
        $userModel = new \App\Models\UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ];

        $userModel->insert($data);

        return redirect()->to('/loginpage')->with('success', 'Account created successfully.');
    }

    public function registerCompany()
    {
        $userModel = new \App\Models\UserModel();
        $companyModel = new \App\Models\CompanyModel();

        // Begin transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // First create the user record
            $userData = [
                'name' => $this->request->getPost('company_name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => 'company',
                'session_id' => null
            ];

            // Insert user and get ID
            $userModel->insert($userData);
            $userId = $db->insertID();

            if (!$userId) {
                throw new \Exception('Failed to create user account');
            }

            // Create company record
            $companyData = [
                'user_id' => $userId,
                'company_name' => $this->request->getPost('company_name'),
                'address' => $this->request->getPost('address'),
                'year_established' => $this->request->getPost('year_established'),
                'email' => $this->request->getPost('email'),
                'status' => 'pending'
            ];

            $companyModel->insert($companyData);

            $db->transCommit();
            return redirect()->to('/loginpage')
                ->with('success', 'Registration successful! Waiting for admin approval.');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function company()
    {
        $db = \Config\Database::connect();
        
        // Start transaction
        $db->transStart();

        try {
            // First insert into user table
            $userModel = new \App\Models\UserModel();
            $userData = [
                'name'     => $this->request->getPost('company_name'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'     => 'company',
                'session_id' => null
            ];
            
            $userModel->insert($userData);
            
            // Then insert into company table
            $companyModel = new \App\Models\CompanyModel();
            $companyData = [
                'company_name' => $this->request->getPost('company_name'),
                'address'    => $this->request->getPost('address'),
                'year_established' => $this->request->getPost('year_established'),
                'email'     => $this->request->getPost('email'),
                'status'    => 'pending'
            ];
            
            $companyModel->insert($companyData);

            // Commit transaction
            $db->transCommit();
            
            return redirect()->to('/loginpage')
                ->with('success', 'Company registration successful! Awaiting admin approval.');
        
        } catch (\Exception $e) {
            // Rollback transaction on error
            $db->transRollback();
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage())
                ->withInput();
        }
    }
}
