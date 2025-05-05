<?php
session_start();
include('check_if_log.php');
require_once('../connection/connection.php');

if (isset($_GET['id_admin'])) {

    $_SESSION['idModifyAdmin'] = $_GET['id_admin'];

    $query_read = $connection->prepare('SELECT * FROM Administrators WHERE id_admin=:id');
    $query_read->bindValue(':id',$_GET['id_admin']);
    $query_read->execute();
    $result = $query_read->fetch();

}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <title>Admin Modification</title>
<?php include('../includes/head.php'); ?>
</head>
<!-- End of the head -->
<!-- Start of body -->
<body>
    <!-- icon for the dropdown -->
    <?php include('icons.php') ?>
    <!-- Start of the main  -->
    <main class="d-flex flex-nowrap">
        <!--Start sidebar bootstrap 5.3 -->
        <?php include('side-bar.php') ?>
        <!-- End sidebar bootstrap 5.3 -->
        
            <div class="w-100">
            <!-- Nav bar bootstrap -->
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">Modify Administrator</a>
                </div>
            </nav>

            <nav class="my-5 d-flex justify-content-between align-items-center "  aria-label="breadcrumb">
                <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                <li class="breadcrumb-item"><a href="administrator_liste.php">List Admin</a></li>
                </ol>
                <p class="me-3">id admin : <?= $_GET['id_admin'] ?> </p>
            </nav>

          
            <!-- Start Card -->
            <div class="card mx-auto" style="width:98%;">
                <div class="card-header">
                    <h5 class="card-title">Modify Admin</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-7 col-lg-8">
                        <form  method="post" action="action_admin.php">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="firstname" value="<?= $result['first_name'] ?>" >
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="lastname" value="<?= $result['last_name'] ?>" >
                                </div>

                                <div class="col-12">
                                    <label for="username" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">@</span>
                                        <input type="email" class="form-control" name="email" placeholder="you@exemple.com" value="<?= $result['email'] ?>" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Role</label>
                                    <select class="form-select" aria-label="Default select example" id="<?= $result['role'] ?>" name="role" >
                                        <option value="">Select role</option>
                                        <option value="Head-Admin" <?= $result['role'] == 'Head-Admin' ? 'selected' : '' ?>>Head Admin</option>
                                        <option value="Super-Admin" <?= $result['role'] == 'Super-Admin' ? 'selected' : '' ?>>Super Admin</option>
                                        <option value="Trail-Admin" <?= $result['role'] == 'Trail-Admin' ? 'selected' : '' ?>>Trail Admin</option>
                                    </select>
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-outline-primary" name="modify_admin">Modify</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Include footer -->
           
            </div>
            <?php include('../includes/footer.php'); ?>
        </div>
        <!-- END Card -->
        <!-- Script of  Bootstrap 5 JavaScript  -->
        <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
        <script src="../BootstrapJS/sidebars.js"></script>
</body>
<!-- end of body -->

</html>