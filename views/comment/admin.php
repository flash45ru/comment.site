<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container" id="main-page">
        <?php foreach ($commentList as $comment) : ?>
            <div class="message-item">
                <div class="message-inner">
                    <div class="message-head clearfix">
                        <div class="avatar pull-left">
                            <img src="<?php echo ($comment['image']) ? '/' . $comment['image'] : '/template/images/no-comment.jpg'; ?>">
                        </div>
                        <div class="comment-update">
                            <?php if ($comment['status'] >= 1) : ?>
                                <button class="btn btn-outline-info btn-sm"
                                        style="<?php echo Comment::getStatusBtnColor($comment['status']) ?>">
                                    <?php echo Comment::getStatusText($comment['status']); ?>
                                </button>
                            <?php endif; ?>
                            <a href="/comment/<?php echo $comment['id']; ?>">
                                <button class="btn btn-success">Редактировать</button>
                            </a>
                        </div>
                    </div>
                    <div class="qa-message-content">
                        <?= $comment['comment'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>