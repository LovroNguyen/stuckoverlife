<div class="post-form-page">
    <h1><?= isset($post) ? 'Edit Post' : 'Create New Post' ?></h1>
    
    <?php if (isset($error) && !empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="<?= isset($post) ? '/coursework/controllers/postController.php?id=' . $post['PostID'] . '&action=edit' 
                                    : '/coursework/createPost.php' 
                    ?>" method="post" class="post-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-control" 
                value="<?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
                autofocus
                placeholder="e.g., How to fix this JavaScript error?"
            >
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea 
                id="content" 
                name="content" 
                class="form-control" 
                required
                placeholder="Describe your problem in detail..."
            ><?= htmlspecialchars($post['content'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="module">Module</label>
            <select id="module" name="module" class="form-control" required>
                <option value="">Select a module</option>
                <?php foreach ($modules as $module): ?>
                    <option 
                        value="<?= htmlspecialchars($module['ModuleID'], ENT_QUOTES, 'UTF-8') ?>"
                        <?= (isset($post) && $post['ModuleID'] == $module['ModuleID']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Display existing images with delete options -->
        <?php if (isset($post['images']) && !empty($post['images'])): ?>
            <div class="form-group">
                <label>Current Images</label>
                <div class="current-images">
                    <?php foreach ($post['images'] as $image): ?>
                        <div class="image-item">
                            <img src="/coursework/uploads/<?= htmlspecialchars($image['mediaKey'], ENT_QUOTES, 'UTF-8') ?>" 
                                 width="100" alt="Post image">
                            <a href="/coursework/controllers/postController.php?id=<?= $post['PostID'] ?>&action=edit&delete_image=<?= $image['AssetID'] ?>" 
                               class="delete-image-link" 
                               onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="images">Add Images (optional)</label>
            <input 
                type="file" 
                id="images" 
                name="images[]" 
                class="form-control" 
                accept="image/*"
                multiple
            >
            <small>You can select multiple images</small>
        </div>
        
        <div class="form-actions">
            <a href="<?= isset($post) ? '/coursework/posts.php?id=' . $post['PostID'] : '/coursework/index.php' ?>" class="form-cancel">Cancel</a>
            <button type="submit" name="save" class="form-submit">
                <?= isset($post) ? 'Update Post' : 'Create Post' ?>
            </button>
        </div>
    </form>
</div>

<style>
.current-images {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
}
.image-item {
    border: 1px solid #dee0e1;
    border-radius: 4px;
    padding: 5px;
    position: relative;
}
.delete-image-link {
    display: block;
    text-align: center;
    margin-top: 5px;
    color: #d1383d;
    font-size: 12px;
    text-decoration: none;
}
.delete-image-link:hover {
    text-decoration: underline;
}
</style>