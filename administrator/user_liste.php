<?php
session_start();
include('../connection/connection.php');

$queryDisplayUsers = $connection->prepare('SELECT * FROM users');
$queryDisplayUsers->execute();
$result = $queryDisplayUsers->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<!-- Start of the head -->

<head>
  <?php include('../includes/head.php'); ?>
  <title>Users space</title>
</head>
<!-- End of the head -->


<!-- Start of body -->

<body>
  <?php include('icons.php'); ?>
  <!-- Start of the main  -->
  <main class="d-flex flex-nowrap">
    <!-- sidebar bootstrap 5.3 -->
    <?php include('side-bar.php') ?>
    <div class="w-100">
      <!-- Nav bar bootstrap -->
      <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Users Liste</a>
        </div>
      </nav>
      <!-- bar of current page and a links to another page -->
      <nav aria-label="breadcrumb my-5 ">
        <ol class="breadcrumb my-5 bg-tertiary p-2">
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav>

      <div class="container-fluid">
        <!-- start alert -->
        <?php include('errorAndSuccessMsg.php'); ?>
        <!-- End alert -->
        <div class="row">

          <div class="col-md-12">


          </div>

          <div class="col-md-12 mt-5">
            <div class="card">
              <h5 class="card-header">List of users</h5>
              <div class="card-body">
                <!-- Table -->
                <table id="example" class="table table-responsive table-striped table-hover text-center" style="width:100%">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">First name</th>
                      <th scope="col">Last name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Date creation</th>
                      <th scope="col">Status</th>
                      <th scope="col">Last login</th>
                      <th scope="col">actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result as $data) { ?>
                      <tr>
                        <td><?= $data['id_user']; ?></td>
                        <td><?= $data['first_name']; ?></td>
                        <td><?= $data['last_name']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td><?= $data['date_creation']; ?></td>
                        <td>
                          <?php
                          if ($data['status'] == 'Online') {
                          ?> <img src="../images_for_dev/Online.png" height="20px" width="20px" alt="online">
                          <?php
                          } else {
                          ?>
                            <img src="../images_for_dev/offline.png" height="20px" width="20px" alt="offline">
                          <?php
                          }
                          ?>
                        </td>
                        <td><?= $data['last_login']; ?></td>
                        <td>
                          <a data-bs-toggle="tooltip" data-bs-title="Edit" class="btn btn-warning btn-sm" href="editUser.php?idUser=<?= $data['id_user']; ?>"><i class="bi bi-pen"></i></a>
                          <form action="action_admin.php?deleteUser=<?= $data['id_user']; ?>" method="post" onclick="return submitForm(this);" class="btn btn-danger btn-sm">
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
          <!-- <div class="col-md-6 mt-5">
            <div class="card">
              <div class="card-header text-center">
                User course
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-5">
            <div class="card">
              <div class="card-header text-center">
                User progress
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-5">
            <div class="card">
              <div class="card-header text-center">
                User progress
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                
              </div> -->
        </div>
      </div>
      <?php include('../includes/footer.php'); ?>
    </div>
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
  <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<!-- end of body -->

</html>