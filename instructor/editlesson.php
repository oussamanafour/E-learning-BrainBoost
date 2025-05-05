<?php
session_start();
include('Checklogs.php');
include('../connection/connection.php');

if (isset($_GET['idLesson'])) {
    $_SESSION['idLesson'] = $_GET['idLesson'];

    $displayLessonsQuery = $connection->prepare('select * from lessons WHERE id_lesson=:id');
    $displayLessonsQuery->bindValue(':id',$_SESSION['idLesson']);
    $displayLessonsQuery->execute();
    $displayLessons = $displayLessonsQuery->fetch(PDO::FETCH_ASSOC);
}




$displayCourseQuery = $connection->prepare('select * from Courses');
$displayCourseQuery->execute();
$resultCourse = $displayCourseQuery->fetchAll(PDO::FETCH_ASSOC);

$displayInstructorQuery = $connection->prepare('select * from Instructor');
$displayInstructorQuery->execute();
$resultInstructor = $displayInstructorQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>Edit lesson</title>
</head>

<body>
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
                    <a class="navbar-brand">edit Form</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Lessons</li>
                    <li class="breadcrumb-item"><a href="dashboard.php">dashboard</a></li>
                </ol>
            </nav>

            <div class="container-fluid">
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">edit lesson</h5>
                            <div class="card-body">
                                <div class="col-md-7 col-lg-8">
                                    <form method="post" action="action.php" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <!-- Display Data from courses table  -->
                                                <label for="Courses" class="form-label">Courses</label>
                                                <select name="courseID" class="form-control">
                                                    <option value="">--Select Course--</option>
                                                    <?php
                                                    foreach ($resultCourse as $dataCourse) {
                                                        $selected = $dataCourse['id_course'] == $displayLessons['id_course']  ? 'selected' : '';
                                                    ?>
                                                        <option value="<?= $dataCourse['id_course']; ?>" <?= $selected; ?>><?= $dataCourse['title']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Display Data from instructors table  -->
                                                <label for="instructor" class="form-label">instructor</label>
                                                <select name="instructorID" class="form-control">
                                                    <option value="">-- Select Instructor --</option>
                                                    <?php
                                                    foreach ($resultInstructor as $dataInstructor) {
                                                        $select = $dataInstructor['id_instructor'] == $displayLessons['id_instructor'] ? 'selected' :'';
                                                    ?>
                                                        <option value="<?= $dataInstructor['id_instructor'];?>" <?= $select ;?> ><?= strtoupper($dataInstructor['first_name']) . ' ' . strtoupper($dataInstructor['last_name']); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="title" class="form-label">title</label>
                                                <input type="text" class="form-control" name="title" value="<?= $displayLessons['title'] ;?>">
                                            </div>


                                            <div class="col-md-12">
                                                <label for="description" class="form-label">description</label>
                                                <textarea name="description" class="form-control" placeholder="Give a description to this course" style="height: 150px"><?= $displayLessons['description'] ;?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="image" class="form-label">Upload image</label>
                                                <input type="file" class="form-control" name="newImage" accept=".JPG, .JPEG, .GIF, .PNG, .ICO">
                                                <input type="hidden" class="form-control" name="odImage"  value="<?=$displayLessons['contenu_image'] ;?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="video" class="form-label">Upload video</label>
                                                <input type="file" class="form-control" name="courseVideo" accept=".MP4, .MP3, .GIF">
                                                <input type="hidden" class="form-control" name="oldVid" value="<?= $displayLessons['contenu_video'] ;?>">
                                            </div>

                                           <!--  <div class="col-md-6">
                                                <label for="document" class="form-label">Upload Document</label>
                                                <input type="file" class="form-control" name="newDoc" accept=".PDF, .WORD">
                                                <input type="text" class="form-control" name="oldDoc"  value="<?= $displayLessons['contenu_document'] ;?>">
                                            </div> -->

                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="editLesson">Edit</button>
                                            </div>
                                        </div>
                                    </form>
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
</body>
<!-- end of body -->

</html>