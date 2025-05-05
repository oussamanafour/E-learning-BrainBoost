<?php
session_start();
include('Checklogs.php');
include('../connection/connection.php');

$displayLessonsQuery = $connection->prepare('select * from lessons WHERE id_instructor=:idIns');
$displayLessonsQuery->bindValue(':idIns',$_SESSION['idInstructor']);
$displayLessonsQuery->execute();
$resultLessons = $displayLessonsQuery->fetchAll(PDO::FETCH_ASSOC);

$displayCourseQuery = $connection->prepare('select * from Courses WHERE id_instructor=:idIns');
$displayCourseQuery->bindParam(':idIns', $_SESSION['idInstructor']);
$displayCourseQuery->execute();
$resultCourse = $displayCourseQuery->fetchAll(PDO::FETCH_ASSOC);

$displayInstructorQuery = $connection->prepare('select * from Instructor WHERE id_instructor=:id');
$displayInstructorQuery->bindValue(':id',$_SESSION['idInstructor']);
$displayInstructorQuery->execute();
$resultInstructor = $displayInstructorQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Add Lesson</title>
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
                    <a class="navbar-brand">Lesson Form</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Lessons</li>
                    <li class="breadcrumb-item"><a href="DashboardInstructor.php">dashboard</a></li>
                </ol>
            </nav>
            <div class="container-fluid">
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Add lesson</h5>
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
                                                    ?>
                                                        <option value="<?= $dataCourse['id_course']; ?>"><?= $dataCourse['title']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Display Data from instructors table  -->
                                                <label for="instructor" class="form-label">instructor</label>
                                                <select name="instructorID" class="form-control">
                                                    <?php
                                                    foreach ($resultInstructor as $dataInstructor) {
                                                    ?>
                                                        <option value="<?= $dataInstructor['id_instructor']; ?>"><?= strtoupper($dataInstructor['first_name']) . ' ' . strtoupper($dataInstructor['last_name']); ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="title" class="form-label">title</label>
                                                <input type="text" class="form-control" name="title" value="">
                                            </div>


                                            <div class="col-md-12">
                                                <label for="description" class="form-label">description</label>
                                                <textarea name="description" class="form-control" placeholder="Give a description to this course" style="height: 150px"></textarea>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <label for="image" class="form-label">Upload image</label>
                                                <input type="file" class="form-control" name="lessonImage" accept=".JPG, .JPEG, .GIF, .PNG, .ICO" value=">">
                                            </div> -->

                                            <div class="col-md-6">
                                                <label for="video" class="form-label">Upload video</label>
                                                <input type="file" class="form-control" name="lessonVideo" accept=".MP4, .MP3, .GIF" value="">
                                            </div>

                                           <!--  <div class="col-md-6">
                                                <label for="document" class="form-label">Upload Document</label>
                                                <input type="file" class="form-control" name="lessonDoc" accept=".PDF, .WORD" value=">">
                                            </div> -->

                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="addLesson">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <h5 class="card-header">Liste of lessons</h5>
                            <div class="card-body">
                                <table id="example" class="table table-responsive table-striped table-hover" style="width:100%">
                                    <thead >
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                <!--             <th>Image</th> -->
                                            <th>Video</th>
                                            <!-- <th>Document</th> -->
                                            <th>Date post</th>
                                           <!--  <th>Last update</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php
                                        foreach ($resultLessons as $dataLesson) {
                                        ?>
                                            <tr>
                                                <td class="idLess"><?= $dataLesson['id_lesson']; ?></td>
                                                <td><?= $dataLesson['title']; ?></td>
                                              <!--   <td><?= $dataLesson['contenu_image']; ?></td> -->
                                                <td class="video"><a href="watchvideo.php?View_Video=<?= $dataLesson['id_lesson']; ?>">Watch the video</a></td>
                                                
                                                <td><?= $dataLesson['date_post']; ?></td>
                                              
                                                <td>
                                                    <a data-bs-toggle="tooltip" data-bs-title="Edit" href="editlesson.php?idLesson=<?= $dataLesson['id_lesson']; ?>"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="action.php?idLesson=<?= $dataLesson['id_lesson'];?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<!-- end of body -->
<script>
/*     $(document).ready(function() {
        $('.video').click(function(e) {
            let idLesson = $(this).closest('tr').find('.idLess').text();
            e.preventDefault();
            console.log(idLesson);
            $('#idLessonD').val(idLesson);
        });
    }); */
</script>

</html>