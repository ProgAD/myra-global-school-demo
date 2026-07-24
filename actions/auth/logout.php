<?php
/* ============================================================
   Logout endpoint
   Destroys the session and returns the user to the login page.
   ============================================================ */

session_start();

// Clear all session data
$_SESSION = [];

// Remove the session cookie
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy the session on the server
session_destroy();

// Back to the login page (relative to actions/auth/)
header('Location: ../../login.html');
exit;
