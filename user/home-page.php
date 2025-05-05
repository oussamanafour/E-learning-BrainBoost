<?php session_start();
require_once('../connection/connection.php');

$query_get_categories = $connection->prepare('SELECT * FROM categories');
$query_get_categories->execute();
$result = $query_get_categories->fetchAll();

$queryGetCourses = $connection->prepare('SELECT c.id_course,c.image , c.title ,c.description , c.level, c.duration , i.first_name ,i.last_name  FROM courses c INNER JOIN
instructor i on c.id_instructor = i.id_instructor');
$queryGetCourses->execute();
$resultCourse = $queryGetCourses->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../includes/head.php') ?>
  <title>Home User</title>
</head>
<!-- Modal -->
<div class="modal fade" id="instructorForm" tabindex="-1" aria-labelledby="instructorFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="instructorFormLabel">Become an instructor in BrainBoost</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname">
              </div>
              <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname">
              </div>
              <div class="col-12">
                <label for="username" class="form-label">Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="email" class="form-control" name="email" placeholder="you@exemple.com">
                </div>
              </div>
              <div class="col-12">
                <label for="username" class="form-label">Password</label>
                <div class="input-group has-validation">
                  <input type="password" class="form-control" name="password">
                </div>
              </div>
              <div class="col-12">
                <label for="address" class="form-label">Domaine</label>
                <select class="form-select" aria-label="Default select example" name="domaine">
                  <option value="">select domaine</option>
                  <?php
                  foreach ($result as $row) {
                  ?>
                    <option value="<?= $row['id_category']; ?>"><?= $row['designation']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-12 mt-4">
                <p>Already have an instructor account ?<a href="../instructor/index.php">sign in</a></p>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="signupInstructor">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<body class="">
  <!-- header  nav bar-->
  <?php include('navBarUser.php'); ?>

  <!-- <h3 class="text-center mt-5">WECOME BACK <?= $_SESSION['U_first_name'] . ' ' . $_SESSION['U_last_name'] ?></h1> -->

    <main class="px-3 d-flex align-items-center flex-column">
      <div class="container-fluid d-flex justify-content-center">
        <div class="row">
          <div class=" col-xl-12">
          <img src="../images_for_dev/landing7.jpg" alt="elearning" width="1620" height="700">
          </div>
        </div>
      </div>

      <br><br><br>

      <div class="container w-100 mt-5">
        <img src="../images_for_dev/img2.jpg" alt="">
      </div>


      <h1 id="categories" class=" mt-5">Categories</h1>

      <div class="container mt-5">
        <div class="row">
          <?php
          foreach ($result as $data) {
          ?>
            <div class="col-md-3 my-5 d-flex  justify-content-center">
              <div class="card" style="width: 20rem;">
                <a href="CategorieCourses.php?idcat=<?= $data['id_category'] ?>"><img src="../imageCategorie/<?= $data['image']; ?>" height="223" width="250" class="card-img-top" alt="<?= $data['designation']; ?>"></a>
                <div class="card-body">
                  <h5 class="card-title"><?= $data['designation']; ?></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>

      <h2 id="courses" class="h1 mb-5">Courses</h2>

      <div class="container my-5">
        <div class="row">
        <?php
            if (empty($resultCourse)) {
              echo '<p>No courses available for the moment.</p>';
            } else {
              foreach ($resultCourse as $dataCourses) {
            ?>
          <div class="col-md-3 h-75 my-3">
                <div class="card mb-3" style="width:18rem;">
                  <img src="../imageForCourses/<?= $dataCourses['image'] ;?>" width="250" height="250" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title text-truncate"><?= $dataCourses['title'] ;?></h5>
                    <span class="card-text d-block">Instructor : <?= $dataCourses['first_name'] .  ' ' . $dataCourses['last_name'] ;?></span>
                    <span class="card-text d-block my-2">Level : <?= $dataCourses['level'] ;?></span>
                     <span class="d-block w-100">Rating : <span class="text-warning"> <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span></span>
                    <a href="viewCourse.php?idCours=<?= $dataCourses['id_course'] ;?>" class="btn btn-primary mt-4 w-100">View Course</a>
                  </div>
                </div>
           
          </div>
          <?php
              }
            }
            ?>
        </div>
        <div class="container my-5 mt-5">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
            <img src="../images_for_dev/img3.jpg" alt="instructor" width="500" height="500">
            </div>
            <div class="col-md-6 d-flex flex-column w-25">
              <h2 class="h3 mb-3">Become an instructor</h3>
                <p class="">Instructors from around the world teach learners on BrainBoost.
                  We provide the tools and skills to teach what you love.</p>
                  <button type="button" class="btn btn-primary w-75" data-bs-toggle="modal" data-bs-target="#instructorForm">  Start teaching today
                  </button>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include('footer2.php') ?>
    <!-- END Card -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>
</html>