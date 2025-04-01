<?php
session_start();
try {
    include '../includes/db.php';
    include '../includes/functions.php';
    
    $title = 'Login';
    $error = '';
    
    if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
        $success = 'Registration successful! Please login.';
    }
    
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Validation
        if (empty($username) || empty($password)) {
            $error = 'All fields are required';
        } else {
            // Check if user exists
            $params = [':username' => $username];
            $checkUser = query($pdo, 'SELECT * FROM user WHERE username = :username', $params);
            $user = $checkUser->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to homepage
                header('Location: /coursework/index.php');
                exit();
            } else {
                $error = 'Invalid username or password';
            }
        }
    }
    
    ob_start();

    include '../views/login.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include '../views/layout.html.php';
?>