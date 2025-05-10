<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $db = db_connect();
        
        try {
            // Test connection
            $db->initialize();
            
            // Execute direct queries with error checking
            $sql = "SELECT * FROM company WHERE status = 'pending'";
            $pending = $db->query($sql);
            
            if (!$pending) {
                throw new \Exception($db->error()['message']);
            }
            
            $data['pending_companies'] = $pending->getResultArray();
            
            $sql = "SELECT * FROM company WHERE status = 'approved'";
            $approved = $db->query($sql);
            $data['approved_companies'] = $approved->getResultArray();
            
            // Add debug info
            $data['debug'] = [
                'db_connected' => true,
                'pending_count' => count($data['pending_companies']),
                'last_query' => $db->getLastQuery(),
                'error' => $db->error()
            ];

        } catch (\Exception $e) {
            log_message('error', '[Admin.index] Database error: ' . $e->getMessage());
            $data['debug'] = [
                'error' => $e->getMessage(),
                'db_connected' => false
            ];
            $data['pending_companies'] = [];
            $data['approved_companies'] = [];
        }

        // Make sure the view exists
        if (! is_file(APPPATH . 'Views/adminpage.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('adminpage.php');
        }

        return view('adminpage', $data);
    }

    public function approve($company_id)
    {
        $companyModel = new \App\Models\CompanyModel();
        $companyModel->update($company_id, ['status' => 'approved']);
        return redirect()->to('adminpage')->with('message', 'Company approved successfully');
    }

    public function decline($company_id)
    {
        $companyModel = new \App\Models\CompanyModel();
        $companyModel->update($company_id, ['status' => 'declined']);
        return redirect()->to('adminpage')->with('message', 'Company declined successfully');
    }
}