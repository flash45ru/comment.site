<?php

use Intervention\Image\ImageManager;

class CommentController extends AdminBase
{
    public function actionIndex()
    {
        if (isset($_POST['sort_param'])) {
            $commentList = array();
            $commentList = Comment::getSortComments($_POST['sort_param']);

            require_once(ROOT . '/views/comment/index.php');

            return true;
        }
    }

    public function actionCreate()
    {
        if (isset($_POST)) {
            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['comment'] = $_POST['comment'];
            $options['create_date'] = time();

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = [
                    'id' => '#field-name',
                    'message' => 'Заполните поле "Имя"'
                ];
            } elseif (!User::checkName($options['name'])) {
                $errors[] = [
                    'id' => '#field-name',
                    'message' => 'Имя должно быть не короче 2-х смволов'
                ];
            }

            if (!isset($options['email']) || empty($options['email'])) {
                $errors[] = [
                    'id' => '#field-email',
                    'message' => 'Заполните поле "Электронная почта"'
                ];
            } elseif (!Comment::checkEmail($options['email'])) {
                $errors[] = [
                    'id' => '#field-email',
                    'message' => 'Не корректный адрес электроноой почты'
                ];
            }

            if (!isset($options['comment']) || empty($options['comment'])) {
                $errors[] = [
                    'id' => '#field-comment',
                    'message' => 'Поле "Текст комментраия" не должно быть пустым'
                ];
            }

            $image = $_FILES["image"]["tmp_name"];
            if ($image) {
                if (!Comment::checkImage()) {
                    $errors[] = [
                        'id' => '#field-image',
                        'message' => 'Допустимые форматы: JPG, GIF, PNG'
                    ];
                }
                $resolution = Comment::getImageResolution();
                $size = Comment::checkImageSize();
            }

            if ($errors) {
                echo json_encode([
                    'status' => 1,
                    'errors' => $errors
                ], JSON_UNESCAPED_UNICODE);
                return true;
            }

            if ($errors == false) {
                $id = Comment::createComment($options);

                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($image)) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($image, ROOT . "/upload/images/comments/{$id}.{$resolution}");
                        Comment::setImageCommentById($id, 'upload/images/comments/' . $id . '.' . $resolution);
                        // Кроп если больше 320х240
                        if (!$size) {
                            require 'vendor/autoload.php';
                            $imagePath = 'upload/images/comments/' . $id . '.' . $resolution;
                            $manager = new ImageManager(array('driver' => 'imagick'));
                            $manager->make($imagePath)->resize(320, 240)->save($imagePath);
                        }
                    }
                }
            }
        }
        echo json_encode([
            'status' => 2
        ]);
//        $commentList = array();
//        $commentList = Comment::getCommentList();
//
//        ob_start();
//        require ROOT . '/views/comment/index.php';
//        $content = ob_get_clean();
//        echo json_encode([
//            'status' => 'ok',
//            'content' => $content
//        ]);
        return true;
    }

    public function actionAdmin()
    {
        self::checkAdmin();

        $commentList = array();
        $commentList = Comment::getCommentListForAdmin();

        require_once(ROOT . '/views/comment/admin.php');

        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();
        $comment = Comment::getCommentById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['comment'] = $_POST['comment'];
            if ($comment['comment'] === $_POST['comment']) {
                $options['update_date'] = null;
            } else {
                $options['update_date'] = time();
                $options['admin_update'] = 1;
            }
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = [
                    'id' => '#field-name',
                    'message' => 'Вы пытались сохранить пустым поле "Имя"',
                    'impossible' => '  - это не возможно'
                ];
            } elseif (!User::checkName($options['name'])) {
                $errors[] = [
                    'id' => '#field-name',
                    'message' => 'Вы пытались сохранить Имя короче 2-х смволов',
                    'impossible' => '  - это не возможно'
                ];
            }

            if (!isset($options['email']) || empty($options['email'])) {
                $errors[] = [
                    'id' => '#field-email',
                    'message' => 'Вы пытались сохранить пустым поле "Электронная почта"',
                    'impossible' => '  - это не возможно'
                ];
            } elseif (!Comment::checkEmail($options['email'])) {
                $errors[] = [
                    'id' => '#field-email',
                    'message' => 'Вы пытались сохранить не корректный адрес электроноой почты',
                    'impossible' => '  - это не возможно'
                ];
            }

            if (!isset($options['comment']) || empty($options['comment'])) {
                $errors[] = [
                    'id' => '#field-comment',
                    'message' => 'Вы пытались сохранить пустым поле "Текст комментраия"',
                    'impossible' => '  - это не возможно'
                ];
            }

            if ($errors == false) {
                Comment::updateCommentById($id, $options);

                header("Location: /admin");
            }
        }

        require_once(ROOT . '/views/comment/update.php');
        return true;
    }
}
