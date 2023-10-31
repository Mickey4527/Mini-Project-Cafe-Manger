<?php
    include_once '../global/conn.php';
    include_once '../global/function.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/layout.php';
    
    if(!checkLogin()){
        header('Location: login.php');
    }

    $css = styleOnly('
    .edit{
        display: none;
    }
    ');
    if(checkLogin()){
        header('Location: index.php');
    }

    htmlHeader('รายงานการขาย',$css,'d-flex align-items-center py-4');
    navbar();

    $result = querySql($conn,'select sum(price) as price, trace_id, max(sale_date) as sale_date from history_sales group by trace_id');
    //$result = getAllSql($conn,'sale_id,trace_id,product_id,sale_date,amount,price','history_sales')
?>

<div class="container-fluid p-5" style="overflow: scroll;">
    <div class="col-12">
        <div class="row">
            <div class="col-9">
                 <h1 class="h3">รายงานการขาย</h1>
            </div>
            <div class="col-3">
            <input class="form-control me-2" type="search" placeholder="ค้นหา" aria-label="Search" id="search">
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-12 my-3 d-flex justify-content-between align-items-center">
        </div>
         <div class="col-12">
            <div id="table">
                <?php table($result,'รายงานการขาย','trace_id',['รหัส','วันขาย','จำนวนเงินที่รับ'],['trace_id','sale_date','price']);?>
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


