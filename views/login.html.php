<div class="auth-page">
    <h1>Log In</h1>
    
    <?php if (isset($error) && !empty($error)): ?>
        <div class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <?php if (isset($success) && !empty($success)): ?>
        <div class="form-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    
    <form action="/coursework/models/login.php" method="post" class="auth-form">
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
            <button type="submit" name="login" class="form-submit">Log In</button>
        </div>
        
        <div class="form-group text-center">
            <p>Don't have an account? <a href="/coursework/models/register.php">Sign up</a></p>
        </div>
    </form>
</div>