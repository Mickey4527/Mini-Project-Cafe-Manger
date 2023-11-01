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

        header("HTTP/1.0 200 OK");
        exit();
    }
    else{
        header("HTTP/1.0 400 Bad Request");
        $res = array(
            'type' => 'invalid',
            'msg' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'
        );
        echo json_encode($res);
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
        header("HTTP/1.0 400 Bad Request");
         $res = array(
                'type' => 'empty',
                'msg' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
                'password' => empty($password),
                'passwordCheck' => empty($passwordCheck),
                'email' => empty($email),
                'firstName' => empty($firstName)
            );
        echo json_encode($res);
        exit();
    }

    if($password !== $passwordCheck){
        header("HTTP/1.0 400 Bad Request");
        $res = array(
            'type' => 'password',
            'msg' => 'รหัสผ่านไม่ตรงกัน'
        );
        echo json_encode($res);
        exit();
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("HTTP/1.0 400 Bad Request");
        $res = array(
            'type' => 'email',
            'msg' => 'รูปแบบอีเมลไม่ถูกต้อง'
        );
        echo json_encode($res);
        exit();
    }
    if(checkValueSQL($conn,'employees_account','email',$email)){
        header("HTTP/1.0 400 Bad Request");
        $res = array(
            'type' => 'email',
            'msg' => 'อีเมลนี้มีผู้ใช้งานแล้ว'
        );
        echo json_encode($res);
        exit();
    }
    if(authRegister($conn,$email,$password,$firstName,$lastName)){
        header("HTTP/1.0 200 OK");
        echo '
        <i class="bi bi-check-circle-fill text-success" style="font-size: 24px;"></i>
        <h3 class="mt-3">สมัครสมาชิกสำเร็จ</h3>
        <p class="text-muted">คุณสามารถเข้าสู่ระบบได้ทันที</p>
        <a href="login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
        ';
        exit();
    }

}
?>