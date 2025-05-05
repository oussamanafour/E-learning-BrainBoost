<?php
session_start();
include('../connection/connection.php');
if (isset($_GET['idlesson']) && isset($_GET['nq'])) {

    $_SESSION['IdlessonForQuiz'] = $_GET['idlesson'];
    $nq = $_GET['nq'];

    $queryQuiz = $connection->prepare('SELECT * FROM quizzes WHERE id_lesson = :idlesson
    AND number_question = :nq');
    $queryQuiz->bindValue(':idlesson', $_SESSION['IdlessonForQuiz']);
    $queryQuiz->bindValue(':nq', $nq);
    $queryQuiz->execute();
    $quizResult = $queryQuiz->fetchALL(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../includes/head.php'); ?>
    <title>Quiz</title>
</head>

<body>
<?php include('navBarUser.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin: 152px 0;">
                <div class="card mx-auto bg-light w-75">
                    <div class="card-body">
                        <?php
                        if (empty($quizResult)) {
                            echo '<h3 class="text-center my-5">No quiz found ...</h3>';
                        } else {
                            foreach ($quizResult as $quiz) {
                        ?>
                                <form action="process.php" method="post">
                                    <h3 class="fs-2 text-center">Question <?= $quiz['number_question']; ?> : </h3>
                                    <span class="d-block fs-4 mb-3"><?php echo $quiz['question']; ?></span>
                                    <div>
                                        <input type="radio" name="answer" value="<?php echo $quiz['option1'];?>">
                                        <label class="fs-5"><?php echo $quiz['option1']; ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="<?php echo $quiz['option2'];?>">
                                        <label class="fs-5"><?php echo $quiz['option2']; ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="<?php echo $quiz['option3'];?>">
                                        <label class="fs-5"><?php echo $quiz['option3']; ?></label>

                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="<?php echo $quiz['option4'];?>">
                                        <label class="fs-5"><?php echo $quiz['option4']; ?></label>
                                    </div>
                                    <input type="hidden" name="numberquestion" value="<?= $nq ;?>"> <br>
                            <?php
                            }
                        }
                            ?>
                            <button name="endQuiz"  class="btn btn-primary mt-3">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer2.php'); ?>
        <!-- END Card -->
        <!-- Script of  Bootstrap 5 JavaScript  -->
        <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>
</html>