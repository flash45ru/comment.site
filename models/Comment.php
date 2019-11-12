<?php

class Comment
{
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkImage()
    {
        $allowed = array('image/gif', 'image/jpeg', 'image/png');

        $image = $_FILES["image"]["tmp_name"];
        if ($image) {
            $size = getimagesize($image, $info);
            if (in_array($size['mime'], $allowed)) {
                return true;
            }
            return false;
        }

    }

    public static function getImageResolution()
    {
        $image = $_FILES["image"]["tmp_name"];
        $size = getimagesize($image, $info);

        $resolution = explode("/", $size['mime']);
        array_shift($resolution);

        return reset($resolution);
    }

    public static function checkImageSize()
    {
        $image = $_FILES["image"]["tmp_name"];
        $size = getimagesize($image, $info);

        if (320 >= $size[1] & $size[0] <= 240) {
            return true;
        }
        return false;
    }

    public static function validateNameEmailComment($options)
    {
        $errors = array();

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

        return $errors;
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case 'null':
                return 'на рассмотрении';
                break;
            case '1':
                return 'принят';
                break;
            case '2':
                return 'отклонен';
                break;
        }
    }

    public static function getStatusBtnColor($status)
    {
        switch ($status) {
            case '0':
                return 'color: black;';
                break;
            case '2':
                return 'color: crimson;';
                break;
        }
    }

    public static function setImageCommentById($id, $imagePath)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE comment SET image = :image WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':image', $imagePath, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Returns an array of comments
     */
    public static function getCommentList()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, email, comment, status, create_date, admin_update, image FROM comment WHERE status = "1"ORDER BY id DESC');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['email'] = $row['email'];
            $productsList[$i]['comment'] = $row['comment'];
            $productsList[$i]['status'] = $row['status'];
            $productsList[$i]['create_date'] = $row['create_date'];
            $productsList[$i]['admin_update'] = $row['admin_update'];
            $productsList[$i]['image'] = $row['image'];
            $i++;
        };

        return $productsList;
    }

    public static function getCommentListForAdmin()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT * FROM comment ORDER BY id DESC');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['email'] = $row['email'];
            $productsList[$i]['comment'] = $row['comment'];
            $productsList[$i]['status'] = $row['status'];
            $productsList[$i]['create_date'] = $row['create_date'];
            $productsList[$i]['image'] = $row['image'];
            $i++;
        };

        return $productsList;
    }

    /**
     * @param $sort
     * @return array
     */
    public static function getSortComments($sort)
    {
        $db = Db::getConnection();
        $commentsList = array();

        $result = $db->query('SELECT * FROM comment WHERE status = "1"ORDER BY ' . $sort . ' ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $commentsList[$i]['id'] = $row['id'];
            $commentsList[$i]['name'] = $row['name'];
            $commentsList[$i]['email'] = $row['email'];
            $commentsList[$i]['comment'] = $row['comment'];
            $commentsList[$i]['create_date'] = $row['create_date'];
            $commentsList[$i]['admin_update'] = $row['admin_update'];
            $commentsList[$i]['status'] = $row['status'];
            $commentsList[$i]['image'] = $row['image'];
            $i++;
        }

        return $commentsList;
    }

    /**
     * Returns comment by id
     * @param $id
     * @return mixed
     */
    public static function getCommentById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM comment WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    /**
     * Create comment
     * @param $options
     * @return int|string
     */
    public static function createComment($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO comment (name, email, comment, create_date)VALUES (:name, :email, :comment, :date)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['create_date'], PDO::PARAM_STR);

        if ($result->execute()) {
            return $db->lastInsertId();
        }

        return 0;
    }

    public static function updateCommentById($id, $options)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE comment SET name = :name, email = :email, comment = :comment, update_date = :update_date, 
                                   admin_update = :admin_update, status = :status WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
        $result->bindParam(':update_date', $options['update_date'], PDO::PARAM_STR);
        $result->bindParam(':admin_update', $options['admin_update'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
}
