<?php

session_start();
include('../connection/connection.php');

$displayLessonsQuery = $connection->prepare('SELECT * FROM lessons');
$displayLessonsQuery->execute();
$resultLessons = $displayLessonsQuery->fetchAll(PDO::FETCH_ASSOC);

$displayInstructorQuery = $connection->prepare('SELECT * FROM instructor');
$displayInstructorQuery->execute();
$resins = $displayInstructorQuery->fetchAll(PDO::FETCH_ASSOC);

$displayquiz = $connection->prepare('SELECT q.id_quiz ,i.id_instructor, l.title ,q.question , q.answer ,q.date_post 
FROM quizzes q INNER join lessons l INNER JOIN instructor i ON i.id_instructor = q.id_instructor 
where l.id_lesson = q.id_lesson');
$displayquiz->execute();
$resultquiz = $displayquiz->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>Add quiz</title>
</head>

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
                <a class="navbar-brand">quiz Form</a>
            </div>
        </nav>
        <!-- bar of current page and a links to another page -->
        <nav aria-label="breadcrumb my-5 ">
            <ol class="breadcrumb my-5 bg-tertiary p-2">
                <li class="breadcrumb-item active" aria-current="page">Quizzes</li>
                <li class="breadcrumb-item"><a href="dashboard.php">dashboard</a></li>
            </ol>
        </nav>

        <div class="container-fluid">
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
            <div class="row">
            
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <h5 class="card-header">Liste of Quizzes</h5>
                        <div class="card-body">
                            <table id="example" class="table table-responsive table-striped table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Lesson</th>
                                        <th>Question</th>
                                        <th>date post</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($resultquiz as $dataquiz) {
                                    ?>
                                        <tr>
                                            <td><?= $dataquiz['id_quiz']; ?></td>
                                            <td><?= $dataquiz['title']; ?></td>
                                            <td><?= $dataquiz['question']; ?></td>
                                            <td><?= $dataquiz['date_post']; ?></td>
                                            <td>
                                                <a href="editquiz.php?idquizzes=<?= $dataQuiz['id_quiz']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                                <form action="action_admin.php?idquiz<?= $dataQuiz['id_quiz']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<!-- end of body -->

</html>