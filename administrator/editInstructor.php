<?php
session_start();
include('check_if_log.php');
include('../connection/connection.php');
if (isset($_GET['idInstructor'])) {
    $_SESSION['idEditInstructor'] = $_GET['idInstructor'];
  
    $queryDisplayInstructor = $connection->prepare('SELECT * FROM instructor WHERE id_instructor=:id');
    $queryDisplayInstructor->bindValue(':id',$_SESSION['idEditInstructor']);
    $queryDisplayInstructor->execute();
    $result = $queryDisplayInstructor->fetch(PDO::FETCH_ASSOC);
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php') ?>
    <title>Edit instructor</title>
</head>

<body>
    <!-- icon for the dropdown -->
    <?php include('icons.php') ?>
    <!-- Start of the main  -->
    <main class="d-flex flex-nowrap">
        <!-- sidebar bootstrap 5.3 -->
        <?php include('side-bar.php') ?>
      

        <div class=" w-100">
            <!-- Nav bar bootstrap -->
            <nav class="navbar bg-body-tertiary mx-0">
                <div class="container-fluid ">
                    <a class="navbar-brand">Edit instructor</a>
                </div>
            </nav>

            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Edit instructor</li>
                    <li class="breadcrumb-item"><a href="instructor_liste.php">List of instructors</a></li>
                </ol>
            </nav>
            <div class="container-fluid">
            <?php include('errorAndSuccessMsg.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit instructor</h5>
                    </div>
                    <div class="card-body">
                    
                        <div class="col-md-7 col-lg-8">
                            <form method="post" action="Action_admin.php">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" name="firstname" value="<?= $result['first_name'];?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" name="lastname" value="<?= $result['last_name']; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text">@</span>
                                            <input type="email" class="form-control" name="email" placeholder="you@exemple.com" value="<?= $result['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="address" class="form-label">Domaine</label>
                                        <select class="form-select" aria-label="Default select example"  name="domaine" >
                                            <option value="">select domaine</option>
                                            <option value="Design" <?= $result['domaine'] == 'Design' ? 'selected' : '' ?>>Design</option>
                                            <option value="Development" <?= $result['domaine'] == 'Development' ? 'selected' : '' ?>>Development</option>
                                            <option value="Business" <?= $result['domaine'] == 'Business' ? 'selected' : '' ?>>Business</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mt-5">
                                        <button type="submit" class="btn btn-outline-primary" name="editInstructor">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
    </main>
</body>
<!-- End of the main  -->
<!-- Script of  Bootstrap 5 JavaScript  -->
<script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
<script src="../BootstrapJS/sidebars.js"></script>

</html>