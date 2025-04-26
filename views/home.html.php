<?php $pageType = 'home-page';?>

<?php if (empty($posts)): ?>
    <div class="no-results">
        <p>No posts found.</p>
    </div>
<?php else: ?>
    <?php foreach($posts as $post): ?>
        <div class="post">
            <!-- Your existing post display code -->
            <div class="post-with-votes">
                <div class="post-main">
                    <div class="post-header">
                        <a class="post-title" href="/coursework/models/posts.php?id=<?= $post['PostID'] ?>"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></a>
                        
                        <div class="user-info">
                            <div class="user-avatar">
                                <?php 
                                    $avatar = htmlspecialchars($post['avatar'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <img height="32px" src="/coursework/assets/images/random_pfp/<?= $avatar ?>" alt="User avatar">
                            </div>
                            <div class="user-info-details">
                                <a href="/coursework/models/profile.php?user_id=<?= htmlspecialchars($post['UserID'], ENT_QUOTES, 'UTF-8') ?>" class="user-name"><?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></a>
                                <span class="user-reputation">asked <?= timeAgo($post['createdAt']) ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-content post-preview">
                        <?php echo trimLine($post['content']); ?>
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

    <!-- Pagination Controls -->
    <?php if ($pagination['totalPages'] > 1): ?>
        <div class="pagination">
            <?php
                // Preserve any search parameters
                $queryParams = $_GET;
                unset($queryParams['page']); // Remove current page param
                $queryString = http_build_query($queryParams);
                $queryString = !empty($queryString) ? '&' . $queryString : '';
                
                // Previous page link
                if ($pagination['currentPage'] > 1):
            ?>
                <a href="?page=<?= $pagination['currentPage'] - 1 . $queryString ?>" class="pagination-link pagination-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                </a>
                <?php endif; ?>
            
            <?php
                // Determine page range to display
                $range = 2; // Number of pages to show on each side of current page
                $startPage = max(1, $pagination['currentPage'] - $range);
                $endPage = min($pagination['totalPages'], $pagination['currentPage'] + $range);
                
                // Always show first page
                if ($startPage > 1):
            ?>
                <a href="?page=1<?= $queryString ?>" class="pagination-link">1</a>
                <?php if ($startPage > 2): ?>
                    <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php // Page links
            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?page=<?= $i . $queryString ?>" class="pagination-link <?= $i === $pagination['currentPage'] ? 'pagination-active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
            
            <?php 
                // Always show last page
                if ($endPage < $pagination['totalPages']):
            ?>
                <?php if ($endPage < $pagination['totalPages'] - 1): ?>
                    <span class="pagination-ellipsis">...</span>
                <?php endif; ?>
                <a href="?page=<?= $pagination['totalPages'] . $queryString ?>" class="pagination-link">
                    <?= $pagination['totalPages'] ?>
                </a>
            <?php endif; ?>
            
            <!-- Next page link -->
            <?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
                <a href="?page=<?= $pagination['currentPage'] + 1 . $queryString ?>" class="pagination-link pagination-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>