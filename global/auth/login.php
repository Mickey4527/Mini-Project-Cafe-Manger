<?php
include_once '../conn.php';
include_once '../function.php';

if (isset($_POST['loginSubmit'])){
    $password = $_POST['password'];
    $email = $_POST['username'];

    if(empty($password) || empty($email)){
        http_response_code(400);
        $res = array(
            'type' => 'empty',
            'msg' => 'โปรดกรอกข้อมูลให้ครบถ้วน'
        );
        echo json_encode($res);
        exit();
    }

    $result = authLogin($conn,$email,$password);
    if($result['status']){
        if(isset($_GET['callback']) && $_GET['callback'] != ''){
            header("Location: ".$_GET['callback']."");
            exit();
        }

        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['first_name'] = $result['first_name'];
        $_SESSION['last_name'] = $result['last_name'];
        $_SESSION['roles'] = $result['roles'];

        http_response_code(200);
        exit();
    }
    else{
        header("Location: ../../views/login.php?error=wrongpassword");
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

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: ../../views/register.php?error=invalidemail");
        exit();
    }
    if(checkValueSQL($conn,'employees_account','email',$email)){
        header("Location: ../../views/register.php?error=emailtaken");
        exit();
    }
    if(authRegister($conn,$email,$password,$firstName,$lastName)){
        header("Location: ../../views/login.php?success=register");
        exit();
    }

}
?>