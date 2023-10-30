<?php
    function checkGetttingStart(){
      if($_SESSION['roles'] == 'employee'){
        echo '<div class = "row justify-content-center">
                <div class="col-12">
                    <h2 class="text-center mb-3">เริ่มต้นใช้งาน</h2>
                    <p class="text-center text-secondary mb-4">นี้เป็นครั้งแรกที่คุณเข้ามาใช้งานใช่มั้ย? เรียนรู้วิธีการใช้งานได้ที่นี่</p>
                </div>
                <div class="col-6">
                  '.CardSetup('เพิ่มสินค้า','เพิ่มสินค้าเข้าสู่ระบบของคุณ','<a href="product_manager.php" class="btn btn-primary">เพิ่มสินค้า</a>','plus').'
                </div> 
              </div>';
      }
    }
    
    function cardSetup($header,$content,$button, $icon = null){
           return '<div class="position-relative p-4 text-center text-muted bg-body border border-dashed rounded-3">
                    <i class="bi bi-'.$icon.' top-0 start-50 translate-middle text-secondary" style="font-size: 3.5rem;"></i>
                    <h1 class="text-body-emphasis">'.$header.'</h1>
                    <p class="col-lg-6 mx-auto mb-4">
                        '.$content.'
                    </p>
                    '.$button.'
                </div>
           ';
    }

?>