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
            <div class="row ">
            <?php
                    $result = getAllSql($conn,'product_id,product_name,product_category,product_stock,product_price,date_added,product_img','products');
                    if(!$result){
                        echo '<tr><td class="text-center" colspan="6">ไม่มีข้อมูล</td></tr>';
                    }
                    else{
                        foreach($result as $row){
                            echo '
                            <div class="card col-2 mx-1" data-price="'.$row['product_price'].'" data-name="'.$row['product_name'].'" data-id="'.$row['product_id'].'" id="product">
                                <div class="card-body row">
                                    <div class="col-12">
                                    <img src="../source/img/product/'.$row['product_img'].'" class="img-fluid" alt="..." width="140">
                                    </div>
                                    <div class="col-12 d-flex justify-content-center align-items-center pt-1">
                                    <h5 class="card-title">'.$row['product_name'].'</h5>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }
                    ?>  
            </div>         
            </div>
        </div>
        <div class="col-4 ms-1 me-3" style="height: calc(100vh - 160px);">
        <span class="small text-secondary">สรุป</span>
            <div class="border py-5 px-1 row h-100">
                <div class="col-12">
                    <span class="small text-secondary">รายการสินค้า</span>
                    <div class="p-3" id="list"></div>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let list = [];
    function addList(id,name,price){
        let index = list.findIndex((item) => item.id == id);
        if(index == -1){
            list.push({id:id,name:name,price:price,amount:1});
        }
        else{
            list[index].amount++;
        }
        showList();
    }
    function showList(){
        let content = '';
        let total = 0;
        list.forEach((item) => {
            content += '<div class="row border-bottom py-2"><div class="col-6">'+item.name+'</div><div class="col-3">จำนวน '+item.amount+'</div><div class="col-3">ราคา '+item.price+' บาท</div></div>';
            total += item.price * item.amount;
        });
        content += '<div class="row border-bottom py-2"><div class="col-6">รวม</div><div class="col-3"></div><div class="col-3">'+total+' บาท</div></div>';
        document.getElementById('list').innerHTML = content;
    }

    document.querySelectorAll('#product').forEach((item) => {
        item.addEventListener('click',() => {
            addList(item.dataset.id,item.dataset.name,item.dataset.price);
        });
    });
</script>
<?php
    htmlFooter(jsOut(['../assets/js/pos.js']));
?>