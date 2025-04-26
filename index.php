<?php
date_default_timezone_set('UTC');
session_start();
// Debug
error_log('Index.php - Session check: ' . (isset($_SESSION['user_id']) ? 'User ID: '.$_SESSION['user_id'] : 'Not logged in'));
    try {
        include './includes/db.php';
        include './includes/functions.php';

        // Get current page from URL parameter, default to 1
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;
        
        // Number of posts per page
        $postsPerPage = 10;
        
        // Get posts with pagination
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = trim($_GET['search']);
            $pagination = search($pdo, $searchTerm, $currentPage, $postsPerPage);
            $posts = $pagination['posts'];
        } else {
            $pagination = getPaginatedPosts($pdo, $currentPage, $postsPerPage);
            $posts = $pagination['posts'];
        }
        
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