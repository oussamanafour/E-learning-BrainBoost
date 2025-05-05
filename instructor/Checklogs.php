<?php 
if(!isset($_SESSION['emailInstructor']) && $_SESSION['role'] !='Instructor' ){
    header('location:index.php');
}