<?php
// import global config json file
define('GLOBAL_APP', json_decode(file_get_contents('../global/global.json'),true));
// import config json file
define('CONFIG', json_decode(file_get_contents('../global/config.json'),true));

// function return CSS and JS path from assets folder
function cssOut($css){
    $output = '';
    foreach($css as $style){
        $output .= '<link rel="stylesheet" href="'.$style.'">';
    }
    return $output;
}
function jsOut($js){
    $output = '';
    foreach($js as $script){
        $output .= '<script src="../assets/'.$script.'"></script>';
    }
    return $output;
}

function authLogin($conn,$email,$password){
    $stmt = $conn->prepare("SELECT user_id, email, first_name, last_name, roles  FROM account_member WHERE email = '$email' AND password = ?");
    $stmt->bind_param("s",$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['roles'] = $row['roles'];
        return true;
    }

    return false;
}
function authRegister($conn,$email,$password,$firstName,$lastName){
    return $conn->query("INSERT INTO `account_member` (`email`, `password`, `first_name`, `last_name`, `roles`) VALUES ('$email', '$password', '$firstName', '$lastName', 'user')");
}
?>