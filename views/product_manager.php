<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';

    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('จัดการสินค้า',null,'d-flex');
    navbar();

?>
<!-- Content -->

<?php
    htmlFooter();
?>