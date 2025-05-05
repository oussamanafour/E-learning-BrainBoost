<?php
include('check_if_log.php');
include('../connection/connection.php');
// functions to get totals

function getTotalAdmins()
{
    global $connection;
    $queryGetTotal = $connection->prepare('SELECT COUNT(*) AS total FROM administrators');
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalUsers()
{
    global $connection;
    $queryGetTotal = $connection->prepare('SELECT COUNT(*) AS total FROM users');
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalCategories()
{
    global $connection;
    $queryGetTotal = $connection->prepare('SELECT COUNT(*) AS total FROM categories');
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalInstructor()
{
    global $connection;
    $queryGetTotal = $connection->prepare('SELECT COUNT(*) AS total FROM instructor');
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalOnlineAdmins()
{
    global $connection;
    $queryGetTotal = $connection->prepare("SELECT COUNT(*) AS total FROM administrators WHERE status='Online' ");
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalOnlineUsers()
{
    global $connection;
    $queryGetTotal = $connection->prepare("SELECT COUNT(*) AS total FROM users WHERE status='Online' ");
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalCourses()
{
    global $connection;
    $queryGetTotal = $connection->prepare("SELECT COUNT(*) AS total FROM courses");
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

function getTotalLessons()
{
    global $connection;
    $queryGetTotal = $connection->prepare("SELECT COUNT(*) AS total FROM lessons");
    $queryGetTotal->execute();
    $result = $queryGetTotal->fetch();
    return $result['total'];
}

// functions for admins
// fetch for email 

function checkForEmail($email)
{
    global $connection;
    $email_query = $connection->prepare('SELECT email FROM administrators WHERE email=:email');
    $email_query->bindValue(':email', $email);
    $email_query->execute();
    $result = $email_query->rowCount();
    return $result;
}

function checkEmailIfHeadAdmin($id)
{
    define('id', 1);

    if ($id == id) {
        return true;
    } else {
        return false;
    }
}

function updateAdmins($first_name, $Last_name, $email, $role, $id)
{
    global $connection;
    $queryUpdate = $connection->prepare("UPDATE administrators SET first_name =:fn , Last_name = :ln, email = :e, role = :r WHERE id_admin = :id");
    $adminData = [
        ':fn' => $first_name,
        ':ln' => $Last_name,
        ':e' => $email,
        ':r' => $role,
        ':id' => $id
    ];
    $Check = $queryUpdate->execute($adminData);

    if ($Check) {
        return true;
    } else {
        return false;
    }
}


// Functions for instructor

function checkForInstructorEmail($email)
{
    global $connection;
    $email_query = $connection->prepare('SELECT email FROM instructor WHERE email=:email');
    $email_query->bindValue(':email', $email);
    $email_query->execute();
    $result = $email_query->rowCount();
    return $result;
}

function addInstructor($first_name, $last_name, $email, $domaine)
{
    global $connection;
   
    $password = '123';
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $addInstructorQuery = $connection->prepare('INSERT INTO instructor (first_name,last_name,email,password,domaine) 
    VALUES (:fn,:ln,:em,:pass,:dm)');
    $dataOfInstructor = [
        ':fn' => $first_name,
        ':ln' => $last_name,
        ':em' => $email,
        ':pass' => $hash,
        ':dm' => $domaine
    ];
    try {
        $result = $addInstructorQuery->execute($dataOfInstructor);
        if ($result) {
            return true;
        }
    } catch (PDOException $e) {
        error_log("Error adding instructor: " . $e->getMessage());
        return false;
    }
}

function updateInstructor($first_name, $last_name, $email, $domaine)
{
    global $connection;
    $updateInstructorQuery = $connection->prepare('UPDATE instructor SET first_name=:fn , last_name =:ln , email=:em ,domaine=:dm WHERE id_instructor=:id');
    $updateDataOfInstructor = [
        ':fn' => $first_name,
        ':ln' => $last_name,
        ':em' => $email,
        ':dm' => $domaine,
        ':id' => $_SESSION['idEditInstructor']
    ];
    $R = $updateInstructorQuery->execute($updateDataOfInstructor);

    return $R;
}

// function for user

function updateUser($first_name, $last_name, $email)
{
    global $connection;

    $updateUserQuery = $connection->prepare('UPDATE users SET first_name=:fn , last_name =:ln , email=:em  WHERE id_user=:id');
    $updateDataOfUser = [
        ':fn' => $first_name,
        ':ln' => $last_name,
        ':em' => $email,
        ':id' => $_SESSION['idUser']
    ];
    $R = $updateUserQuery->execute($updateDataOfUser);

    return $R;
}


// function for categories

function checkIfCategorieExiste($designation)
{
    global $connection;
    $checkNameCatQuery = $connection->prepare('SELECT * FROM categories WHERE designation=:des');
    $checkNameCatQuery->bindValue(':des', $designation);
    $checkNameCatQuery->execute();
    $nbr = $checkNameCatQuery->rowCount();
    return $nbr;
}

function addCategories($nameOfImage, $designation)
{

    global $connection;
    $addCategoryQuery = $connection->prepare('INSERT INTO categories (image,designation) VALUES (:img,:des) ');
    $addCategoryQuery->bindParam(':img', $nameOfImage);
    $addCategoryQuery->bindParam(':des', $designation);
    $res = $addCategoryQuery->execute();

    return $res;
}

function updateCategories($updateImageName, $designation)
{

    global $connection;
    $updateCategoryQuery = $connection->prepare('UPDATE categories SET image=:img,designation=:des WHERE id_category=:id');
    $updateCategoryQuery->bindParam(':img', $updateImageName);
    $updateCategoryQuery->bindParam(':des', $designation);
    $updateCategoryQuery->bindParam(':id', $_SESSION['idCategory']);
    $res = $updateCategoryQuery->execute();

    return $res;
}

// function Course








// functions for Lesson

function addLesson($idCourse,$idInstructor,$title,$description,$nameOfImage,$nameOfVideo/* ,$nameOfDoc */){
    global $connection;

    $addLessonQuery = $connection->prepare('INSERT INTO lessons (id_course,id_instructor,title,description,contenu_image,contenu_video,contenu_document)
    VALUES (:idC ,:idIns,:ti,:des,:img,:vi,:doc)');
    $lessonData = [
        ':idC' =>$idCourse,
        ':idIns' => $idInstructor,
        ':ti' => $title,
        ':des'=>$description,
        ':img' =>$nameOfImage,
        ':vi' =>$nameOfVideo,
        /* ':doc' => $nameOfDoc */
    ];
    $resInsert =  $addLessonQuery->execute($lessonData);

    return $resInsert;
}
