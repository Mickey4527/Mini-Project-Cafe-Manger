<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/layout.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('จัดการบัญชีพนักงาน',null,'d-flex bg-cafe-white');
    navbar();

    $result = getAnySql($conn,'user_id,first_name,last_name,email,telephone,creation_date','employees_account','roles','employee');
?>
<div class="container p-5">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="h3">จัดการบัญชีพนักงาน</h1>
        <form class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" placeholder="ค้นหารายชื่อ" aria-label="Search">
          </form>
    </div>
    <div class="row">
        <div class="col-12 my-3 d-flex justify-content-between align-items-center">
            <div>
                <a class="btn small " href="#" data-bs-toggle="modal" data-bs-target="#ModalCrate"><i class="bi bi-plus-lg text-primary"></i>เพิ่มบัญชี</a>
            </div>
            <div>
                <span class="text-secondary">จำนวนพนักงานทั้งหมด <?php echo $result->num_rows;?> คน</span>
            </div>
        </div>
        <div class="col-12">
            <div id="table">
                <?php table($result,'พนักงาน','user_id',['รหัสพนักงาน','ชื่อจริง','นามสกุล','อีเมล','เบอร์โทรศัพท์','วันที่สร้าง'],['user_id','first_name','last_name','email','telephone','creation_date']);?>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ModalCrate" tabindex="-1" aria-labelledby="ModalCrateLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalCrateLabel">สร้างบัญชีพนักงาน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <form method="post" action="../global/employee/employee.php">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">ชื่อจริง*</label>
                            <input name="EmpfirstName" type="text" class="form-control" id="firstname" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="lastName" class="form-label">นามสกุล</label>
                            <input name="EmplastName" type="text" class="form-control" id="lastname" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล*</label>
                            <input name="Empemail" type="email" class="form-control" id="email" placeholder="อีเมล">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">เบอร์โทรศัพท์*</label>
                            <input name="Emptelephone" type="text" class="form-control" id="telephone" placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน*</label>
                            <input name="Emppassword" type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">ยืนยันรหัสผ่าน*</label>
                            <input name="EmpconfirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="ยืนยันรหัสผ่าน">
                        </div>
                    </div>

                    <small class="mt-3 text-danger">* จำเป็นต้องกรอก</small><br>
                    <small class="text-secondary">** รหัสผ่านจะถูกส่งไปยังอีเมลที่ระบุ</small>

                    <button class="btn mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        ข้อมูลเพิ่มเติม <i class="bi bi-caret-down-fill"></i>
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password" class="form-label">วันที่เข้าทำงาน</label>
                                <input name="Empdate" type="date" class="form-control" id="date" placeholder="วันที่เข้าทำงาน">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        ตั้งเป็นวันที่ปัจจุบัน
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="roles" class="form-label">ตำแหน่ง*</label>
                                <select name="Emproles" class="form-select" aria-label="Default select example">
                                    <option selected>เลือกตำแหน่ง</option>
                                    <option value="employee">พนักงาน</option>
                                    <option value="manager">ผู้จัดการ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button name="submitCreateUser" type="submit" class="btn btn-primary">สร้าง</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="Delete" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3 shadow">
        <div class="modal-body p-4 text-center">
            <h5 class="mb-0">ต้องการลบข้อมูลหรือไม่ ?</h5>
            <p class="mb-0">เมื่อลบข้อมูลแล้ว จะไม่สามารถกู้คืนกลับมาได้</p>
        </div>
        <div class="modal-footer flex-nowrap p-0">
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" id="confirm"><strong class="text-danger">ลบบัญชี</strong></button>
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
    </div>
  </div>
</div>

<?php
    htmlFooter(jsOut(['../assets/js/employee.js']));
?>