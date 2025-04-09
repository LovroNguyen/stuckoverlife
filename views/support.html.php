<div class="post-form-page">
    <h1>Support</h1>
    
    <?php if (isset($error) && !empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form class="post-form">
        <div class="form-group">
            <label for="email">Your email (Optional)</label>
            <input 
                type="text" 
                id="email" 
                name="email" 
                class="form-control" 
                placeholder="Your email"
            >
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-control" 
                required
                autofocus
                placeholder="Enter at least 5 characters"
            >
        </div>
        
        <div class="form-group">
            <label for="content">Please describe your problem</label>
            <textarea 
                id="content" 
                name="content" 
                class="form-control" 
                required
                placeholder="Enter at least 15 characters"
            ></textarea>
        </div>
        
        <div class="form-actions">
            <a href="/coursework/index.php" class="form-cancel">Cancel</a>
            <button type="submit" name="save" class="form-submit">Submit</button>
        </div>
    </form>
</div>
