<?php
// auth.php
session_start();
require_once 'db.php';

// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check CSRF Token
function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        die('CSRF token validation failed.');
    }
}

// Redirect if logged in
function redirect_if_logged_in($url = 'dashboard.php') {
    if (isset($_SESSION['user_id'])) {
        header("Location: $url");
        exit;
    }
}

// Redirect if not logged in
function require_login($url = 'login.php') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: $url");
        exit;
    }
}

// Track visitor (simple implementation based on IP)
function track_visitor($pdo) {
    $ip = $_SERVER['REMOTE_ADDR'];
    // Check if we already logged this IP in the current session to avoid spam
    if (!isset($_SESSION['visitor_logged'])) {
        // Log to visitors_log table
        $stmt = $pdo->prepare("INSERT INTO visitors_log (ip_address) VALUES (?)");
        $stmt->execute([$ip]);
        
        // Increment global counter
        $stmt2 = $pdo->prepare("UPDATE site_stats SET stat_value = stat_value + 1 WHERE stat_name = 'visitor_count'");
        $stmt2->execute();
        
        $_SESSION['visitor_logged'] = true;
    }
}
?>
