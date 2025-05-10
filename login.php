<?php

function login($email, $password) {
    global $db; // Assuming you have a database connection
    
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Check if user is already logged in somewhere else
        if (!empty($user['session_id'])) {
            return [
                'success' => false,
                'message' => 'This account is already logged in on another device. Please logout first.'
            ];
        }
        
        // Generate new session ID
        $sessionId = session_id();
        
        // Update user's session ID in database
        $updateStmt = $db->prepare("UPDATE users SET session_id = ? WHERE user_id = ?");
        $updateStmt->execute([$sessionId, $user['user_id']]);
        
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        
        return [
            'success' => true,
            'message' => 'Login successful'
        ];
    }
    
    return [
        'success' => false,
        'message' => 'Invalid credentials'
    ];
} 