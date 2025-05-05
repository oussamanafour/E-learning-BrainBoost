<?php
$host = 'localhost';
$db = 'naiptv37_brainboostacademy';
$username = 'naiptv37_oussama';
$password = 'Hmk9-D*ox9+.';
try{
    $connection = NEW PDO ("mysql:host=$host;dbname=$db_name;charset=utf8",$username,$password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'Erreur ! ' . $e;
}