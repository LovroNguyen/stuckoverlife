<?php
session_start();
try {
    include '../includes/db.php';
    include '../includes/functions.php';
    
    // Require login
    requireLogin();
    
    $title = 'Create New Post';
    $error = '';
    
    // Get all modules for dropdown
    $modules = allModules($pdo);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $postTitle = trim($_POST['title']);
        $content = trim($_POST['content']);
        $moduleId = $_POST['module'];
        
        // Validation
        if (empty($postTitle) || empty($content) || empty($moduleId)) {
            $error = 'All fields are required';
        } else {
            try {
                
                createPost($postTitle, $content,$_SESSION['user_id'] , $moduleId);
                
                // Redirect to index page after successful post creation
                header('Location: /coursework/');
                exit();
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = $e->getMessage();
            }
        }
    }

    ob_start();
    include '../views/createPost.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../views/layout.html.php';
?>