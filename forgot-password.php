<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="BootstrapJS/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image" href="images_for_dev/brainboost.png">
    <meta name="description" content="">
    <title>Login</title>
    <link href="BootstrapCSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrapCSS/bootstrapstyle.css">
    <!-- Custom styles for this template -->
    <link href="BootstrapCSS/sign-in.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary ">
    <?php include('includes/nav-bar.php'); ?>

    <main class="form-signin m-auto border border-secondary my-5 shadow-sm p-3 mb-5 bg-body-tertiary rounded">

        <form class="form-log mt-5 p-1" method="post" action="">
            <h1 class="h5 mb-4 fw-normal">Forgot password</h1>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success']; ?>
                </div>
            <?php
                unset($_SESSION['success']);
            } ?>
           <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error']; ?>
                </div>
            <?php
                unset($_SESSION['error']);
            } ?>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="email" name="email">
                <label for="floatingInput">Email address</label>
            </div>
            <button class="btn btn-primary w-100 mb-2 py-2" type="submit" name="forgot">Reset password</button>
            <p class="mt-2 mb-3 text-center text-body-secondary">or <a class="ms-2" href="login.php">Login</a></p>
        </form>

    </main>
    <?php include('includes/footer2.php'); ?>
    <!--  -->
    <script src="BootstrapJS/bootstrap.bundle.min.js"></script>
</body>

</html>