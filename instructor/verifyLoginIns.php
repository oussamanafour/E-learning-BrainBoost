<?php
date_default_timezone_set('Africa/Casablanca');
session_start();
require_once('../connection/connection.php');

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars(strtolower($_POST['email']));
        $password = htmlspecialchars($_POST['password']);
        //query 
        $queryLoginForinstructor = $connection->prepare('SELECT * FROM instructor WHERE email=:email');
        $queryLoginForinstructor->bindValue(':email', $email);
        $queryLoginForinstructor->execute();
        $resultLogin= $queryLoginForinstructor->fetch();
        $nbr_row = $queryLoginForinstructor->rowCount();
        if ($nbr_row > 0) {
            // check if password are match 
            if (password_verify($password, $resultLogin['password'])) {
                // collecting data to use it in the pages 
                $_SESSION['idInstructor'] = $resultLogin['id_instructor'];
                $_SESSION['firstname'] = $resultLogin['first_name'];
                $_SESSION['lastname'] = $resultLogin['last_name'];
                $_SESSION['emailInstructor'] = $resultLogin['email'];
                $_SESSION['roleins'] = $resultLogin['role'];
                /*
                $status = 'Online';
                $last_login = date('Y-m-d H:i:s');
                $queryUpdateStatusUsers = $connection->prepare('UPDATE users SET status=:status,last_login=:last_login WHERE id_user=:id_user');
                $UpdateOfStatusUsers = [
                    ':status' => $status,
                    ':last_login' => $last_login,
                    ':id_user' => $_SESSION['id_user']
                ];
                $queryUpdateStatusUsers->execute($UpdateOfStatusUsers); */
                header('location:DashboardInstructor.php');
            }else {
                header('location:index.php');
                $_SESSION['error'] = 'password incorrect';
                exit();
             } 
        }else {
            header('location:index.php');
            $_SESSION['error'] = 'Email or password not true';
            exit();
         } 
    } else {
        header('location:index.php');
        $_SESSION['error'] = 'All files are required';
        exit();
    }
}else{
    header('location:index.php');
}
