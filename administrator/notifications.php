<?php
session_start();
include('../connection/connection.php');

$notificationsQuery = $connection->prepare('SELECT c.title , n.id_notification ,n.update_title,n.message,n.date_notifs FROM notifications n
INNER JOIN courses c on c.id_course = n.id_course');
$notificationsQuery->execute();
$result = $notificationsQuery->fetchAll();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Notification</title>
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
                    <a class="navbar-brand">Notification</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Notification</li>
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
                                <h5 class="card-title">Liste Notification</h5>
                            </div>
                            <table style="width: 98%;" id="example" class="table table-responsive mx-auto my-3 table-striped table-hover m-auto" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>updated</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $data) {
                                    ?>
                                        <tr>
                                            <td><?= $data['id_notification']; ?></td>
                                            <td><?= $data['title']; ?></td>
                                            <td><?= $data['update_title']; ?></td>
                                            <td><?= $data['message']; ?></td>
                                            <td><?= $data['date_notifs']; ?></td>
                                            <td>
                                                <form action="action_admin.php?nt=<?= $data['id_notification'];?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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