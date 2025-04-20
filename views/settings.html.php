<div class="admin-settings">
    <h1>Admin Settings</h1>
    
    <?php if (!empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="form-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <!-- Admin navigation tabs -->
    <div class="admin-tabs">
        <a href="?tab=users" class="admin-tab <?= $activeTab === 'users' ? 'active' : '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="tab-icon" viewBox="0 0 24 24" width="16" height="16">
                <path d="M12,17a4,4,0,1,1,4-4A4,4,0,0,1,12,17Zm6,4a3,3,0,0,0-3-3H9a3,3,0,0,0-3,3v3H18ZM18,8a4,4,0,1,1,4-4A4,4,0,0,1,18,8ZM6,8a4,4,0,1,1,4-4A4,4,0,0,1,6,8Zm0,5A5.968,5.968,0,0,1,7.537,9H3a3,3,0,0,0-3,3v3H6.349A5.971,5.971,0,0,1,6,13Zm11.651,2H24V12a3,3,0,0,0-3-3H16.463a5.952,5.952,0,0,1,1.188,6Z"/>
            </svg>
            Users
        </a>
        <a href="?tab=modules" class="admin-tab <?= $activeTab === 'modules' ? 'active' : '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="tab-icon" viewBox="0 0 24 24" width="16" height="16">
                <path d="m14.011,8.5c0,.829.672,1.5,1.5,1.5s1.5-.671,1.5-1.5v-1.714c0-1.611-.869-3.108-2.268-3.907l-3.999-2.286c-1.377-.787-3.088-.788-4.466,0L2.278,2.879C.879,3.678.011,5.175.011,6.786v5.428c0,1.611.869,3.108,2.268,3.907l4,2.286c.674.385,1.446.59,2.222.593.826,0,1.497-.668,1.5-1.494,0-.009,0-6.955,0-6.955l4.011-2.268v.217Zm-7.011,6.864l-3.233-1.848c-.466-.267-.756-.766-.756-1.303v-3.918l3.989,2.257v4.811Zm1.498-7.411l-4.549-2.574,3.818-2.181c.459-.263,1.029-.263,1.488,0l3.806,2.175-4.564,2.581Zm14.082,10.748l-.663-.383c.049-.266.083-.538.083-.818s-.033-.552-.083-.818l.663-.383c.718-.414.963-1.332.549-2.049-.414-.719-1.333-.963-2.049-.549l-.676.39c-.413-.352-.884-.629-1.404-.815v-.776c0-.829-.672-1.5-1.5-1.5s-1.5.671-1.5,1.5v.776c-.521.186-.992.463-1.404.815l-.676-.39c-.717-.415-1.634-.17-2.049.549-.415.717-.168,1.635.549,2.049l.663.383c-.049.266-.083.538-.083.818s.033.552.083.818l-.663.383c-.717.414-.963,1.332-.549,2.049.278.481.782.75,1.3.75.255,0,.513-.065.749-.202l.676-.39c.413.352.884.629,1.404.815v.776c0,.829.672,1.5,1.5,1.5s1.5-.671,1.5-1.5v-.776c.521-.186.992-.463,1.404-.815l.676.39c.236.137.494.202.749.202.518,0,1.022-.269,1.3-.75.414-.717.169-1.635-.549-2.049Zm-5.08.299c-.827,0-1.5-.673-1.5-1.5s.673-1.5,1.5-1.5,1.5.673,1.5,1.5-.673,1.5-1.5,1.5Z"/>
            </svg>
            Modules
        </a>
        <a href="?tab=posts" class="admin-tab <?= $activeTab === 'posts' ? 'active' : '' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="tab-icon" viewBox="0 0 24 24" width="16" height="16">
                <path d="M.1,6C.57,3.72,2.59,2,5,2h14c2.41,0,4.43,1.72,4.9,4H.1Zm23.9,2v9c0,2.76-2.24,5-5,5H5c-2.76,0-5-2.24-5-5V8H24Zm-14,4c0-.55-.45-1-1-1H5c-.55,0-1,.45-1,1s.45,1,1,1h1v4c0,.55,.45,1,1,1s1-.45,1-1v-4h1c.55,0,1-.45,1-1Zm10,4c0-.55-.45-1-1-1h-6c-.55,0-1,.45-1,1s.45,1,1,1h6c.55,0,1-.45,1-1Zm0-4c0-.55-.45-1-1-1h-6c-.55,0-1,.45-1,1s.45,1,1,1h6c.55,0,1-.45,1-1Z"/>
            </svg>
            Posts
        </a>
    </div>
    
    <!-- Tab content -->
    <div class="admin-tab-content">
        
        <!-- Users tab -->
        <?php if ($activeTab === 'users'): ?>
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2><?= $editUser ? 'Edit User' : 'Add New User' ?></h2>
                </div>
                
                <form method="post" class="admin-form">
                    <input type="hidden" name="action" value="<?= $editUser ? 'edit_user' : 'add_user' ?>">
                    <?php if ($editUser): ?>
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($editUser['UserID'], ENT_QUOTES, 'UTF-8') ?>">
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username" 
                                value="<?= htmlspecialchars($editUser['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password"><?= $editUser ? 'New Password (leave blank to keep current)' : 'Password *' ?></label>
                            <input type="password" id="password" name="password" 
                                <?= $editUser ? '' : 'required' ?>>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" 
                                value="<?= htmlspecialchars($editUser['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" 
                                value="<?= htmlspecialchars($editUser['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role">
                            <option value="user" <?= (isset($editUser) && $editUser['role'] === 'user') ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= (isset($editUser) && $editUser['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <?php if ($editUser): ?>
                            <a href="/coursework/models/settings.php?tab=users" class="form-cancel">Cancel</a>
                        <?php endif; ?>
                        <button type="submit" class="form-submit"><?= $editUser ? 'Update User' : 'Add User' ?></button>
                    </div>
                </form>
                
                <div class="admin-section-header">
                    <h2>User List</h2>
                </div>
                
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="6" class="empty-table">No users found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['UserID'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <div class="user-cell">
                                                <img src="/coursework/assets/images/random_pfp/<?= htmlspecialchars($user['avatar'], ENT_QUOTES, 'UTF-8') ?>" 
                                                     alt="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" 
                                                     class="user-avatar small">
                                                <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>
                                        <td>
                                            <span class="user-role <?= $user['role'] ?>">
                                                <?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </td>
                                        <td><?= formatDate($user['createdAt']) ?></td>
                                        <td class="actions-cell">
                                            <a href="?tab=users&edit_user=<?= $user['UserID'] ?>" class="edit-link">Edit</a>
                                            <?php if ($user['UserID'] != $_SESSION['user_id']): ?>
                                                <form method="post" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    <input type="hidden" name="action" value="delete_user">
                                                    <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                                                    <button type="submit" class="delete-link">Delete</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Modules tab -->
        <?php if ($activeTab === 'modules'): ?>
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2><?= $editModule ? 'Edit Module' : 'Add New Module' ?></h2>
                </div>
                
                <form method="post" class="admin-form">
                    <input type="hidden" name="action" value="<?= $editModule ? 'edit_module' : 'add_module' ?>">
                    <?php if ($editModule): ?>
                        <input type="hidden" name="module_id" value="<?= htmlspecialchars($editModule['ModuleID'], ENT_QUOTES, 'UTF-8') ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="module_name">Module Name *</label>
                        <input type="text" id="module_name" name="module_name" 
                            value="<?= htmlspecialchars($editModule['moduleName'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                            required>
                    </div>
                    
                    <div class="form-actions">
                        <?php if ($editModule): ?>
                            <a href="/coursework/models/settings.php?tab=modules" class="form-cancel">Cancel</a>
                        <?php endif; ?>
                        <button type="submit" class="form-submit"><?= $editModule ? 'Update Module' : 'Add Module' ?></button>
                    </div>
                </form>
                
                <div class="admin-section-header">
                    <h2>Module List</h2>
                </div>
                
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Module Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($modules)): ?>
                                <tr>
                                    <td colspan="3" class="empty-table">No modules found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($modules as $module): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($module['ModuleID'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="actions-cell">
                                            <a href="?tab=modules&edit_module=<?= $module['ModuleID'] ?>" class="edit-link">Edit</a>
                                            <form method="post" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this module?');">
                                                <input type="hidden" name="action" value="delete_module">
                                                <input type="hidden" name="module_id" value="<?= $module['ModuleID'] ?>">
                                                <button type="submit" class="delete-link">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Posts tab -->
        <?php if ($activeTab === 'posts'): ?>
            <div class="admin-section">
                <div class="admin-section-header">
                    <h2>Post Management</h2>
                </div>
                
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Module</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($posts)): ?>
                                <tr>
                                    <td colspan="5" class="empty-table">No posts found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($posts as $post): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($post['PostID'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <a href="/coursework/models/posts.php?id=<?= $post['PostID'] ?>" class="post-link">
                                                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
                                            </a>
                                        </td>
                                        <td><?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <button type="button" class="edit-link" 
                                                    onclick="showReassignModal(<?= $post['PostID'] ?>, '<?= htmlspecialchars(addslashes($post['title']), ENT_QUOTES, 'UTF-8') ?>')">
                                                Reassign
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Reassign Post Modal -->
            <div id="reassignModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeReassignModal()">&times;</span>
                    <h2>Reassign Post</h2>
                    <p id="reassignPostTitle"></p>
                    
                    <form method="post" class="admin-form">
                        <input type="hidden" name="action" value="reassign_post">
                        <input type="hidden" name="post_id" id="reassignPostId">
                        
                        <div class="form-group">
                            <label for="user_id">Assign to User</label>
                            <select id="user_id" name="user_id" required>
                                <option value="">Select User</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['UserID'] ?>">
                                        <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="module_id">Assign to Module</label>
                            <select id="module_id" name="module_id" required>
                                <option value="">Select Module</option>
                                <?php foreach ($modules as $module): ?>
                                    <option value="<?= $module['ModuleID'] ?>">
                                        <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="form-cancel" onclick="closeReassignModal()">Cancel</button>
                            <button type="submit" class="form-submit">Reassign Post</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Modal functions
function showReassignModal(postId, postTitle) {
    document.getElementById('reassignModal').style.display = 'block';
    document.getElementById('reassignPostId').value = postId;
    document.getElementById('reassignPostTitle').textContent = 'Post: ' + postTitle;
}

function closeReassignModal() {
    document.getElementById('reassignModal').style.display = 'none';
}

// Close modal if user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById('reassignModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>