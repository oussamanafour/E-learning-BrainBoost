<?php
session_start();

include('check_if_log.php');
include('functions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once('../connection/connection.php');

// Insert Data To Adminstrator table
// Function to Generate A Random password 

function generateRandomPassword($len)
{
    return bin2hex(random_bytes($len));
}

if (isset($_POST['add_admin'])) {

    $Fisrt_name = $_POST['firstname'];
    $Last_name = $_POST['lastname'];
    $email = strtolower($_POST['email']);
    //$password = generateRandomPassword(10);
    $role = $_POST['role'];
    // query for email to see if it's existe in database or not 
    $result_email = checkForEmail($email);

    if ($result_email > 0) {
        header('location:administrator_liste.php');
        $_SESSION['info'] = 'Email already exist';
    } else {
        try {
            // hash the password
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            // INSERT DATA 
            $Add_admin_query = $connection->prepare('INSERT INTO administrators (first_name,last_name,email,password,role) 
            VALUES (:first_name,:last_name,:email,:password,:role)');
            $Add_admin_query->bindValue(':first_name', $Fisrt_name);
            $Add_admin_query->bindValue(':last_name', $Last_name);
            $Add_admin_query->bindValue(':email', $email);
            $Add_admin_query->bindValue(':password', $hash_password);
            $Add_admin_query->bindValue(':role', $role);
            $isItTrue = $Add_admin_query->execute();

            //Create an instance 
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'brainboostacademy27@gmail.com';
            $mail->Password   = 'uprooqmeahxnsgcr';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            //Recipients
            $mail->setFrom('brainboostacademy27@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Account details';
            $mail->Body    = 'Hello ' . $Fisrt_name . ' <br> <br> 
            Your account was created successfully , this is your credentials : <br><br>
            Email : ' . $email . ' <br>
            password : ' . $password . '<br><br>
            
            <u> you can sign-in by click in this link </u>: <br><br>
            http://localhost/brainboost_academy/login.php <br>
            please change your password after sign in  <br><br> 
            
            best regards  <br>
            BrainBoost Academy 2024 <br>';

            $mail->send(); 
            // Redirecting to admin form with success message 
            if ($isItTrue) {
                header('location:administrator_liste.php');
                $_SESSION['success'] = 'Admin add successfully';
            }
        } catch (PDOException $e) {
            header('location:administrator_liste.php');
            $_SESSION['error'] = $e->getMessage();
        }
    }
}

// Modify Admins Accounts

if (isset($_POST['modify_admin'])) {
    $idModAdmin = $_SESSION['idModifyAdmin'];
    $first_name = $_POST['firstname'];
    $Last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (!empty($first_name) && !empty($Last_name) && !empty($email) && !empty($role)) {

        $checkIfMatched = checkEmailIfHeadAdmin($idModAdmin);

        if ($checkIfMatched) {
            header('location:administrator_liste.php');
            $_SESSION['error'] = 'You can not update Head Admin account';
        } else {
            // Update data 
            $Check =  updateAdmins($first_name, $Last_name, $email, $role, $idModAdmin);
            if ($Check) {
                header('location:administrator_liste.php');
                $_SESSION['success'] = 'Admin updated successfully';
            } else {
                header('location:administrator_liste.php');
                $_SESSION['error'] = 'Failed to update Admin';
            }
        }
    } else {
        header('location:administrator_liste.php');
        $_SESSION['error'] = 'All fields are required';
    }
}

// DELETE Admin Account 

if (isset($_POST['deleteAdmin'])) {
    $id = $_POST['deleteAdminId'];

    $checkIfMatched = checkEmailIfHeadAdmin($id);

    if ($checkIfMatched) {
        header('location:administrator_liste.php');
        $_SESSION['error'] = 'You can not delete Head Admin account';
    } else {
        // Test if id session equal id of the account that we wanna delete
        if ($_SESSION['id_admin'] == $id) {
            header('location:administrator_liste.php');
            $_SESSION['error'] = "Error ! You can't delete your account";
        } else {
            //query delete 
            $queryDeleteAdmin = $connection->prepare('DELETE FROM administrators WHERE id_admin=:id');
            $queryDeleteAdmin->bindValue(':id', $id);
            $checkIfDeleteAdminTrue = $queryDeleteAdmin->execute();
            //Check if the execution is true or false
            if ($checkIfDeleteAdminTrue) {
                header('location:administrator_liste.php');
                $_SESSION['success'] = "Account deleted successfully";
            } else {
                header('location:administrator_liste.php');
                $_SESSION['error'] = "Error ! Can't delete the account try later";
            }
        }
    }
}


// Add instructor account 

if (isset($_POST['addInstructor'])) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['domaine'])) {
        $first_name = htmlspecialchars($_POST['firstname']);
        $last_name = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars(strtolower($_POST['email']));
        $domaine = htmlspecialchars($_POST['domaine']);
        //check if email already existe 
        $checkIfExiste = checkForInstructorEmail($email);
        if ($checkIfExiste > 0) {
            header('location:instructor_liste.php');
            $_SESSION['info'] = 'Email already exist';
        } else {
            //insert data to instructor table
            $checkIfTrue =  addInstructor($first_name, $last_name, $email, $domaine);
            if ($checkIfTrue) {
                header('location:instructor_liste.php');
                $_SESSION['success'] = 'Instructor add successfully';
            }
        }
    } else {
        header('location:instructor_liste.php');
        $_SESSION['error'] = 'All fields are required';
    }
}


// edit instructor 

if (isset($_POST['editInstructor'])) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['domaine'])) {
        $first_name = htmlspecialchars($_POST['firstname']);
        $last_name = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars(strtolower($_POST['email']));
        $domaine = htmlspecialchars($_POST['domaine']);

        try {
            $result =  updateInstructor($first_name, $last_name, $email, $domaine);
            if ($result) {
                header('location:instructor_liste.php');
                $_SESSION['success'] = 'Instructor updated successfully';
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    } else {
        header('location:editInstructor.php?idInstructor=' . $_SESSION['idEditInstructor']);
        $_SESSION['error'] = 'All fields are required';
    }
}


// delete instructor 

if (isset($_GET['dltinstructor'])) {
    $id = $_GET['dltinstructor'];
    $deleteInstructorQuery = $connection->prepare('DELETE FROM instructor WHERE  id_instructor=:id');
    $deleteInstructorQuery->bindValue(':id', $id);
    $CheckIns = $deleteInstructorQuery->execute();

    if ($CheckIns) {
        header('location:instructor_liste.php');
        $_SESSION['success'] = 'Instructor deleted successfully';
    } else {
        header('location:instructor_liste.php');
        $_SESSION['error'] = "Error ! Can't delete the account try later or Contact the support of development";
    }
}

// update user 

if (isset($_POST['updateUser'])) {

    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])) {
        $first_name = htmlspecialchars($_POST['firstname']);
        $last_name = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars(strtolower($_POST['email']));

        try {
            $Check = updateUser($first_name, $last_name, $email);
            if ($Check) {
                header('location:editUser.php?idUser=' . $_SESSION['idUser']);
                $_SESSION['success'] = 'User updated successfully';
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    } else {
        header('location:editUser.php?idUser=' . $_SESSION['idUser']);
        $_SESSION['error'] = 'All fields are required';
    }
}

//delete user

if (isset($_GET['deleteUser'])) {
    $id = $_GET['deleteUser'];

    $deleteUserQuery = $connection->prepare('DELETE FROM users WHERE id_user=:id');
    $deleteUserQuery->bindValue(':id', $id);
    $CheckUser = $deleteUserQuery->execute();

    if ($CheckUser) {
        header('location:user_liste.php');
        $_SESSION['success'] = 'User deleted successfully';
    } else {
        header('location:instructor_liste.php');
        $_SESSION['error'] = "Error ! can't delete this account try later or contact development support";
    }
}

//add Category

if (isset($_POST['addCategory'])) {
    if (!empty($_FILES['imageCat']['name']) && !empty($_POST['designation'])) {
        $designation = $_POST['designation'];
        $resultOfCheck = checkIfCategorieExiste($designation);
        if ($resultOfCheck > 0) {
            header('Location:categoriesList.php');
            $_SESSION['info'] = 'Categorie already existe !';
            exit();
        }

        if ($_FILES['imageCat']['size'] <= 10000000) {

            $infosfichier = pathinfo($_FILES['imageCat']['name']);
            $extensionUpload = $infosfichier['extension'];
            $tmp = $_FILES['imageCat']['tmp_name'];
            $nameOfImage = $_FILES['imageCat']['name'];

            if (in_array(strtoupper($extensionUpload), array('JPG', 'JPEG', 'GIF', 'PNG'))) {
                // Test if file match the extention 
                $Check = addCategories($nameOfImage, $designation);

                if ($Check) {
                    move_uploaded_file($tmp, "../imageCategorie/" . $nameOfImage);
                    header('Location:categoriesList.php');
                    $_SESSION['success'] = 'Categorie add successfully';
                } else {
                    header('Location:categoriesList.php');
                    $_SESSION['error'] = "Error ! can't insert category try later or contact development support";
                }
            } else {
                header("Location:categoriesList.php");
                $_SESSION['error'] = "The extension of the image file is not compatible";
            }
        } else {
            header('Location:categoriesList.php');
            $_SESSION['error'] = 'Image file size exceeds allowed limit';
        }
    } else {
        header('location:categoriesList.php');
        $_SESSION['error'] = 'All fields are required';
    }
}

// update category

if (isset($_POST['editCategory'])) {

    if (!empty($_POST['designation'])) {

        $designation = $_POST['designation'];
        $oldImage = $_POST['oldImage'];
        $newImage = $_FILES['newImage']['name'];

        if ($newImage != '') {
            if ($_FILES['newImage']['size'] <= 10000000) {
                $infoFile = pathinfo($_FILES['newImage']['name']);
                $extension = $infoFile['extension'];
                $tmp = $_FILES['newImage']['tmp_name'];
                $updateImageName = $newImage;

                if (in_array(strtoupper($extension), array('JPG', 'JPEG', 'GIF', 'PNG', 'ICO'))) {
                    $Check = updateCategories($updateImageName, $designation);
                    if ($Check) {
                        move_uploaded_file($tmp, "../imageCategorie/" . $updateImageName);
                        $_SESSION['success'] = 'Category updated successfully';
                        header('location:editCategory.php?idCat=' . $_SESSION['idCategory']);
                    } else {
                        $_SESSION['error'] = 'Failed to update the image';
                        header('location:editCategory.php?idCat=' . $_SESSION['idCategory']);
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "The extension of the image file is not compatible";
                    header('Location:editCategory.php?idCat=' . $_SESSION['idCategory']);
                }
            } else {
                $_SESSION['error'] = 'image file size exceeds allowed limit';
                header('location:editCategory.php?idCat=' . $_SESSION['idCategory']);
            }
        } else {
            $updateImageName = $oldImage;
            $Check = updateCategories($updateImageName, $designation);
            if ($Check) {
                $_SESSION['success'] = 'Category updated successfully';
                header('location:editCategory.php?idCat=' . $_SESSION['idCategory']);
            } else {
                $_SESSION['error'] = 'Failed to update the image';
                header('location:editCategory.php?idCat=' . $_SESSION['idCategory']);
                exit();
            }
        }
    } else {
        $_SESSION['error'] = 'All fields are required';
        header('location:editCategory.php');
    }
}

// delete category

if (isset($_GET['idCat'])) {
    $id = $_GET['idCat'];
    try {
        $deleteCategoryQuery = $connection->prepare('DELETE FROM categories WHERE id_category=:id');
        $deleteCategoryQuery->bindValue(':id', $id);
        $CheckCategory = $deleteCategoryQuery->execute();

        if ($CheckCategory) {
            header('location:categoriesList.php');
            $_SESSION['success'] = 'Category deleted successfully';
        } else {
            header('location:categoriesList.php');
            $_SESSION['error'] = "Error ! can't delete this category! try later or contact development support";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error ! you can't delete this category because it's relieted with at least one course";
        header('location:categoriesList.php');
    }
}

include('../includes/functions.php');

// Insert Course 
if (isset($_POST['addCourse'])) {

    if (!empty($_FILES['imageCourse']['name']) && !empty($_POST['categoryId']) && !empty($_POST['idIns'])  && !empty($_POST['titleCourse']) && !empty($_POST['description']) && !empty($_POST['level']) && !empty($_POST['duration'])) {

        $idCat = $_POST['categoryId'];
        $idInstructor = $_POST['idIns'];
        $title = htmlspecialchars($_POST['titleCourse']);
        $description = htmlspecialchars($_POST['description']);
        $level = htmlspecialchars($_POST['level']);
        $duration = htmlspecialchars($_POST['duration']);

        if ($_FILES['imageCourse']['size'] <= 10000000) {
            $infosfichier = pathinfo($_FILES['imageCourse']['name']);

            $extensionUpload = $infosfichier['extension'];
            $tmp = $_FILES['imageCourse']['tmp_name'];
            $nameOfImage = $_FILES['imageCourse']['name'];

            if (in_array(strtoupper($extensionUpload), array('JPG', 'JPEG', 'GIF', 'PNG', 'ICO'))) {
                // Test if file match the extention 
                $Check = addCourse($idCat, $idInstructor, $nameOfImage, $title, $description, $level, $duration);
                if ($Check) {
                    move_uploaded_file($tmp, "../imageForCourses/" . $nameOfImage);
                    header('Location:coursesList.php');
                    $_SESSION['success'] = 'Course add successfully';
                } else {
                    header('Location:coursesList.php');
                    $_SESSION['error'] = "Error ! can't insert this course try later or contact development support";
                }
            } else {
                header("Location:coursesList.php");
                $_SESSION['error'] = "The extension of the image file is not compatible";
            }
        } else {
            header('Location:coursesList.php');
            $_SESSION['error'] = 'Image file size exceeds allowed limit';
        }
    } else {
        header('location:coursesList.php');
        $_SESSION['error'] = 'All fields are required';
    }
}
// update Course 
if (isset($_POST['editCourse'])) {
    if (!empty($_POST['idCategory']) && !empty($_POST['titleCourse']) && !empty($_POST['description']) && !empty($_POST['level']) && !empty($_POST['duration'])) {
        $idCat = $_POST['idCategory'];
        $title = htmlspecialchars($_POST['titleCourse']);
        $description = htmlspecialchars($_POST['description']);
        $level = htmlspecialchars($_POST['level']);
        $duration = htmlspecialchars($_POST['duration']);

        // Check if image file is provided
        if (!empty($_FILES['imageCourse']['name'])) {
            if ($_FILES['imageCourse']['size'] <= 10000000) {
                $infosfichier = pathinfo($_FILES['imageCourse']['name']);
                $extensionUpload = $infosfichier['extension'];
                $tmp = $_FILES['imageCourse']['tmp_name'];
                $nameOfImage = $_FILES['imageCourse']['name'];

                if (in_array(strtoupper($extensionUpload), array('JPG', 'JPEG', 'GIF', 'PNG', 'ICO'))) {
                    // Test if file match the extention 
                    $Check = updateAllCourse($idCat, $nameOfImage, $title, $description, $level, $duration);

                    if ($Check) {
                        move_uploaded_file($tmp, "../imageForCourses/" . $nameOfImage);
                        header('Location:coursesList.php');
                        $_SESSION['success'] = 'Course update successfully';
                    } else {
                        header('Location:coursesList.php');
                        $_SESSION['error'] = "Error ! can't update this course try later or contact development support";
                    }
                } else {
                    header("Location:coursesList.php");
                    $_SESSION['error'] = "The extension of the image file is not compatible";
                }
            } else {
                header('Location:coursesList.php');
                $_SESSION['error'] = 'Image file size exceeds allowed limit';
            }
        } else {
            // Image file not provided, only update details
            $Check = updateCourseDetails($idCat, $title, $description, $level, $duration);
            if ($Check) {
                header('Location:coursesList.php');
                $_SESSION['success'] = 'Course details updated successfully';
            } else {
                header('Location:coursesList.php');
                $_SESSION['error'] = "Error ! can't update this course details, try later or contact development support";
            }
        }
    } else {
        header('location:editCourse.php?idCourse=' . $_SESSION['idCourse']);
        $_SESSION['error'] = 'All fields are required';
    }
}

// delete course

if (isset($_GET['deleteCourse'])) {
    $id = $_GET['deleteCourse'];
    try {
        $courseDltQuery = $connection->prepare('DELETE FROM courses WHERE id_course =:id');
        $courseDltQuery->bindValue(':id', $id);
        $resDlt = $courseDltQuery->execute();
        if ($resDlt) {
            header('location:coursesList.php');
            $_SESSION['success'] = 'Course deleted successfully';
        } else {
            header('location:coursesList.php');
            $_SESSION['error'] = "Error ! can't delete this course ! try later or contact development support";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error ! you can't delete this course because it's relieted with at least one Lesson";
        header('location:coursesList.php');
    }
}

// insert lesson
if (isset($_POST['addLesson'])) {
    if (!empty($_FILES['lessonImage']['name']) && !empty($_FILES['lessonVideo']['name']) /* && !empty($_FILES['lessonDoc']['name']) */ && !empty($_POST['courseID']) && !empty($_POST['instructorID']) && !empty($_POST['title']) && !empty($_POST['description'])) {
        $idCourse = $_POST['courseID'];
        $idInstructor = htmlspecialchars($_POST['instructorID']);
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);

        if ($_FILES['lessonImage']['size'] <= 10000000 && $_FILES['lessonVideo']['size'] <= 40000000 /* && $_FILES['lessonDoc']['size'] <= 10000000 */) {
            //For image 
            $infoImage = pathinfo($_FILES['lessonImage']['name']);
            $extensionUploadImage = $infoImage['extension'];
            $tmp = $_FILES['lessonImage']['tmp_name'];
            $nameOfImage = $_FILES['lessonImage']['name'];
            // for video
            $infoVideo = pathinfo($_FILES['lessonVideo']['name']);
            $extensionUploadVideo = $infoVideo['extension'];
            $tmpV = $_FILES['lessonVideo']['tmp_name'];
            $nameOfVideo = $_FILES['lessonVideo']['name'];
            // for document
            /*  $infoDoc = pathinfo($_FILES['lessonDoc']['name']);
            $extensionUploadDoc = $infoDoc['extension'];
            $tmpD = $_FILES['lessonDoc']['tmp_name'];
            $nameOfDoc = $_FILES['lessonDoc']['name']; */

            if (
                in_array(strtoupper($extensionUploadImage), array('JPG', 'JPEG', 'GIF', 'PNG', 'ICO'))
                and in_array(strtoupper($extensionUploadVideo), array('MP4', 'WMV', 'AVI'))
                /* and in_array(strtoupper($extensionUploadDoc), array('PDF', 'DOCX')) */
            ) {
                // Test if file match the extention 
                $Check = addLesson($idCourse, $idInstructor, $title, $description, $nameOfImage, $nameOfVideo/* , $nameOfDoc */);

                if ($Check) {
                    move_uploaded_file($tmp, "../imageForCourses/" . $nameOfImage);
                    move_uploaded_file($tmpV, "../videosForLessons/" . $nameOfVideo);
                    /*  move_uploaded_file($tmpD, "../documentForLessons/" . $nameOfDoc); */

                    header('Location:lessonsList.php');
                    $_SESSION['success'] = 'Course add successfully';
                } else {
                    header('Location:lessonsList.php');
                    $_SESSION['error'] = "Error ! can't insert this course try later or contact development support";
                }
            } else {
                header("Location:lessonsList.php");
                $_SESSION['error'] = "The extension files is not compatible";
            }
        } else {
            header('Location:lessonsList.php');
            $_SESSION['error'] = 'The files exceeds allowed limit';
        }
    } else {
        header('location:lessonsList.php');
        $_SESSION['error'] = 'All fields are required';
    }
}
//delete Lesson 
if (isset($_GET['idLesson'])) {
    $id = $_GET['idLesson'];
    $deleteLessonQuery = $connection->prepare('DELETE FROM lessons WHERE id_lesson=:id');
    $deleteLessonQuery->bindValue(':id', $id);
    try {
        $CheckLesson = $deleteLessonQuery->execute();
        if ($CheckLesson) {
            header('location:lessonsList.php');
            $_SESSION['success'] = 'Lesson deleted successfully';
        } else {
            header('location:lessonsList.php');
            $_SESSION['error'] = "Error ! can't delete this lesson try later or contact development support";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error ! you can't delete this lesson because it's relieted with at least one quiz";
        header('location:lessonsList.php');
    }
}


if (isset($_GET['idquiz'])) {

    $id = $_GET['idquiz'];
    $deleteQuizQuery = $connection->prepare('DELETE FROM quizzes WHERE id_quiz=:id');
    $deleteQuizQuery->bindValue(':id', $id);
    $CheckQuiz = $deleteQuizQuery->execute();
    if ($CheckQuiz) {
        header('location:quiz.php');
        $_SESSION['success'] = 'Quiz deleted successfully';
    } else {
        header('location:quiz.php');
        $_SESSION['error'] = "Error ! can't delete this quiz try later or contact development";
    }
}

// delete progress 
if (isset($_GET['progress'])) {
    $id = $_GET['progress'];
    $progressDltQuery = $connection->prepare('DELETE FROM progresses WHERE id_progress =:id');
    $progressDltQuery->bindValue(':id', $id);
    $resDlt = $progressDltQuery->execute();
    if ($resDlt) {
        header('location:progressUser.php');
        $_SESSION['success'] = 'deleted successfully';
    } else {
        header('location:progressUser.php');
        $_SESSION['error'] = "Error ! can't delete this course ! try later or contact development support";
    }
}
// quiz records 
if (isset($_GET['qr'])) {
    $id = $_GET['qr'];

    $deleteQuizRecords = $connection->prepare('DELETE FROM recordsquiz WHERE id=:id');
    $deleteQuizRecords->bindValue(':id', $id);
    $result = $deleteQuizRecords->execute();

    if ($result) {
        header('location:quizRecords.php');
        $_SESSION['success'] = 'deleted successfully';
    } else {
        header('location:quizRecords.php');
        $_SESSION['error'] = "Error ! can't delete this course ! try later or contact development support";
    }
}

// notifications
if (isset($_GET['nt'])) {
    $id = $_GET['nt'];
    $notificationQuery = $connection->prepare('DELETE FROM notifications WHERE id_notification=:id');
    $notificationQuery->bindValue(':id', $id);
    $result = $notificationQuery->execute();
    if ($result) {
        header('location:notifications.php');
        $_SESSION['success'] = 'deleted successfully';
    } else {
        header('location:notifications.php');
        $_SESSION['error'] = "Error ! can't delete this course ! try later or contact development support";
    }
}
