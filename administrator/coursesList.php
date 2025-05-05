<?php
session_start();
include('../connection/connection.php');

$dislayCourseQuery = $connection->prepare('SELECT co.id_course, ca.designation , co.image ,co.title ,co.description ,co.level ,co.duration ,co.date_post  from categories ca INNER JOIN courses co  
on ca.id_category = co.id_category');
$dislayCourseQuery->execute();
$resultCourses = $dislayCourseQuery->fetchAll(PDO::FETCH_ASSOC);

$displayCatQuery = $connection->prepare('select * from categories');
$displayCatQuery->execute();
$resultCat = $displayCatQuery->fetchAll(PDO::FETCH_ASSOC);

$displayInstructorQuery = $connection->prepare('select * from Instructor');
$displayInstructorQuery->execute();
$resultInstructor = $displayInstructorQuery->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Courses space</title>
</head>
<!-- End of Delete Modal -->
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
                    <a class="navbar-brand">Course space</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Courses</li>
                </ol>
            </nav>
            <div class="container-fluid">
                <?php include('errorAndSuccessMsg.php'); ?>
                <div class="row">
                    
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <h5 class="card-header">List of courses</h5>
                            <div class="card-body">
                                <table id="example" class="table table-responsive table-striped table-hover text-center" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Level</th>
                                            <th>Duration</th>
                                            <th>Date post</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($resultCourses as $dataCourse) {
                                        ?>
                                            <tr>
                                                <td class="idCourse"><?= $dataCourse['id_course']; ?></td>
                                                <td><?= $dataCourse['designation']; ?></td>
                                                <td><?= $dataCourse['image']; ?></td>
                                                <td><?= $dataCourse['title']; ?></td>
                                                <td><?= $dataCourse['level']; ?></td>
                                                <td><?= $dataCourse['duration']; ?></td>
                                                <td><?= $dataCourse['date_post']; ?></td>
                                                <td>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Edit" href="editCourse.php?idCourse=<?= $dataCourse['id_course']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></a>
                                                    <form action="action_admin.php?deleteCourse=<?= $dataCourse['id_course']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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
        </div>
    </main>
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
</body>
<!-- end of body -->

</html>