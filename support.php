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
                
                // Create post
                // the message
                $msg = "$content";

                // use wordwrap() if lines are longer than 70 characters
                $msg = wordwrap($msg,70);

                // send email
                mail("lovronguyen2@gmail.com",$title,$msg);
                                
                $pdo->commit();
                
                // Redirect to index page after successful post creation
                header('Location: index.php');
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