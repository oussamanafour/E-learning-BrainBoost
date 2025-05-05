

<div class="d-flex flex-column flex-shrink-0 bg-body-tertiary min-vh-100 me-3" style="width: 5.2rem;">
    <a href="DashboardInstructor.php" class="d-block p-3 link-body-emphasis text-decoration-none" title="Icon-only" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="../images_for_dev/brainboost.png" width="50" height="50">
        <span class="visually-hidden">Logo BrainBoost</span>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a href="DashboardInstructor.php" class="nav-link  py-3 border-bottom rounded-0" aria-current="page" title="dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Home">
                    <use xlink:href="#home" />
                </svg>
            </a>
        </li>
        <li>
            <a href="coursesList.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Courses" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-journal-text me-2"></i>
            </a>
        </li>

        <li>
            <a href="lessonsList.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Lessons" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-calendar3 me-2"></i>
            </a>
        </li>
        <li>
            <a href="quiz.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Quizzes" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-receipt me-2"></i>
            </a>
        </li>
        
    </ul>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images_for_dev/brainboost.png" alt="" width="52" height="52" class="rounded-circle me-2">

        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-vcard-fill me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" target="_blank" href="../index.php"><i class="bi bi-window-fullscreen me-2"></i>Website</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"></i>
                    <?php
                    if (empty($_SESSION['firstname']) && empty($_SESSION['lastname'])) {
                        echo 'Welcome Instructor';
                    } else {
                        echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
                    }
                    ?></a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
        </ul>
    </div>
</div>