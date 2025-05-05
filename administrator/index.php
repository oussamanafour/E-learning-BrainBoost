<?php 
    session_start();
   /*  $pass ='123';
    $hash= password_hash($pass,PASSWORD_DEFAULT);
    echo $hash ; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/head.php'); ?>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../BootstrapCSS/sign-in.css">
</head>

<body>
    <?php include('icons.php') ?>
    <!-- Form Login Admin -->
    <main class="form-signin m-auto border border-secondary mt-5 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <form class="form-log mt-5 p-1 " method="post" action="verifyAdminsLog.php">
            <div class="d-flex justify-content-center">
            <img class="mt-4 mx-auto" src="../images_for_dev/brainboost.png" alt="logo" width="150px" height="150px">
            </div>
            <h1 class="h5 mb-4 fw-normal text-center">Admin Login</h1>
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
            <div class="form-floating my-5">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-dark w-100 mb-5 py-2" type="submit" name="login">Login</button>
            <hr>
            <p class="mt-2 mb-5 text-center text-body-secondary"><a class="ms-2" href="#">Forgot Password</a>
        </form>
    </main>
    <!-- Scripts -->
    <?php include('../includes/footer.php') ?>
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
    <script src="../BootstrapJS/sidebars.js"></script>
</body>

</html>