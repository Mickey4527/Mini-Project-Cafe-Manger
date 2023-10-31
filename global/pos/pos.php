<?php
 include_once '../conn.php';
 include_once '../function.php';
 include_once '../layout.php';
 
if(isset($_POST['list'])){
    $trace_id = 'TR'.date('Ymd').rand(1000,9999);
    $date = date('Y-m-d H:i:s');
    
    foreach ($_POST['list'] as $row){
        
        $productId = $row['id'];
        $productPrice = $row['price'];
        $productAmount = $row['amount'];

        $status = [];

        $result = insertAnySql($conn, 'history_sales', 'trace_id,product_id,payment_method,price,amount,sale_date', "'$trace_id','$productId','1','$productPrice','$productAmount','$date'");
        $update = updateAnySql($conn, 'products', 'product_stock = product_stock - '.$productAmount, 'product_id', $productId);

        $result['status'] ? array_push($status, true) : array_push($status, false);
        $update['status'] ? array_push($status, true) : array_push($status, false);
    }
    if(!in_array(false,$status)){
        http_response_code(200);
        modalForm('success','','<div class="d-flex align-items-center justify-content-center" style="height: 600px;">
        <h1 class="text-success">บันทึกข้อมูลสำเร็จ</h1></div>',true,'<button type="button" class="btn btn-success w-100" data-dismiss="modal" style="height: 75px;">ตกลง</button>');
        exit();
    }
    else{
        http_response_code(400);
        $res = array(
            'type' => 'error',
            'msg' => 'บันทึกข้อมูลไม่สำเร็จ'
        );
        echo json_encode($res);
        exit();
    }

}
?>