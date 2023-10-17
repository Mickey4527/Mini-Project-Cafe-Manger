<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    
    
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }

    htmlHeader('Settings',null,'d-flex');
    include_once '../global/navbar.php';
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

