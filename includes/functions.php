<?php
    function query($pdo, $sql, $parameters = []) {
        $query = $pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    function getModule($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT id, moduleName FROM modules', $parameters);
        return $query->fetchAll();
    }

    function timeAgo($datetime, $full = false) {
        if (empty($datetime)) {
            return 'unknown time';
        }
        
        static $now = null; // Cache the now time
        
        try {
            if ($now === null) {
                $now = new DateTime(); // Only create once per page load
            }
            $then = new DateTime($datetime);
            
            $diff = (array) $now->diff($then);
            
            // Convert days to weeks
            $diff['w'] = floor($diff['d'] / 7);
            $diff['d'] -= $diff['w'] * 7;
            
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            
            foreach($string as $k => &$v) {
                if ($diff[$k]) {
                    $v = $diff[$k] . ' ' . $v . ($diff[$k] > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
            
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        } catch (Exception $e) {
            error_log('Error in timeAgo function: ' . $e->getMessage());
            return 'unknown time';
        }
    }

    // post FUNCTION ===================================================================================================

    function getPost($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT * FROM posts WHERE PostID = :id', $parameters);
        return $query->fetch();
    }

    function createPost($postTitle, $content, $userId, $moduleId) {
        global $pdo;
        // Begin transaction
        $pdo->beginTransaction();
                        
        // Create post - fixed parameter order to match columns
        $stmt = $pdo->prepare("
            INSERT INTO posts (title, content, ModuleID, UserID)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$postTitle, $content, $moduleId, $userId]); // Fixed parameter order
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
        return $postId; // Return the new post ID
    }

    function updatePost($pdo, $postId, $title, $content, $moduleId) {
        try {
            $query = 'UPDATE posts SET title = :title, content = :content, ModuleID = :moduleId, updatedAt = NOW() WHERE PostID = :postId';
            $parameters = [
                ':postId' => $postId, 
                ':title' => $title, 
                ':content' => $content, 
                ':moduleId' => $moduleId
            ];
            
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($parameters);
            
            if (!$result) {
                error_log('Post Update Failed: ' . print_r($stmt->errorInfo(), true));
                error_log('Post ID: ' . $postId);
                error_log('New Content: ' . $content);
            }
            
            return true;
        } catch (PDOException $e) {
            error_log('Post Update Exception: ' . $e->getMessage());
            return false;
        }
    }

    function deletePost($pdo, $postId) {
        $parameters = [':postId' => $postId];
        query($pdo, 'DELETE FROM comment WHERE QuestionID = :postId', $parameters);
        query($pdo, 'DELETE FROM posts WHERE PostID = :postId', $parameters);

        // Get all images for this post
        $images = getPostImages($pdo, $postId);
        
        // Delete each image file
        foreach ($images as $image) {
            $filePath = 'uploads/' . $image['mediaKey'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $parameters = [':postId' => $postId];
        // Delete image references
        query($pdo, 'DELETE FROM asset WHERE QuestionID = :postId', $parameters);
        // Delete comments
        query($pdo, 'DELETE FROM comment WHERE QuestionID = :postId', $parameters);
        // Delete the post
        query($pdo, 'DELETE FROM posts WHERE PostID = :postId', $parameters);
    }

    function allPosts($pdo){
        $posts = query($pdo, 'SELECT * FROM posts
        INNER JOIN user ON posts.userid = user.userid
        INNER JOIN modules ON posts.moduleid = modules.moduleid');
        return $posts->fetchAll();
    }


    function getPostWithDetails($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT p.*, u.username, u.avatar, m.moduleName 
                              FROM posts p
                              INNER JOIN user u ON p.UserID = u.UserID
                              INNER JOIN modules m ON p.ModuleID = m.ModuleID
                              WHERE p.PostID = :id', $parameters);
        $post = $query->fetch();
        
        if ($post) {
            // Get asset information if it exists
            if ($post['AssetID'] !== null) {
                $assetParams = [':assetId' => $post['AssetID']];
                $assetQuery = query($pdo, 'SELECT * FROM asset WHERE AssetID = :assetId', $assetParams);
                $post['asset'] = $assetQuery->fetch();
            }
            
            // Get comments
            $commentParams = [':postId' => $id];
            $commentsQuery = query($pdo, 'SELECT c.*, u.username 
                                   FROM comment c 
                                   INNER JOIN user u ON c.UserID = u.UserID
                                   WHERE c.QuestionID = :postId
                                   ORDER BY c.createdAt ASC', $commentParams);
            $post['comments'] = $commentsQuery->fetchAll();
        }
        
        return $post;
    }

    function incrementViewCount($pdo, $id) {
        $parameters = [':id' => $id];
        query($pdo, 'UPDATE posts SET viewCount = viewCount + 1 WHERE PostID = :id', $parameters);
    }

    function uploadPostImage($postId) {
        $targetDir = "uploads/";
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $postId . "_" . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($fileType, $allowTypes)) {
            return "Only JPG, JPEG, PNG, GIF files are allowed.";
        }
        
        // Check file size (2MB max)
        if ($_FILES["image"]["size"] > 2000000) {
            return "File is too large. Maximum size is 2MB.";
        }
        
        // Upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            global $pdo;
            // Update post with image path
            $params = [':id' => $postId, ':image' => $targetFilePath];
            query($pdo, 'UPDATE posts SET image = :image WHERE id = :id', $params);
            return true;
        } else {
            return "There was an error uploading your file.";
        }
    }

    // Check if user owns a post
    function userOwnsPost($pdo, $postId, $userId) {
        $parameters = [':postId' => $postId, ':userId' => $userId];
        $query = query($pdo, 'SELECT COUNT(*) as count FROM posts WHERE PostID = :postId AND UserID = :userId', $parameters);
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    function userOwnsComment($pdo, $commentId, $userId) {
        $parameters = [':commentId' => $commentId, ':userId' => $userId];
        $query = query($pdo, 'SELECT COUNT(*) as count FROM comment WHERE CommentID = :commentId AND UserID = :userId', $parameters);
        $result = $query->fetch();
        return $result['count'] > 0;
    }
    
    function addComment($pdo, $postId, $commentContent, $userId) {
        $query = 'INSERT INTO comment (content, createdAt, UserID, QuestionID) VALUES (:content, NOW(), :userId, :postId)';
        $parameters = [
            ':content' => $commentContent,
            ':userId' => $userId,
            ':postId' => $postId
        ];
        return query($pdo, $query, $parameters);
    }

    function updateComment($pdo, $commentId, $content) {
        $query = 'UPDATE comment SET content = :content WHERE CommentID = :commentId';
        $parameters = [
            ':content' => $content,
            ':commentId' => $commentId
        ];
        return query($pdo, $query, $parameters);
    }
    
    function deleteComment($pdo, $commentId) {
        $parameters = [':commentId' => $commentId];
        query($pdo, 'DELETE FROM comment WHERE CommentID = :commentId', $parameters);
    }

    // Get all images for a post
    function getPostImages($pdo, $postId) {
        $parameters = [':postId' => $postId];
        $query = query($pdo, 'SELECT * FROM asset WHERE QuestionID = :postId', $parameters);
        return $query->fetchAll();
    }

    // Check if an image exists and belongs to a post
    function imageExistsForPost($pdo, $assetId, $postId) {
        $parameters = [':assetId' => $assetId, ':postId' => $postId];
        $query = query($pdo, 'SELECT COUNT(*) as count FROM asset WHERE AssetID = :assetId AND QuestionID = :postId', $parameters);
        $result = $query->fetch();
        return $result['count'] > 0;
    }

    // Delete an image asset and its file
    function deleteImageAsset($pdo, $assetId) {
        // First get the image filename
        $parameters = [':assetId' => $assetId];
        $query = query($pdo, 'SELECT mediaKey FROM asset WHERE AssetID = :assetId', $parameters);
        $asset = $query->fetch();
        
        if ($asset) {
            // Delete the physical file
            $filePath = 'uploads/' . $asset['mediaKey'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            // Delete the database record
            query($pdo, 'DELETE FROM asset WHERE AssetID = :assetId', $parameters);
            
            return true;
        }
        
        return false;
    }

    function trimLine($content){
        $contents = strip_tags($content);
                    
        $lines = explode("\n", $contents);
        
        $preview = array_slice($lines, 0, 2);
        $preview = implode("\n", $preview);
        
        if (count($lines) > 2 || strlen($contents) > strlen($preview)) {
            $preview = trim($preview) . '...';
        }
        
        return $preview;
    }

    function search($pdo, $searchTerm) {
        // Prepare search term for use in LIKE clause
        $searchParam = '%' . $searchTerm . '%';
        $parameters = [':search' => $searchParam];
        
        // Query posts matching search term in title or content
        $query = query($pdo, 
            'SELECT p.*, u.username, m.moduleName 
            FROM posts p
            INNER JOIN user u ON p.UserID = u.UserID
            INNER JOIN modules m ON p.ModuleID = m.ModuleID
            WHERE p.title LIKE :search 
            OR p.content LIKE :search
            ORDER BY p.createdAt DESC', 
            $parameters
        );
        
        return $query->fetchAll();
    }

    // user FUNCTION ===================================================================================================

    function register($username, $password) {
        global $pdo;
    
        // Check if username or email already exists
        $params = [':username' => $username];
        $checkUser = query($pdo, 'SELECT * FROM user WHERE username = :username', $params);
            
        if ($checkUser->rowCount() > 0) {
            throw new Exception('Username already exists');
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Create user
            $insertParams = [
                ':username' => $username,
                ':password' => $hashedPassword
            ];
            
            query($pdo, 'INSERT INTO user (username, password) VALUES (:username, :password)', $insertParams);
            
            // Use a separate parameter array for the SELECT query
            $selectParams = [':username' => $username];
            return query($pdo, 'SELECT * FROM user WHERE username = :username', $selectParams)->fetch();
        }
    }

    function getUser($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT * FROM user', $parameters);
        return $query->fetchAll();
    }

    function allUsers($pdo){
        $users = query($pdo, 'SELECT * FROM user');
        return $users->fetchAll();
    }

    function isAdmin() {
        if (!isLoggedIn()) {
            return false;
        }
        
        global $pdo;
        $params = [':id' => $_SESSION['user_id']];
        $query = query($pdo, 'SELECT role FROM user WHERE UserID = :id', $params);
        $user = $query->fetch();
        
        return ($user && $user['role'] === 'admin');
    }

    function getUserByPost($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT u.* FROM user u
                              INNER JOIN posts p ON u.UserID = p.UserID
                              WHERE p.PostID = :id', $parameters);
        return $query->fetch();
    }

    function getPostByUser($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT p.*, u.username, m.moduleName FROM posts p   
                              INNER JOIN user u ON p.UserID = u.UserID
                              INNER JOIN modules m ON p.ModuleID = m.ModuleID
                              WHERE u.UserID = :id
                              ORDER BY p.createdAt DESC', $parameters);
        return $query->fetchAll();
    }

    function getUserPostCount($pdo, $userId) {
        $parameters = [':userId' => $userId];
        $result = query($pdo, 'SELECT COUNT(*) as count FROM posts WHERE UserID = :userId', $parameters);
        return $result->fetch()['count'];
    }
    
    function getUserCommentCount($pdo, $userId) {
        $parameters = [':userId' => $userId];
        $result = query($pdo, 'SELECT COUNT(*) as count FROM comment WHERE UserID = :userId', $parameters);
        return $result->fetch()['count'];
    }

    function getUserByUsername($pdo, $username) {
        $parameters = [':username' => $username];
        $query = query($pdo, 'SELECT * FROM user WHERE username = :username', $parameters);
        return $query->fetch();
    }
    
    function getUserById($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT * FROM user WHERE UserID = :id', $parameters);
        return $query->fetch();
    }
    
    function formatDate($dateString) {
        if (empty($dateString)) return 'Unknown';
        $date = new DateTime($dateString);
        return $date->format('F j, Y');
    }

    // module FUNCTION =================================================================================================

    function allModules($pdo){
        $Modules = query($pdo, 'SELECT * FROM modules');
        return $Modules->fetchAll();
    }

    // feedback FUNCTION ================================================================================================

    function saveFeedback($pdo, $title, $content, $email, $userId) {
        $query = 'INSERT INTO feedback (title, content, email, createdAt, UserID) 
                 VALUES (:title, :content, :email, NOW(), :userId)';
        $parameters = [
            ':title' => $title,
            ':content' => $content, 
            ':email' => $email,
            ':userId' => $userId
        ];
        
        return query($pdo, $query, $parameters);
    }
    
    function getUserFeedback($pdo, $userId) {
        $parameters = [':userId' => $userId];
        $query = query($pdo, 'SELECT * FROM feedback WHERE UserID = :userId ORDER BY createdAt DESC', $parameters);
        return $query->fetchAll();
    }

    function getAllFeedback($pdo) {
        $query = query($pdo, 'SELECT f.*, u.username FROM feedback f 
                             INNER JOIN user u ON f.UserID = u.UserID 
                             ORDER BY f.createdAt DESC');
        return $query->fetchAll();
    }

    function deleteFeedback($pdo, $feedbackId) {
        $parameters = [':feedbackId' => $feedbackId];
        return query($pdo, 'DELETE FROM feedback WHERE feedbackID = :feedbackId', $parameters);
    }
    
    function markFeedbackResolved($pdo, $feedbackId) {
        // Check if status column exists in feedback table
        try {
            // First check if column exists
            $result = $pdo->query("SHOW COLUMNS FROM feedback LIKE 'status'");
            
            if ($result->rowCount() == 0) {
                // Add status column if it doesn't exist
                $pdo->exec("ALTER TABLE feedback ADD COLUMN status VARCHAR(20) DEFAULT 'open'");
            }
            
            // Mark as resolved
            $parameters = [':feedbackId' => $feedbackId];
            return query($pdo, "UPDATE feedback SET status = 'resolved' WHERE feedbackID = :feedbackId", $parameters);
        } catch (Exception $e) {
            error_log('Error marking feedback as resolved: ' . $e->getMessage());
            throw new Exception('Unable to mark feedback as resolved');
        }
    }

    // session FUNCTION ================================================================================================

    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    function getCurrentUser($pdo) {
        if (isLoggedIn()) {
            $params = [':id' => $_SESSION['user_id']];
            $query = query($pdo, 'SELECT * FROM user WHERE userid = :id', $params);
            return $query->fetch();
        }
        return false;
    }

    function requireLogin() {
        if (!isLoggedIn()) {
            header('Location: /coursework/models/login.php');
            exit();
        }
    }
    
?>