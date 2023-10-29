<?php
    include_once '../global/header.php';
    include_once '../global/function.php';
    $_GET['errortype'] = isset($_GET['errortype']) ? $_GET['errortype'] : '';
    
    if($_GET['error'] === null){
        header("Location: index.php");
    }
    if($_GET['errortype'] === 'database'){
        $error = 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล';
    }
    else{
        $error = 'เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุ';
    }

    $css = styleOnly('
    .form-signin{
        max-width: 400px;
    }
    ');

    htmlHeader('ข้อผิดพลาด',$css,'d-flex align-items-center py-4 bg-cafe-body');
?>
<main class="form-signin px-5 pt-5 w-100 m-auto bg-cafe-white border rounded">
    <h6 class="mb-4">Code name : <?php echo APP['app']['name'];?></h6>

    <h1 class="h4 fw-normal">ข้อผิดพลาด</h1>
    <p class="mb-5 small"><?php echo $error;?></p>
    <p class="mb-4 small">รายละเอียด : <?php echo $_GET['error'];?></p>

    <p class="mt-1 mb-3 text-body-secondary small">กรุณาติดต่อผู้ดูแลระบบ</p>
    <p class="mt-5 mb-3 text-body-secondary small">©2023 <?php echo APP['app']['name'];?> - เวอร์ชั่น <?php echo APP['app']['version'];?></p>
</main>

<?php
    htmlFooter();
?>
