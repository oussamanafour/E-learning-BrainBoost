<?php
session_start();
include('../connection/connection.php');

if (isset($_GET['idUser'])) {
    $_SESSION['idUser'] = $_GET['idUser'];

    $queryDisplayUsers = $connection->prepare('SELECT * FROM users WHERE id_user=:id');
    $queryDisplayUsers->bindValue(':id', $_SESSION['idUser']);
    $queryDisplayUsers->execute();
    $result = $queryDisplayUsers->fetch(PDO::FETCH_ASSOC);
}

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
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">Edit user</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Edit users</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="user_liste.php">User list</a></li>
                </ol>
            </nav>

            <div class="container-fluid">
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row"> </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit user</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-7 col-lg-8">
                            <form method="post" action="action_admin.php">
                                <div class="row g-3">
                                    <div class="col-sm-3">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" name="firstname" value="<?= $result['first_name']; ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" class="form-control" name="lastname" value="<?= $result['last_name']; ?>">
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-6">
                                        <label for="username" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text">@</span>
                                            <input type="email" class="form-control" name="email" placeholder="you@exemple.com" value="<?= $result['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6"></div>

                                    <div class="col-md-6 mb-5">
                                        <label for="lastname" class="form-label">date creation</label>
                                        <input type="text" class="form-control" name="date" value="<?= $result['date_creation']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6 mb-5">
                                        <button class="btn btn-outline-primary" type="submit" name="updateUser">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
        </div>
    </main>
</body>
<!-- End of the main  -->
<!-- Script of  Bootstrap 5 JavaScript  -->
<script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
<script src="../BootstrapJS/sidebars.js"></script>

</html>