<?php $blockLoader->render(\Igord\CustomBlog\Blocks\Messages\Handler::BLOCK_ID); ?>

<?php if (!empty($posts)): ?>
    <h1> Posts list:</h1>

    <?php foreach ($posts as $post): ?>
        <div class="row p-4">
            <div class="col">
                <a href="/post/<?php echo $post['post_id']; ?>"> <?php echo $post['post_text'] ?> </a>
            </div>
            <div class="col">
                Author: <?php echo $post['author_name']; ?>
                Created: <?php echo $post['post_created_at']; ?>
                Comments count: <?php echo $post['comments_count']; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert-warning"> Posts not exists!</div>
<?php endif; ?>

<h2>Add new post:</h2>

<form action="/post" method="post">
    <label for="author">
        Author name:
    </label>

    <input type="text" name="author" required>

    <label for="text">
        Post text:
    </label>
    <textarea name="text" cols="60" rows="10" required></textarea>

    <input type="submit" name="submit_post" value="Add post">
</form>
