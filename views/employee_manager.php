<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('จัดการบัญชีพนักงาน',null,'d-flex');
    navbar();
?>
<div class="container p-5">
    <h1 class="h3">จัดการบัญชีพนักงาน</h1>
    <div class="row">
        <div class="col-12 mt-3">
            <a class="btn small" href="#" data-bs-toggle="modal" data-bs-target="#ModalCrate"><i class="bi bi-plus-lg text-primary"></i>เพิ่มบัญชี</a>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">email</th>
                    <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAnySql($conn,'user_id,first_name,last_name,email','account_member','user_id','1');
                    foreach($result as $row){
                        echo '<tr>';
                        echo '<th scope="row">'.$row['user_id'].'</th>';
                        echo '<td>'.$row['first_name'].'</td>';
                        echo '<td>'.$row['last_name'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        echo '<td><a class="btn small" href="#"><i class="bi bi-pencil-square text-primary"></i>แก้ไขบัญชี</a><a class="btn small" href="#"><i class="bi bi-trash-fill text-primary"></i>ลบบัญชี</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="ModalCrate" tabindex="-1" aria-labelledby="ModalCrateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalCrateLabel">สร้างบัญชีพนักงาน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <form>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" id="firstname" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="lastname" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" class="form-control" id="email" placeholder="อีเมล">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
                        </div>
                    </div>

                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary">สร้าง</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
    htmlFooter();
?>