<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lovro Nguyen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/coursework/style.css">
    <link rel="shortcut icon" href="/coursework/assets/images/favicon.ico" type="image/x-icon">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/coursework/index.php" class="header-logo">
                <img src="/coursework/assets/images/logo.svg" alt="Logo" title="Home">
            </a>
            <div class="header-search">
                <input type="text" placeholder="Search something...">
            </div>
            <nav class="header-nav">
                <a href="/coursework/createPost.php" class="create-post-button">
                    Create Post
                </a>
                
                <?php if(isLoggedIn()):?>
                        <?php 
                        $currentUser = getCurrentUser($pdo);
                        $avatar = isset($currentUser['avatar']) ? htmlspecialchars($currentUser['avatar'], ENT_QUOTES, 'UTF-8') : "random_pfp";
                        ?>
                        <img class="user-avatar" height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar" onclick="toggleSubMenu()">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="sub-menu-item">
                                    <img height="40px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                                    <h3><?= htmlspecialchars($currentUser['username'] ?? 'Anonymous User', ENT_QUOTES, 'UTF-8') ?></h3>
                                </div>
                                <hr>
                                <a href="#" class="sub-menu-link">
                                    <img style="background-position: 0px -419px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;" src="/coursework/assets/images/profile.png" alt="profile">
                                    <p>Profile</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                                <?php if(isAdmin()):?>
                                    <a href="#" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yf/r/N1cx5zPsD4a.png&quot;); background-position: 0px -419px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>                                    
                                    <p>Settings</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                                <?php endif; ?>
                                <a href="/coursework/support.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/y9/r/SRMpAnW50Ui.png&quot;); background-position: 0px -193px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>
                                    <p>Help & Support</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                                <a href="/coursework/logout.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yT/r/uUd4Xa0YZdV.png&quot;); background-position: 0px -340px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>                                    
                                    <p>Log Out</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                            </div>
                        </div>
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
                    <h3>Quote of the day</h3>
                    <p>"The only way to do great work is to love what you do." </br>- Steve Jobs</p>
                <?php else: ?>
                    <p>Welcome to Stuck Overlife!</p>
                    <p>Please <a href="/coursework/login.php">log in</a> or <a href="/coursework/register.php">sign up</a> to post questions and answers.</p>
                <?php endif; ?>
            </div>
        </aside>
    </div>

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

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleSubMenu() {
        subMenu.classList.toggle("open-menu");
    }
</script>
</body>
</html>