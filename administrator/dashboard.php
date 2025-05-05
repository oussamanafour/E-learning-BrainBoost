<?php
session_start();
   include('functions.php');
   include('check_if_log.php');
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
   <?php include('side-bar.php') ?>
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
        if(empty($_SESSION['A_firstname']) && empty($_SESSION['A_lastname']))
        {
          echo 'Welcome ADMIN';
        }else{
          echo 'WELCOME '. strtoupper($_SESSION['A_firstname']) .' ' . strtoupper($_SESSION['A_lastname']) ;
        }
        ?>
       </h3> 
        <div class="container-fluid px-4 ">
          <div class="row">
            <div class="col-xl-3 col-md-6">
            <a href="administrator_liste.php#ListeAdmin" class="text-decoration-none">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalAdmins(); ?></h2>
                  <h5 class="text-center">Total Administrators</h5>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?=getTotalUsers();?></h2>
                  <h5 class="text-center">Total users</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?=getTotalCategories();?></h2>
                  <h5 class="text-center">Total Categories</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalInstructor() ;?></h2>
                  <h5 class="text-center">Total Instructors</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><span class="text-success"><?=getTotalOnlineAdmins() ;?></span></h2>
                  <h5 class="text-center">Active Admins</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><span class="text-success"><?=getTotalOnlineUsers() ;?></span></h2>
                  <h5 class="text-center">Active Users</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalCourses() ;?></h2>
                  <h5 class="text-center">Total of Courses</h5>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-light text-dark cardHover mb-4">
                <div class="card-body">
                  <h2 class="text-center"><?= getTotalLessons() ;?></h2>
                  <h5 class="text-center">Total lessons</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer  -->
        <?php include('../includes/footer.php'); ?>
    </div>
    </div>
  </main>
  <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
  <script src="../BootstrapJS/sidebars.js"></script>
</body>
</html>