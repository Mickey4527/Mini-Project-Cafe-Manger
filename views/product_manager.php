<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';
    include_once '../global/layout.php';

    if(!checkLogin()){
        header('Location: login.php?callback='.$_SERVER['REQUEST_URI']);
    }

    htmlHeader('จัดการสินค้า',null,'d-flex bg-cafe-white');
    navbar();

?>
<!-- Content -->
<div class="container-fluid p-5">
    <h1 class="h3">จัดการสินค้า</h1>
    <div class="row">
        <div class="col-12 my-3">
            <a class="btn small" href="#" data-bs-toggle="modal" data-bs-target="#Addpro"><i class="bi bi-plus-lg text-primary"></i>เพิ่มสินค้า</a>
        </div>
        <div class="col-12">
            <div id="table">
                <?php 

                     $result = joinOnSql(  $conn,
                                'products.product_id,products.product_name,products.product_type,
                                products.product_stock,products.product_price,products.date_added,products.product_img,
                                categories.cat_name',
                                'products',
                                'categories',
                                'product_type',
                                'cat_id'
                            );

                    //$result = getAllSql($conn,'product_id,product_name,product_type,product_stock,product_price,date_added,product_img','products');
                    table($result,'สินค้า','product_id',['รูปภาพ','ชื่อสินค้า','หมวดหมู่','จำนวน','ราคา','วันที่เปลี่ยนแปลง'],
                    ['product_img','product_name','cat_name','product_stock','product_price','date_added'],null,true,'product_img','../source/img/product/');
                ?>
            </div>
        </div>
    </div>
</div>

<!--Modal Add Product-->
<div class="modal" id="Addpro" tabindex="-1" aria-labelledby="AddproLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddproLabel">เพิ่มสินค้า</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container p-3">
                    <?php
                        echo formTemplate("add",CONFIG['form']['Product']['fields']);
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button name="save_product" type="submit" id="savePro" class="btn btn-primary">เพิ่ม</button>
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
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" id="confirm"><strong class="text-danger">ลบบัญชี</strong></button>
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
    </div>
  </div>
</div>


<div id="edit"></div>
<div id="toast"></div>
<?php
    htmlFooter(jsOut(['../assets/js/product.js']));
?>