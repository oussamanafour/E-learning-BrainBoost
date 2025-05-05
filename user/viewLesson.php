<?php
session_start();
include('../connection/connection.php');
date_default_timezone_set('Africa/Casablanca');
unset($_SESSION['score']);
//  insert to progresse table 
if (isset($_GET['idLesson'])) {
    $idLesson = $_GET['idLesson'];
    // Check if progress already exists for this lesson and user
    $checkProgressQuery = $connection->prepare('SELECT * FROM progresses WHERE id_lesson = :idLesson AND id_user = :id_user');
    $checkProgressQuery->bindValue(':idLesson', $idLesson);
    $checkProgressQuery->bindValue(':id_user', $_SESSION['id_user']);
    $checkProgressQuery->execute();
    $existingProgress = $checkProgressQuery->fetch();

    if (!$existingProgress) {
        // query to bring lesson details 
        $displayLessonsQuery = $connection->prepare('select * from lessons WHERE id_lesson = :id');
        $displayLessonsQuery->bindValue(':id', $_GET['idLesson']);
        $displayLessonsQuery->execute();
        $dataleson = $displayLessonsQuery->fetch();
        // take some varible to insert it in progress table 
        $title = $dataleson['title'];
        $status = 'In progress';
        $dateStart = date('Y-m-d H:i:s');
       
        $id_user = $_SESSION['id_user'];
        // query insert in table progress 

        if (!empty($id_user) && !empty($idLesson)) {
            try {
                $queryInsertProgress = $connection->prepare('INSERT INTO progresses (titre_lesson,status,date_start,id_user,id_lesson)
        VALUES (:title,:status,:dateStart,:id_user,:idLesson)');
                $dataProgress = [
                    ':title' => $title,
                    ':status' => $status,
                    ':dateStart' => $dateStart,
                    ':id_user' => $id_user,
                    ':idLesson' => $idLesson
                ];
                $queryInsertProgress->execute($dataProgress);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
//check if progress statuts is finished or not 
$queryCheckStatus = $connection->prepare('SELECT * FROM progresses WHERE id_user=:iduser AND id_lesson=:idlesson');
$queryCheckStatus->bindValue(':iduser', $_SESSION['id_user']);
$queryCheckStatus->bindValue(':idlesson', $_GET['idLesson']);
$queryCheckStatus->execute();
$resultStatus = $queryCheckStatus->fetch();

if (isset($_GET['idLesson'])) {
    $queryLesson = $connection->prepare('SELECT * FROM lessons WHERE id_lesson = :idLesson');
    $queryLesson->bindValue(':idLesson', $_GET['idLesson']);
    $queryLesson->execute();
    $resultLesson = $queryLesson->fetch();
}

    $_SESSION['lessonForquiz'] = $resultLesson['title'];
?>      
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/head.php'); ?>
    <title>Course details</title>
</head>

<body>
    <?php include('navBarUser.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3><?= $resultLesson['title']; ?></h1>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <video autoplay muted controls height="700" width="1000" src="../videosForLessons/<?= $resultLesson['contenu_video']; ?>"> </video>
                    </div>
                    <h3 class="mx-5 mt-2">description : </h3>
                    <p class="mx-5">
                    <pre class="mx-5 fs-5"><?= $resultLesson['description']; ?> </pre>
                    </p>
                    <?php if ($resultStatus['status'] != 'Lesson finished') { ?>
                        <a href="action.php?idLesson=<?= $resultLesson['id_lesson']; ?>" class="mx-5 my-5 text-center">Finish Watching</a>
                    <?php  } ?>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="viewCourse.php?idCours=<?= $resultLesson['id_course']; ?>" class="btn btn-primary">Back</a>
                        <a href="passQuiz.php?idlesson=<?= $resultLesson['id_lesson']; ?>&nq=1" class="btn btn-success">Quiz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    /*  echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>'; */
   /*  echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; */

    ?>

    <?php include('footer2.php') ?>
    <!-- END Card -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>

</html>