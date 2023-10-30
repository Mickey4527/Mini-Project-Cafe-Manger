<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/layout.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    htmlHeader('รายงานการขาย',null,'d-flex bg-cafe-white');
    navbar();

    //querySql($conn,'SELECT * FROM history_sales')
    $result = getAllSql($conn,'sale_id,trace_id,product_id,sale_date,amount,price','history_sales')
?>

<div class="container-fluid p-5">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="row">
                <div class="col-12 my-3 d-flex justify-content-between align-items-center">
                </div>
                <div class="col-12">
                    <div id="table">
                        <?php table($result,'รายงานการขาย','sale_id',['รหัส','รหัสสินค้า','วันขาย','จำนวน','ราคา'],['trace_id','product_id','sale_date','amount','price']);?>
                    </div>
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
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" id="confirm"><strong class="text-danger">ลบการขาย</strong></button>
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
    </div>
  </div>
</div>


<div id="toast"></div>
<?php
    htmlFooter(jsOut(['../assets/js/report_sale.js']));
?>


