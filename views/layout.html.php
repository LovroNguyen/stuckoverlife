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
<body class="<?= $pageType ?? '' ?>">
    <header>
        <div class="header-container">
            <a href="/coursework/index.php" class="header-logo">
                <img src="/coursework/assets/images/logo.svg" alt="Logo" title="Home">
            </a>
            <div class="header-search">
                <form action="/coursework/index.php" method="get" class="header-search-form">
                    <input type="text" name="search" placeholder="Search something..." 
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
                    <button type="submit" class="search-icon">
                        <svg aria-hidden="true" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z" fill="currentColor"></path>
                        </svg>
                    </button>
                </form>
            </div>
            <nav class="header-nav">
                <a href="/coursework/models/createPost.php" class="create-post-button">
                    Create Post
                </a>
                
                <?php if(isLoggedIn()):?>
                        <?php 
                        $currentUser = getCurrentUser($pdo);
                        $avatar = isset($currentUser['avatar']) ? htmlspecialchars($currentUser['avatar'], ENT_QUOTES, 'UTF-8') : "random_pfp";
                        ?>
                        <img class="user-avatar avatar-button" height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar" onclick="toggleSubMenu()">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="sub-menu-item">
                                    <img height="40px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                                    <h3><?= htmlspecialchars($currentUser['username'] ?? 'Anonymous User', ENT_QUOTES, 'UTF-8') ?></h3>
                                </div>
                                <hr>
                                <a href="/coursework/models/profile.php?user_id=<?= $_SESSION['user_id'] ?>" class="sub-menu-link">
                                    <img style="background-position: 0px -419px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;" src="/coursework/assets/images/profile.png" alt="profile">
                                    <p>Profile</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                                <?php if(isAdmin()):?>
                                    <a href="/coursework/models/settings.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yf/r/N1cx5zPsD4a.png&quot;); background-position: 0px -419px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>                                    
                                    <p>Settings</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                    </a>
                                    <a href="/coursework/controllers/feedbackController.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="x1b0d499 xep6ejk" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yT/r/uUd4Xa0YZdV.png&quot;); background-position: 0px -67px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>                                    
                                    <p>Feedbacks</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="/coursework/models/support.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/y9/r/SRMpAnW50Ui.png&quot;); background-position: 0px -193px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>
                                    <p>Help & Support</p>
                                    <i data-visualcompletion="css-img" class="point-right-arrow" aria-hidden="true" style="margin-left: auto;font-size: 22px;background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yU/r/ETqWQ46BPZV.png&quot;); background-position: 0px -50px; background-size: auto; width: 24px; height: 24px; background-repeat: no-repeat; display: inline-block;"></i>
                                </a>
                                <a href="/coursework/models/logout.php" class="sub-menu-link">
                                    <i data-visualcompletion="css-img" class="sub-menu-link-icon" aria-hidden="true" style="background-image: url(&quot;https://static.xx.fbcdn.net/rsrc.php/v4/yT/r/uUd4Xa0YZdV.png&quot;); background-position: 0px -340px; background-size: auto; width: 20px; height: 20px; background-repeat: no-repeat; display: inline-block;"></i>                                    
                                    <p>Log Out</p>
                                </a>
                            </div>
                        </div>
                <?php else:?>
                    <a href="/coursework/models/login.php" class="login-button">Log in</a>
                    <a href="/coursework/models/register.php" class="signup-button">Sign up</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <main class="main-content">
            <div class="main-content-welcome">
                <?php if(isset($_GET['search']) && !empty($_GET['search']) && isset($pageType) && $pageType === 'home-page'): ?>
                    <div class="main-container-welcome-text">
                        <p>Search Results</p>
                        <span>Results for <?= htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                <?php elseif(!isLoggedIn() && isset($pageType) && $pageType === 'home-page'): ?>
                    <p>Newest Questions</p>
                <?php elseif(isset($pageType) && $pageType === 'home-page'): ?>
                    <svg aria-hidden="true" class="wave" width="48" height="48" viewBox="0 0 48 48">
                        <path d="M37.96 1.57c.67-.34 1.5-.07 1.84.6l5.42 10.75a1.37 1.37 0 1 1-2.46 1.23L37.35 3.41c-.34-.67-.07-1.5.6-1.84m-3.2 5.9c.69-.31 1.5 0 1.81.69l2.32 5.15a1.37 1.37 0 0 1-2.5 1.13L34.06 9.3c-.31-.7 0-1.5.69-1.82M6.87 35.3a1.37 1.37 0 0 1 1.94-.06l4.64 4.39a1.37 1.37 0 1 1-1.89 2l-4.64-4.39a1.37 1.37 0 0 1-.05-1.94m-5.21 2.38a1.37 1.37 0 0 1 1.94-.06l8.34 7.82a1.37 1.37 0 1 1-1.88 2l-8.34-7.81a1.37 1.37 0 0 1-.06-1.95m14.72-.75c3.22 4.1 7.62 9.71 13.93 9.71q2.77 0 5.65-1.47c5.71-2.92 6.97-6.96 8.55-12.07l.28-.9c1.46-4.67 2.44-8.4 2.7-9.44.56-1.8-.53-3.64-2.43-4.16a3.8 3.8 0 0 0-2.7.27 3.3 3.3 0 0 0-1.7 1.97l-1.82 6.27a.3.3 0 0 1-.25.2q-.2-.04-.27-.17L28.18 4.31c-.9-1.52-2.62-2.05-4.05-1.32-1.52.78-1.85 2.05-1 3.9.87 1.87 5.02 13.3 5.71 15.3q.07.24-.12.35c-.18.07-.3 0-.37-.1L17.9 5.56a2.9 2.9 0 0 0-3.83-1.08c-.67.34-1.13.9-1.32 1.56a2.6 2.6 0 0 0 .3 2.02l9.7 16.55q.1.2-.09.34c-.19.1-.28.04-.37-.06l-9.9-12.16c-.55-.64-1.45-1.4-2.65-1.4q-.72 0-1.42.35-.9.46-1.1 1.33c-.18.71.06 1.55.64 2.3.81 1.06 8.66 11.99 10.22 14.17l.05.06c.07.1.05.25-.05.33a.3.3 0 0 1-.36.01l-9.66-7.57a4 4 0 0 0-2.4-.94q-.64 0-1.23.3c-.35.17-.62.58-.73 1.08-.11.54-.02 1.09.25 1.56.57.97 2.47 2.68 4.49 4.49 2.24 2 4.78 4.28 6.61 6.46.39.46.8.98 1.34 1.67" class="wave-opacity" fill="currentColor"></path>
                        <path d="m11.76 34.62.49.58 2.06 2.56.62.74c4.55 5.47 7.93 7.85 12.87 7.85q3.01 0 6.1-1.58c4.66-2.38 6.58-5.1 8.47-10.81l.58-1.86.43-1.4c1.05-3.4 1.86-6.22 2.57-8.98a4.3 4.3 0 0 0-3.14-5.37l-.21-.06a4.6 4.6 0 0 0-5.41 2.96l-1.27 4.39L26.58 2.6l-.05-.1C25.36.55 23.08-.18 21.16.8c-1.97 1-2.48 2.79-1.55 4.99l.15.32c.4.9 1.56 3.97 2.75 7.18l.53 1.44-6.81-11C15.18 1.97 13 1.5 11.2 2.38l-.18.08c-1.77.95-2.48 2.92-1.36 4.83l4.89 8.33-3.91-4.8A4.5 4.5 0 0 0 7.2 9.04c-3.07 0-4.47 3.05-2.78 5.45l1.7 2.33 3.51 4.86 2.14 2.97-5.63-4.41a5 5 0 0 0-3.02-1.16 2.91 2.91 0 0 0-2.57 4.44l.11.18c.5.77 1.38 1.66 3.25 3.37l3.5 3.16.7.65q1.01.93 1.83 1.77 1.04 1.05 1.81 1.97m4.1 1.88-1.89-2.35-.68-.82a36 36 0 0 0-1.92-2.1l-.59-.57q-.75-.74-1.64-1.57l-1.89-1.7-1.74-1.58c-1.99-1.8-2.87-2.7-3.22-3.3-.41-.7.01-1.43.84-1.43.58 0 1.2.28 1.78.73l9.67 7.57c.55.44 1.31.35 1.75-.17.37-.46.4-1.13.02-1.62L7.1 14.72l-.96-1.3c-.88-1.15-.34-2.38 1.08-2.38.68 0 1.33.39 1.89 1.05L19 24.24c.43.51 1.12.58 1.64.28.57-.34.82-1.07.45-1.7l-9.7-16.55c-.53-.9-.23-1.67.67-2.1.94-.45 1.96-.23 2.45.61L25 21.68c.8 1.3 2.77.33 2.28-1.1l-.57-1.64a378 378 0 0 0-5.17-13.76c-.64-1.39-.47-2.08.54-2.6l.15-.06c.87-.36 1.87-.04 2.5.86l.06.1L34.9 26.26c.47 1.06 2.07.97 2.4-.16l1.81-6.27c.38-1.2 1.84-1.92 3.18-1.55 1.37.37 2.13 1.66 1.74 2.9l-.29 1.1c-.58 2.23-1.24 4.53-2.05 7.17l-.96 3.1-.25.76C38.74 38.58 37.1 40.9 33 43q-2.68 1.36-5.2 1.36c-4.35 0-7.41-2.29-11.93-7.85" fill="currentColor"></path>
                    </svg>
                    <div class="main-container-welcome-text">
                        <p>Welcome back, <?= htmlspecialchars($currentUser['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($currentUser['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>!</p>
                        <span>Find answers to your questions and help others answer theirs.</span> 
                    </div>                
                <?php endif; ?>
            </div>
            
            <?= $output ?>

        </main>
        
<aside class="sidebar">
    <div class="sidebar-widget">
        <?php if(isset($pageType) && $pageType === 'profile-page'): ?>
            <div class="profile-card">
                <div class="profile-header">
                    <img class="profile-avatar" src="/coursework/assets/images/random_pfp/<?= htmlspecialchars($profileUser['avatar'], ENT_QUOTES, 'UTF-8') ?>" alt="User avatar">
                    <div class="profile-names">
                        <h3 class="profile-fullname">
                            <?= htmlspecialchars($profileUser['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?> 
                            <?= htmlspecialchars($profileUser['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </h3>
                        <p class="profile-username">@<?= htmlspecialchars($profileUser['username'] ?? 'anonymous', ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
                
                <?php if(!empty($profileUser['bio'])): ?>
                    <p class="profile-bio"><?= htmlspecialchars($profileUser['bio'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-value"><?= getUserPostCount($pdo, $profileUserId) ?? 0 ?></span>
                        <span class="stat-label">Posts</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value"><?= getUserCommentCount($pdo, $profileUserId) ?? 0 ?></span>
                        <span class="stat-label">Comments</span>
                    </div>
                </div>
                
                <div class="profile-details">
                    <div class="member-since">
                        <span>Member since: <?= formatDate($currentUser['createdAt'] ?? '') ?></span>
                    </div>
                </div>
            </div>
        <?php elseif(isLoggedIn()): ?>
            <h3>Quote of the day</h3>
            <p>"The only way to do great work is to love what you do." </br>- Steve Jobs</p>
        <?php else: ?>
            <p>Welcome to Stuck Overlife!</p>
            <p>Please <a href="/coursework/models/login.php">log in</a> or <a href="/coursework/models/register.php">sign up</a> to post questions and answers.</p>
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

    document.addEventListener('click', function(event) {
        // Check if the click was outside the submenu and the avatar button
        const userAvatar = document.querySelector('.user-avatar.avatar-button');
        if (subMenu && subMenu.classList.contains('open-menu') && 
            !subMenu.contains(event.target) && 
            event.target !== userAvatar) {
            subMenu.classList.remove("open-menu");
        }
    });
</script>
</body>
</html>