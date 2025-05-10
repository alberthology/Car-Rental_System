<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function login()
{
    $model = new \App\Models\UserModel();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if ($user) {
        if ($user['status'] == 'pending') {
            return redirect()->back()->with('error', 'Your account is pending approval.');
        }

        if ($user['status'] == 'declined') {
            return redirect()->back()->with('error', 'Your account has been declined.');
        }

        if (password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('role', $user['role']);
            return redirect()->to('/dashboard');
        }
    }

    return redirect()->back()->with('error', 'Invalid credentials.');
}















}