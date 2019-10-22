<?php if (!empty($popularPosts)): ?>
    <?php foreach ($popularPosts as $popularPost): ?>
        <div class="row p-4">
            <div class="col">
                <a href="/post/<?php echo $popularPost['post_id']; ?>"> <?php echo $popularPost['post_text'] ?> </a>
            </div>
            <div class="col">
                Author: <?php echo $popularPost['author_name']; ?>
                Created: <?php echo $popularPost['post_created_at']; ?>
                Comments count: <?php echo $popularPost['comments_count']; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert-warning"> Posts not exists!</div>
<?php endif; ?>
