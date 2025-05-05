<?php
session_start();
include('../connection/connection.php');
$getQuizRecords = $connection->prepare('SELECT * FROM recordsquiz WHERE id_user =:id');
$getQuizRecords->bindValue(':id', $_SESSION['id_user']);
$getQuizRecords->execute();
$result = $getQuizRecords->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="BootstrapJS/color-modes.js"></script>
    <link rel="icon" type="image" href="images_for_dev/brainboost.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../bootstrapCSS/bootstrap.min.css">
    <title>My Quiz Test</title>
</head>

<body>
    <!-- header -->
    <?php include('navBarUser.php'); ?>
    <main class="container my-5">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="myLessons.php">Lessons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">Quiz</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-striped my-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Titre Lesson</th>
                            <th>Score</th>
                            <th>Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($result)) {
                            echo '<tr><td class="text-center" colspan="4" class="text-center">you didn\'t view any lesson yet </td></tr>';
                        } else {
                            foreach ($result as $data) {
                        ?>
                                <tr>
                                    <td><a class="text-decoration-none" href="viewLesson.php?idLesson=<?= $data['id_lesson']; ?>"><?= $data['lesson_title']; ?></a></td>
                                    <td><?= $data['score']; ?>/20</td>
                                    <td><?= $data['date']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top position-absolute bottom-0 end-0 start-0">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 BrainBoost Academy</p>

            <a href="#" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="../images_for_dev/brainboost.png" width="100" height="100" alt="">
            </a>
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Categories</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Courses</a></li>
            </ul>
        </footer>
    </div>
    <script src="../BootstrapJS/bootstrap.bundle.min.js"></script>
</body>

</html>