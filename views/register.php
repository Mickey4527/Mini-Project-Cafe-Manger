<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/function.php';

    $css = styleOnly('
    html,
    body {
        height: 100%;
    }
    .form-signin{
        max-width: 550px;
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

    htmlHeader('Register',$css,'d-flex align-items-center py-4');
?>

<main class="form-signin p-0 w-100 m-auto bg-cafe-white border rounded">
<div id="loading-login" class="loader-line" style="position: relative;"></div>
  <form >
    <h6 class="px-5 pt-5 mb-4"><?php echo APP['app']['name'];?></h6>

    <div class="px-5 pt-5" id="formRegister">
    <h1 class="h4 fw-normal">ลงทะเบียนเข้าใช้งาน</h1>
    <p class="mb-5 small">ให้ข้อมูลสั้นๆ เพื่อให้เรารู้รายละเอียดเกี่ยวกับคุณ</p>
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstName" class="form-label">ชื่อ</label>
            <input name="firstName" type="text" class="form-control" id="firstName" placeholder="" value="" required="">
              <div class="invalid-feedback" id="firstName-invalid">
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">นามสกุล <span class="text-secondary">(ไม่จำเป็นต้องระบุ)</span></label>
              <input name="lastName" type="text" class="form-control" id="lastName" placeholder="" value="">
              <div class="invalid-feedback" id="lastName-invalid">
              </div>
            </div>

            <div class="col-12 mt-4">
              <label for="email" class="form-label">อีเมล</label>
              <input name="email" type="email" class="form-control" id="email">
              <div class="invalid-feedback" id="email-invalid">
              </div>
            </div>

            <div class="col-12">
              <label for="password" class="form-label">รหัสผ่าน</label>
              <input name="password" type="password" class="form-control" id="password" oninput="checkPassword()">
              <div class="invalid-feedback" id="password-invalid">
              </div>
            </div>
            <div class="col-12">
              <label for="password-check" class="form-label">ยืนยันรหัสผ่าน</label>
              <input name="passwordCheck" type="password" class="form-control" id="password-check" oninput="checkPassword()">
              <div class="invalid-feedback" id="password-check-invalid">
                รหัสผ่านไม่ตรงกัน
              </div>
            </div>
          </div>
    <div class="d-flex justify-content-between align-items-center mt-5">
        <a class="btn small py-2" href="login.php">ย้อนกลับ</a>
        <button name="registerSubmit" class="btn btn-primary py-2" id="registerSubmit" type="submit">ลงทะเบียน</button>
    </div>

    </div>
    <p class="px-5 pt-5 mt-5 mb-3 text-body-secondary small">©2023 <?php echo APP['app']['name'];?> - เวอร์ชั่น <?php echo APP['app']['version'];?></p>
  </form>
</main>

<small class="text-white position-absolute bottom-0 end-0 me-3 mb-3">
  <a class="text-white" href="https://www.freepik.com/free-photo/closeup-latte-art-coffee-cup-wooden-table_2791480.htm#page=2&query=cafe&position=48&from_view=search&track=sph">Image by rawpixel.com</a> on Freepik
</small>
<?php
    htmlFooter(jsOut(['../assets/js/login.js']));
?>