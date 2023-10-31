<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('Settings',null,'d-flex bg-cafe-white');
    navbar();
?>
<div class="container-fluid p-5"  style="overflow: scroll;">
    <h1>การตั้งค่า</h1>
    <div class="row mt-5">
        <div class="col-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    การตั้งค่าทั่วไป
                </a>
                <a href="../global/auth/logout.php" class="list-group-item list-group-item-action">ออกจากระบบ</a>
            </div>
        </div>
        <div class="col-9">
            <!--about-->
            <div class="border rounded-1 py-3 px-4 bg-body d-flex align-items-center justify-content-between w-100">
                <div class="d-flex">
                    <i class="bi bi-info-circle" style="font-size: 24px;"></i>
                    <div class="d-flex flex-column ms-3">
                        <span class="fw-bold">เกี่ยวกับ</span>
                        <span class="text-secondary">ระบบจัดการสินค้าและพนักงาน</span>
                    </div>
                </div>
                <span class="small">เวอร์ชัน <?php echo APP['app']['version'];?></span>
            </div>
        </div>  
    </div>  
</div>
<?php
    htmlFooter();
?>