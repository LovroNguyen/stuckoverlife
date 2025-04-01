<?php
session_start();
try {
    // Fix the include paths - use absolute paths from the project root
    include __DIR__ . '/../includes/db.php';
    include __DIR__ . '/../includes/functions.php';
    
    if (!isset($_GET['id'])) {
        header('Location: /coursework/index.php');
        exit();
    }
    
    $postId = $_GET['id'];
    $post = getPostWithDetails($pdo, $postId);
    
    if (!$post) {
        header('Location: /coursework/index.php');
        exit();
    }
    
    incrementViewCount($pdo, $postId);
    
    $title = 'Stuck Overlife';
    
    ob_start();
    include __DIR__ . '/../views/posts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include __DIR__ . '/../views/layout.html.php';
?>