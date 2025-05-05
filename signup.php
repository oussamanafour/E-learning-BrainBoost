<?php
session_start();
require_once('connection/connection.php');

if (isset($_POST['signup'])) {

    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {

        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars(strtolower($_POST['email']));
        $password = htmlspecialchars($_POST['password']);
        $confirm = htmlspecialchars($_POST['confirm_password']);


      /*   $data = [$first_name,$last_name,$email,$password,$confirm];

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die(); */

        //check for the email if already existe in database

        $queryCheckForEmailOfUser = $connection->prepare('SELECT * FROM users WHERE email=:email');
        $queryCheckForEmailOfUser->bindValue(':email', $email);
        $queryCheckForEmailOfUser->execute();
        $queryCheckForEmailOfUser->fetch();
        $nbrOfRows = $queryCheckForEmailOfUser->rowCount();

        
        if ($nbrOfRows > 0) {
            header('location:signup-form.php');
            $_SESSION['error'] = 'Email already exists';
            die();
        } elseif ($password != $confirm) {
            header('location:signup-form.php');
            $_SESSION['error'] = 'Password not match';
            die();
        } else {
            // hashing the password 
            $hash = password_hash($password, PASSWORD_DEFAULT);
            //Insert data 
            $queryInsertUser = $connection->prepare('INSERT INTO users (first_name,last_name,email,password)
             VALUES (:first_name,:last_name,:email,:password)');
              $data = [
                    ':first_name' => $first_name,
                    ':last_name' => $last_name,
                    ':email' => $email,
                    ':password' => $hash
                    ];
            $isok = $queryInsertUser->execute($data);

            if ($isok) {
                header('location:signup-form.php');
                $_SESSION['success'] ='You have been registered successfully';
                die();
            } else {
                header('location:signup-form.php');
                $_SESSION['error'] ='Something went wrong ! try later';
                die();
            }
        }
    } else {
        header('location:signup-form.php?error=All fields are required');
    }
} else {
    header('location:signup-form.php');
}
