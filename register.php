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
            // Check if username or email already exists
            $params = [':username' => $username];
            $checkUser = query($pdo, 'SELECT * FROM user WHERE username = :username', $params);
            
            if ($checkUser->rowCount() > 0) {
                $error = 'Username or email already exists';
            } else {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Create user
                $params = [
                    ':username' => $username,
                    ':password' => $hashedPassword
                ];
                
                query($pdo, 'INSERT INTO user (username, password) VALUES (:username, :password)', $params);
                
                // Redirect to login
                header('Location: login.php?registered=true');
                exit();
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