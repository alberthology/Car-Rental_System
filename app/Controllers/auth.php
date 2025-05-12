<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        // Initialize session
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('loginpage');
    }

    public function register()
    {
        return view('register');
    }

    public function adminpage()
    {
        // Check if user is logged in and is admin
        if (!$this->session->get('logged_in') || !$this->session->get('isAdmin')) {
            return redirect()->to('login')->with('error', 'Please login as admin');
        }

        // Update last activity
        $this->session->set('last_activity', time());

        $db = \Config\Database::connect();

        // Get pending companies
        $data['pending_companies'] = $db->table('company')
            ->where('status', 'pending')
            ->get()
            ->getResultArray();

        // Get approved companies
        $data['approved_companies'] = $db->table('company')
            ->where('status', 'approved')
            ->get()
            ->getResultArray();

        // Get pending renters
        $data['pending_renters'] = $db->table('renters')
            ->where('status', 'pending')
            ->get()
            ->getResultArray();

        // Get approved renters
        $data['approved_renters'] = $db->table('renters')
            ->where('status', 'approved')
            ->get()
            ->getResultArray();

        return view('AdminDashBoard/adminpage', $data);
    }

    public function renter()
    {
        return view('renterpage');
    }

    public function company()
    {
        return view('RentalCompany/company');
    }

    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $user = $db->table('users')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            // Check if user is already logged in elsewhere - optional BUT DO NOT DELETE
            /* if ($user['session_id'] !== null) {
                return redirect()->back()->with('error', 'Account is already logged in on another device/browser. Please logout first.');
            } */

            $session = session();

            // Base session data for all users
            $sessionData = [
                'user_id' => $user['user_id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true,
                'session_id' => session_id()
            ];

            // Check role specific conditions
            if ($user['role'] == 'Admin') {
                $sessionData['isAdmin'] = true;
                $session->set($sessionData);

                // Store session ID in database
                $db->table('users')
                    ->where('user_id', $user['user_id'])
                    ->update(['session_id' => session_id()]);


                $session->setFlashdata('success', 'Login successful!');

                return redirect()->to('adminpage')
                    ->with('toastr_info', 'Login successful!')
                    ->with('toastr_success', 'Welcome Admin ' . $user['name'] . '!');
            } else if ($user['role'] === 'Company' || $user['role'] === 'Renter') {
                // Get status based on role
                $statusTable = $user['role'] === 'Company' ? 'company' : 'renters';
                $details = $db->table($statusTable)
                    ->where('user_id', $user['user_id'])
                    ->get()
                    ->getRowArray();

                if ($details && $details['status'] === 'Approved') {
                    $session->set($sessionData);
                    // Store session ID in database
                    $db->table('users')
                        ->where('user_id', $user['user_id'])
                        ->update(['session_id' => session_id()]);

                    $session->setFlashdata('success', 'Login successful!');

                    return redirect()->to($user['role'] === 'Company' ? 'RentalCompany/company' : 'renterpage')
                        ->with('toastr_info', 'Login successful!')
                        ->with('toastr_success', 'Welcome ' . $user['name'] . '!');
                } else {
                    return redirect()->back()->with('error', 'Your account is still pending approval.');
                }


                /* // Set role-specific session data
                $session->set($sessionData);

                // Store session ID
                $db->table('users')
                    ->where('user_id', $user['user_id'])
                    ->update(['session_id' => session_id()]);

                // Redirect based on role
                return redirect()->to($user['role'] === 'Company' ? '/RentalCompany/company' : '/renterpage'); */
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }



    /* public function logout()
    {
        $session = session();
        $userModel = new UserModel();

        // Get the user ID from session
        $userId = $session->get('user_id');

        // Check if a valid user is logged in
        if ($userId) {
            // Update the user session in the database by setting session_id to null
            $userModel->update($userId, ['session_id' => null]);

            // Destroy the session
            $session->destroy();
        }
        $session->setFlashdata('success', 'You have been logged out.');


        // Redirect to the login page after logging out
        return redirect()->to(base_url('/loginpage'))->with('success', 'You have successfully logged out.');
    } */

    public function logout()
    {
        $userModel = new UserModel();

        $user_id = $this->session->get('user_id');

        if ($user_id) {

            /* $db = \Config\Database::connect();
            $db->table('users')->where('user_id', $user_id)->update(['session_id' => null]); */

            $userModel->update($user_id, ['session_id' => null]);
        }

        $this->session->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to('loginpage')->with('success', 'You have been logged out successfully.');
        $this->session->destroy();
    }


    public function adminLogout()
    {
        try {
            $session = session();
            $userModel = new UserModel();

            // Debug: Check if session exists
            $userId = $session->get('user_id');
            $sessionId = $session->get('session_id');

            log_message('debug', 'Attempting logout for user_id: ' . $userId . ' with session_id: ' . $sessionId);

            if ($userId) {
                // Force update the session_id to null
                $result = $userModel->where('user_id', $userId)
                    ->set(['session_id' => null])
                    ->update();

                if ($result) {
                    log_message('debug', 'Successfully cleared session_id for user ' . $userId);
                } else {
                    log_message('error', 'Failed to clear session_id for user ' . $userId);
                }

                // Double-check the update
                $user = $userModel->find($userId);
                if ($user && $user['session_id'] === null) {
                    log_message('debug', 'Verified session_id is null in database');
                }
            }

            // Clear all session data
            $session->remove(['user_id', 'email', 'role', 'session_id', 'logged_in']);
            $session->destroy();

            // Clear any remaining session cookies
            if (isset($_COOKIE['ci_session'])) {
                unset($_COOKIE['ci_session']);
                setcookie('ci_session', '', time() - 3600, '/');
            }

            // Redirect with session cleared message
            $session->setFlashdata('message', 'Successfully logged out');
            return redirect()->to(base_url('/loginpage'));
        } catch (\Exception $e) {
            log_message('error', 'Logout error: ' . $e->getMessage());
            return redirect()->to(base_url('/loginpage'));
        }
    }
}
