<?php
    include_once('../global/conn.php');
    include_once('../global/function.php');
    include_once('../global/header.php');
    include_once('../global/navbar.php');
    include_once('../global/layout.php');

    htmlHeader('จัดการหมวดหมู่',null,'d-flex bg-cafe-white');
    navbar();

    $result = getAllSql($conn,'cat_id,cat_name,cat_desc,color','categories')
?>


<div class="container-fluid p-5">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="h3">จัดการหมวดหมู่</h1>
        <form class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" placeholder="ค้นหาหมวดหมู่" aria-label="Search">
          </form>
    </div>
    <div class="row">
        <div class="col-12 my-3 d-flex justify-content-between align-items-center">
            <div>
                <a class="btn small " href="#" data-bs-toggle="modal" data-bs-target="#catCreate"><i class="bi bi-plus-lg text-cafe-brown-800"></i>เพิ่มหมวดหมู่</a>
            </div>
        </div>
        <div class="col-12">
            <div id="table">
                <?php table($result,'หมวดหมู่สินค้า','cat_id',['รหัส','ชื่อหมวดหมู่','สี'],['cat_id','cat_name','color']);?>
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
<div class="modal" id="catCreate" tabindex="-1" aria-labelledby="catcreateLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="catcreateLabel">สร้างหมวดหมู่</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <form method="post" action="../global/product/cat.php">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="catName" class="form-label">ชื่อหมวดหมู่*</label>
                            <input name="catName" type="text" class="form-control" id="catName" placeholder="ชื่อหมวดหมู่">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="catColor" class="form-label">สี</label>
                            <input name="catColor" type="color" class="form-control" id="catColor" placeholder="สี">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="catDesc" class="form-label">คำอธิบาย</label>
                            <input name="catDesc" type="text" class="form-control" id="catDesc" placeholder="คำอธิบาย">
                        </div>
                    </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button name="submitCreateCat" type="submit" class="btn btn-primary">สร้าง</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
    htmlFooter(jsOut(['../assets/js/category_manager.js']));
?>
