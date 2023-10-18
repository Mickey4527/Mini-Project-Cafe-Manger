<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/dashboard/dashboard.php';
    
    
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    htmlHeader('Home',null,'d-flex');
    navbar();
?>
<div class="container p-5">
    <?php
        checkBusiness();
    ?>
</div>
<?php
    htmlFooter();
?>

