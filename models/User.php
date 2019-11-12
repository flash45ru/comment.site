<?php


class User
{
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 3) {
            return true;
        }
        return false;
    }

    public static function checkUserData($name, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE name =:name AND password =:password';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user SET name = :name, password = :password WHERE id =:id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }



    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if ($_SESSION['user']) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");

    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($userId)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE id =:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        //указываем что хотим получить данные в  виде  массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

}