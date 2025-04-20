<?php
session_start();
try {
    include '../includes/db.php';
    include '../includes/functions.php';
    
    // Check if user is admin, redirect if not
    requireAdmin();
    
    $title = 'Admin Settings';
    $error = '';
    $success = '';
    
    // Get active tab from query string or default to 'users'
    $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'users';
    
    // Handle form submissions based on action
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // User management actions
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add_user':
                    try {
                        $username = trim($_POST['username']);
                        $password = $_POST['password'];
                        $firstname = trim($_POST['firstname'] ?? '');
                        $lastname = trim($_POST['lastname'] ?? '');
                        $role = $_POST['role'] ?? 'user';
                        
                        if (empty($username) || empty($password)) {
                            throw new Exception('Username and password are required');
                        }
                        
                        addUser($pdo, $username, $password, $firstname, $lastname, '', $role);
                        $success = 'User added successfully';
                        $activeTab = 'users';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'users';
                    }
                    break;
                    
                case 'edit_user':
                    try {
                        $userId = $_POST['user_id'];
                        $username = trim($_POST['username']);
                        $firstname = trim($_POST['firstname'] ?? '');
                        $lastname = trim($_POST['lastname'] ?? '');
                        $role = $_POST['role'] ?? 'user';
                        $password = !empty($_POST['password']) ? $_POST['password'] : null;
                        
                        if (empty($username)) {
                            throw new Exception('Username is required');
                        }
                        
                        updateUser($pdo, $userId, $username, $firstname, $lastname, '', $role, $password);
                        $success = 'User updated successfully';
                        $activeTab = 'users';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'users';
                    }
                    break;
                    
                case 'delete_user':
                    try {
                        $userId = $_POST['user_id'];
                        
                        // Prevent deleting self
                        if ($userId == $_SESSION['user_id']) {
                            throw new Exception('You cannot delete your own account');
                        }
                        
                        deleteUser($pdo, $userId);
                        $success = 'User deleted successfully';
                        $activeTab = 'users';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'users';
                    }
                    break;
                    
                case 'add_module':
                    try {
                        $moduleName = trim($_POST['module_name']);
                        
                        if (empty($moduleName)) {
                            throw new Exception('Module name is required');
                        }
                        
                        addModule($pdo, $moduleName);
                        $success = 'Module added successfully';
                        $activeTab = 'modules';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'modules';
                    }
                    break;
                    
                case 'edit_module':
                    try {
                        $moduleId = $_POST['module_id'];
                        $moduleName = trim($_POST['module_name']);
                        
                        if (empty($moduleName)) {
                            throw new Exception('Module name is required');
                        }
                        
                        updateModule($pdo, $moduleId, $moduleName);
                        $success = 'Module updated successfully';
                        $activeTab = 'modules';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'modules';
                    }
                    break;
                    
                case 'delete_module':
                    try {
                        $moduleId = $_POST['module_id'];
                        deleteModule($pdo, $moduleId);
                        $success = 'Module deleted successfully';
                        $activeTab = 'modules';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'modules';
                    }
                    break;
                    
                case 'reassign_post':
                    try {
                        $postId = $_POST['post_id'];
                        $userId = $_POST['user_id'];
                        $moduleId = $_POST['module_id'];
                        
                        reassignPost($pdo, $postId, $userId, $moduleId);
                        $success = 'Post reassigned successfully';
                        $activeTab = 'posts';
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                        $activeTab = 'posts';
                    }
                    break;
            }
        }
    }
    
    // Get data for each tab
    $users = AllUsers($pdo);
    $modules = allModules($pdo);
    $posts = getPostBasicInfo($pdo);
    
    // Edit mode handling
    $editUser = null;
    $editModule = null;
    
    if (isset($_GET['edit_user'])) {
        $editUser = getUserById($pdo, $_GET['edit_user']);
        $activeTab = 'users';
    }
    
    if (isset($_GET['edit_module'])) {
        $moduleId = $_GET['edit_module'];
        $moduleParams = [':id' => $moduleId];
        $query = query($pdo, 'SELECT * FROM modules WHERE ModuleID = :id', $moduleParams);
        $editModule = $query->fetch();
        $activeTab = 'modules';
    }
    
    // Pass variables to view and display
    ob_start();
    include '../views/settings.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include '../views/layout.html.php';
?>