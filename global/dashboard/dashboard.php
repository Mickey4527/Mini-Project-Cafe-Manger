<?php
    function checkBusiness(){
        if($_SESSION['business_id'] === null){
            echo '<div class = "row">
                    <div class="col-12">
                        <h2 class="text-center mb-3">เริ่มต้นใช้งาน</h2>
                        <p class="text-center text-secondary mb-4">เริ่มต้นใช้งานโดยการสร้างร้านค้าของคุณเองหรือเข้าร่วมร้านค้าที่มีอยู่แล้ว</p>
                    </div>
                    <div class="col-6">
                        '.CardSetup('ฉันเป็นเจ้าของร้าน','สร้างร้านค้าของคุณเองเพื่อเริ่มต้นใช้งาน','<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">สร้างร้านค้า</a>','shop').'
                    </div>
                    <div class="col-6">
                        '.CardSetup('ฉันเป็นพนักงาน','เข้าร่วมร้านค้าที่มีอยู่แล้วเพื่อเริ่มต้นใช้งาน','<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#joinModal">เข้าร่วมร้านค้า</a>','person-badge-fill').'
                    </div>
                </div>';
                modalForm('createModal','สร้างร้านค้า','สร้างร้านค้าของคุณเองเพื่อเริ่มต้นใช้งาน');
                modalForm('joinModal','เข้าร่วมร้านค้า','เข้าร่วมร้านค้าที่มีอยู่แล้วเพื่อเริ่มต้นใช้งาน');
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

    function modalForm($ModalId, $header, $content){
        echo '<div class="modal fade" id="'.$ModalId.'" tabindex="-1" aria-labelledby="'.$ModalId.'Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="'.$ModalId.'Label">'.$header.'</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              '.$content.'
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>';
    }
?>