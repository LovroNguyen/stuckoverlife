<?php
session_start();
try {
    include './includes/db.php';
    include './includes/functions.php';
    
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
    include './views/posts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include './views/layout.html.php';
?>