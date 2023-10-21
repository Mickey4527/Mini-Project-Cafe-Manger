<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    include_once '../global/function.php';

    if(!checkLogin()){
        header('Location: login.php?callback='.$_SERVER['REQUEST_URI']);
    }

    htmlHeader('จัดการสินค้า',null,'d-flex');
    navbar();

?>
<!-- Content -->
<div class="container p-5">
    <h1 class="h3">จัดการสินค้า</h1>
    <div class="row">
        <div class="col-12 mt-3">
            <a class="btn small" href="#" data-bs-toggle="modal" data-bs-target="#Addpro"><i class="bi bi-plus-lg text-primary"></i>เพิ่มสินค้า</a>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Quantity used</th>
                    <th scope="col">Date added</th>
                    <th scope="col">edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllSql($conn,'product_id,product_name,product_category,product_stock,product_Quantity,date_added','product_manager');
                    foreach($result as $row){
                        echo '<tr>';
                        echo '<th scope="row">'.$row['product_id'].'</th>';
                        echo '<td>'.$row['product_name'].'</td>';
                        echo '<td>'.$row['product_category'].'</td>';
                        echo '<td>'.$row['product_stock'].'</td>';
                        echo '<td>'.$row['product_Quantity'].'</td>';
                        echo '<td>'.$row['date_added'].'</td>';
                        echo '<td><a class="btn small" href="#"><i class="bi bi-pencil-square text-primary"></i>แก้ไขสินค้า</a><a class="btn small" href="#"><i class="bi bi-trash-fill text-primary"></i>ลบสินค้า</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="Addpro" tabindex="-1" aria-labelledby="AddproLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddproLabel">เพิ่มสินค้า</h1>
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

<?php
    htmlFooter();
?>