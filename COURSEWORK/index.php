<?php
session_start();
// Debug
error_log('Index.php - Session check: ' . (isset($_SESSION['user_id']) ? 'User ID: '.$_SESSION['user_id'] : 'Not logged in'));
    try {
        include './includes/db.php';
        include './includes/functions.php';

        $posts = allPosts($pdo);
        $title = 'Stuck Overlife';
        
        ob_start();
        include './views/home.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
    include './views/layout.html.php';
?>