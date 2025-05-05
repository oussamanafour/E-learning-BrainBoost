<?php
session_start();

include('../connection/connection.php');

$id = $_SESSION['idInstructor'];
/* $status = 'Offline';

$update_status = $connection->prepare('UPDATE instructor SET status=:status WHERE id_admin=:id_admin');
$update_status->bindParam(':status', $status);
$update_status->bindParam(':id_admin',$id_admin);
$isok = $update_status->execute(); */

/* if($isok){ */
unset($_SESSION['idInstructor']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['emailInstructor']);
unset($_SESSION['roleins']);

header('location:index.php');
/* } */
