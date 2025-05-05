<?php
session_start();
//include('../connection/connection.php');
require('class.php');
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Users space</title>
</head>
<!-- End of the head -->
<!-- Start of body -->
<body>
    <?php include('../includes/iconsuser.php'); ?>
    <!-- Start of the main  -->
    <?php include('navBarUser.php'); ?>
    <main class="d-flex flex-nowrap">
        <!-- navbar bootstrap 5.3 -->

        <div class="w-100">

            <!-- Nav bar bootstrap -->
            <nav class="container navbar bg-dark mt-5">
                <div class="container-fluid d-flex justify-content-center">
                    <a class="navbar-brand text-uppercase text-light">My profile</a>
                </div>
            </nav>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                   
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="profileUser.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true">Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                    <?php include('../includes/errorAndSuccesMsg.php'); ?>
                        <form action="action.php" method="post">
                            <div class="row">
                            
                                <div class="col-md-9 my-4">
                                    <label>Changing password</label>
                                </div>
                                <div class="col-md-5">
                                    <div class=" mb-3">
                                        <label for="Resent" class="form-label">Resent</label>
                                        <input type="password" class="form-control" name="resent">
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="new" class="form-label">New password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="confirm" class="form-label">Confirme password</label>
                                        <input type="password" class="form-control" name="confirme">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="updatepassword">update</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
    </main>
    <!-- End of the main  -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
    <script src="../BootstrapJS/sidebars.js"></script>
</body>
<!-- end of body -->

</html>