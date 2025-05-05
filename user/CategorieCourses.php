<?php
session_start();
include('../connection/connection.php');
if (isset($_GET['idcat'])) {
    $CoursesQuery = $connection->prepare('SELECT c.id_course, c.id_category, c.image , c.title ,c.description , c.level, c.duration , i.first_name ,i.last_name  FROM courses c INNER JOIN
instructor i on c.id_instructor = i.id_instructor WHERE id_category = :idcat ');
    $CoursesQuery->execute(array(':idcat' => $_GET['idcat']));
    $CoursesQuery->execute();
    $result = $CoursesQuery->fetchAll();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/head.php'); ?>
    <title>Courses by category</title>
</head>

<body>
    <?php include('navBarUser.php'); ?>

    <!--  <div class="container mt-5 ">
            <div class="row">
                <form method="post" class="d-flex col-md-12">
                    <label for="Recherch" class="form-label">Search for Courses</label>
                    <input type="text" name="search" class="form-control">
                    <button class="btn ms-2" type="submit" name="rech"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div> -->

    <h1 class="mt-5 text-center">Liste of course </h1>

    <div class="container my-3">
        <div class="row ">
            <?php
            if (empty($result)) {
                echo '<p class="text-center  fs-2">No courses available for the moment.</p>';
            } else {
                foreach ($result as $dataCourses) {
            ?>
                    <div class="col-md-3 h-75">
                        <div class="card mb-3" style="width:18rem;">
                            <img src="../imageForCourses/<?= $dataCourses['image']; ?>" width="250" height="250" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= strtolower($dataCourses['title']);  ?></h5>
                                <span class="card-text d-block">Instructor : <?= $dataCourses['first_name'] .  ' ' . $dataCourses['last_name']; ?></span>
                                <span class="card-text d-block">Level : <?= $dataCourses['level']; ?></span>
                                <span class="d-block w-100">Rating : <span class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span></span>
                                <span class="card-text d-block">duration : <?= $dataCourses['duration']; ?></span>
                                <a href="viewCourse.php?idCours=<?= $dataCourses['id_course']; ?>" class="btn btn-primary mt-1 w-100">view Course</a>
                            </div>
                        </div>

                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include('footer2.php') ?>
</body>

</html>