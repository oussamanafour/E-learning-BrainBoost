<?php
session_start();
include('../connection/connection.php');

if (isset($_GET['idCat'])) {
    $_SESSION['idCategory'] = $_GET['idCat'];
    $queryDisplayCategories = $connection->prepare('SELECT * FROM categories WHERE id_category=:id');
    $queryDisplayCategories->bindValue(':id',$_SESSION['idCategory']);
    $queryDisplayCategories->execute();
    $result = $queryDisplayCategories->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Edit category</title>
</head>
<body>
    <!-- icon for the dropdown -->
    <?php include('icons.php') ?>
    <!-- Start of the main  -->
    <main class="d-flex flex-nowrap">
        <!-- sidebar bootstrap 5.3 -->
        <?php include('side-bar.php') ?>
        <!-- end sidebar bootstrap 5.3 -->
        <div class="w-100">
            <!-- Nav bar bootstrap -->
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">Edit category</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Edit category</li>
                    <li class="breadcrumb-item"><a href="categoriesList.php">Categorie liste</a></li>
                </ol>
            </nav>

            <div class="container-fluid">
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Edit category</h5>
                            <div class="card-body">
                                <div class="col-md-7 col-lg-8">
                                    <form method="post" action="action_admin.php" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="image" class="form-label"> Upload image</label>
                                                <input type="file" class="form-control" name="newImage" accept=".JPG, .JPEG, .GIF, .PNG, .ICO'" >
                                                <input type="hidden" name="oldImage" value="<?= $result['image'] ;?>">
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Designation</label>
                                                <input type="text" class="form-control" name="designation" value="<?= $result['designation'] ;?>">
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Image</label>
                                                <div>
                                                    <img src="../imageCategorie/<?= $result['image'] ;?>" width="500" height="400" alt="imageCat">
                                                </div>
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="editCategory">update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
        </div>
    </main>
    <!-- End of the main  -->
    <!-- Script of  Bootstrap 5 JavaScript  -->
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
    <script src="../BootstrapJS/sidebars.js"></script>
</body>
<!-- end of body -->

</html>