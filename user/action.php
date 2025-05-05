<?php

session_start();

include('../connection/connection.php');
require('class.php');
date_default_timezone_set('Africa/Casablanca');

if (isset($_GET['idLesson'])) {
    $_SESSION['idlesson'] = $_GET['idLesson'];
    $idUser = $_SESSION['id_user'];
    $status = 'Lesson finished';
    $datefin = date('Y-m-d H:i:s');
    // query to the id of progresse if it match the id lesson and user login 
    $queryProgress = $connection->prepare('SELECT * FROM progresses WHERE id_lesson = :idlesson AND id_user=:iduser');
    $queryProgress->bindValue(':idlesson', $_SESSION['idlesson']);
    $queryProgress->bindValue(':iduser', $idUser);
    $queryProgress->execute();
    $resultProgress = $queryProgress->fetch(PDO::FETCH_ASSOC);
    // ID progress 
    $idprogress = $resultProgress['id_progress'];

    // update the status of the progress to lesson finished
    $queryUpdateProgress = $connection->prepare('UPDATE progresses SET status=:status,date_end=:dateend
         WHERE id_progress=:idprogress');
    $queryUpdateProgress->bindValue(':status', $status);
    $queryUpdateProgress->bindValue(':dateend', $datefin);
    $queryUpdateProgress->bindValue(':idprogress', $idprogress);
    $updateIsGood = $queryUpdateProgress->execute();

    if ($updateIsGood) {
        header('Location:viewLesson.php?idLesson= ' . $_SESSION['idlesson']);
    }
}
if (isset($_POST['updatepassword'])) {
    if (!empty($_POST)) {
        extract($_POST);
        $u = [$resent, $password, $confirme];
        $resent = $u[0];
        $user = new user();
        $dbpass = $user->getPassword($_SESSION['id_user']);
        $db = $dbpass['password'];
        if (password_verify($resent, $db)) {
            $password = $u[1];
            $verify = $u[2];
            if ($verify == $password) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user->updatePassword($hash, $_SESSION['id_user']);
            } else {
                $_SESSION['error'] = 'Confirme password not matched';
                header('location:security.php');
            }
        } else {
            $_SESSION['error'] = 'Error password enter the valid one';
            header('location:security.php');
        }
    } else   
    $_SESSION['error'] = 'all fields are required';
    header('location:security.php');
}

if (isset($_POST['update'])) {
    if (!empty($_POST)) {
        extract($_POST);
        $idUser = $_SESSION['id_user'];
        $c = [$firstname, $lastname, $email, $idUser];
        $user = new user();
        $user->updateUserInfo($c);
        unset($_POST);
    }else
    $_SESSION['error'] = 'all fields are required';
    header('location:profileUser.php');
}
