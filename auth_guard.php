<?php
/*
  -------------------------------------------------------------
  File: auth_guard.php
  Purpose: Handles session-based authentication and access control.
  -------------------------------------------------------------
*/

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * require_login()
 * Ensures the user is logged in.
 * If not, redirect to login page.
 */
function require_login() {
    if (empty($_SESSION['user'])) {
        header("Location: /your_app/auth/login.php");
        exit;
    }
}

/**
 * require_role($role)
 * Ensures the logged-in user has the specific role (voter/admin).
 * If not, redirect back to login page.
 */
function require_role($role) {
    require_login();
    if (empty($_SESSION['user']['PERANAN']) || $_SESSION['user']['PERANAN'] !== $role) {
        header("Location: /your_app/auth/login.php");
        exit;
    }
}
?>
