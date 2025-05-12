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

        // Roy Base query builder
        $companyBuilder = $db->table('company')
            ->select('company.*, users.name AS user_name, users.email AS user_email')
            ->join('users', 'users.user_id = company.user_id');

        $pending_companies = (clone $companyBuilder)
            ->where('company.status', 'pending')
            ->get()
            ->getResultArray();

        $approved_companies = (clone $companyBuilder)
            ->where('company.status', 'approved')
            ->get()
            ->getResultArray();

        $renterBuilder = $db->table('renters')
            ->select('renters.*, users.name AS user_name, users.email AS user_email')
            ->join('users', 'users.user_id = renters.user_id');

        $pending_renters = (clone $renterBuilder)
            ->where('renters.status', 'pending')
            ->get()
            ->getResultArray();

        $approved_renters = (clone $renterBuilder)
            ->where('renters.status', 'approved')
            ->get()
            ->getResultArray();


        $companyModel = new \App\Models\CompanyModel();
        $pendingCompanyCount = $companyModel->where('status', 'pending')->countAllResults();
        $approvedCompanyCount = $companyModel->where('status', 'approved')->countAllResults();


        return view('AdminDashBoard/adminpage', [
            'pending_companies' => $pending_companies,
            'approved_companies' => $approved_companies,
            'pending_renters' => $pending_renters,
            'approved_renters' => $approved_renters,
            'pendingCompanyCount' => $pendingCompanyCount,
            'approvedCompanyCount' => $approvedCompanyCount
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
        $db->table('renters')
            ->where('renter_id', $renterId)
            ->update(['status' => 'approved']);

        return redirect()->back()
            ->with('message', 'Renter approved successfully');
    }

    public function declineRenter($renterId)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $renter = $db->table('renters')
            ->where('renter_id', $renterId)
            ->get()
            ->getRowArray();

        if ($renter) {
            // Delete user account
            $db->table('users')
                ->where('user_id', $renter['user_id'])
                ->delete();

            // Delete renter details
            $db->table('renters')
                ->where('renter_id', $renterId)
                ->delete();
        }

        $db->transComplete();
        return redirect()->back()
            ->with('message', 'Renter registration declined');
    }

    // ROY

    public function fetchPendingCompanies()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');

        $request = service('request');

        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];

        $query = $builder->where('status', 'pending');

        if ($search) {
            $query = $query->groupStart()
                ->like('company_name', $search)
                ->orLike('address', $search)
                ->groupEnd();
        }

        $totalFiltered = $query->countAllResults(false);
        $data = $query->limit($length, $start)->get()->getResultArray();

        foreach ($data as &$row) {
            $row['actions'] = '
            <a href="' . base_url('admin/approve/' . $row['company_id']) . '" class="approve-btn">Approvess</a>
            <a href="' . base_url('admin/decline/' . $row['company_id']) . '" class="decline-btn">Decline</a>
        ';
        }

        return $this->response->setJSON([
            "draw" => intval($draw),
            "recordsTotal" => $builder->countAllResults(),
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ]);
    }
}
