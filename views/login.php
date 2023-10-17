<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';

    $css = styleOnly('
    html,
    body {
        height: 100%;
    }
    .form-signin{
        max-width: 400px;
    }
    ');

    htmlHeader('ลงชื่อเข้าใช้งาน',$css,'d-flex align-items-center py-4 bg-body-tertiary');
?>
<main class="form-signin px-5 pt-5 w-100 m-auto bg-body border rounded">
  <form name="loginForm" method="post" action="../global/auth/login.php">
    <h6 class="mb-4">Code name : <?php echo GLOBAL_APP['app']['name'];?></h6>

    <h1 class="h4 fw-normal">ลงชื่อเข้าใช้งาน</h1>
    <p class="mb-5 small">เพื่อใช้งานระบบจัดการร้านของคุณ</p>

    <div class="form-floating">
      <input name="email" type="email" class="form-control mb-2" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">อีเมล์</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">รหัสผ่าน</label>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-5">
        <a class="btn small py-2" href="register.php">สมัครสมาชิก</a>
        <button name="loginSubmit" class="btn btn-primary py-2" type="submit">ลงชื่อเข้าใช้</button>
    </div>

    <p class="mt-5 mb-3 text-body-secondary small">©2023 <?php echo GLOBAL_APP['app']['name'];?> - เวอร์ชั่น <?php echo GLOBAL_APP['app']['version'];?></p>
  </form>
</main>

<?php
    htmlFooter();
?>
