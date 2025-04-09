<?php
session_start();
$pageType = 'profile-page';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /coursework/models/login.php');
    exit();
}

// Include database connection and functions
include_once '../includes/db.php';
include_once '../includes/functions.php';

// Set page title
$title = 'My Profile';

// Get user information
$currentUser = getCurrentUser($pdo);

// Check if user exists
if (!$currentUser) {
    header('Location: /coursework/models/login.php');
    exit();
}

// Show header and profile page
ob_start();
include_once '../views/profile.html.php';
$output = ob_get_clean();

// Show layout
include_once '../views/layout.html.php';
?>