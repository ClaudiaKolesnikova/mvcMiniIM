<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;                 
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            if ($errors == false) {
                $result = User::register($name, $email, $password);
                    if($result){
                        $userId = User::checkUserData($email, $password);
                        $_SESSION['regUserId'] = $userId;
                        $_SESSION['userId'] = $_SESSION['regUserId'];
                        header("Location: /cabinet/");
                    }
                
                
//                header('Location: '.$_SERVER['HTTP_REFERER']);  
            }
        }
        require_once ROOT . '/views/user/register.php';
        return true;
    }
    
    public function actionLogin()
    {
        $email = '';
        $password = '';
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                $_SESSION['userId'] = $userId;
                header("Location: /cabinet/");
            }
        }
        require_once ROOT . '/views/user/login.php';
        return true;
    }
    
    public function actionLogout()
    {   
        if(isset($_SESSION["userId"])){
            unset($_SESSION["userId"]);
        }
        header("Location: /");
    }

}
