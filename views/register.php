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
        max-width: 550px;
    }
    ');

    htmlHeader('Register',$css,'d-flex align-items-center py-4 bg-body-tertiary');
?>

<main class="form-signin px-5 pt-5 w-100 m-auto bg-body border rounded">
  <form name="registerForm" method="post" action="../global/auth/login.php">
    <h6 class="mb-4">Code name : <?php echo GLOBAL_APP['app']['name'];?></h6>

    <h1 class="h4 fw-normal">ลงทะเบียนเข้าใช้งาน</h1>
    <p class="mb-5 small">ให้ข้อมูลสั้นๆ เพื่อให้เรารู้รายละเอียดเกี่ยวกับคุณ</p>
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstName" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                โปรดระบุชื่อของคุณ
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">นามสกุล <span class="text-secondary">(ไม่จำเป็นต้องระบุ)</span></label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" >
              <div class="invalid-feedback">
                โปรดระบุนามสกุลของคุณ
              </div>
            </div>

            <div class="col-12 mt-4">
              <label for="email" class="form-label">อีเมล์</label>
              <input type="email" class="form-control" id="email" >
              <div class="invalid-feedback">
                โปรดระบุอีเมล์ของคุณ
              </div>
            </div>

            <div class="col-12">
              <label for="password" class="form-label">รหัสผ่าน</label>
              <input type="password" class="form-control" id="password" oninput="checkPassword()">
              <div class="invalid-feedback">
                โปรดระบุรหัสผ่านของคุณ
              </div>
            </div>
            <div class="col-12">
              <label for="password-check" class="form-label">ยืนยันรหัสผ่าน</label>
              <input type="password" class="form-control" id="password-check" oninput="checkPassword()">
              <div class="invalid-feedback" id="password-check-invalid">
                รหัสผ่านไม่ตรงกัน
              </div>
            </div>
          </div>
    <div class="d-flex justify-content-end align-items-center mt-5">
        <button name="registerSubmit" class="btn btn-primary py-2" type="submit">ลงทะเบียน</button>
    </div>

    <p class="mt-5 mb-3 text-body-secondary small">©2023 <?php echo GLOBAL_APP['app']['name'];?> - เวอร์ชั่น <?php echo GLOBAL_APP['app']['version'];?></p>
  </form>
</main>

<?php
    htmlFooter(jsOut(['login.js']));
?>