<?php

class User
{
    public static function register($name, $email, $password) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (?, ?, ?)';
        $result = $db->prepare($sql);
        return $result->execute([$name, $email, $password]);
    }
    
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email) {
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) FROM user WHERE email = ?";
        $result = $db->prepare($sql);
        $result->execute([$email]);
        if($result->fetchColumn()){
            return true;
        }
        return false;
    }
    
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE email = ? AND password = ?';
        $result = $db->prepare($sql);
        $result->execute([$email, $password]);
        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;
    }
    
    public static function checkLogged()
    {
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }
        header("Location: /user/login");
    }
    
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }
    
    public static function isGuest()
    {
        if (isset($_SESSION['userId'])) {
            return false;
        }
        return true;
    }
    
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = ?';
            $result = $db->prepare($sql);
            $result->execute([$id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }
    
    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();
        $sql = "UPDATE user SET name = ?, password = ? WHERE id = ?";
        $result = $db->prepare($sql);                                  
        return $result->execute([$name, $password, $id]);
    }

}