<?php
// Start the session at the beginning of the script
session_start();

// Include necessary files
include_once './includes/functions.php';
include_once './includes/db.php';  // This should contain your PDO connection in $pdo

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    // Validate inputs
    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    $comment_content = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    
    // Make sure user_id is available from session
    if (!isset($_SESSION['user_id'])) {
        // If somehow the user_id is not in session despite being logged in
        header('Location: login.php');
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    
    // Basic validation
    $errors = [];
    
    if ($post_id <= 0) {
        $errors[] = 'Invalid post ID';
    }
    
    if (empty($comment_content)) {
        $errors[] = 'Comment cannot be empty';
    } elseif (strlen($comment_content) > 1000) {
        $errors[] = 'Comment is too long (maximum 1000 characters)';
    }
    
    // Check if post exists and is not deleted
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('SELECT PostID FROM posts WHERE PostID = ? AND status != "Deleted"');
            $stmt->execute([$post_id]);
            
            if ($stmt->rowCount() === 0) {
                $errors[] = 'Post not found or has been deleted';
            }
        } catch (PDOException $e) {
            error_log('Database error in add-comment.php: ' . $e->getMessage());
            $errors[] = 'A database error occurred. Please try again later.';
        }
    }
    
    // Insert comment if no errors
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO comment (content, QuestionID, UserID) VALUES (?, ?, ?)');
            $result = $stmt->execute([$comment_content, $post_id, $user_id]);
            
            if ($result) {
                $_SESSION['success_message'] = 'Comment added successfully!';
            } else {
                $errors[] = 'Failed to add comment';
            }
        } catch (PDOException $e) {
            error_log('Database error in add-comment.php: ' . $e->getMessage());
            $errors[] = 'A database error occurred. Please try again later.';
        }
    }
    
    if (!empty($errors)) {
        $_SESSION['error_messages'] = $errors;
    }
    
    header("Location: /coursework/posts.php?id=$post_id");
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>