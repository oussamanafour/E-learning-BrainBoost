<?php
session_start();

include('check_if_log.php');
include('../connection/connection.php');

$id_admin = $_SESSION['id_admin'];
$status = 'Offline';

$update_status = $connection->prepare('UPDATE administrators SET status=:status WHERE id_admin=:id_admin');
$update_status->bindParam(':status', $status);
$update_status->bindParam(':id_admin', $id_admin);
$isok = $update_status->execute();

if ($isok) {
    unset($_SESSION['id_admin']);
    unset($_SESSION['A_firstname']);
    unset($_SESSION['A_lastname']);
    unset($_SESSION['emailAdmin']);
    unset($_SESSION['role']);
    header('location:index.php');
    session_destroy();
}
