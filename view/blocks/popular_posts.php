<div class="row p-3 border mt-5">
    <div class="col">
        <?php if (!empty($popularPosts)): ?>
            <h3 class="font-weight-bold p-2">Popular posts</h3>

            <?php foreach ($popularPosts as $popularPost): ?>
                <div class="row border p-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <span class="small">
                                    <a href="/post/<?php echo $popularPost['post_id']; ?>"> <?php echo $popularPost['post_text'] ?> </a>
                                </span>
                            </div>

                            <div class="offset-2"></div>

                            <div class="col-3">
                                <span class="small font-weight-bold">Comments count: <?php echo $popularPost['comments_count']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-9 col-3">
                        <span class="small">
                            Author: <?php echo $popularPost['author_name']; ?>
                        </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-9 col-3">
                        <span class="small">
                            Created: <?php echo $popularPost['post_created_at']; ?>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="text-info font-weight-bolder"> Popular posts not found! </span>
        <?php endif; ?>
    </div>
</div>
