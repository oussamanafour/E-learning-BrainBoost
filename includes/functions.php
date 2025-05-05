<?php
include('../connection/connection.php');
// add course 
function addCourse($idCat,$idInstructor,$nameOfImage, $title, $description, $level,$duration){
    global $connection;
    $addCourseQuery = $connection->prepare('INSERT INTO courses (id_category,id_instructor,image,title,description,level,duration)
    Values (:idcat,:idIns,:img,:title,:descr,:level,:duaration)
    ');
    $courseData = [
       ':idcat'=>$idCat,
       ':idIns'=>$idInstructor,
       ':img'=>$nameOfImage,
       ':title'=>$title,
       ':descr'=>$description,
       ':level'=>$level,
       ':duaration'=>$duration 
    ];
    $resAdd = $addCourseQuery->execute($courseData);
    return $resAdd;
}


// update course 
function updateAllCourse($idCat,$nameOfImage,$title,$description,$level,$duaration){
    global $connection;
    $updateCourseQuery = $connection->prepare('UPDATE courses SET id_category=:idcat,image=:img,title=:title,description=:descr,level=:level,duration=:duaration WHERE id_course=:id');
    $courseData = [
       ':idcat'=>$idCat,
       ':img'=>$nameOfImage,
       ':title'=>$title,
       ':descr'=>$description,
       ':level'=>$level,
       ':duaration'=>$duaration ,
       ':id' => $_SESSION['idCourse']
    ];
    $res = $updateCourseQuery->execute($courseData);
    return $res;
}
//update details
function updateCourseDetails($idCat, $title, $description, $level, $duration){
    global $connection;
    $updateCourseQueryD = $connection->prepare('UPDATE courses SET id_category=:idcat,title=:title,description=:descr,level=:level,duration=:duaration WHERE id_course=:id');
    $courseDataD = [
       ':idcat'=>$idCat,
       ':title'=>$title,
       ':descr'=>$description,
       ':level'=>$level,
       ':duaration'=> $duration ,
       ':id' => $_SESSION['idCourse']
    ];
    $res = $updateCourseQueryD->execute($courseDataD);
    return $res;
}
//lesson
function addLessons($idCourse,$idInstructor,$title,$description,/* $nameOfImage, */$nameOfVideo){
    global $connection;
    $addLessonQuery = $connection->prepare('INSERT INTO lessons (id_course,id_instructor,title,description,/* contenu_image, */contenu_video)
    VALUES (:idC ,:idIns,:ti,:des,/* :img, */:vi)');
    $lessonData = [
        ':idC' =>$idCourse,
        ':idIns' => $idInstructor,
        ':ti' => $title,
        ':des'=>$description,
       /*  ':img' =>$nameOfImage, */
        ':vi' =>$nameOfVideo
        
    ];
    $resInsert =  $addLessonQuery->execute($lessonData);
    return $resInsert;
}

// quizzes

function addQuizzes($idlesson,$idInstructor,$numberOfQuestion,$question,$option1,$option2,$option3,$option4,$answer){
    global $connection;
    $addQuizQuery = $connection->prepare('INSERT INTO quizzes (id_lesson,id_instructor,number_question,question,option1,option2,option3,option4,answer)
    VALUES (:idLesson,:idIns,:numberques,:ques,:opt1,:opt2,:opt3,:opt4,:answer)');
    $quizData = [
        ':idLesson' =>$idlesson,
        ':idIns' => $idInstructor,
        ':numberques' => $numberOfQuestion,
        ':ques' => $question,
        ':opt1' => $option1,
        ':opt2' => $option2,
        ':opt3' => $option3,
        ':opt4' => $option4,
        ':answer' => $answer
        ];
   $ok= $addQuizQuery->execute($quizData);
    return $ok;
}
