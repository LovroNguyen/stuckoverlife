<div class="post">
    <div class="post-with-votes">
        <div class="post-main">
            <div class="post-header">
                    <h1 class="post-title post-view" href="/coursework/posts.php?id=<?= $post['PostID'] ?>"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h1>
                    
                    <div class="user-info">
                        <div class="user-avatar">
                            <?php 
                                $author = getUserByPost($pdo, $post['PostID']);
                                $avatar = isset($author['avatar']) ? htmlspecialchars($author['avatar'], ENT_QUOTES, 'UTF-8') : "random_pfp";
                                ?>
                                <img height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                        </div>
                        <div class="user-info-details">
                            <a href="#" class="user-name"><?= htmlspecialchars($post['username'] ?? 'Anonymous User', ENT_QUOTES, 'UTF-8') ?></a>
                            <span class="user-reputation">asked <?= timeAgo($post['createdAt']) ?></span>
                        </div>
                    </div>
            </div>

            <!-- content -->
            <div class="post-content post-view"><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></div>

            <!-- image -->
            <?php if (isset($post['asset']) && $post['asset']): ?>
                <div class="post-image">
                    <img width="760px" src="/coursework/uploads/<?= htmlspecialchars($post['asset']['mediaKey'], ENT_QUOTES, 'UTF-8') ?>" 
                        alt="Post image">
                </div>
            <?php endif; ?>

            <!-- module -->
            <div class="post-module post-view">
                Module: <?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            
            <!-- post actions -->
            <div class="post-stats post-view">
                <div class="post-stat">
                    <span class="post-stat-value">Asked </span><span class="post-stat-value-bold"><?= timeAgo($post['createdAt']) ?></span>
                </div>
                <div class="post-stat">
                    <span class="post-stat-value">Viewed </span><span class="post-stat-value-bold"><?= htmlspecialchars($post['viewCount'], ENT_QUOTES, 'UTF-8') ?> times</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="comments">
        <h3>Comments</h3>
        
        <?php if (!empty($post['comments'])): ?>
            <?php foreach($post['comments'] as $comment): ?>
            <div class="comment">
                <span class="comment-author"><?= htmlspecialchars($comment['username'], ENT_QUOTES, 'UTF-8') ?></span>
                <span class="comment-content"><?= htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8') ?></span>
                <div class="comment-time"><?= timeAgo($comment['createdAt']) ?></div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>
        
        <?php if (isLoggedIn()): ?>
        <form method="post" action="/coursework/add-comment.php" class="comment-form">
            <input type="hidden" name="post_id" value="<?= $post['PostID'] ?>">
            <div class="form-group">
                <textarea name="comment" placeholder="Add a comment..." required></textarea>
            </div>
            <button class="form-submit" type="submit">Add Comment</button>
        </form>
        <?php else: ?>
        <p><a href="/coursework/login.php">Login</a> to add a comment.</p>
        <?php endif; ?>
    </div>
</div>