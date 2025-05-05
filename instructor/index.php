<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/head.php'); ?>
    <title>Instructor Login</title>
    <link rel="stylesheet" href="../BootstrapCSS/sign-in.css">
</head>

<body>
    
    <!-- Form Login Admin -->
    <main class="form-signin m-auto border border-secondary mt-5 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <form class="form-log mt-5 p-1 " method="post" action="verifyLoginIns.php">
            <div class="d-flex justify-content-center">
            <img class="mt-4 mx-auto" src="../images_for_dev/brainboost.png" alt="logo" width="150px" height="150px">
            </div>
            <h1 class="h5 mb-4 fw-normal text-center">Instructor Login</h1>
            <!-- Error Message -->
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
            <div class="form-floating ">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating my-5">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 mb-5 py-2" type="submit" name="login">Login</button>
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