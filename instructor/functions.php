<?php
include('../connection/connection.php');

function getTotalCourses()
{
    global $connection;
    $getTotal = $connection->prepare('SELECT count(*) As total FROM courses WHERE id_instructor=:id');
    $getTotal->bindValue(':id', $_SESSION['idInstructor']);
    $getTotal->execute();
    $total =$getTotal->fetch();
    return  $total['total'];
}

function getTotalLessons()
{
    global $connection;
    $getTotal = $connection->prepare('SELECT count(*) As total FROM lessons WHERE id_instructor=:id');
    $getTotal->bindValue(':id', $_SESSION['idInstructor']);
    $getTotal->execute();
    $total =$getTotal->fetch();
    return  $total['total'];
}

function getTotalQuiz()
{
    global $connection;
    $getTotal = $connection->prepare('SELECT count(*) As total FROM quizzes WHERE id_instructor=:id');
    $getTotal->bindValue(':id', $_SESSION['idInstructor']);
    $getTotal->execute();
    $total =$getTotal->fetch();
    return  $total['total'];
}