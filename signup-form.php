<?php
session_start();
  $first='';
  $last='';
  $email='';
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <script src="BootstrapJS/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image" href="images_for_dev/brainboost.png">
  <meta name="description" content="">
  <title>Sign-up</title>
  <link href="BootstrapCSS/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrapCSS/bootstrapstyle.css">
  <!-- Custom styles for this template -->
  <link href="BootstrapCSS/sign-in.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary ">

  <?php include('includes/nav-bar.php'); ?>

  <main class="form-signin m-auto border border-secondary my-5 shadow-sm p-3 mb-5 bg-body-tertiary rounded">

    <form class="mt-5 p-1" method="post" action="signup.php">
      <h1 class="h5 mb-4 fw-normal">Sign up and start learning</h1>

      <!-- Success Message -->
      <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION['success']; ?>
        </div>
      <?php
      unset($_SESSION['success']);
      } ?>
      <!-- Error Message -->
      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $_SESSION['error']; ?>
        </div>
      <?php
      unset($_SESSION['error']);
      } 
      ?>
      <!-- Error Message  GET-->
      <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $_GET['error']; ?>
        </div>
        <meta http-equiv="refresh" content="2;url=http://localhost/brainboost_academy/signup-form.php">
      <?php
      } ?>

      <div class="row g-3">
        <div class="form-floating col-md-6">
          <input type="text" class="form-control" name="first_name" placeholder="First name">
          <label for="floatingInput">First name</label>
        </div>

        <div class="form-floating col-md-6 ">
          <input type="text" class="form-control" name="last_name" placeholder="Last name">
          <label for="floatingInput">Last name</label>
        </div>

        <div class="form-floating col-md-12 ">
          <input type="email" class="form-control" name="email" placeholder="email">
          <label for="floatingInput">Email</label>
        </div>

        <div class="form-floating col-md-12">
          <input type="password" class="form-control" placeholder="password" name="password"> 
          <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating mb-3 col-md-12">
          <input type="password" class="form-control" placeholder="confirme" name="confirm_password">
          <label for="PasswordConfirme">Confirme password</label>
        </div>

      </div>
      <button class="btn btn-primary w-100 mb-2 py-2" type="submit" name="signup">Sign up</button>
      <hr>
      <p class="mt-2 mb-3 text-center text-body-secondary">Already have an account?<a class="ms-2" href="login.php">Log in</a>
      </p>
    </form>

  </main>
  <?php include('includes/footer2.php'); ?>
  <!--  -->
  <script src="BootstrapJS/bootstrap.bundle.min.js"></script>
</body>

</html>