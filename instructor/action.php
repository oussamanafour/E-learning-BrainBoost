<?php
session_start();
include('../includes/functions.php');

//add course

if (isset($_POST['addCourse'])) {
    if (!empty($_FILES['imageCourse']['name']) && !empty($_POST['categoryId']) && !empty($_POST['titleCourse']) && !empty($_POST['description']) && !empty($_POST['level']) && !empty($_POST['duration'])) {

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

// update course 

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
            $_SESSION['success'] = 'Course deleted successfully';
            header('location:coursesList.php');
        } else {
            $_SESSION['error'] = 'Error ! can\'t delete this course, try later or';
        }
    } catch (PDOException $e) {
        header('location:coursesList.php');
        $_SESSION['error'] = "Error ! can't delete this course ! try later or contact development support";
    }
}

// Lesson 

// insert lesson
if (isset($_POST['addLesson'])) {
    if (/* !empty($_FILES['lessonImage']['name']) */  !empty($_FILES['lessonVideo']['name']) /* && !empty($_FILES['lessonDoc']['name']) */ && !empty($_POST['courseID']) && !empty($_POST['instructorID']) && !empty($_POST['title']) && !empty($_POST['description'])) {
        $idCourse = $_POST['courseID'];
        $idInstructor = htmlspecialchars($_POST['instructorID']);
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        if ($_FILES['lessonImage']['size'] <= 10000000 && $_FILES['lessonVideo']['size'] <= 41943040 && $_FILES['lessonDoc']['size'] <= 10000000) {
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
            /* $infoDoc = pathinfo($_FILES['lessonDoc']['name']);
            $extensionUploadDoc = $infoDoc['extension'];
            $tmpD = $_FILES['lessonDoc']['tmp_name'];
            $nameOfDoc = $_FILES['lessonDoc']['name']; */
            if (
               /*  in_array(strtoupper($extensionUploadImage), array('JPG', 'JPEG', 'GIF', 'PNG', 'ICO')) */
               in_array(strtoupper($extensionUploadVideo), array('MP4', 'WMV', 'AVI'))
                /*  and in_array(strtoupper($extensionUploadDoc), array('PDF', 'DOCX')) */
            ) {
                // Test if file match the extention 
                $Check = addLessons($idCourse, $idInstructor, $title, $description,/*  $nameOfImage, */ $nameOfVideo);

                if ($Check) {
                    /* move_uploaded_file($tmp, "../imageForCourses/" . $nameOfImage); */
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

// edit lesson 

/* if (isset($_POST['editLesson'])) {
    // Assurez-vous que tous les paramètres nécessaires sont présents et valides
    if (isset($_POST['courseID'], $_POST['instructorID'], $_POST['title'], $_POST['description'], $_POST['oldImage'], $_POST['oldVideo'])) {

        // Récupération des données du formulaire
        $courseID = $_POST['courseID'];
        $instructorID = $_POST['instructorID'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $oldImage = $_POST['oldImage']; // Chemin de l'image existante
        $oldVideo = $_POST['oldVideo']; // Chemin de la vidéo existante

        // Chemin de la nouvelle image téléchargée
        $newImagePath = '';
        if ($_FILES['newImage']['size'] > 0 && is_uploaded_file($_FILES['newImage']['tmp_name'])) {
            $targetDir = "imageForCourses/";
            $newImageName = basename($_FILES["newImage"]["name"]);
            $targetFilePath = $targetDir . $newImageName;
            if (move_uploaded_file($_FILES["newImage"]["tmp_name"], $targetFilePath)) {
                $newImagePath = $targetFilePath;
            } else {
                $_SESSION['error'] = 'Error uploading image';
                header('Location: editLesson.php');
                exit;
            }
        } else {
            // Aucune nouvelle image téléchargée, conservez le chemin existant
            $newImagePath = $oldImage;
        }

        // Chemin de la nouvelle vidéo téléchargée
        $newVideoPath = '';
        if ($_FILES['courseVideo']['size'] > 0 && is_uploaded_file($_FILES['courseVideo']['tmp_name'])) {
            $targetDir = "videosForLessons/";
            $newVideoName = basename($_FILES["courseVideo"]["name"]);
            $targetFilePath = $targetDir . $newVideoName;
            if (move_uploaded_file($_FILES["courseVideo"]["tmp_name"], $targetFilePath)) {
                $newVideoPath = $targetFilePath;
            } else {
                $_SESSION['error'] = 'Error uploading video';
                header('Location: editLesson.php');
                exit;
            }
        } else {
            // Aucune nouvelle vidéo téléchargée, conservez le chemin existant
            $newVideoPath = $oldVideo;
        }

        // Préparation de la requête de mise à jour
        $sql = "UPDATE lessons SET 
                id_course = :courseID,
                id_instructor = :instructorID,
                title = :title,
                description = :description,
                contenu_image = :imagePath,
                contenu_video = :videoPath
                WHERE id_lesson = :lessonID";

        try {
            // Préparation de la requête
            $stmt = $connection->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':courseID', $courseID);
            $stmt->bindParam(':instructorID', $instructorID);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':imagePath', $newImagePath);
            $stmt->bindParam(':videoPath', $newVideoPath);
            // Utilisation de $_SESSION['idLesson'] pour l'ID de la leçon
            $stmt->bindParam(':lessonID', $_SESSION['idLesson']);

            // Exécution de la requête
            if ($stmt->execute()) {
                $_SESSION['success'] = 'Lesson updated successfully';
                header('Location: editLesson.php');
                exit;
            } else {
                $_SESSION['error'] = 'Lesson not updated';
                header('Location: editLesson.php');
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Database error: ' . $e->getMessage();
            header('Location: editLesson.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Missing required parameters';
        header('Location: editLesson.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request';
    header('Location: editLesson.php');
    exit;
}
 */

/* delete lesson */

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

//Quiz

if (isset($_POST['addQuiz'])) {
    if (!empty($_POST['LessonID']) && !empty($_POST['instructorID']) && !empty($_POST['Question']) && !empty($_POST['option1']) && !empty($_POST['option2']) && !empty($_POST['option3']) && !empty($_POST['option4']) && !empty($_POST['answer'])) {
        $idlesson = $_POST['LessonID'];
        $idInstructor = $_POST['instructorID'];
        $numberOfQuestion = $_POST['numberquestion'];
        $question = $_POST['Question'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];
        $answer = $_POST['answer'];

        $checkInsert = addQuizzes($idlesson, $idInstructor, $numberOfQuestion, $question, $option1, $option2, $option3, $option4, $answer);

        if ($checkInsert) {
            header('Location:quiz.php');
            $_SESSION['success'] = 'Quiz add successfully';
        } else {
            header('Location:quiz.php');
            $_SESSION['error'] = "Error ! can't insert this quiz try later or contact development support";
        }
    } else {
        header('location:quiz.php');
        $_SESSION['error'] = 'All fields are required';
    }
}
// update quiz 

if (isset($_POST['editQuiz'])) {
    if (!empty($_POST['LessonID']) && !empty($_POST['instructorID']) && !empty($_POST['Question']) && !empty($_POST['numberquestion']) && !empty($_POST['option1']) && !empty($_POST['option2']) && !empty($_POST['option3']) && !empty($_POST['option4']) && !empty($_POST['answer'])) {
        $idlesson = $_POST['LessonID'];
        $idInstructor = $_POST['instructorID'];
        $numberOfQuestion = $_POST['numberquestion'];
        $question = $_POST['Question'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];
        $answer = $_POST['answer'];
        $updateQuizQuery = $connection->prepare('UPDATE quizzes SET id_lesson=:il ,
            id_instructor=:idins,
            number_question=:nq,
            question=:q,
            option1=:op1,
            option2=:op2,
            option3=:op3,
            option4=:op4,
            answer=:an 
            WHERE id_quiz=:id');
        $updateQuizQuery->bindValue(':il', $idlesson);
        $updateQuizQuery->bindValue(':idins', $idInstructor);
        $updateQuizQuery->bindValue(':nq', $numberOfQuestion);
        $updateQuizQuery->bindValue(':q', $question);
        $updateQuizQuery->bindValue(':op1', $option1);
        $updateQuizQuery->bindValue(':op2', $option2);
        $updateQuizQuery->bindValue(':op3', $option3);
        $updateQuizQuery->bindValue(':op4', $option4);
        $updateQuizQuery->bindValue(':an', $answer);
        $updateQuizQuery->bindValue(':id', $_SESSION['idQuiz']);

        if ($updateQuizQuery->execute()) {
            header('Location:editQuiz.php?idquiz=' . $_SESSION['idQuiz']);
            $_SESSION['success'] = "Updated successfully";
        } else {
            header('Location:editQuiz.php?idquiz=' . $_SESSION['idQuiz']);
            $_SESSION['error'] = "Error ! can't update this quiz try later or contact development";
        }
    } else {
        header('location:editQuiz.php?idquiz=' . $_SESSION['idQuiz']);
        $_SESSION['error'] = 'All fields are required';
    }
}


// delete quiz
if (isset($_GET['idquiz'])) {
    $id = $_GET['idquiz'];
    
        try {
        $deleteQuizQuery = $connection->prepare('DELETE FROM quizzes WHERE id_quiz=:id');
        $deleteQuizQuery->bindValue(':id', $id);
        $deleteQuizQuery->execute();
        header('location:quiz.php');
        $_SESSION['success'] = 'Quiz deleted successfully';
    } catch (PDOException $e) {
        header('location:quiz.php');
        $_SESSION['error'] = "Error ! can't delete this quiz may be related with another section";
    }
}
