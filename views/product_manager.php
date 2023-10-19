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
                    <th scope="col">Selling Price</th>
                    <th scope="col">Date added</th>
                    <th scope="col">edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllSql($conn,'product_id,product_name,product_category,product_stock,product_price,date_added','product_manager');
                    foreach($result as $row){
                        echo '<tr>';
                        echo '<th scope="row">'.$row['product_id'].'</th>';
                        echo '<td>'.$row['product_name'].'</td>';
                        echo '<td>'.$row['product_category'].'</td>';
                        echo '<td>'.$row['product_stock'].'</td>';
                        echo '<td>'.$row['product_price'].'</td>';
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
        <h1 class="modal-title fs-5" id="AddproLabel">สร้างสินค้า</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <form> <!--edit-->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" id="firstname" placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="lastname" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" class="form-control" id="email" placeholder="อีเมล">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" placeholder="รหัสผ่าน">
                        </div>
                    </div>

                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary">สร้าง</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
    htmlFooter();
?>