<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/layout.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('รายงานการขาย',null,'d-flex bg-cafe-white');
    navbar();

    $result = getAnySql($conn,'user_id,first_name,last_name,email,telephone,creation_date','employees_account','roles','employee');
?>

<div class="container-fluid p-5">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="h3">รายงานการขาย</h1>




