
<!-- Alerts -->

<?php
if (isset($_SESSION['info'])) {
?>
<div style="width: 98%;" class="alert alert-info alert-dismissible fade show mx-auto" role="alert">
        <i class="bi bi-info-circle me-2"></i><?= $_SESSION['info']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
unset($_SESSION['info']);
?>

<?php
if (isset($_SESSION['success'])) {
?>
    <div style="width: 98%;" class="alert alert-success alert-dismissible fade show mx-auto" role="alert">
    <i class="bi bi-check-circle me-2"></i><?= $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
}
unset($_SESSION['success']);
?>

<?php
if (isset($_SESSION['error'])) {
?>
    <div style="width: 98%;" class="alert alert-danger alert-dismissible fade show mx-auto" role="alert">
    <i class="bi bi-x-circle me-2"></i><?= $_SESSION['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
unset($_SESSION['error']);
?>

<!-- End of Alert  -->