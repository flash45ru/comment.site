<?php foreach ($commentList as $comment) : ?>
    <div class="message-item">
        <div class="message-inner">
            <div class="message-head clearfix">
                <div class="avatar pull-left">
                    <img src="<?php echo($comment['image'])? '/' . $comment['image'] : '/template/images/no-comment.jpg'; ?>">
                </div>
                <div class="user-detail">
                    <h5 class="handle"><?php echo $comment['name']; ?> <span id="admin-update"><?php echo ($comment['admin_update']>= 1)?'"изменен администратором"':''; ?></span></h5>
                    <div class="post-meta">
                        <div class="asker-meta">
                            <span class="qa-message-what"></span>
                            <span class="qa-message-when">
                                    <span class="qa-message-when-data">
                                        <?php echo date("Y-m-d H:i:s", $comment['create_date']); ?></span>
                                </span>
                            <span class="qa-message-who">
                                    <span class="qa-message-who-pad">Email: </span>
                                    <span class="qa-message-who-data"><a
                                                href="/"><?php echo $comment['email'] ?></a></span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qa-message-content">
                <?= $comment['comment'] ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
