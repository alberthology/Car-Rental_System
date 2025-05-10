<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\RentalCompanyModel;
use App\Models\RentalModel;
use Config\Services;

class AdminController extends BaseController 
{
    protected $session;

    public function __construct()
    {
        $this->session = Services::session();
    }

    public function admin()
    {
        $db = \Config\Database::connect();
        
        // Get pending companies
        $pending_companies = $db->table('company')
            ->where('status', 'pending')
            ->get()->getResultArray();
            
        // Get approved companies    
        $approved_companies = $db->table('company')
            ->where('status', 'approved')
            ->get()->getResultArray();

        // Get pending renters
        $pending_renters = $db->table('renter_details')
            ->where('status', 'pending')
            ->get()->getResultArray();
            
        // Get approved renters    
        $approved_renters = $db->table('renter_details')
            ->where('status', 'approved')
            ->get()->getResultArray();

        return view('AdminDashBoard/adminpage', [
            'pending_companies' => $pending_companies,
            'approved_companies' => $approved_companies,
            'pending_renters' => $pending_renters,
            'approved_renters' => $approved_renters
        ]);
    }

    public function dashboard()
    {
        return $this->admin(); // Reuse the admin method functionality
    }

    public function logout()
    {
        $userModel = new UserModel();
        $userId = $this->session->get('user_id');
        
        if ($userId) {
            $userModel->update($userId, ['session_id' => null]);
        }
        
        $this->session->destroy();
        return redirect()->to('/loginpage');
    }

   
    public function manageRental()
    {
        $companyModel = new RentalModel();
    
        $data['pending_rentals'] = $companyModel->getPendingCompanies();
        $data['approved_rentals'] = $companyModel->getApprovedCompanies();

        return view('AdminDashBoard/adminpage', $data);
    }

    public function approve($companyId)
    {
        $db = \Config\Database::connect();
        
        $db->table('company')
            ->where('company_id', $companyId)
            ->update(['status' => 'approved']);
            
        return redirect()->back()->with('message', 'Company approved successfully');
    }

    public function decline($companyId) 
    {
        $db = \Config\Database::connect();
        
        // Get user_id before deleting
        $company = $db->table('company')
            ->where('company_id', $companyId)
            ->get()->getRowArray();
            
        if ($company) {
            $db->transStart();
            // Delete from users table
            $db->table('users')
                ->where('user_id', $company['user_id'])
                ->delete();
                
            // Delete from company_details
            $db->table('company')
                ->where('company_id', $companyId)
                ->delete();
            $db->transComplete();
        }
        
        return redirect()->back()->with('message', 'Company registration declined');
    }

    public function approveRenter($renterId)
    {
        $db = \Config\Database::connect();
        $db->table('renter_details')
            ->where('renter_id', $renterId)
            ->update(['status' => 'approved']);
            
        return redirect()->back()
            ->with('message', 'Renter approved successfully');
    }

    public function declineRenter($renterId)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        
        $renter = $db->table('renter_details')
            ->where('renter_id', $renterId)
            ->get()
            ->getRowArray();
            
        if ($renter) {
            // Delete user account
            $db->table('users')
                ->where('user_id', $renter['user_id'])
                ->delete();
                
            // Delete renter details
            $db->table('renter_details')
                ->where('renter_id', $renterId)
                ->delete();
        }
        
        $db->transComplete();
        return redirect()->back()
            ->with('message', 'Renter registration declined');
    }
}
