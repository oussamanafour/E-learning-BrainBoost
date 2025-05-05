<?php
session_start();
date_default_timezone_set('Africa/Casablanca');
require_once('../connection/connection.php');
if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars(strtolower($_POST['email']));
        $password = htmlspecialchars($_POST['password']);
        //query 
        $queryLoginForAdmin = $connection->prepare('SELECT * FROM administrators WHERE email=:email');
        $queryLoginForAdmin->bindValue(':email', $email);
        $queryLoginForAdmin->execute();
        $resultLoginAdmin = $queryLoginForAdmin->fetch();
        $nbr_row = $queryLoginForAdmin->rowCount();
        if ($nbr_row > 0) {
            // check if password are match 
            if (password_verify($password, $resultLoginAdmin['password'])) {
                // collecting data to use it in the pages 
                $_SESSION['id_admin'] = $resultLoginAdmin['id_admin'];
                $_SESSION['A_firstname'] = $resultLoginAdmin['first_name'];
                $_SESSION['A_lastname'] = $resultLoginAdmin['last_name'];
                $_SESSION['emailAdmin'] = $resultLoginAdmin['email'];
                $_SESSION['role'] = $resultLoginAdmin['role'];

                $status = 'Online';
                $last_login = date('Y-m-d H:i:s');

                $queryUpdateStatusAdmin = $connection->prepare('UPDATE administrators SET status=:status,last_login=:last_login WHERE id_admin=:id_admin');
                $UpdateOfStatusAdmin = [
                    ':status' => $status,
                    ':last_login' => $last_login,
                    ':id_admin' => $_SESSION['id_admin']
                ];
                $iskok = $queryUpdateStatusAdmin->execute($UpdateOfStatusAdmin);
                if($iskok){
                    header('location:dashboard.php');
                }
            }
        }else {
            $_SESSION['error'] = 'Email or password incorrect';
            header('location:index.php');
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
