<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: /coursework/models/login.php');
    exit();
}

// Get action parameter
$action = $_GET['action'] ?? 'view';
$feedbackId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$userId = $_SESSION['user_id'];

// Check if user is admin for certain actions
$isAdmin = isAdmin();

switch ($action) {
    case 'view':
        // View feedback list (for admins)
        if (!$isAdmin) {
            header('Location: /coursework/index.php');
            exit();
        }
        
        $title = 'Admin - User Feedback';
        
        // Get all feedback submissions with username
        $feedbackList = getAllFeedback($pdo);
        
        // Handle search functionality if needed
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = trim($_GET['search']);
            $filteredFeedback = [];
            
            foreach ($feedbackList as $feedback) {
                if (stripos($feedback['title'], $search) !== false || 
                    stripos($feedback['content'], $search) !== false ||
                    stripos($feedback['username'], $search) !== false) {
                    $filteredFeedback[] = $feedback;
                }
            }
            
            $feedbackList = $filteredFeedback;
        }
        
        // Important: Set the correct page type for CSS styling
        $pageType = 'feedback-page';
        
        ob_start();
        include '../views/userFeedback.html.php';
        $output = ob_get_clean();
        include '../views/layout.html.php';
        break;
        
    case 'delete':
        // Delete feedback (admin only)
        if (!$isAdmin || $feedbackId <= 0) {
            header('Location: /coursework/controllers/feedbackController.php');
            exit();
        }
        
        try {
            deleteFeedback($pdo, $feedbackId);
            $_SESSION['success'] = 'Feedback successfully deleted';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error deleting feedback: ' . $e->getMessage();
        }
        
        header('Location: /coursework/controllers/feedbackController.php');
        exit();
        break;
        
    case 'resolve':
        // Mark feedback as resolved (admin only)
        if (!$isAdmin || $feedbackId <= 0) {
            header('Location: /coursework/controllers/feedbackController.php');
            exit();
        }
        
        try {
            markFeedbackResolved($pdo, $feedbackId);
            $_SESSION['success'] = 'Feedback marked as resolved';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error updating feedback: ' . $e->getMessage();
        }
        
        header('Location: /coursework/controllers/feedbackController.php');
        exit();
        break;
        
    default:
        // Default to viewing feedback list
        header('Location: /coursework/controllers/feedbackController.php?action=view');
        exit();
}
?>