<?php
session_start();
include("../connection/connection.php");
$score = $_SESSION['score'];
if ($score >= 15) {
    $msg = 'Execellent';
} elseif ($score >= 10) {
    $msg = 'Not too bad ';
} else {
    $msg = 'You failed , you need to study more';
}
$getlastidquiz = $connection->prepare('SELECT * from quizzes WHERE id_lesson =:id  order by date_post DESC LIMIT 1');
$getlastidquiz->bindValue(':id', $_SESSION['IdlessonForQuiz']);
$getlastidquiz->execute();
$getID = $getlastidquiz->fetch();
$idQuiz = $getID['id_quiz'];


$titleLesson = $_SESSION['lessonForquiz'];
$idLesson = $_SESSION['IdlessonForQuiz'];
$idUse = $_SESSION['id_user'];

// check if the quiz alredy passed by user 
$checkQuiz = $connection->prepare('SELECT *  from recordsquiz WHERE id_user =:iduser AND id_lesson=:idlesson');
$checkQuiz->bindValue(':iduser', $_SESSION['id_user']);
$checkQuiz->bindValue(':idlesson', $_SESSION['IdlessonForQuiz']);
$checkQuiz->execute();
$GetidRecord = $checkQuiz->fetch();

$Count =  $checkQuiz->rowCount();
//$idrecord =  $GetidRecord['id'];

if ($Count > 0) {
    $updateRecordQuiz = $connection->prepare('UPDATE recordsquiz SET score=:score ,date=:date WHERE id=:id ');
    $updateRecordQuiz->bindValue(':score', $score);
    $updateRecordQuiz->bindValue(':date', date('Y-m-d H:i:s'));
    $updateRecordQuiz->bindValue(':id', $GetidRecord['id']);
    $updateRecordQuiz->execute();
} else {
    $insertRecordQuiz = $connection->prepare('INSERT INTO recordsquiz (id_lesson,id_user,id_quiz,lesson_title,score)
        VALUES (:idlesson,:iduser,:idquiz,:titlelesson,:score)');
    $insertRecordQuiz->bindValue(':titlelesson', $titleLesson);
    $insertRecordQuiz->bindValue(':idlesson', $idLesson);
    $insertRecordQuiz->bindValue(':iduser', $idUse);
    $insertRecordQuiz->bindValue(':idquiz', $idQuiz);
    $insertRecordQuiz->bindValue(':score', $score);
    $insertRecordQuiz->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../includes/head.php') ?>
    <title>Result Quiz</title>
</head>
<body>
    <div class="container d-flex " style="margin-top: 200px;">
        <div class="card mx-auto p-5 text-center bg-light">
            <img class="mx-auto mb-5" src="../images_for_dev/checked.png" width="100" height="100" alt="done">
            <h1 style="color: #28a745;">You're Finished your Quiz</h1>
            <p class="fs-4">Lesson Title : <?= $_SESSION['lessonForquiz']; ?></p>
            <p class="fs-5 text-bold" style="font-weight: bold;">Quiz score : <?= $score; ?> /20</p>
            <p class="fs-5 "><?= $msg; ?></p>
            <a class="btn btn-primary mt-3" href="viewLesson.php?idLesson=<?= $_SESSION['IdlessonForQuiz']; ?>">Go back to lesson</a>
        </div>
    </div>
</body>
</html>

