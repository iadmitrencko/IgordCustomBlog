<?php $blockLoader->render(\Igord\CustomBlog\Blocks\Messages\Handler::BLOCK_ID); ?>

<h1>
    POST:
</h1>

<div class="row m-3">
    <div class="col">
        <div>
            TEXT: <?php echo $post['text']; ?>
        </div>
    </div>
</div>

<div class="row m-3">
    <div class="col">
        <div>
            Author: <?php echo $post['author_name']; ?>
        </div>
    </div>
</div>

<div class="row m-3">
    <div class="col">
        <div>
            Created: <?php echo $post['created_at']; ?>
        </div>
    </div>
</div>

<h2>
    Comments:
</h2>

<?php if (!is_null($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <div class="mb-5">
            <div class="row m-3">
                <div class="col">
                    <div>
                        TEXT: <?php echo $comment['text']; ?>
                    </div>
                </div>
            </div>
            <div class="row m-3">
                <div class="col">
                    <div>
                        Created: <?php echo $comment['created_at']; ?>
                    </div>
                </div>
            </div>
            <div class="row m-3">
                <div class="col">
                    <div>
                        Author: <?php echo $comment['author_name']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert-info">
        No comments
    </div>
<?php endif; ?>

<h2>Add new Comment:</h2>

<form action="/post/<?php echo $post['id']; ?>/comment" method="post">
    <label for="author">
        Author name:
    </label>

    <input type="text" name="author" required>

    <label for="text">
        Text:
    </label>
    <textarea name="text" cols="60" rows="10" required></textarea>

    <input type="submit" value="Add comment">
</form>