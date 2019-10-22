<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap-4.3.1.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col mt-5 mb-5 p-3">
            <?php $blockLoader->render(\Igord\CustomBlog\Blocks\PopularPosts\Handler::BLOCK_ID); ?>
        </div>
    </div>
    <div class="row">
        <div class="col mt-5 mb-5 p-3">
            <?php include_once $child; ?>
        </div>
    </div>
</div>
</body>
</html>