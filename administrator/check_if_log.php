<?php 

if(!isset($_SESSION['emailAdmin']) /* && $_SESSION['role'] != 'Head-Admin' */ ){
    header("Location:../index.php");
}
?>