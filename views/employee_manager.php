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
                    <th scope="col">telephone</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAnySql($conn,'user_id,first_name,last_name,email,telephone','account_member','business_id',$_SESSION['business_id']);
                    if(!$result){
                        echo '<tr><td class="text-center" colspan="6">ไม่มีข้อมูล</td></tr>';
                    }
                    else{
                        foreach($result as $row){
                            echo '<tr>';
                            echo '<th scope="row">'.$row['user_id'].'</th>';
                            echo '<td>'.$row['first_name'].'</td>';
                            echo '<td>'.$row['last_name'].'</td>';
                            echo '<td>'.$row['email'].'</td>';
                            echo '<td>'.$row['telephone'].'</td>';
                            echo '<td><a class="btn small py-0 px-2" href="#"><i class="bi bi-pencil-square text-primary"></i>แก้ไขบัญชี</a><a class="btn small py-0 px-2" href="#" data-id="'.$row['user_id'].'" data-bs-toggle="modal" data-bs-target="#DeleteEmp"><i class="bi bi-trash-fill text-primary"></i>ลบบัญชี</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="ModalCrate" tabindex="-1" aria-labelledby="ModalCrateLabel" aria-hidden="true">
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
                            <label for="firstName" class="form-label">ชื่อจริง</label>
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
                            <label for="email" class="form-label">อีเมล</label>
                            <input name="Empemail" type="email" class="form-control" id="email" placeholder="อีเมล">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">เบอร์โทรศัพท์</label>
                            <input name="Emptelephone" type="text" class="form-control" id="telephone" placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input name="Emppassword" type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
                        </div>
                    </div>

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

<div class="modal" id="DeleteEmp" tabindex="-1" aria-labelledby="DeleteEmpLabel" aria-hidden="true">
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

<script>
// ถ้ากดลบบัญชี ให้ยืนยันอีกครั้ง ส่งการลบด้วย ajax
$('#DeleteEmp').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    $('#confirm').click(function(){
        $.ajax({
            url: '../global/employee/employee.php',
            type: 'post',
            data: {Empdelete: id},
            beforeSend: function(){
                button.attr('disabled',true);
            },
            success: function(response){
                //hide modal
                $('#DeleteEmp').modal('hide');
                //display toast
                const toast = new bootstrap.Toast(document.querySelector('.toast'));
                toast.show();
                $('.toast-body').html(response);
                setTimeout(function(){
                    window.location.reload();
                }, 2000);
            }
        });
    });
});

</script>

<div class="toast-container position-fixed top-0 end-0 p-3">
<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
</div>

<?php
    htmlFooter();
?>