<?php
session_start();
include('../connection/connection.php');

$id_admin = $_SESSION['id_admin'];
$queryDislpayAdmins = $connection->prepare('SELECT * FROM administrators WHERE id_admin=:id_admin');
$queryDislpayAdmins->bindValue(':id_admin', $id_admin);
$queryDislpayAdmins->execute();
$result = $queryDislpayAdmins->fetch();
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
    <?php include('icons.php'); ?>
    <!-- Start of the main  -->
    <main class="d-flex flex-nowrap">
        <!-- sidebar bootstrap 5.3 -->
        <?php include('side-bar.php') ?>
      
        <div class="w-100">
            <!-- Nav bar bootstrap -->
            <nav class="navbar bg-dark ">
                <div class="container-fluid d-flex justify-content-center">
                    <a class="navbar-brand text-uppercase text-light">My profile</a>
                </div>
            </nav>
            <div class="container-fluid mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="admin_profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="security.php">Security</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                            <!-- Start of the alert -->
                        <?php include('errorAndSuccessMsg.php'); ?>
                             <!-- END of the alert -->
                        <form action="action_admin.php" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="password" class="form-control" placeholder="Resent password" name="ResentPassCode">
                                        <label for="floatingInput">Resent password</label>
                                    </div>
                                </div>
                                <div class="col-md-8"></div>

                                <div class="col-md-4">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="password" class="form-control" placeholder="New password" name="newPassCode">
                                        <label for="floatingInput">New password</label>
                                    </div>
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-4 mb-5">
                                    <div class="form-floating my-3 mx-3 ">
                                        <input type="password" class="form-control " placeholder="Confirm password" name="confirmNewPassCode">
                                        <label for="floatingInput">confirm password</label>
                                    </div>
                                </div>
                                <div class="col-md-8"></div>

                                <div class="col-md-4 d-flex justify-content-start mx-3 mb-5">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>

                            </div>

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