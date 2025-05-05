<?php
session_start();
include('../connection/connection.php');

if (isset($_GET['idquiz'])) {
    $_SESSION['idQuiz']= $_GET['idquiz'];
    $displayquiz = $connection->prepare('SELECT * FROM quizzes WHERE id_quiz = :id');
    $displayquiz->bindValue(':id',$_SESSION['idQuiz']);
    $displayquiz->execute();
    $resultquiz = $displayquiz->fetch();
}

$querylesson= $connection->prepare('SELECT * FROM lessons ');
$querylesson->execute();
$resultatles= $querylesson->fetchAll();

$displayLessonsQuery = $connection->prepare('select * from lessons WHERE id_instructor=:idIns');
$displayLessonsQuery->bindValue(':idIns', $_SESSION['idInstructor']);
$displayLessonsQuery->execute();
$resultLessons = $displayLessonsQuery->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>edit quiz</title>
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
                <a class="navbar-brand">Edit Form</a>
            </div>
        </nav>
        <!-- bar of current page and a links to another page -->
        <nav aria-label="breadcrumb my-5 ">
            <ol class="breadcrumb my-5 bg-tertiary p-2">
                <li class="breadcrumb-item active" aria-current="page">Edit quiz</li>
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
                                            <select name="LessonID" class="form-control">
                                                <option value="">--Select Lesson--</option>
                                                <?php
                                                foreach ($resultLessons as $datalesson) {
                                                    $selected = $datalesson['id_lesson'] == $resultatles['id_lesson'] ? 'selected' : '';
                                                ?>
                                                    <option value="<?= $datalesson['id_lesson']; ?>" <?= $selected;?>><?= $datalesson['title']; ?></option>
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
                                            <input type="number" class="form-control" name="numberquestion" value="<?= $resultquiz['number_question'];?>">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text" class="form-control" name="Question" value="<?= $resultquiz['question'];?>">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 1" class="form-label">Option 1</label>
                                            <input type="text" class="form-control" name="option1" value="<?= $resultquiz['option1'];?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 2" class="form-label">Option 2</label>
                                            <input type="text" class="form-control" name="option2" value="<?= $resultquiz['option2'];?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 3" class="form-label">Option 3</label>
                                            <input type="text" class="form-control" name="option3" value="<?= $resultquiz['option3'];?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="option 4" class="form-label">Option 4</label>
                                            <input type="text" class="form-control" name="option4" value="<?= $resultquiz['option4'];?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="answer" class="form-label">answer</label>
                                            <input type="text" class="form-control" name="answer" value="<?= $resultquiz['answer'];?>">
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-outline-warning" name="editQuiz">edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>