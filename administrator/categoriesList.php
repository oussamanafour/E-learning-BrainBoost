<?php
session_start();
include('../connection/connection.php');
$queryDisplayCategories = $connection->prepare('SELECT * FROM categories');
$queryDisplayCategories->execute();
$result = $queryDisplayCategories->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>Categorie</title>

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
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">Categories</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Liste Categorie</li>
                </ol>
            </nav>

            <div class="container-fluid mb-5">
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Add Category</h5>
                            <div class="card-body">
                                <div class="col-md-7 col-lg-8">
                                    <form method="post" action="action_admin.php" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label for="image" class="form-label">Upload image</label>
                                                <input type="file" class="form-control" name="imageCat">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="designation" class="form-label">Designation</label>
                                                <input type="text" class="form-control" name="designation">
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="addCategory">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">List of categories</h5>
                            <div class="card-body">
                                <!-- Table -->
                                <table id="example" class="table table-responsive table-striped table-hover text-center" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Date creation</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($result as $data) {
                                        ?>
                                            <tr>
                                                <td class="IdCate"><?= $data['id_category']; ?></td>
                                                <td>
                                                    <img src="../imageCategorie/<?= $data['image']; ?>" width="50" height="50" alt="">
                                                </td>
                                                <td><?= $data['designation']; ?></td>
                                                <td><?= $data['date_creation']; ?></td>
                                                <td>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Edit" href="editCategory.php?idCat=<?= $data['id_category']; ?>"class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="action_admin.php?idCat=<?= $data['id_category']; ?>" method="post" onclick="return Delete(this);" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
    <script>
        function Delete(form) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } 
    </script>
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<!-- end of body -->
</html>