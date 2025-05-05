<?php
session_start();
include('../connection/connection.php');

$displayLessonsQuery = $connection->prepare('select * from lessons WHERE id_instructor=:idIns');
$displayLessonsQuery->bindValue(':idIns', $_SESSION['idInstructor']);
$displayLessonsQuery->execute();
$resultLessons = $displayLessonsQuery->fetchAll(PDO::FETCH_ASSOC);

$displayquiz = $connection->prepare('SELECT q.id_quiz ,i.id_instructor, l.title ,q.question , q.answer ,q.date_post 
FROM quizzes q INNER join lessons l INNER JOIN instructor i ON i.id_instructor = q.id_instructor 
where l.id_lesson = q.id_lesson 
AND i.id_instructor = :idins');
$displayquiz->bindValue(':idins', $_SESSION['idInstructor']);
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
    <?php include('sidebar.php') ?>
    <!-- end sidebar bootstrap 5.3 -->
    <div class="w-100">
        <!-- Nav bar bootstrap -->
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">Quiz Form</a>
            </div>
        </nav>
        <!-- bar of current page and a links to another page -->
        <nav aria-label="breadcrumb my-5 ">
            <ol class="breadcrumb my-5 bg-tertiary p-2">
                <li class="breadcrumb-item active" aria-current="page">Quizzes</li>
                <li class="breadcrumb-item"><a href="DashboardInstructor.php">dashboard</a></li>
            </ol>
        </nav>
        <div class="container-fluid">
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5 class="card-header">Add Quiz</h5>
                        <div class="card-body">
                            <div class="col-md-7 col-lg-8">
                                <form method="post" action="action.php">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <!-- Display Data from lesson table  -->
                                            <label for="lesson" class="form-label">Lesson</label>
                                            <select name="LessonID" class="form-select">
                                                <option value="">--Select Lesson--</option>
                                                <?php
                                                foreach ($resultLessons as $datalesson) {
                                                ?>
                                                    <option value="<?= $datalesson['id_lesson']; ?>"><?= $datalesson['title']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Display Data from instructors table  -->
                                            <label for="instructor" class="form-label">instructor</label>
                                            <select name="instructorID" class="form-control">
                                                <option value="<?= $_SESSION['idInstructor']; ?>"><?= strtoupper($_SESSION['firstname']) . ' ' . strtoupper($_SESSION['lastname']); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="numberofquestion" class="form-label">Number of question</label>
                                            <input type="number" class="form-control" name="numberquestion" placeholder="Exemple : 1 or 2 ..">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text" class="form-control" name="Question">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 1" class="form-label">Option 1</label>
                                            <input type="text" class="form-control" name="option1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 2" class="form-label">Option 2</label>
                                            <input type="text" class="form-control" name="option2">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 3" class="form-label">Option 3</label>
                                            <input type="text" class="form-control" name="option3">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 4" class="form-label">Option 4</label>
                                            <input type="text" class="form-control" name="option4">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="answer" class="form-label">Correct Answer :</label>
                                            <input type="text" class="form-control" name="answer">
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-outline-primary" name="addQuiz">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-danger my-3 fs-5">Remarque : The max of questions is 4 </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <h5 class="card-header">Liste of Quizzes</h5>
                        <div class="card-body">
                            <table id="example" class="table table-responsive table-striped table-hover" style="width:100%">
                                <thead>
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
                                                <a href="editQuiz.php?idquiz=<?= $dataquiz['id_quiz']; ?>"><i class="bi bi-pencil-square"></i></a>
                                                <form action="action.php?idquiz=<?= $dataquiz['id_quiz'];?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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