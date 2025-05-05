<?php
$host ='localhost';
$db_name = 'bba';
$username = 'root';
$password ='';

try{
    $connection = NEW PDO ("mysql:host=$host;dbname=$db_name;charset=utf8",$username,$password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Erreur ! ' . $e->getMessage();
}