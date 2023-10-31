<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/function.php';

    $css = styleOnly('
    .form-signin{
        max-width: 400px;
    }
    body::before{
      content: "";
      background-image: url(../assets/img/bg.jpg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      filter: blur(5px);
      z-index: -1;
    }
    body::after{
      content: "";
      background-color: rgba(0,0,0,0.5);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    ');
    if(checkLogin()){
        header('Location: index.php');
    }

    htmlHeader('ลงชื่อเข้าใช้งาน',$css,'d-flex align-items-center py-4');
    $_GET['callback'] = isset($_GET['callback']) ? $_GET['callback'] : '';
?>
<main class="form-signin p-0 w-100 m-auto bg-cafe-white border rounded">
  <div id="loading-login" class="loader-line" style="position: relative;"></div>
  <form name="loginForm" class="px-5 pt-5">
    <h6 class="mb-4"><?php echo APP['app']['name'];?></h6>

    <h1 class="h4 fw-normal">ลงชื่อเข้าใช้งาน</h1>
    <p class="mb-5 small">เพื่อใช้งานระบบจัดการร้านของคุณ</p>

    <div class="form-floating">
      <input name="email" type="email" class="form-control mb-2" id="username" placeholder="name@example.com">
      <label for="floatingInput">อีเมล</label>
      <div class="invalid-feedback" id="username-invalid"></div>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="password" placeholder="Password">
      <label for="floatingPassword">รหัสผ่าน</label>
      <div class="invalid-feedback" id="password-invalid"></div>
    </div>
    <input type="hidden" name="callback" value="<?php echo $_GET['callback'];?>">
    <div class="invalid-feedback" id="invalid_feedback"></div>

    <div class="d-flex justify-content-between align-items-center mt-5">
        <a class="btn small py-2" href="register.php">สมัครสมาชิก</a>
        <button name="loginSubmit" class="btn btn-primary py-2" type="submit" id="loginSubmit">ลงชื่อเข้าใช้</button>
    </div>

    <p class="mt-5 mb-3 text-body-secondary small">©2023 <?php echo APP['app']['name'];?> - เวอร์ชั่น <?php echo APP['app']['version'];?></p>
  </form>
</main>

<small class="text-white position-absolute bottom-0 end-0 me-3 mb-3">
  <a class="text-white" href="https://www.freepik.com/free-photo/closeup-latte-art-coffee-cup-wooden-table_2791480.htm#page=2&query=cafe&position=48&from_view=search&track=sph">Image by rawpixel.com</a> on Freepik
</small>
<?php
    htmlFooter(jsOut(['../assets/js/login.js']));
?>
