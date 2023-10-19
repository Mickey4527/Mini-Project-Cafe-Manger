<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('Settings',null,'d-flex');
    navbar();
?>
<div class="container p-5">
    <h1>การตั้งค่า</h1>
    <div class="row">
        <div class="col-3">
            <a href="settings.php">ทั่วไป</a>
        </div>
        <div class="col-9 border rounded-1 p-3">
        </div>  
    </div>  
</div>
<?php
    htmlFooter();
?>

