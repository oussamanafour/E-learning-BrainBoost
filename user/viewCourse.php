<?php
session_start();
include('../connection/connection.php');

if (isset($_GET['idCours'])) {
    $CoursesQuery = $connection->prepare('SELECT c.id_course, c.id_category, c.image , c.title ,c.description , c.level, c.duration , i.first_name ,i.last_name ,c.date_post  FROM courses c INNER JOIN
instructor i on c.id_instructor = i.id_instructor WHERE id_course = :idcourse ');
    $CoursesQuery->execute(array(':idcourse' => $_GET['idCours']));
    $CoursesQuery->execute();
    $result = $CoursesQuery->fetch();
}

$queryLesson = $connection->prepare('SELECT * FROM lessons WHERE id_course = :idcourse AND id_instructor = id_instructor order by date_post asc');
$queryLesson->bindValue(':idcourse', $_GET['idCours']);
$queryLesson->execute();
$resultLesson = $queryLesson->fetchAll();

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
            <div class="col-md-12">
                <div class="card my-5">
                    <img src="../imageForCourses/<?= $result['image']; ?>" class="card-img-bottom" height="350" alt="brainboost">
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="mt-2 ms-5 text-truncate"><?= $result['title']; ?></h1>
                <p class="w-75 overflow-hidden"><?= $result['description']; ?></p>
                <span class="d-block w-100">Rating : <span class="text-warning"> <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span></span>
                <span class="d-block w-100">Created par : <?= $result['first_name'] . ' ' . $result['last_name']; ?></span>
                <span class="d-block w-100">Level : <?= $result['level']; ?></span>
                <span class="d-block w-100">Date creation : <?= $result['date_post']; ?> </span>
            </div>

            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Lessons details</h1>
                    </div>
                    <?php
                    if (empty($resultLesson)) {
                        echo '<div class="text-center my-5 fs-4">No lesson found ...</div>';
                    }
                    $i = 1;
                    foreach ($resultLesson as $data) {
                    ?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between h-25">
                                <h5 class="card-title d-inline ">Lesson <?= $i++ ?> : </h5> <span><?= $data['title']; ?></span> <span class="">durée : 15 min</span>
                                <p><span><?= $data['date_post']; ?></p>
                                <?php
                                if (isset($_SESSION['email'])) {
                                ?>
                                <a href="viewLesson.php?idLesson=<?= $data['id_lesson']; ?>" class="btn btn-primary ">view Lesson</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



    </div>
    <?php include('footer2.php') ?>
    <!-- END Card -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>

</html>