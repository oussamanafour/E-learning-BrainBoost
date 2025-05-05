<?php

class User
{
    function myCon()
    {
        return new PDO("mysql:host=localhost;dbname=bba", 'root', '');
    }
    
    function getUserInfo($id)
    {
        $con = $this->myCon();
        $stmt = $con->prepare("SELECT * FROM users WHERE id_user = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function updateUserInfo($c)
    {
        try {
            $con = $this->myCon();
            $stmt = $con->prepare('UPDATE users SET first_name=?,last_name=?,email=? WHERE id_user=?');
            $stmt->execute($c);
            $_SESSION['success'] = "Profile updated succefully";
            header('location:profileUser.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error to update';
            header('location:profileUser.php');
        }
    }
    function getPassword($id)
    {
        $con = $this->myCon();
        $stmt = $con->prepare("SELECT password FROM users WHERE id_user = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function updatePassword($password,$id)
    {
        try {
            $con = $this->myCon();
            $stmt = $con->prepare('UPDATE users SET password=:pass WHERE id_user=:id');
            $stmt->bindValue(':pass', $password);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $_SESSION['success'] = "Password updated succefully";
            header('location:security.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error to update';
            header('location:security.php');
        }
    }
}
