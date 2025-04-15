<div class="post-form-page">
    <h1>Support</h1>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="form-success"><?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="form-error"><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <form class="post-form" method="post" action="">
        <div class="form-group">
            <label for="email">Your email (Optional)</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control" 
                placeholder="Your email"
                value="<?= isset($email) ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : '' ?>"
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
                value="<?= isset($feedbackTitle) ? htmlspecialchars($feedbackTitle, ENT_QUOTES, 'UTF-8') : '' ?>"
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
            ><?= isset($content) ? htmlspecialchars($content, ENT_QUOTES, 'UTF-8') : '' ?></textarea>
        </div>
        
        <div class="form-actions">
            <a href="/coursework/index.php" class="form-cancel">Cancel</a>
            <button type="submit" name="save" class="form-submit">Submit</button>
        </div>
    </form>
</div>