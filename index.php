<?php
require_once('connection/connection.php');
$query_get_categories = $connection->prepare('SELECT * FROM categories');
$query_get_categories->execute();
$result = $query_get_categories->fetchAll(PDO::FETCH_ASSOC);

$queryGetCourses = $connection->prepare('SELECT c.id_course, c.image , c.title ,c.description , c.level, c.duration , i.first_name ,i.last_name  FROM courses c INNER JOIN
instructor i on c.id_instructor = i.id_instructor');
$queryGetCourses->execute();
$resultCourse = $queryGetCourses->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <script src="BootstrapJS/color-modes.js"></script>
  <link rel="icon" type="image" href="images_for_dev/brainboost.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="bootstrapCSS/bootstrap.min.css">
  <title>Brain Boost</title>
</head>

<body>
  <!-- Modal -->
  <div class="modal fade" id="instructorForm" tabindex="-1" aria-labelledby="instructorFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="instructorFormLabel">Become an instructor in BrainBoost</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="signup-ins.php" method="post">
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
                    <option value="<?= $row['designation']; ?>"><?= $row['designation']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-12 mt-4">
                <p>Already have an instructor account ?<a href="instructor/index.php" target="_blank">sign in</a></p>
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
  <!-- header -->
  <?php include('includes/nav-bar.php'); ?>
  <main class="px-3 d-flex align-items-center flex-column">
    <div class="container-fluid d-flex justify-content-center">
      <div class="row">
        <div class=" col-xl-12">
          <img src="images_for_dev/landing6.jpg" alt="cover" width="1620" height="700">
        </div>
      </div>
    </div>
    <br><br><br>
    <div class="container w-100 mt-5">
      <img src="images_for_dev/img2.jpg" alt="">
    </div>
    <h1 id="Categories" class=" my-2">Categories</h3>
      <div class="row">
        <?php
        foreach ($result as $data) {
        ?>
          <div class="col-md-3 my-5 d-flex  justify-content-center">
            <div class="card" style="width: 20rem;">
              <img src="imageCategorie/<?= $data['image']; ?>" height="223" width="250" class="card-img-top" alt="<?= $data['designation']; ?>">
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
      <br><br><br><br>
      <h2 id="Courses" class="text-center h1 mb-2">Courses</h3>
        <div class="container mt-5">
          <div class="row ">
            <?php
            if (empty($resultCourse)) {
              echo '<p class="text-center fs-2 mb-5">No courses available for the moment.</p>';
            } else {
              foreach ($resultCourse as $dataCourses) {
            ?>
                <div class="col-md-3 h-75">
                  <div class="card mb-5" style="width:18rem;">
                    <img src="imageForCourses/<?= $dataCourses['image']; ?>" width="250" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-truncate"><?= $dataCourses['title']; ?></h5>
                      <span class="card-text d-block">Instructor : <?= $dataCourses['first_name'] .  ' ' . $dataCourses['last_name']; ?></span>
                      <span class="card-text d-block my-2">Level : <?= $dataCourses['level']; ?></span>
                      <span class="d-block w-100">Rating : <span class="text-warning"> <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span></span>
                      <a href="viewcourse.php?idCours=<?= $dataCourses['id_course']; ?>" class="btn btn-primary mt-4 w-100">view Course</a>
                    </div>
                  </div>

                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
        <div class="container my-5">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
              <img src="images_for_dev/instrutor.png" alt="instructor" width="500" height="500">
            </div>
            <div class="col-md-6 d-flex flex-column w-25">
              <h2 class="h3 mb-3">Become an instructor</h3>
                <p class="">Instructors from around the world teach learners on BrainBoost.
                  We provide the tools and skills to teach what you love.</p>
                <button type="button" class="btn btn-primary w-75" data-bs-toggle="modal" data-bs-target="#instructorForm">
                  Start teaching today
                </button>
            </div>
          </div>
        </div>

        <?php include('includes/footer2.php'); ?>
        <script src="BootstrapJS/bootstrap.bundle.min.js"></script>
  </main>
</body>

</html>