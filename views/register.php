<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';

    $css = styleOnly('
    html,
    body {
        height: 100%;
    }
    ');

    htmlHeader('Register',$css,'d-flex align-items-center py-4 bg-body-tertiary')
?>

<main class="form-signin px-5 pt-5 w-100 m-auto bg-body border rounded">
  <form name="loginForm" method="post" action="../global/auth/login.php">
    <h6 class="mb-4">Code name : <?php echo GLOBAL_APP['app']['name'];?></h6>

    <h1 class="h4 fw-normal">ไม่พร้อมใช้งาน</h1>
</main>

<?php
    htmlFooter();
?>