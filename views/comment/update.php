<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container" id="update-comment">
        <div class="content">
            <div class="row">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li class="active">Редактирование комментария</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><span class='label label-info'> - <?php echo $error['message']; ?></span><span
                                        class='label label-danger'><?php echo $error['impossible']; ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="row">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Ваше имя</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa"
                                                                               aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="<?php echo $comment['name']; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Адрес электроной почты</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope fa"
                                                                               aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" id="email"
                                               value="<?php echo $comment['email']; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Статус</label>
                                <select name="status" id="inputState" class="form-control">
                                    <option value="0" selected>Выбрать статус...</option>
                                    <option value="1" <?php if ($comment['status'] == 1) echo ' selected="selected"'; ?>>
                                        Принят
                                    </option>
                                    <option value="2" <?php if ($comment['status'] == 2) echo ' selected="selected"'; ?>>
                                        Отклонен
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="cols-sm-2 control-label">Текст комментраия</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment-o"
                                                                   aria-hidden="true"></i></span>
                                <textarea rows="6" cols="30" class="form-control"
                                          name="comment"><?php echo $comment['comment']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <button type="submit" name="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
