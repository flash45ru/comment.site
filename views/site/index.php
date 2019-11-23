<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container" id="main-page">
        <div class="row main-form">
            <h4>Добавить комментраий</h4>
            <form action="comment/create" method="post" id="ajax_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Ваше имя</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa"
                                                                               aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Ваше имя"/>
                                </div>
                                <span class='label label-danger' id="field-name"></span>
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
                                    <input type="text" class="form-control" name="email"
                                           placeholder="Адрес электроной почты"/>
                                </div>
                                <span class='label label-danger' id="field-email"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="cols-sm-2 control-label">Прикрепить
                                изображение:</label>
                            <div class="cols-sm-10">
                                <label class="btn btn-primary btn-load-image" for="image">
                                    <input id="image" name="image" type="file" style="display:none"
                                           onchange="$('#upload-file-info').html(this.files[0].name)">
                                    загрузить
                                </label>
                                <span class='label label-info' id="upload-file-info"></span>
                                <span class='label label-danger' id="field-image"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Текст комментраия</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment-o"
                                                                       aria-hidden="true"></i></span>
                            <textarea rows="6" cols="30" class="form-control" name="comment"
                                      placeholder="Текст комментраия"></textarea>
                        </div>
                        <span class='label label-danger' id="field-comment"></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" class="btn btn-primary btn-lg btn-block login-button">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <div class="row elements-page-btn mt-3">
                    <div class="col-md-7 col-sm-7 mx-auto text-center">
                        <h4>Сортировать по:</h4>
                        <button type="button" id="sort-email" data-id="email" class="btn btn-outline-info btn-sm">
                            Email
                        </button>
                        <button type="button" id="sort-name" data-id="name" class="btn btn-outline-info btn-sm">автор
                        </button>
                        <button type="button" id="sort-data" data-id="create_date" class="btn btn-outline-info btn-sm">
                            дата
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Последние комментарии</h2>
                <div class="row">

                    <div class="qa-message-list">
                        <?php require 'views/comment/index.php'; ?>
                    </div>

                </div>
            </div><!--features_items-->
        </div><!--/recommended_items-->

    </div>
    </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
