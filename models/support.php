<?php
session_start();
try {
    include './includes/db.php';
    include './includes/functions.php';
    
    // Require login
    requireLogin();
    
    $title = 'Help Center - Contact Us';
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $email = trim($_POST['email']);
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        // Validation
        if (empty($email) || empty($content)) {
            $error = 'All fields are required';
        } else {
            try {
                // Begin transaction
                $pdo->beginTransaction();
                
                // ============ Contact Mod Function ================
                                
                $pdo->commit();
                
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
    include './views/support.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include './views/layout.html.php';
?>