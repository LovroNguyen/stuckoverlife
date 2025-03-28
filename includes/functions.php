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

    function createPost($pdo, $title, $content, $userid, $moduleid) {
        $query = 'INSERT INTO posts (title, content, createdAt, userid, moduleid) VALUES (:title, :content, CURDATE(), :userid, :moduleid)';
        $parameters = [':title' => $title, ':content' => $content, ':userid' => $userid, ':moduleid' => $moduleid];
        query($pdo, $query, $parameters);
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

    function updateComment($pdo, $commentId, $content) {
        try {
            $query = 'UPDATE comment SET content = :content, updatedAt = NOW() WHERE CommentID = :commentId';
            $parameters = [':commentId' => $commentId, ':content' => $content];
            
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($parameters);
            
            // Add detailed error logging
            if (!$result) {
                error_log('Comment Update Failed: ' . print_r($stmt->errorInfo(), true));
                error_log('Comment ID: ' . $commentId);
                error_log('New Content: ' . $content);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log('Comment Update Exception: ' . $e->getMessage());
            return false;
        }
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
    // user FUNCTION ===================================================================================================

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
        
    }

    function getUserByPost($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT u.* FROM user u
                              INNER JOIN posts p ON u.UserID = p.UserID
                              WHERE p.PostID = :id', $parameters);
        return $query->fetch();
    }

    // module FUNCTION =================================================================================================

    function allModules($pdo){
        $Modules = query($pdo, 'SELECT * FROM modules');
        return $Modules->fetchAll();
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
            header('Location: login.php');
            exit();
        }
    }
    
?>