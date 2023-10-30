<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';
    include_once '../global/dashboard/dashboard.php';
    
    
    if(!checkLogin()){
        header('Location: login.php');
    }
    
    htmlHeader('Home',null,'d-flex bg-cafe-white');
    navbar();
?>
<div class="container p-5">
    <h1 class="h3">สวัสดี <?php echo $_SESSION['user']['name'];?></h1>
    <?php
        checkGetttingStart();
    ?>
</div>
<?php
    htmlFooter();
?>

