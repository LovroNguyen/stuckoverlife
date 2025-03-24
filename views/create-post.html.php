<div class="post-form-page">
    <h1><?= isset($post) ? 'Edit Post' : 'Create New Post' ?></h1>
    
    <?php if (isset($error) && !empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="<?= isset($post) ? '/coursework/posts.php?id=' . $post['PostID'] . '&action=edit' : '/coursework/create-post.php' ?>" method="post" class="post-form" enctype="multipart/form-data">
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
        
        <div class="form-group">
            <label for="image">Image (optional)</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="form-control" 
                accept="image/*"
            >
            <?php if (isset($post) && !empty($post['image'])): ?>
                <p>Current image: <?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
        </div>
        
        <div class="form-actions">
            <a href="/coursework/index.php" class="form-cancel">Cancel</a>
            <button type="submit" name="save" class="form-submit">
                <?= isset($post) ? 'Update Post' : 'Create Post' ?>
            </button>
        </div>
    </form>
</div>