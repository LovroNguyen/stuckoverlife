<?php
// Save as add-comment.php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: /coursework/login.php');
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'] ?? 0;
    $commentContent = $_POST['comment'] ?? '';
    $userId = $_SESSION['user_id'];
    
    // Validate input
    if (empty($postId) || empty($commentContent)) {
        $error = 'All fields are required';
        header('Location: /coursework/posts.php?id=' . $postId . '&error=' . urlencode($error));
        exit();
    }
    
    // Check if we're editing an existing comment or creating a new one
    $commentId = $_POST['comment_id'] ?? '';
    
    if (!empty($commentId)) {
        // Editing an existing comment
        // Verify user owns this comment
        if (!userOwnsComment($pdo, $commentId, $userId)) {
            header('Location: /coursework/posts.php?id=' . $postId);
            exit();
        }
        
        // Update the comment
        updateComment($pdo, $commentId, $commentContent);
    } else {
        // Adding a new comment
        // Insert the comment
        $query = 'INSERT INTO comment (content, createdAt, UserID, QuestionID) VALUES (:content, NOW(), :userId, :postId)';
        $parameters = [
            ':content' => $commentContent,
            ':userId' => $userId,
            ':postId' => $postId
        ];
        query($pdo, $query, $parameters);
    }
    
    // Redirect to view the post
    header('Location: /coursework/posts.php?id=' . $postId);
    exit();
} else {
    // If not a POST request, redirect to home
    header('Location: /coursework/index.php');
    exit();
}
?>