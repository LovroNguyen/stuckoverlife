<?php
$posts = isset($userPosts) ? $userPosts : [];
$avatar = htmlspecialchars($profileUser['avatar'], ENT_QUOTES, 'UTF-8');
?>

<div class="profile-header-container">
    <?php if(isset($isOwnProfile) && $isOwnProfile): ?>
        <p>My Profile</p>
    <?php else: ?>
        <p><?= htmlspecialchars($profileUser['username'], ENT_QUOTES, 'UTF-8') ?>'s Profile</p>
    <?php endif; ?>
</div>

<?php if (empty($posts)): ?>
    <div style="text-align: center;">
        <?php if(isset($isOwnProfile) && $isOwnProfile): ?>
            <p>You haven't created any posts yet.</p>
        <?php else: ?>
            <p>This user hasn't created any posts yet.</p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <?php foreach($posts as $post): ?>
        <div class="post">
            <div class="post-with-votes">
                <div class="post-main">
                    <div class="post-header">
                        <a class="post-title" href="/coursework/models/posts.php?id=<?= $post['PostID'] ?>"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></a>
                        
                        <div class="user-info">
                            <div class="user-avatar">
                                <?php 
                                    $author = getUserByPost($pdo, $post['PostID']);
                                    $postAvatar = htmlspecialchars($author['avatar'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <img height="32px" src="/coursework/assets/images/random_pfp/<?= $postAvatar ?>" alt="User avatar">
                            </div>
                            <div class="user-info-details">
                                <a href="/coursework/models/profile.php?user_id=<?= htmlspecialchars($post['UserID'], ENT_QUOTES, 'UTF-8') ?>" class="user-name"><?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></a>
                                <span class="user-reputation">asked <?= timeAgo($post['createdAt']) ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-content post-preview">
                        <?php
                        echo trimLine(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'))
                        ?>
                    </div>                

                    <div class="post-module">
                        Module: <?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                          
                    <div class="post-stats">
                        <div class="post-stat">
                            <span class="post-stat-value"><?= htmlspecialchars($post['viewCount'], ENT_QUOTES, 'UTF-8') ?></span> views
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>