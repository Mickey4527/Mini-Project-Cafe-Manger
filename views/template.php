<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';

    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('A');
    navbar();
?>
<!-- Content -->

<?php
    htmlFooter();
?>