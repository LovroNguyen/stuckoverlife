<?php
session_start();
try {
    include '../includes/db.php';
    include '../includes/functions.php';
    
    // Require login
    requireLogin();
    
    $title = 'Create New Post';
    $error = '';
    
    // Get all modules for dropdown
    $modules = allModules($pdo);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $postTitle = trim($_POST['title']);
        $content = trim($_POST['content']);
        $moduleId = $_POST['module'];
        
        // Validation
        if (empty($postTitle) || empty($content) || empty($moduleId)) {
            $error = 'All fields are required';
        } else {
            try {
                // Begin transaction
                $pdo->beginTransaction();
                
                // Create post
                $stmt = $pdo->prepare("
                    INSERT INTO posts (title, content, ModuleID, UserID)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([$postTitle, $content, $moduleId, $_SESSION['user_id']]);
                $postId = $pdo->lastInsertId();
                
                // Upload image if provided
                $assetId = null;
                if (!empty($_FILES['images']['name'][0])) {
                    $fileCount = count($_FILES['images']['name']);
                    
                    for ($i = 0; $i < $fileCount; $i++) {
                        // Skip empty file inputs
                        if ($_FILES['images']['error'][$i] != 0) continue;
                        
                        $uploadedType = $_FILES['images']['type'][$i];
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        
                        if (!in_array($uploadedType, $allowedTypes)) {
                            throw new Exception("Invalid file type. Only JPG, PNG, and GIF are allowed.");
                        }
                        
                        // Generate unique filename
                        $fileName = uniqid('post_') . '_' . $_FILES['images']['name'][$i];
                        $uploadPath = 'uploads/' . $fileName;
                        
                        // Create uploads directory if it doesn't exist
                        if (!file_exists('uploads')) {
                            mkdir('uploads', 0777, true);
                        }
                        
                        // Move uploaded file
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadPath)) {
                            // Insert new asset
                            $stmt = $pdo->prepare("INSERT INTO asset (mediaKey, QuestionID) VALUES (?, ?)");
                            $stmt->execute([$fileName, $postId]);
                        } else {
                            throw new Exception("Failed to upload image: " . $_FILES['images']['name'][$i]);
                        }
                    }
                }
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
    include '../views/createPost.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../views/layout.html.php';
?>