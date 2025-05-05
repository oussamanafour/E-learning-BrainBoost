<?php
session_start();
include('../connection/connection.php');
//query for displaying instructor in table 
$queryDisplayInstructor = $connection->prepare('SELECT * FROM instructor');
$queryDisplayInstructor->execute();
$result = $queryDisplayInstructor->fetchAll(PDO::FETCH_ASSOC);

$queryDisplayCategories = $connection->prepare('SELECT * FROM categories');
$queryDisplayCategories->execute();
$result1 = $queryDisplayCategories->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php') ?>
    <title>Instructor</title>
</head>
<!-- Start of Delete Modal -->
<body>
    <!-- icon for the dropdown -->
    <?php include('icons.php') ?>
    <!-- Start of the main  -->
    <main class="d-flex flex-nowrap">
        <!-- sidebar bootstrap 5.3 -->
        <?php include('side-bar.php') ?>


        <div class="w-100">
            <!-- Nav bar bootstrap -->
            <nav class="navbar bg-body-tertiary mx-0">
                <div class="container-fluid ">
                    <a class="navbar-brand">Instructor space</a>
                </div>
            </nav>

            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">instructor</li>
                </ol>
            </nav>

            <div class="container-fluid">
                <!-- Start of Alert  -->
                <?php include('errorAndSuccessMsg.php'); ?>
                <!-- End of Alert  -->
                <div class="row">

                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <h5 class="card-header">List of instructor</h5>
                            <div class="card-body">

                                <!-- Table -->
                                <table style="width: 98%;" id="example" class="table table-responsive table-striped table-hover " style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Domaine</th>
                                            <th>Date creation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($result as $data) {
                                        ?>
                                            <tr>
                                                <td class="id_instructor"><?= $data['id_instructor']; ?></td>
                                                <td><?= $data['first_name']; ?></td>
                                                <td><?= $data['last_name']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td><?= $data['domaine']; ?></td>
                                                <td><?= $data['date_creation']; ?></td>
                                                <td class="text-center">
                                                    <a href="editInstructor.php?idInstructor=<?= $data['id_instructor']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></a>
                                                    <form action="action_admin.php?dltinstructor=<?= $data['id_instructor']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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
            </div>
            <?php include('../includes/footer.php'); ?>
    </main>
    <script>
        function submitForm(form) {
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
</body>
<!-- End of the main  -->
<!-- Script of  Bootstrap 5 JavaScript  -->
<script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
<script src="../BootstrapJS/sidebars.js"></script>
<script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>