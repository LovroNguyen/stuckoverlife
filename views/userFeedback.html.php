<div class="container">
    <div class="page-header">
        <h1>User Feedback</h1>
        <div class="subtitle">Manage user feedback submissions</div>
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="form-success"><?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="form-error"><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <!-- Search form -->
    <div class="search-container">
        <form action="" method="get" class="search-form">
            <input type="hidden" name="action" value="view">
            <input type="text" name="search" placeholder="Search feedback..." 
                   value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') : '' ?>">
            <button type="submit" class="search-button">Search</button>
            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                <a href="/coursework/controllers/feedbackController.php" class="clear-search">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    
    <?php if (empty($feedbackList)): ?>
        <div class="empty-state">
            <p>No feedback submissions found.</p>
        </div>
    <?php else: ?>
        <div class="post-list">
            <?php foreach ($feedbackList as $feedback): ?>
                <div class="post-card <?= isset($feedback['status']) && $feedback['status'] === 'resolved' ? 'feedback-resolved' : '' ?>">
                    <div class="post-header">
                        <h3 class="post-title"><?= htmlspecialchars($feedback['title']) ?></h3>
                        <div class="post-metadata">
                            <span class="post-author">From: <?= htmlspecialchars($feedback['username']) ?></span>
                            <span class="post-date">Submitted: <?= timeAgo($feedback['createdAt']) ?></span>
                            <?php if (isset($feedback['status']) && $feedback['status'] === 'resolved'): ?>
                                <span class="feedback-status resolved">Resolved</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="post-content">
                        <p><?= nl2br(htmlspecialchars($feedback['content'])) ?></p>
                    </div>
                    <div class="post-footer">
                        <?php if (!empty($feedback['email'])): ?>
                            <div class="feedback-email">
                                Contact: <a href="mailto:<?= htmlspecialchars($feedback['email']) ?>">
                                    <?= htmlspecialchars($feedback['email']) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-actions">
                            <a href="/coursework/controllers/feedbackController.php?action=delete&id=<?= $feedback['feedbackID'] ?>" 
                               class="delete-link" 
                               onclick="return confirm('Are you sure you want to delete this feedback?')">
                                Delete
                            </a>
                            <?php if (!isset($feedback['status']) || $feedback['status'] !== 'resolved'): ?>
                                <a href="/coursework/controllers/feedbackController.php?action=resolve&id=<?= $feedback['feedbackID'] ?>" 
                                   class="edit-link">
                                    Mark as Resolved
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>