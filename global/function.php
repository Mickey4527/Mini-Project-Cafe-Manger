<?php
// import global config json file
define('GLOBAL_APP', json_decode(file_get_contents('../global/global.json'),true));
// import config json file
define('CONFIG', json_decode(file_get_contents('../global/config.json'),true));

// function return CSS and JS path from assets folder
function cssOut($css){
    $output = '';
    foreach($css as $style){
        $output .= '<link rel="stylesheet" href="../assets/'.$style.'">';
    }
    return $output;
}
function jsOut($js){
    $output = '';
    foreach($js as $script){
        $output .= '<script src="../assets/js/'.$script.'"></script>';
    }
    return $output;
}

function authLogin($conn,$email,$password){
    
}
function authRegister($conn,$email,$password,$firstName,$lastName){
    return $conn->query("INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `role`, `status`, `created_at`, `updated_at`) VALUES (NULL, '$email', '$password', '$firstName', '$lastName', 'user', 'active', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
}
?>