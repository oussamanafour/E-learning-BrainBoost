<?php
date_default_timezone_set('Africa/Casablanca');
session_start();
require_once('connection/connection.php');
if (isset($_POST['sign-in'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars(strtolower($_POST['email']));
        $password = htmlspecialchars($_POST['password']);
        //query 
        $queryLoginForUsers = $connection->prepare('SELECT * FROM users WHERE email=:email');
        $queryLoginForUsers->bindValue(':email', $email);
        $queryLoginForUsers->execute();
        $resultLoginUser = $queryLoginForUsers->fetch();
        $nbr_row = $queryLoginForUsers->rowCount();
        if ($nbr_row > 0) {
            // check if password are match 
            if (password_verify($password, $resultLoginUser['password'])) {
                // collecting data to use it in the pages 
                $_SESSION['id_user'] = $resultLoginUser['id_user'];
                $_SESSION['U_first_name'] = $resultLoginUser['first_name'];
                $_SESSION['U_last_name'] = $resultLoginUser['last_name'];
                $_SESSION['email'] = $resultLoginUser['email'];
                // update status to online
                $status = 'Online';
                $last_login = date('Y-m-d H:i:s');
                $queryUpdateStatusUsers = $connection->prepare('UPDATE users SET status=:status,last_login=:last_login WHERE id_user=:id_user');
                $UpdateOfStatusUsers = [':status' => $status,':last_login' => $last_login,':id_user' => $_SESSION['id_user']];
                $queryUpdateStatusUsers->execute($UpdateOfStatusUsers);
                header('location:user/home-page.php');
            } else {
                $_SESSION['error'] = 'password incorrect';
                header('location:login.php');
            }
        } else {
            $_SESSION['error'] = 'Email or password incorrect';
            header('location:login.php');
        }
    } else {
        header('location:login.php');
        $_SESSION['error'] = 'All files are required';
        exit();
    }
} else {
    header('location:login.php');
}
