<div class="auth-page">
    <h1>Sign Up</h1>
    
    <?php if (isset($error) && !empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="/coursework/models/register.php" method="post" class="auth-form">
        <div class="form-group">
            <label for="username">Username</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                class="form-control" 
                value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                required
                autofocus
            >
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control" 
                required
            >
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input 
                type="password" 
                id="confirm_password" 
                name="confirm_password" 
                class="form-control" 
                required
            >
        </div>
        
        <div class="form-group">
            <button type="submit" name="register" class="form-submit">Sign Up</button>
        </div>
        
        <div class="form-group text-center">
            <p>Already have an account? <a href="/coursework/models/login.php">Log in</a></p>
        </div>
    </form>
</div>