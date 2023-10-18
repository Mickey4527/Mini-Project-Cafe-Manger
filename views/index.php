<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    
    
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    htmlHeader('Home',null,'d-flex');
    include_once '../global/navbar.php';
?>
<div class="container p-5">
    <h1>สวัสดี <?php echo $_SESSION['first_name'];?></h1>
    <div class=""
</div>
<?php
    htmlFooter();
?>

