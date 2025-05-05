<?php
session_start();
include('check_if_log.php');
require_once('../connection/connection.php');

if (isset($_POST['search'])) {
  $search_email = $_POST['email'];

  $query_search_administrators = $connection->prepare('SELECT * FROM Administrators WHERE email =:email');
  $query_search_administrators->bindValue(':email', $search_email);
  $query_search_administrators->execute();
  $result = $query_search_administrators->fetchAll();
  $nbr = $query_search_administrators->rowCount();

  $page = 1;
  $current_page = 1;
} else {
  if (isset($_GET['page_nu'])) {
    $current_page = $_GET['page_nu'];
  } else {
    $current_page = 1;
  }
  // count the number of records 
  $get_admin_records = $connection->prepare('SELECT COUNT(*) as nu_records FROM Administrators');
  $get_admin_records->execute();
  $count_result = $get_admin_records->fetch();
  // the result 
  $number_of_records = (int)$count_result['nu_records'];
  $page = ceil($number_of_records / 5);

  $start = ($current_page * 5) - 5;

  // query 
  $query_display_admin_limit_10 = $connection->prepare('SELECT * FROM Administrators LIMIT :start,5');
  $query_display_admin_limit_10->bindValue(':start', $start, PDO::PARAM_INT);
  $query_display_admin_limit_10->execute();
  $result = $query_display_admin_limit_10->fetchAll();
  $nbr = $query_display_admin_limit_10->rowCount();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<!-- Start of the head -->

<head>
  <?php include('../includes/head.php') ?>
  <title>Admin</title>
</head>
<!-- End of the head -->

<!-- Start of Delete Modal -->
<!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="deleteAdmins" tabindex="-1" aria-labelledby="deleteAdminsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteAdminsLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="action_admin.php" method="post">
        <div class="modal-body">
          <input type="hidden" id="deleteAdmin" name="deleteAdminId"><br>
          Are you sure you wanna delete this Admin ?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="deleteAdmin">Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Start of Delete Modal -->

<!-- Start of body -->

<body>
  <!-- icon for the dropdown -->
  <?php include('icons.php') ?>
  <!-- Start of the main  -->
  <main class="d-flex flex-nowrap">
    <!-- sidebar bootstrap 5.3 -->
    <?php include('side-bar.php') ?>


    <div class="w-100">
      <!-- Nav bar bootstrap -->
      <nav class="navbar bg-body-tertiary mx-0">
        <div class="container-fluid ">
          <a class="navbar-brand">Administrator space</a>
          <form class="d-flex" role="search" method="post">
            <input class="form-control me-2" type="email" placeholder="Search email" aria-label="Search" name="email">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </form>
        </div>
      </nav>
      <!-- bar of current page and a links to another page -->
      <nav aria-label="breadcrumb my-5 ">
        <ol class="breadcrumb my-5 bg-tertiary p-2">
          <li class="breadcrumb-item active" aria-current="page">Administrator</li>
        </ol>
      </nav>
      <!-- Table -->
      <div class="container-fluid">
        <!-- Start of Alert  -->
        <?php include('errorAndSuccessMsg.php'); ?>

        <div class="row">
          <div class="col-md-12">
              <!-- Insert form -->
            <div class="card mx-auto">
              <div class="card-header">
                <h5 class="card-title">ADD Admin</h5>
              </div>
              <div class="card-body">
                <div class="col-md-7 col-lg-8">
                  <form class="" method="post" action="Action_admin.php">
                    <div class="row g-3">
                      <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstname" required>
                      </div>
                      <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" required>
                      </div>

                      <div class="col-12">
                        <label for="username" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text">@</span>
                          <input type="email" class="form-control" name="email" placeholder="you@exemple.com" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="address" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role" required>
                          <option value="">select role</option>
                          <option value="Head-Admin">Head Admin</option>
                          <option value="Super-Admin">Super Admin</option>
                          <option value="Trail-Admin">Trail Admin</option>
                        </select>
                      </div>
                      <div class="mt-5">
                        <button type="submit" class="btn btn-outline-primary" name="add_admin">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

            <!-- Table -->

          <div class="col-md-12 mt-5">
            <div class="card">
              <h5 class="card-header">List of admins</h5>
              <div class="card-body">
                <table id="ListeAdmin"  class="table table-responsive table-striped table-bordered m-auto text-center">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First name</th>
                      <th scope="col">Last name</th>
                      <th scope="col">Email</th>
                      <th scope="col">role</th>
                      <th scope="col">status</th>
                      <th scope="col">date registration</th>
                      <th scope="col">last login</th>
                      <th scope="col">actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (empty($result)) {
                    ?>
                      <td colspan="9" class="text-center"> not Records Found </td>
                      <?php
                    } else {
                      foreach ($result as $data) {
                      ?>
                        <tr>
                          <td class="id_adm"><?= $data['id_admin']; ?></td>
                          <td><?= $data['first_name']; ?></td>
                          <td><?= $data['last_name']; ?></td>
                          <td><?= $data['email']; ?></td>
                          <td><?= $data['role']; ?></td>
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
                          <td><?= $data['date_creation']; ?></td>
                          <td><?= $data['last_login']; ?></td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-secondary btn-sm p-1">Actions</button>
                              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                <span class="visually-hidden">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin_modification.php?id_admin=<?= $data['id_admin']; ?>">Modify</a></li>
                                <li><a data-bs-toggle="modal" data-bs-target="#deleteAdmins" class="dropdown-item deleteAdm" href="action_admin.php?delete_admin=<?= $data['id_admin']; ?>">Delete</a></li>
                              </ul>
                            </div>
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
        

      <?php
      ?>
      <div class="my-5 mx-0">
        Total of Administrators : <?php if (isset($nbr)) {
                                    echo $nbr;
                                  } ?>
      </div>
      <!-- pagination Bootstrap 5.3 -->
      <nav aria-label="Page navigation example ">
        <ul class="pagination justify-content-center my-5">
          <?php
          if ($current_page == 1) {
          ?>
            <li class="page-item disabled"> <a class="page-link">Previous</a> </li>
          <?php
          } else {
          ?>
            <li class="page-item"><a class="page-link" href="administrator_liste.php?page_nu=<?= $_GET['page_nu'] - 1; ?>">Previous</a> </li>
          <?php
          }
          ?>
          <?php
          for ($i = 1; $i <= $page; $i++) {
          ?>
            <li class="page-item"><a class="page-link" href="administrator_liste.php?page_nu=<?= $i; ?>"><?= $i; ?></a></li>
          <?php
          }
          ?>
          <li class="page-item">
          <li class="page-item">
            <?php
            if ($current_page == $page) {
            ?>
              <a class="page-link disabled">Next</a>
            <?php
            } else {
            ?>
              <a class="page-link" href="administrator_liste.php?page_nu=<?= $current_page + 1; ?>">Next</a>
            <?php
            }
            ?>

          </li>
          </li>
        </ul>
      </nav>
      <!-- Include footer -->
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
    $(document).ready(function() {
      $('.deleteAdm').click(function(e) {
        let adminId = $(this).closest('tr').find('.id_adm').text();
        e.preventDefault();
        console.log(adminId);
        $('#deleteAdmin').val(adminId);
      });
    });
  </script>

</body>
<!-- end of body -->

</html>