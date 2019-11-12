<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 padding-right">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <form action="#" method="post" class="form-horizontal">
                        <span class="heading">АВТОРИЗАЦИЯ</span>
                        <div class="form-group">
                            <input type="name" name="name" class="form-control" id="inputEmail"
                                   placeholder="Имя" value="<?php echo $name; ?>"/>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="form-group help">
                            <input type="password" name="password" class="form-control" id="inputPassword"
                                   placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-default">ВХОД</button>
                        </div>
                    </form>
                </div>
                <br/>
                <br/>
            </div>
        </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>