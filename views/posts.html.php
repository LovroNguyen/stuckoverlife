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
                
                <!-- Post owner actions -->
                <?php if (isLoggedIn() && userOwnsPost($pdo, $post['PostID'], $_SESSION['user_id'])): ?>
                <div class="post-owner-actions">
                    <a href="/coursework/controllers/post-controller.php?id=<?= $post['PostID'] ?>&action=edit" class="edit-link">Edit</a>
                    <a href="#" class="delete-link" onclick="deletePost(<?= $post['PostID'] ?>)">Delete</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="comments">
        <h3>Comments</h3>
        
        <?php if (!empty($post['comments'])): ?>
            <?php foreach($post['comments'] as $comment): ?>
            <div class="comment" id="comment-<?= $comment['CommentID'] ?>">
                <span class="comment-author"><?= htmlspecialchars($comment['username'], ENT_QUOTES, 'UTF-8') ?></span>
                <span class="comment-content"><?= htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8') ?></span>
                <div class="comment-info">
                <div class="comment-time"><?= timeAgo($comment['createdAt']) ?></div>
                <?php if (isLoggedIn() && userOwnsComment($pdo, $comment['CommentID'], $_SESSION['user_id'])): ?>
                    <div class="comment-actions">
                        <a href="#" class="edit-comment-link" onclick="editComment(<?= $comment['CommentID'] ?>, '<?= htmlspecialchars(addslashes($comment['content']), ENT_QUOTES, 'UTF-8') ?>')">Edit</a>
                        <a href="#" class="delete-comment-link" onclick="deleteComment(<?= $comment['CommentID'] ?>, <?= $post['PostID'] ?>)">Delete</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>
        
        <!-- Comment form -->
        <?php if (isLoggedIn()): ?>
        <form method="post" action="/coursework/add-comment.php" class="comment-form" id="comment-form">
            <input type="hidden" name="post_id" value="<?= $post['PostID'] ?>">
            <input type="hidden" name="comment_id" id="comment_id" value="">
            <div class="form-group">
                <textarea name="content" id="comment-content" placeholder="Add a comment..." required></textarea>
            </div>
            <div class="form-actions">
                <button class="form-submit" type="submit" id="comment-submit">Add Comment</button>
                <button type="button" class="form-cancel" id="cancel-edit" style="display: none;" onclick="cancelEdit()">Cancel</button>
            </div>
        </form>
        <?php else: ?>
        <p><a href="/coursework/login.php">Login</a> to add a comment.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function editComment(commentId, content) {
        document.getElementById('comment-form').action = '/coursework/controllers/comment-controller.php?action=edit&id=' + commentId + '&post_id=<?= $post['PostID'] ?>';
        document.getElementById('comment_id').value = commentId;
        document.getElementById('comment-content').value = content;
        document.getElementById('comment-submit').textContent = 'Update Comment';
        document.getElementById('cancel-edit').style.display = 'inline-block';
    }
    
    function cancelEdit() {
        // Reset form
        document.getElementById('comment-form').action = '/coursework/add-comment.php';
        document.getElementById('comment_id').value = '';
        document.getElementById('comment-content').value = '';
        document.getElementById('comment-submit').textContent = 'Add Comment';
        document.getElementById('cancel-edit').style.display = 'none';
    }
    
    function deleteComment(commentId, postId) {
        if (confirm('Are you sure you want to delete this comment?')) {
            window.location.href = '/coursework/controllers/comment-controller.php?action=delete&id=' + commentId + '&post_id=' + postId;
        }
    }
    
    function deletePost(postId) {
        if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
            window.location.href = '/coursework/controllers/post-controller.php?action=delete&id=' + postId;
        }
    }
</script>