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
<div class="container p-5">
    <h1 class="h3">จัดการสินค้า</h1>
    <div class="row">
        <div class="col-12 my-3">
            <a class="btn small" href="#" data-bs-toggle="modal" data-bs-target="#Addpro"><i class="bi bi-plus-lg text-primary"></i>เพิ่มสินค้า</a>
        </div>
        <div class="col-12">
            <div id="table">
                <?php 
                    $result = getAllSql($conn,'product_id,product_name,product_category,product_stock,product_price,date_added,product_img','products');
                    table($result,'สินค้า','product_id',['รูปภาพ','ชื่อสินค้า','หมวดหมู่','จำนวน','ราคา','วันที่เปลี่ยนแปลง'],
                    ['product_img','product_name','product_category','product_stock','product_price','date_added'],null,true,'product_img','../source/img/product/');
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
            <form method="post" action="../global/product/product.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="ProductPic" class="form-label">รูปสินค้า</label>
                            <input name="ProImg" type="file" class="form-control" id="ProductPic" placeholder="รูปสินค้า" accept="image/*">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ProductName" class="form-label">ชื่อสินค้า</label>
                            <input name="ProductName" type="text" class="form-control" id="ProductName" placeholder="ชื่อสินค้า">
                        </div>
                    </div>
                    <div class="col-6">
                
                        <label for="Category" class="form-label">ประเภทสินค้า</label>
                        <select name="ProCat" class="form-select" id="Category" aria-label="Floating label select example">
                            <option selected>ประเภทสินค้า</option>
                            <option value="1">Coffee</option>
                            <option value="2">Tea</option>
                        </select>
                        </div>
                    </div>
                    

                    <label for="Stock" class="form-label">จำนวน</label>
                    <div class="input-group mb-3">
                        <input name="Procount" type="number" class="form-control" placeholder="จำนวน" aria-label="จำนวน" aria-describedby="Stock">
                        <span class="input-group-text" id="Stock">หน่วย/แก้ว</span>
                    </div>

                    <label for="Price" class="form-label">ราคา</label>
                    <div class="input-group mb-3">
                        <input name="ProPrice" type="number" class="form-control" placeholder="จำนวน" aria-label="จำนวน" aria-describedby="Price">
                        <span class="input-group-text" id="Price">บาท</span>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Dateadded" class="form-label">วันที่เพิ่มสินค้า</label>
                            <input name="Dateadded" type="date" class="form-control" id="date" placeholder="วันที่เพิ่มสินค้า">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ตั้งเป็นวันที่ปัจจุบัน
                                </label>
                            </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button name="add_product" type="submit" class="btn btn-primary">เพิ่ม</button>
        </div>
        </form>
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



<div class="modal" id="Edit" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EditLabel">เพิ่มสินค้า</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <form method="post" action="../global/product/product.php">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ProductName" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" id="ProductName" placeholder="ชื่อสินค้า">
                        </div>
                    </div>
                    <div class="col-6">
                
                        <label for="Category" class="form-label">ประเภทสินค้า</label>
                        <select class="form-select" id="Category" aria-label="Floating label select example">
                            <option selected>ประเภทสินค้า</option>
                            <option value="1">Coffee</option>
                            <option value="2">Tea</option>
                        </select>
                        </div>
                    </div>

                    <label for="Stock" class="form-label">จำนวน</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="จำนวน" aria-label="จำนวน" aria-describedby="Stock">
                        <span class="input-group-text" id="Stock">ชอต/แก้ว</span>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Dateadded" class="form-label">วันที่เพิ่มสินค้า</label>
                            <input name="Dateadded" type="date" class="form-control" id="date" placeholder="วันที่เพิ่มสินค้า">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ตั้งเป็นวันที่ปัจจุบัน
                                </label>
                            </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary">เพิ่ม</button>
      </div>
      </form>
    </div>
  </div>
</div> 
</div>

<div id="edit"></div>
<?php
    htmlFooter(jsOut(['../assets/js/product.js']));
?>