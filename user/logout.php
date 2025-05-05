<?php
session_start();
include('../connection/connection.php');

$id_user = $_SESSION['id_user'];
$status = 'Offline';

$updateStatusLogoutUser = $connection->prepare('UPDATE users SET status=:status WHERE id_user=:id_user');
$updateStatusLogoutUser->bindParam(':status', $status);
$updateStatusLogoutUser->bindParam(':id_user', $id_user);
$isok = $updateStatusLogoutUser->execute();

if ($isok) {
    unset($_SESSION['id_user']);
    unset($_SESSION['U_first_name']);
    unset($_SESSION['U_last_name']);
    unset($_SESSION['email']);    
    header('location:../login.php');
}
