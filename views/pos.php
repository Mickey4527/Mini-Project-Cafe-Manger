<?php
    include_once('../global/conn.php');
    include_once('../global/function.php');
    include_once('../global/header.php');

    htmlHeader('POS');
?>
<div class="border-bottom py-3">
    <ul class="nav col-12 col-lg-auto my-md-0 text-small mx-5">
         <li>
            <a href="../views/index.php" class="nav-link text-secondary border">
                ออกจากระบบ
              </a>
            </li>
          </ul>
</div>
<div class="container-fluid mt-5">
    <div class="row">
        
        <div class="col-7 ms-3 me-1">
            <span class="small text-secondary">รายการสินค้า</span>
            <div class="border p-5 ">

            </div>
        </div>
        <div class="col-4 ms-1 me-3">
        <span class="small text-secondary">สรุป</span>
            <div class="border p-5 ">

            </div>
        </div>
    </div>
</div>
<?php
    htmlFooter(jsOut(['../assets/js/pos.js']));
?>