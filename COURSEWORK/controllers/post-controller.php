<?php
// Save as controllers/post-controller.php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: /coursework/login.php');
    exit();
}

$action = $_GET['action'] ?? '';
$postId = $_GET['id'] ?? 0;
$userId = $_SESSION['user_id'];

// Verify the post exists
$post = getPost($pdo, $postId);
if (!$post) {
    header('Location: /coursework/index.php');
    exit();
}

switch ($action) {
    case 'edit':
        // Handle edit form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verify user owns this post
            if (!userOwnsPost($pdo, $postId, $userId)) {
                header('Location: /coursework/controllers/posts.php?id=' . $postId);
                exit();
            }
            
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $moduleId = $_POST['module'] ?? '';
            
            // Validate input
            if (empty($title) || empty($content) || empty($moduleId)) {
                $error = 'All fields are required';
                // Get modules for form
                $modules = allModules($pdo);
                include '../views/create-post.html.php';
                exit();
            }
            
            // Update the post
            updatePost($pdo, $postId, $title, $content, $moduleId);
            
            // Redirect to view the post
            header('Location: /coursework/controllers/posts.php?id=' . $postId);
            exit();
        } else {
            // Display edit form
            // Verify user owns this post
            if (!userOwnsPost($pdo, $postId, $userId)) {
                header('Location: /coursework/controllers/posts.php?id=' . $postId);
                exit();
            }
            
            // Get post data
            $post = getPost($pdo, $postId);
            
            // Get modules for form
            $modules = allModules($pdo);
            
            // Display edit form
            $title = 'Edit Post - Stuck Overlife';
            ob_start();
            include '../views/create-post.html.php';
            $output = ob_get_clean();
            include '../views/layout.html.php';
        }
        break;
        
    case 'delete':
        // Verify user owns this post
        if (!userOwnsPost($pdo, $postId, $userId)) {
            header('Location: /coursework/controllers/posts.php?id=' . $postId);
            exit();
        }
        
        // Delete the post
        deletePost($pdo, $postId);
        
        // Redirect to home
        header('Location: /coursework/index.php');
        exit();
        break;
        
    default:
        header('Location: /coursework/controllers/posts.php?id=' . $postId);
        exit();
}
?>