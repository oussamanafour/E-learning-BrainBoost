<?php
session_start();
include('../connection/connection.php');

$idAdmin = $_SESSION['id_admin'];

$queryDislpayAdmins = $connection->prepare('SELECT * FROM administrators WHERE id_admin=:id_admin');
$queryDislpayAdmins->bindValue(':id_admin', $idAdmin);
$queryDislpayAdmins->execute();
$result = $queryDislpayAdmins->fetch();

//ar_dump($result);
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
                                <a class="nav-link active" aria-current="true" href="admin_profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="security.php">security</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Start of the alert -->
                       <?php include('../includes/errorAndSuccesMsg.php'); ?>
                        <!-- END of the alert -->
                        <form action="action_admin.php" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="First name" name="firstname" value="<?= $result['first_name']; ?>">
                                        <label for="floatingInput">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Last name" name="lastname" value="<?= $result['last_name']; ?>">
                                        <label for="floatingInput">Last name</label>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="Email" name="email" value="<?= $result['email']; ?>">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Role" value="<?= $result['role'] ?>" readonly>
                                        <label for="floatingInput">Role</label>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3 mx-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="date creation" value="<?= $result['date_creation'] ?>" readonly>
                                        <label for="floatingInput">date creation </label>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6 d-flex justify-content-start ms-3 py-2">
                                    <button type="submit" class="btn btn-primary mb-3" name="update">update</button>
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