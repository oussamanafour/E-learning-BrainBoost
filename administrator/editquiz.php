<?php
session_start();
include('../connection/connection.php');

$displayQuizQuery = $connection->prepare('SELECT * FROM quizzes WHERE id_quiz=:id');
$displayQuizQuery->bindValue(':id' , $_GET['idquiz']);
$displayQuizQuery->execute();
$resultQuiz = $displayQuizQuery->fetch(PDO::FETCH_ASSOC);

$displayLessonsQuery = $connection->prepare('SELECT * FROM lessons');
$displayLessonsQuery->execute();
$resultLessons = $displayLessonsQuery->fetchAll(PDO::FETCH_ASSOC);

$displayInstructorQuery = $connection->prepare('SELECT * FROM instructor');
$displayInstructorQuery->execute();
$resins = $displayInstructorQuery->fetchAll(PDO::FETCH_ASSOC);
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
                <a class="navbar-brand">Edit Quiz</a>
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
                        <h5 class="card-header">Edit Quiz</h5>
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
                                            <select name="instructorID" class="form-select">
                                                <option value="">--Select Instructor</option>
                                                <?php
                                                foreach ($resins as $res) {
                                                ?>
                                                    <option value="<?= $res['id_instructor']; ?>"><?= $res['first_name'] . ' ' . $res['last_name']; ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="numberofquestion" class="form-label">Number of question</label>
                                            <input type="number" class="form-control" name="numberquestion" placeholder="Exemple : 1 or 2 .." value="<?php $resultQuiz['number_question'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text" class="form-control" name="Question" value="<?php $resultQuiz['question'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 1" class="form-label">Option 1</label>
                                            <input type="text" class="form-control" name="option1" value="<?php $resultQuiz['option1'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 2" class="form-label">Option 2</label>
                                            <input type="text" class="form-control" name="option2" <?php $resultQuiz['option2'] ?>>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 3" class="form-label">Option 3</label>
                                            <input type="text" class="form-control" name="option3" value="<?php $resultQuiz['option3'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 4" class="form-label">Option 4</label>
                                            <input type="text" class="form-control" name="option4" value="<?php $resultQuiz['option4'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="answer" class="form-label">Correct Answer :</label>
                                            <input type="text" class="form-control" name="answer" <?php $resultQuiz['answer'] ?>>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-outline-primary" name="addQuiz">edit</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-danger my-3 fs-5">Remarque : The max of questions is 4 </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../includes/footer.php'); ?>
</main>
<script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
<script src="../BootstrapJS/sidebars.js"></script>
</body>
<!-- end of body -->
</html>