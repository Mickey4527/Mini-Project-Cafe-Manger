<?php
include_once '../conn.php';
include_once '../function.php';

if (isset($_POST['loginSubmit'])){
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(empty($password) || empty($email)){
        header("Location: ../../views/login.php?error=emptyfields");
        exit();
    }

    if(authLogin($conn,$email,$password)){
        header("Location: ../../views/index.php");
        exit();
    }

}

if (isset($_POST['registerSubmit'])){
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    if(empty($password) || empty($passwordCheck) || empty($email) || empty($firstName)){
        header("Location: ../../views/register.php?error=emptyfields");
        exit();
    }

    if($password !== $passwordCheck){
        header("Location: ../../views/register.php?error=passwordcheck");
        exit();
    }

    if(authRegister($conn,$email,$password,$firstName,$lastName)){
        header("Location: ../../views/login.php?success=register");
        exit();
    }

}
?>