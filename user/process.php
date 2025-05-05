<?php
session_start();
include('../connection/connection.php');

$getTotalofquestion = $connection->prepare('SELECT * FROM quizzes WHERE id_lesson=:idless');
$getTotalofquestion->bindValue(':idless', $_SESSION['IdlessonForQuiz']);
$getTotalofquestion->execute();
$Totalofquestion = $getTotalofquestion->rowCount();

$_SESSION['correctAnswer'] = 0;


if (isset($_POST['endQuiz'])) {
    $numberQuestion = $_POST['numberquestion'];
    $answer = $_POST['answer'];
    //check is score 
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }
    // check if variable is set 
  
    // get the answer from db and check if it's correct 
    $queryGetQuizAnswer = $connection->prepare('SELECT * FROM quizzes WHERE id_lesson=:idles AND number_question=:nq');
    $queryGetQuizAnswer->bindValue(':idles', $_SESSION['IdlessonForQuiz']);
    $queryGetQuizAnswer->bindValue(':nq', $numberQuestion);
    $queryGetQuizAnswer->execute();
    $row = $queryGetQuizAnswer->fetch(PDO::FETCH_ASSOC);
    $Result = $row['answer'];
    $_SESSION['idquiz'] = $row['id'];

    // check the answer if it's correct 

    if ($Result == $answer) {
        $_SESSION['score'] += 5;
    } 

    // check if the number of question is equal to the total number of question
    if ($numberQuestion == $Totalofquestion) {
        header('location:resultQuiz.php?result=done');
    } else {
        header('location:passQuiz.php?idlesson=' . $_SESSION['IdlessonForQuiz'] . '&nq=' . ($numberQuestion + 1));

    }


    
}
