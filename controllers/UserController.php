<?php


class UserController
{
    public function actionLogin()
    {
        $name ='';
        $password = '';

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя должно быть не короче 2-х смволов';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль должен быть не короче 6-ти  смволов';
            }

            $userId = User::checkUserData($name, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                header("Location: /admin/");
            }
        }

        require_once (ROOT . '/views/user/login.php');

        return true;
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }
}
