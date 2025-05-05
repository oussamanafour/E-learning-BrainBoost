<?php
session_start();
include('connection/connection.php');
if (isset($_GET['idCours'])) {
    $CoursesQuery = $connection->prepare('SELECT c.id_course, c.id_category, c.image , c.title ,c.description , c.level, c.duration , i.first_name ,i.last_name ,c.date_post  FROM courses c INNER JOIN
instructor i on c.id_instructor = i.id_instructor WHERE id_course = :idcourse ');
    $CoursesQuery->execute(array(':idcourse' => $_GET['idCours']));
    $CoursesQuery->execute();
    $result = $CoursesQuery->fetch();
}

$queryLesson = $connection->prepare('SELECT * FROM lessons WHERE id_course = :idcourse  order by date_post asc');
$queryLesson->bindValue(':idcourse', $_GET['idCours']);
$queryLesson->execute();
$resultLesson = $queryLesson->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<script src="BootstrapJS/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <!-- icon of the page -->
  <link rel="icon" type="image" href="images_for_dev/">
  <!--bootstrap link -->
  <link href="BootstrapCSS/bootstrap.min.css" rel="stylesheet">
  <!-- icons divder and img bootstrap link -->
  <link rel="stylesheet" href="BootstrapCSS/bootstrapstyle.css">
  <!-- icons bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- mon style -->
    <link rel="stylesheet" href="BootstrapCSS/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="css/style.css">
  <script async src="JavaScript/myScript.js"></script>
    <title>Course details</title>
</head>
<body>
    <?php include('includes/nav-bar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5">
                    <img src="imageForCourses/<?= $result['image']; ?>" class="card-img-bottom" height="350" alt="brainboost">
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
    <?php include('includes/footer2.php') ?>
    <!-- END Card -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>
</html>