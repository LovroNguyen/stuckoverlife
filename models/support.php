<?php
session_start();
try {
    include '../includes/db.php';
    include '../includes/functions.php';
    
    // Require login
    requireLogin();
    
    $title = 'Help Center - Contact Us';
    $error = '';
    $success = '';
    
    // Get current user
    $userId = $_SESSION['user_id'];
    $currentUser = getCurrentUser($pdo);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $email = trim($_POST['email']);
        $feedbackTitle = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        // Use user's email from database if not provided
        if (empty($email)) {
            $email = null; // Store as NULL in database if not provided
        }
        
        // Validation
        if (empty($feedbackTitle) || empty($content)) {
            $_SESSION['error'] = 'Title and content are required';
        } else {
            try {
                // Begin transaction
                $pdo->beginTransaction();
                
                // Save feedback to database
                saveFeedback($pdo, $feedbackTitle, $content, $email, $userId);
                
                $pdo->commit();
                
                $_SESSION['success'] = 'Feedback successfully sumitted!';
                
                // Clear form after successful submission
                $email = '';
                $feedbackTitle = '';
                $content = '';
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = 'Error saving feedback: ' . $e->getMessage();
            }
        }
    }

    $pageType = 'support-page';

    ob_start();
    include '../views/support.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../views/layout.html.php';
?>