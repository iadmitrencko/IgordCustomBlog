<?php $blockLoader->render(\Igord\CustomBlog\Blocks\Messages\Handler::BLOCK_ID); ?>

<div class="row mb-5">
    <div class="col">
        <?php if (!empty($posts)): ?>
            <h3 class="font-weight-bold p-2 pl-3"> Posts</h3>
            <?php foreach ($posts as $post): ?>
                <div class="row border p-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <span class="small">
                                    <a href="/post/<?php echo $post['post_id']; ?>"> <?php echo $post['post_text'] ?> </a>
                                </span>
                            </div>

                            <div class="offset-2"></div>

                            <div class="col-3">
                                <span class="small font-weight-bold">Comments count: <?php echo $post['comments_count']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-9 col-3">
                        <span class="small">
                            Author: <?php echo $post['author_name']; ?>
                        </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-9 col-3">
                        <span class="small">
                            Created: <?php echo $post['post_created_at']; ?>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="text-info font-weight-bolder"> Posts not found! </span>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col">
        <form action="/post" method="post">
            <label for="author">Author:</label>
            <input type="text" name="author" required>

            <label for="text">Text:</label>
            <textarea name="text" cols="60" rows="10" required></textarea>

            <input type="submit" name="submit_post" value="Add post">
        </form>
    </div>
</div>

