<?php
session_start();
require('class.php');
$id = $_SESSION['id_user'];
$USER = new User();
$result = $USER->getUserInfo($id);
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
                                <a class="nav-link active" aria-current="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="security.php">Password</a>
                            </li>
                        </ul>
                    </div>
                    <?php include('../includes/errorAndSuccesMsg.php'); ?>
                    <div class="card-body">
                        <form action="action.php" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class=" mb-3">
                                        <label for="FirstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" name="firstname" value="<?= $result['first_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="LastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" name="lastname" value="<?= $result['last_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class=" mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?= $result['email']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-3 mb-5">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Date creation</label>
                                        <input type="text" class="form-control" value="<?= $result['date_creation']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="update">update</button>
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