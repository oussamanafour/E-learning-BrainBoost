<?php
require_once('connection/connection.php');

if (isset($_POST['signupInstructor'])) {

    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])&& !empty($_POST['password']) && !empty($_POST['domaine'])) {
        $first_name = htmlspecialchars($_POST['firstname']);
        $last_name = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars(strtolower($_POST['email']));
        $password = $_POST['password'];
        $domaine = htmlspecialchars($_POST['domaine']);
        //check if email already existe 
        $email_query = $connection->prepare('SELECT email FROM instructor WHERE email=:email');
        $email_query->bindValue(':email', $email);
        $email_query->execute();
        $checkIfExiste = $email_query->rowCount();
        if ($checkIfExiste > 0) {
            header('location:instructor/index.php');
            $_SESSION['info'] = 'Email already exist';
        } else {
            //insert data to instructor table
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
            $result = $addInstructorQuery->execute($dataOfInstructor);

            if ($result) {
                
                $_SESSION['success'] = 'you\'re account was successfully added ';
                header('location:instructor/index.php');
            } else {
                header('location:instructor/index.php');
                $_SESSION['error'] = 'All fields are required';
            }
        }
    }
}
