<?php
session_start();
include('Checklogs.php');
include('functions.php');
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <?php include('../includes/head.php') ?>
  <title>Dashboard</title>
</head>

<body>

  <!-- icon for the dropdown -->
  <?php include('icons.php') ?>

  <main class="d-flex flex-nowrap">

    <?php include('sidebar.php') ?>



    <div class="w-100">

      <!-- Nav bar bootstrap -->

      <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Dashboard</a>
        </div>
      </nav>

      <!-- le contenu de la page  -->


      <h3 class="my-5 text-center">
        <?php
        if (empty($_SESSION['firstname']) && empty($_SESSION['lastname'])) {
          echo 'Welcome Instructor';
        } else {
          echo 'WELCOME BACK ' . strtoupper($_SESSION['firstname']) . ' ' . strtoupper($_SESSION['lastname']);
        }
        ?>
      </h3>
      <div class="container-fluid px-4 ">
        <div class="row">
          <div class="col-xl-4 col-md-4">
            <a href="#" class="text-decoration-none">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?=  getTotalCourses() ;?></h2>
                  <h5 class="text-center">Total Courses</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-md-4">
            <a href="#" class="text-decoration-none">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalLessons() ?></h2>
                  <h5 class="text-center">Total Lessons</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-xl-4 col-md-4">
            <a href="#" class="text-decoration-none">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalQuiz() ?></h2>
                  <h5 class="text-center">total Quizzes</h5>
                </div>
              </div>
            </a>
          </div>
        <!--   <div class="col-xl-3 col-md-6">
            <a href="#" class="text-decoration-none">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center">30</h2>
                  <h5 class="text-center">total Quizzes recordes</h5>
                </div>
              </div>
            </a>
          </div> -->



        </div>
      </div>
      <hr>
      <?php


/* echo 'id :'. $_SESSION['idInstructor'] . '<br>';
echo 'first_name :'. $_SESSION['firstname'] . '<br>';
echo 'last_name :'. $_SESSION['lastname'] . '<br>';
echo 'email :'. $_SESSION['emailInstructor'] . '<br>';
echo 'role :'. $_SESSION['roleins'] . '<br>'; */

?>

      <!-- footer  -->
      <?php include('../includes/footer.php'); ?>

     
    </div>
    </div>


  </main>

  <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
  <script src="../BootstrapJS/sidebars.js"></script>
</body>

</html>