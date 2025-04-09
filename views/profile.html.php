<?php
$currentUserId = $_SESSION['user_id'];

$posts = getPostByUser($pdo, $currentUserId);

if (empty($posts)): ?>
    <div style="text-align: center;">
        <p>You haven't created any posts yet.</p>
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
                                    $avatar = htmlspecialchars($author['avatar'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <img height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                            </div>
                            <div class="user-info-details">
                                <a href="#" class="user-name"><?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></a>
                                <span class="user-reputation">asked <?= timeAgo($post['createdAt']) ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-content post-preview">
                        <?php 
                        $content = strip_tags(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'));
                        
                        $lines = explode("\n", $content);
                        
                        $preview = array_slice($lines, 0, 2);
                        $preview = implode("\n", $preview);
                        
                        if (count($lines) > 2 || strlen($content) > strlen($preview)) {
                            $preview = trim($preview) . '...';
                        }
                        
                        echo $preview;
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