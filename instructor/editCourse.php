<?php
session_start();
include('Checklogs.php');
include('../connection/connection.php');
if (isset($_GET['idCourse'])) {
    $_SESSION['idCourse'] = $_GET['idCourse'];
    $dislayCourseQuery = $connection->prepare('SELECT co.id_course, ca.id_category , ca.designation , co.image ,co.title ,co.description ,co.level ,co.duration ,co.date_post from categories ca INNER JOIN courses co
     on ca.id_category = co.id_category
     WHERE id_course = :id
    ');
    $dislayCourseQuery->bindValue(':id', $_SESSION['idCourse']);
    $dislayCourseQuery->execute();
    $resultCourses = $dislayCourseQuery->fetch(PDO::FETCH_ASSOC);

     $_SESSION['imageCourse'] = $resultCourses['image'];

    $displayCatQuery = $connection->prepare('select * from categories');
    $displayCatQuery->execute();
    $resultCat = $displayCatQuery->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->

<head>
    <?php include('../includes/head.php'); ?>
    <title>Courses space</title>
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
                    <a class="navbar-brand">Course space</a>
                </div>
            </nav>
            <!-- bar of current page and a links to another page -->
            <nav aria-label="breadcrumb my-5 ">
                <ol class="breadcrumb my-5 bg-tertiary p-2">
                    <li class="breadcrumb-item active" aria-current="page">Edit courses</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="coursesList.php">List of courses</a></li>
                </ol>
            </nav>

            <div class="container-fluid">
            <?php include('../includes/errorAndSuccesMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Edit course</h5>
                            <div class="card-body">
                                <div class="col-md-7 col-lg-8">
                                    <form method="post" action="action.php" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="categorie" class="form-label">Categorie</label>
                                                <select name="idCategory" class="form-control">
                                                    <option value="">--Select category--</option>
                                                    <?php
                                                    foreach ($resultCat as $data) {
                                                        // Check if the current category matches the course's category
                                                        $selected = $data['id_category'] == $resultCourses['id_category'] ? 'selected' : '';
                                                    ?>
                                                        <option value="<?= $data['id_category']; ?>" <?= $selected; ?>> <?= $data['designation']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-8">
                                                <?php if (isset($resultCourses['image'])) : ?>
                                                    <div class="form-group">
                                                        <label for="currentImage">Current Image</label><br>
                                                        <img src="../imageForCourses/<?= $resultCourses['image']; ?>" alt="Current Image" style="width: 200px; height: auto;">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="form-group">
                                                    <label for="imageCourse">Upload New Image</label>
                                                    <input type="file" class="form-control" name="imageCourse">
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="titleCourse" value="<?= $resultCourses['title']; ?>">
                                            </div>


                                            <div class="col-md-12">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="form-control" placeholder="Give a description to this course" style="height: 150px"><?= $resultCourses['description']; ?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="level" class="form-label">Level</label>
                                                <select name="level" class="form-control">
                                                    <option value="All Levels" <?= $resultCourses['level'] == 'All Levels' ? 'selected' : ''; ?>>All Levels</option>
                                                    <option value="Beginer" <?= $resultCourses['level'] == 'Beginer' ? 'selected' : ''; ?>>Beginer</option>
                                                    <option value="Intermediate" <?= $resultCourses['level'] == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                                    <option value="Advanced" <?= $resultCourses['level'] == 'Advanced' ? 'selected' : ''; ?>>Advanced</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="duration" class="form-label">Duration</label>
                                                <input type="text" class="form-control" name="duration" value="<?= $resultCourses['duration']; ?>">
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="editCourse">update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
</body>
<!-- end of body -->

</html>