<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap-4.3.1.css">
</head>
<body>
<div class="container">
    <?php $blockLoader->render(\Igord\CustomBlog\Blocks\PopularPosts\Handler::BLOCK_ID); ?>

    <div class="row p-3 border">
        <div class="col mt-2 p-3">
            <?php include_once $child; ?>
        </div>
    </div>
</div>
</body>
</html>