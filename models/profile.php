<?php
session_start();
$pageType = 'profile-page';

include_once '../includes/db.php';
include_once '../includes/functions.php';

$profileUserId = null;

// Check if user_id parameter is provided
if (isset($_GET['user_id'])) {
    $profileUserId = $_GET['user_id'];
    $profileUser = getUserById($pdo, $profileUserId);
}
// For backward compatibility - redirect username queries to user_id URLs
elseif (isset($_GET['username'])) {
    $profileUsername = $_GET['username'];
    // Get user by username
    $profileUser = getUserByUsername($pdo, $profileUsername);
    if ($profileUser) {
        // Redirect to the user_id based URL for consistency
        header('Location: /coursework/models/profile.php?user_id=' . $profileUser['UserID']);
        exit();
    }
} 
// Fall back to current user if logged in
elseif (isset($_SESSION['user_id'])) {
    $profileUserId = $_SESSION['user_id'];
    $profileUser = getCurrentUser($pdo);
} 
// Redirect to login if trying to view a profile while not logged in
else {
    header('Location: /coursework/models/login.php');
    exit();
}

// Set page title and get profile data
if ($profileUser) {
    // If viewing own profile
    if (isset($_SESSION['user_id']) && $profileUserId == $_SESSION['user_id']) {
        $title = 'My Profile';
        $currentUser = $profileUser;
        $isOwnProfile = true;
    } else {
        $title = $profileUser['username'] . '\'s Profile';
        $currentUser = $profileUser;
        $isOwnProfile = false;
    }
    
    // Get user's posts
    $userPosts = getPostByUser($pdo, $profileUserId);
    
    // Show header and profile page
    ob_start();
    include_once '../views/profile.html.php';
    $output = ob_get_clean();
    
    // Show layout
    include_once '../views/layout.html.php';
} else {
    // User not found
    header('Location: /coursework/index.php');
    exit();
}
?>