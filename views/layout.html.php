<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/coursework/style.css">
    <link rel="shortcut icon" href="/coursework/assets/images/favicon.ico" type="image/x-icon">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<script>
        // Toggle dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.closest('.dropdown');
                    dropdown.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function() {
                    const dropdowns = document.querySelectorAll('.dropdown');
                    dropdowns.forEach(function(dropdown) {
                        if (dropdown.classList.contains('show')) {
                            dropdown.classList.remove('show');
                        }
                    });
                });
            }
        });
    </script>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="/coursework/index.php" class="header-logo">
                <img src="/coursework/assets/images/logo.svg" alt="Logo" title="Home">
            </a>
            <div class="header-search">
                <input type="text" placeholder="Search something...">
            </div>
            <nav class="header-nav">
                <a href="/coursework/create-post.php" class="create-post-button">
                    Create Post
                </a>
                
                <?php if(isLoggedIn()):?>
                    <a href="#" class="header-nav-item">
                        <div class="user-avatar">
                            <?php 
                            $currentUser = getCurrentUser($pdo);
                            $avatar = isset($currentUser['avatar']) ? htmlspecialchars($currentUser['avatar'], ENT_QUOTES, 'UTF-8') : "random_pfp";
                            ?>
                            <img height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                        </div>
                    </a>
                <?php else:?>
                    <a href="/coursework/login.php" class="login-button">Log in</a>
                    <a href="/coursework/register.php" class="signup-button">Sign up</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <main class="main-content">
            <?= $output ?>
        </main>
        
        <aside class="sidebar">
            <div class="sidebar-widget">
                <?php if(isLoggedIn()): ?>
                    <h3>Welcome, <?= htmlspecialchars($currentUser['username'], ENT_QUOTES, 'UTF-8') ?>!</h3>
                    <p>What would you like to do today?</p>
                    <a href="#" class="button">Profile</a> <br>
                    <?php if(isAdmin()):?>
                        <a href="#" class="button">Dash board</a> <br>
                    <?php endif; ?>
                    <a href="/coursework/logout.php" class="button">Log out</a>
                <?php else: ?>
                    <p>Welcome to Stuck Overlife!</p>
                    <p>Please <a href="/coursework/login.php">log in</a> or <a href="/coursework/register.php">sign up</a> to post questions and answers.</p>
                <?php endif; ?>
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="#" class="footer-link">About</a>
            <a href="#" class="footer-link">Privacy</a>
            <a href="#" class="footer-link">Terms</a>
            <a href="#" class="footer-link">Contact</a>
        </div>
        <div class="footer-copyright">
            © 2025 Stuck Overlife, Inc. None of rights reserved.
        </div>
    </footer>
</body>
</html>