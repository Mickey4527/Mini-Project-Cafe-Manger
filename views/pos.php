<?php
    include_once('../global/conn.php');
    include_once('../global/function.php');
    include_once('../global/header.php');

    htmlHeader('POS');

    if(!checkLogin()){
        header('Location: login.php?callback='.$_SERVER['REQUEST_URI'].'');
    }
?>
<div class="border-bottom py-3 d-flex align-items-center justify-content-between">
    <ul class="nav col-12 col-lg-auto my-md-0 text-small mx-5">
         <li>
            <a href="../views/index.php" class="nav-link text-secondary border">
                ออกจากระบบ
            </a>
        </li>
    </ul>
    <div class="text-end text-secondary mx-5">
        <h4 id="time"></h4>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-7 ms-3 me-1">
            <span class="small text-secondary">รายการสินค้า</span>
            <div class="border p-5 ">
            <div class="row " id="product_list_dsiplay">
            <?php
                    $result = getAllSql($conn,'product_id,product_name,product_type,product_stock,product_price,date_added,product_img','products');
                    if(!$result){
                        echo '<tr><td class="text-center" colspan="6">ไม่มีข้อมูล</td></tr>';
                    }
                    else{
                        foreach($result as $row){
                            echo '
                            <button class="card col-2 mx-1" data-price="'.$row['product_price'].'" data-name="'.$row['product_name'].'" data-id="'.$row['product_id'].'" id="product">
                                <div class="card-body row">
                                    <div class="col-12">
                                    <img src="../source/img/product/'.$row['product_img'].'" class="img-fluid d-flex" alt="..." width="75" style="margin-left: auto;
                                    margin-right: auto;">
                                    </div>
                                    <div class="col-12 d-flex justify-content-center align-items-center pt-1">
                                    <h5 class="card-title">'.$row['product_name'].'</h5>
                                    </div>
                                </div>
                            </button>
                            ';
                        }
                    }
                    ?>  
            </div>         
            </div>
            <div class="small text-secondary mt-5">เครื่องมือ</div>
            <div class="row ">
                <div class="col-2">
                    <button class="btn btn-primary w-100 border" data-bs-toggle="modal" data-bs-target="#paycashModal"id="paycash" style="height: 120px;" disabled>ชำระเงินสด</button>
                </div>
            </div>
        </div>

        <div class="col-4 ms-1 me-3" style="height: calc(100vh - 160px);">
        <span class="small text-secondary">สรุป</span>
            <div class="border py-5 px-1 row h-100">
                <div class="col-12">
                    <span class="small text-secondary">รายการสินค้า</span>
                    <div class="p-3" id="list" style="height: 120px;"></div>
                </div>

                <div class="col-12">
                    <span class="small text-secondary">สรุปยอด</span>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            <p>ยอดรวม</p><h1 id="total" class="ms-auto"></h1>
                        </div>
                        <div class="col-12 d-flex align-items-center">
                            <p>ภาษี</p><h1 id="val" class="ms-auto"></h1>
                        </div>
                        <div class="col-12 d-flex align-items-center">
                            <p>ยอดสุทธิ</p><h1 id="net" class="ms-auto"></h1>
                        </div>
                        <hr>
                        <div class="col-12 d-flex align-items-center">
                            <p>รับเงิน</p><h1 id="receive" class="ms-auto"></h1>
                        </div>
                        <div class="col-12 d-flex align-items-center">
                            <p>เงินทอน</p><h1 id="change" class="ms-auto"></h1>
                        </div>   
                    </div>
                </div>

                <div class="col-12 d-flex flex-column justify-content-end h-0">
                    <button class="btn btn-primary w-100" id="pay" style="height: 75px;">ชำระเงิน</button>
                    <button class="btn w-100 border mt-1" id="cancel" style="height: 75px;" disabled>ยกเลิก</button>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal" id="paycashModal" tabindex="-1" aria-labelledby="paycashModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container p-3">
            <div class="row">
                <div class="col-12 mt-5">
                    <h1 class="text-center text-secondary">ชำระเงิน</h1>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control form-control-lg text-center" style="height: 75px; font-size: 75px;" id="paycash" placeholder="กรอกจำนวนเงินที่ชำระ" oninput="checkCash()">
                </div>
                <div class="col-12 mt-5">
                    <button class="btn btn-primary w-100 mt-3" id="paycash_btn" style="height: 125px;" disabled>เสร็จสิ้นการขาย</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function checkCash() {
        var paycashInput = document.getElementById('paycash').value;
        var paycashValue = parseFloat(paycashInput.value);
        var netElement = document.getElementById('net');
        var netValue = parseFloat(netElement.innerText);

        console.log("Paycash value: ", paycashValue);
        console.log("Net value: ", netValue);

        if (!isNaN(paycashValue) && paycashValue >= netValue) {
            document.getElementById('paycash_btn').disabled = false
        } else {
            document.getElementById('paycash_btn').disabled = false
        }
    }
</script>

<?php
    htmlFooter(jsOut(['../assets/js/pos.js']));
?>