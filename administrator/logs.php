<?php
session_start();
include('../connection/connection.php');

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>logs</title>
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
                    <a class="navbar-brand">logs</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Logs</li>
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
                                <h5 class="card-title">Liste Logs</h5>
                            </div>
                            <table style="width: 98%;" id="example" class="table table-responsive mx-auto my-3 table-striped table-hover m-auto" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>date</th>
                                        <th>Activity</th>
                                        <th>User Name</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    ?>
                                    <tr>
                                        <td>1</td>
                                        <td>12/07/2027 20:15:39</td>
                                        <td>UPDATE</td>
                                        <td>OUSSAMA NAFOUR</td>
                                        <td>Update USER ID :[5] </td>
                                       
                                    </tr>
                                    <?php

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

</html>