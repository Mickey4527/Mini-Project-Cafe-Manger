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
            <a class="btn small" href="#" data-bs-toggle="offcanvas" data-bs-target="#AddEmp" aria-controls="AddEmp"><i class="bi bi-plus-lg text-primary"></i>เพิ่มบัญชี</a>
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

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="AddEmp" aria-labelledby="AddEmpLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="AddEmpLabel">เพิ่มพนักงานของคุณ</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      <form>
        <div class="mb-3">
          <label for="firstname" class="form-label">ชื่อ</label>
          <input type="text" class="form-control" id="firstname" aria-describedby="firstnameHelp">
          <div id="firstnameHelp" class="form-text">ชื่อจริงของพนักงาน</div>
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">นามสกุล</label>
          <input type="text" class="form-control" id="lastname" aria-describedby="lastnameHelp">
          <div id="lastnameHelp" class="form-text">นามสกุลของพนักงาน</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">อีเมล</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">อีเมลของพนักงาน</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">รหัสผ่าน</label>
          <input type="password" class="form-control" id="password" aria-describedby="passwordHelp">
          <div id="passwordHelp" class="form-text">รหัสผ่านของพนักงาน</div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
    htmlFooter();
?>