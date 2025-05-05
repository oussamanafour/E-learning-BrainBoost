<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fs-1 text-white" href="home-page.php">BrainBoost</a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">BrainBoost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link fs-5 text-white" aria-current="page" href="home-page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-xl-2 fs-5 text-white" href="#categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-xl-2 fs-5 text-white" href="#courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-xl-2 fs-5 text-white" href="myLessons.php">My learning</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-end ms-5">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../images_for_dev/brainboost.png" alt="" width="52" height="52" class="rounded-circle me-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="profileUser.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</nav>