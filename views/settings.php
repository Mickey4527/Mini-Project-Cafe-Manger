<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('Settings',null,'d-flex');
    navbar();
?>
<div class="container p-5">
    <h1>การตั้งค่า</h1>
    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    การตั้งค่าทั่วไป
                </a>
                <a href="#" class="list-group-item list-group-item-action">บัญชีผู้ใช้</a>
                <a href="#" class="list-group-item list-group-item-action">บริษัท</a>
                <a href="#" class="list-group-item list-group-item-action">สินค้า</a>
                <a href="#" class="list-group-item list-group-item-action">ผู้ใช้</a>
                <a href="#" class="list-group-item list-group-item-action">ออกจากระบบ</a>
            </div>
        </div>
        <div class="col-9 border rounded-1 p-3">
            <h4>การตั้งค่าทั่วไป</h4>
            <!--about-->
            <div class="">
                <i class="bi bi-info-circle"></i> เกี่ยวกัยแอพพลิเคชั่น
                <span class="text-secondary">ระบบจัดการสินค้าและพนักงาน</span>
                <span class="small">v. <?php echo APP['app']['version'];?></span>
            </div>
        </div>  
    </div>  
</div>
<?php
    htmlFooter();
?>

