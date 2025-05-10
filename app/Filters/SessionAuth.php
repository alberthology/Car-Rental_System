<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class SessionAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userModel = new UserModel();
        
        $userId = $session->get('user_id');
        $currentSessionId = session_id(); // ✅ Get actual session ID

        // Check if user is logged in
        if (!$userId) {
            return redirect()->to(base_url('/loginpage'))->with('error', 'Please log in first.');
        }

        // Verify session_id in database
        $user = $userModel->find($userId);
        if (!$user || $user['session_id'] !== $currentSessionId) {
            $session->destroy();
            return redirect()->to(base_url('/loginpage'))->with('error', 'Session expired or logged in elsewhere. Please login again.');
        }

        return; // Allow to proceed
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-filter actions needed
    }
}
