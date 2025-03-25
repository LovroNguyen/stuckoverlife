<?php
// Save as controllers/comment-controller.php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: /coursework/login.php');
    exit();
}

$action = $_GET['action'] ?? '';
$commentId = $_GET['id'] ?? 0;
$postId = $_GET['post_id'] ?? 0;
$userId = $_SESSION['user_id'];

switch ($action) {
    case 'edit':
        // Handle edit form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verify user owns this comment
            if (!userOwnsComment($pdo, $commentId, $userId)) {
                header('Location: /coursework/posts.php?id=' . $postId);
                exit();
            }
            
            $content = $_POST['content'] ?? '';
            
            // Validate input
            if (empty($content)) {
                $error = 'Comment content is required';
                header('Location: /coursework/posts.php?id=' . $postId . '&error=' . urlencode($error));
                exit();
            }
            
            updateComment($pdo, $commentId, $content);
            
            header('Location: /coursework/posts.php?id=' . $postId);
            exit();
        }
        break;
        
    case 'delete':
        // Verify user owns this comment
        if (!userOwnsComment($pdo, $commentId, $userId)) {
            header('Location: /coursework/posts.php?id=' . $postId);
            exit();
        }
        
        // Delete the comment
        deleteComment($pdo, $commentId);
        
        // Redirect to view the post
        header('Location: /coursework/posts.php?id=' . $postId);
        exit();
        break;
        
    default:
        header('Location: /coursework/posts.php?id=' . $postId);
        exit();
}
?>