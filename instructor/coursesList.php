<?php
session_start();
include('../connection/connection.php');
include('Checklogs.php');

$displayCourseQuery = $connection->prepare('SELECT DISTINCT co.id_course, ca.designation , co.image ,co.title ,co.description ,co.level ,co.duration ,co.date_post  from categories ca INNER JOIN courses co  
on ca.id_category = co.id_category 
INNER JOIN instructor on 
co.id_instructor = :id_instructor');
$displayCourseQuery->bindValue(':id_instructor',$_SESSION['idInstructor']);
$displayCourseQuery->execute();
$resultCourses = $displayCourseQuery->fetchAll(PDO::FETCH_ASSOC);

$displayCatQuery = $connection->prepare('select * from categories');
$displayCatQuery->execute();
$resultCat = $displayCatQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<!-- Start of the head -->
<head>
    <?php include('../includes/head.php'); ?>
    <title>Courses space</title>
</head>
<!-- Modal -->
<div class="modal fade" id="deleteCourse" tabindex="-1" aria-labelledby="deleteCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCourseLabel">Delete course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="action.php" method="post">
                <div class="modal-body">
                <label for="IDCourse" class="form-label">ID course</label>
                <input type="text" id="dltCourse" class="form-control" name="CourseDltCourse"><br>
                    <p class="text-center fs-5">Are you sure you wanna delete this course ?</p> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="deleteCourse">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete Modal -->
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
                    <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    <li class="breadcrumb-item"><a href="DashboardInstructor.php">dashboard</a></li>
                </ol>
            </nav>
            <div class="container-fluid">
                <?php include('../includes/errorAndSuccesMsg.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">Add course</h5>
                              <div class="card-body">
                                <div class="col-md-7 col-lg-8">
                                    <form method="post" action="action.php" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <input name="idIns" type="hidden" class="form-control" placeholder="id instructor" value="<?= $_SESSION['idInstructor'];?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Categorie</label>
                                                <select name="categoryId" class="form-control">
                                                    <option value="">--Select category--</option>
                                                    <?php
                                                    foreach ($resultCat as $data) {
                                                    ?>
                                                        <option value="<?= $data['id_category']; ?>"><?= $data['designation']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Image course</label>
                                                <input type="file" class="form-control" name="imageCourse">
                                            </div>
                                            <div class="col-md-8">
                                                <label for="designation" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="titleCourse">
                                            </div>
                                            <div class="col-md-12">
                                                <textarea name="description" class="form-control" placeholder="Give a description to this course" style="height: 150px"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="level" class="form-label">Level</label>
                                                <select name="level" class="form-control">
                                                    <option value="">--Select level of course</option>
                                                    <option value="All Levels">All Levels</option>
                                                    <option value="Beginer">Beginer</option>
                                                    <option value="Intermediate">intermediate</option>
                                                    <option value="Advanced">advanced</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Duration</label>
                                                <input type="text" class="form-control" name="duration" placeholder="Exemple: 22 H 54 min">
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-outline-primary" name="addCourse">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="card">
                            <h5 class="card-header">List of courses</h5>
                            <div class="card-body">
                                <table id="example" class="table table-responsive table-striped table-hover text-center" style="width:100%">
                                    <thead>
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
                                        if(empty($resultCourses)){
                                            ?>
                                            <td colspan="8">No course uploaded</td>
                                            <?php
                                        }else{ 
                                        foreach($resultCourses as $dataCourse){
                                        ?>
                                        <tr>
                                            <td class="idCourse"><?= $dataCourse['id_course'];?></td>
                                            <td><?= $dataCourse['designation'];?></td>
                                            <td><?= $dataCourse['image'];?></td>
                                            <td><?= $dataCourse['title'];?></td>
                                            <td><?= $dataCourse['level'];?></td>
                                            <td><?= $dataCourse['duration'];?></td>
                                            <td><?= $dataCourse['date_post'];?></td>
                                            <td>
                                                <a data-bs-toggle="tooltip" data-bs-title="Edit" href="editCourse.php?idCourse=<?= $dataCourse['id_course'];?>"><i class="bi bi-pencil-square"></i></a>
                                                <form action="action.php?deleteCourse=<?= $dataCourse['id_course']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </form>
                                            </td>
                                        </tr>
                                        <?php
                                            }
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
</body>
<!-- end of body -->
<script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>