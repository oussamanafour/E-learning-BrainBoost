<?php 
try{
    $db = 'mysql:host=localhost;dbname=hotel';
    $user = 'root';
    $pass = '';
    $pdo = new PDO($db, $user, $pass);
    echo 'connected';
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage() . "<br>";
}