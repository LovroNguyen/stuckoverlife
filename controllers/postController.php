<?php
session_start();
include '../includes/db.php';
include '../includes/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: /coursework/login.php');
    exit();
}

$action = $_GET['action'] ?? '';
$postId = $_GET['id'] ?? 0;
$userId = $_SESSION['user_id'];

// Verify the post exists
$post = getPost($pdo, $postId);
if (!$post) {
    header('Location: /coursework/index.php');
    exit();
}

// Handle image deletion if requested
if (isset($_GET['delete_image']) && !empty($_GET['delete_image'])) {
    $assetId = $_GET['delete_image'];
    
    // Verify this image belongs to the post and user owns the post
    if (userOwnsPost($pdo, $postId, $userId) && imageExistsForPost($pdo, $assetId, $postId)) {
        // Delete the image file and record
        deleteImageAsset($pdo, $assetId);
        
        // Redirect back to edit page
        header('Location: /coursework/controllers/postController.php?id=' . $postId . '&action=edit');
        exit();
    }
}

switch ($action) {
    case 'edit':
        // Handle edit form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verify user owns this post
            if (!userOwnsPost($pdo, $postId, $userId)) {
                header('Location: /coursework/posts.php?id=' . $postId);
                exit();
            }
            
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $moduleId = $_POST['module'] ?? '';
            
            // Validate input
            if (empty($title) || empty($content) || empty($moduleId)) {
                $error = 'All fields are required';
                // Get modules for form
                $modules = allModules($pdo);
                include '/coursework/views/createPost.html.php';
                exit();
            }
            
            try {
                // Begin transaction
                $pdo->beginTransaction();
                
                // Update the post basic info
                updatePost($pdo, $postId, $title, $content, $moduleId);
                
                // Handle multiple image uploads
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
                        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/coursework/uploads/' . $fileName;

                        // Create uploads directory if it doesn't exist
                        if (!file_exists('../uploads')) {
                            mkdir('../uploads', 0777, true);
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
                
                // Redirect to view the post
                header('Location: /coursework/models/posts.php?id=' . $postId);
                exit();
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = $e->getMessage();
                
                // Get modules for form
                $modules = allModules($pdo);
                include '/coursework/views/createPost.html.php';
                exit();
            }
        } else {
            // Display edit form
            // Verify user owns this post
            if (!userOwnsPost($pdo, $postId, $userId)) {
                header('Location: /coursework/models/posts.php?id=' . $postId);
                exit();
            }
            
            // Get post data
            $post = getPost($pdo, $postId);
            
            // Get all images for this post
            $post['images'] = getPostImages($pdo, $postId);
            
            // Get modules for form
            $modules = allModules($pdo);
            
            // Display edit form
            $title = 'Edit Post - Stuck Overlife';
            ob_start();
            include '../views/createPost.html.php';
            $output = ob_get_clean();
            include '../views/layout.html.php';
        }
        break;
        
    case 'delete':
        // Verify user owns this post
        if (!userOwnsPost($pdo, $postId, $userId)) {
            header('Location: /coursework/posts.php?id=' . $postId);
            exit();
        }
        
        // Delete the post and all associated images
        deletePost($pdo, $postId);
        
        // Redirect to home
        header('Location: /coursework/index.php');
        exit();
        break;
        
    default:
        header('Location: /coursework/posts.php?id=' . $postId);
        exit();
}
?>