<?php
try {
    include './includes/db.php';
    include './includes/functions.php';
    
    $title = 'Register';
    $error = '';
    
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        
        // Validation
        if (empty($username) || empty($password) || empty($confirmPassword)) {
            $error = 'All fields are required';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords do not match';
        } else {
            try {
                register($username, $password);
                // Redirect to login
                header('Location: /coursework/login?registered=true');
                exit();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
    
    ob_start();
    include './views/signup.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include './views/layout.html.php';
?>