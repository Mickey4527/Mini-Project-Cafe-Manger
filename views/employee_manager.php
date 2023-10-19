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
                        echo '<td><a href="#"><i class="bi bi-pencil-square"></i></a><a class="btn small" href="#"><i class="bi bi-trash-fill text-primary"></i>ลบบัญชี</a></td>';
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
      เมื่อต้องการเพิ่มพนักงานของคุณ ให้พนักงานเข้าสู่ระบบแล้วกรอกโค๊ด business id ด้านล่างนี้
    </div>
  </div>
</div>
<?php
    htmlFooter();
?>