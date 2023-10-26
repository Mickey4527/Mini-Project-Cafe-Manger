<?php
    include_once('../global/conn.php');
    include_once('../global/function.php');
    include_once('../global/header.php');
    include_once('../global/navbar.php');

    htmlHeader('จัดการหมวดหมู่');
    navbar();
?>

<?php
    htmlFooter(jsOut(['../assets/js/category_manager.js']));
?>