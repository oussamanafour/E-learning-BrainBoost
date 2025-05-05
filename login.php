<?php 
  session_start();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <script src="BootstrapJS/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image" href="images_for_dev/brainboost.png">
  <meta name="description" content="">
  <title>Login</title>
  <link href="BootstrapCSS/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrapCSS/bootstrapstyle.css">
  <!-- Custom styles for this template -->
  <link href="BootstrapCSS/sign-in.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary ">
  <?php include('includes/nav-bar.php'); ?>
  <main class="form-signin m-auto border border-secondary my-5 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
    <form class="form-log mt-5 p-1" method="post" action="verify.php">
      <h1 class="h5 mb-4 fw-normal">Log in to your BrainBoost account</h1>
      <!-- Error Message -->
      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $_SESSION['error']; ?>
        </div>
      <?php
      unset($_SESSION['error']);
      } ?>
      <div class="form-floating ">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating my-4">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="btn btn-primary w-100 mb-2 py-2" type="submit" name="sign-in">Sign in</button>
      <p class="mt-2 mb-3 text-center text-body-secondary">or<a class="ms-2" href="forgot-password.php">Forgot Password</a>
        <hr>
      <p class="mt-2 mb-3 text-center text-body-secondary">You don't have an account?<a class="ms-2" href="signup-form.php">Sign up</a>
      </p>
    </form>
  </main>
  <?php include('includes/footer2.php'); ?>
  <script src="BootstrapJS/bootstrap.bundle.min.js"></script>
</body>
</html>