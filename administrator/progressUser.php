<?php
session_start();
include('../connection/connection.php');

$progessDisplayQuery = $connection->prepare('SELECT p.id_progress, u.first_name,u.last_name, l.title ,p.titre_lesson,p.status,p.date_start,p.date_end FROM users u INNER JOIN progresses p
on u.id_user = p.id_user
INNER JOIN lessons l ON
l.id_lesson = p.id_lesson');
$progessDisplayQuery->execute();
$result = $progessDisplayQuery->fetchAll();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Progress User</title>
</head>
<!-- Modal -->
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
                    <a class="navbar-brand">Progress User</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Progress</li>
                    <li class="breadcrumb-item"><a href="dashboard.php">dashboard</a></li>
                </ol>
            </nav>
            <div class="container-fluid">
                <!-- End of Alert  -->
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Liste progress</h5>
                            </div>
                            <table style="width: 98%;" id="example" class="table table-responsive table-striped table-hover m-auto" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Status</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Name user</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $data) {
                                    ?>
                                        <tr>
                                            <td><?= $data['id_progress']; ?></td>
                                            <td><?= $data['titre_lesson']; ?></td>
                                            <td>
                                                <?php if ($data['status'] == 'Lesson finished') {
                                                ?>
                                                    <img src="../images_for_dev/checkmark.png" alt="">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="../images_for_dev/process.png" alt="">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= $data['date_start']; ?></td>
                                            <td><?= $data['date_end']; ?></td>
                                            <td><?= $data['last_name'] . ' ' . $data['first_name']; ?></td>
                                            <td class="text-center">
                                                <form action="action_admin.php?progress=<?= $data['id_progress']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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
                <?php include('../includes/footer.php'); ?>
            </div>
    </main>
</body>
<!-- End of the main  -->
<!-- Script of  Bootstrap 5 JavaScript  -->
<script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
<script src="../BootstrapJS/sidebars.js"></script>
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
<script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>