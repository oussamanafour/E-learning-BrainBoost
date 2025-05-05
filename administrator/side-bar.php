
<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary min-vh-100" style="width: 280px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="../images_for_dev/brainboost.png" alt="logo" width="130px" height="130px">
        <span class="fs-4">BrainBoost Academy</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="dashboard.php" class="nav-link link-body-emphasis mb-2">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#speedometer2" />
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="administrator_liste.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-person-gear me-2" width="16" height="16"></i>
                Administrator
            </a>
        </li>
        <li>
            <a href="instructor_liste.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-person-circle me-2" width="16" height="16"></i>
                Instructor
            </a>
        </li>
        <li>
            <a href="user_liste.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-people me-2" width="16" height="16"></i>
                Users
            </a>
        </li>
        <li>
            <a href="categoriesList.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-collection me-2" width="16" height="16"></i>
                Categories
            </a>
        </li>
        <li>
            <a href="coursesList.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-journal-text me-2" width="16" height="16"></i>
                Courses
            </a>
        </li>
        <li>
            <a href="lessonsList.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-calendar3 me-2" width="16" height="16"></i>
                Lessons
            </a>
        </li>
        <li>
            <a href="quiz.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-receipt me-2" width="16" height="16"></i>
                Quizzes
            </a>
        </li>
        <li>
            <a href="progressUser.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-arrow-repeat me-2" width="16" height="16"></i>
                User Progess
            </a>
        </li>
        <li>
            <a href="quizRecords.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-card-checklist me-2" width="16" height="16"></i>
                Quiz Records
            </a>
        </li>
        <li>
            <a href="notifications.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-bell me-2" width="16" height="16"></i>
                Notifications
            </a>
        </li>
       <!--  <li>
            <a href="logs.php" class="nav-link link-body-emphasis mb-2">
                <i class="bi bi-journal-text me-2" width="16" height="16"></i>
                logs
            </a>
        </li> -->
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images_for_dev/brainboost.png" alt="" width="52" height="52" class="rounded-circle me-2">
            <strong class="nav-link link-body-emphasis h-2"> <?php
                                                                if (empty($_SESSION['A_firstname']) && empty($_SESSION['A_lastname'])) {
                                                                    echo 'Welcome ADMIN';
                                                                } else {
                                                                    echo $_SESSION['A_firstname'] . ' ' . $_SESSION['A_lastname'];
                                                                }
                                                                ?>
            </strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="admin_profile.php"><i class="bi bi-person-vcard-fill me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="../index.php" target="_blank"><i class="bi bi-window-fullscreen me-2"></i>Website</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
        </ul>
    </div>
</div> 

<!-- <div class="d-flex flex-column flex-shrink-0 bg-body-tertiary min-vh-100 me-3" style="width: 5.2rem;">
    <a href="dashboard.php" class="d-block p-3 link-body-emphasis text-decoration-none" title="Icon-only" data-bs-toggle="tooltip" data-bs-placement="right">
        <img src="../images_for_dev/brainboost.png" width="50" height="50">
        <span class="visually-hidden">Logo BrainBoost</span>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link  py-3 border-bottom rounded-0" aria-current="page" title="dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Home">
                    <use xlink:href="#home" />
                </svg>
            </a>
        </li>
        <li>
            <a href="administrator_liste.php" class="nav-link py-3 border-bottom rounded-0 fs-4" title="Administrators" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-person-gear me-2" ></i>
            </a>
        </li>
        <li>
            <a href="instructor_liste.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Instructors" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-person-circle"></i>
            </a>
        </li>
        <li>
            <a href="user_liste.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Users" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-people"></i>
            </a>
        </li>
        <li>
            <a href="categoriesList.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Categories" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-collection me-2"></i>
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
            <a href="progressUser.php" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Progress of user" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-arrow-repeat me-2"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Quizzes" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-receipt me-2"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0 fs-5" title="Quiz User" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-card-checklist me-2"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0 fs-5" title="notification" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class="bi bi-bell me-2"></i>
            </a>
        </li>
         
    </ul>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images_for_dev/logo.png" alt="" width="52" height="52" class="rounded-circle me-2">

        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="admin_profile.php"><i class="bi bi-person-vcard-fill me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="../index.php"><i class="bi bi-window-fullscreen me-2"></i>Website</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"></i>
                    <?php
                    if (empty($_SESSION['A_firstname']) && empty($_SESSION['A_lastname'])) {
                        echo 'Welcome ADMIN';
                    } else {
                        echo $_SESSION['A_firstname'] . ' ' . $_SESSION['A_lastname'];
                    }
                    ?></a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
        </ul>
    </div>
</div> -->