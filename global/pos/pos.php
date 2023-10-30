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

        $result = insertAnySql($conn, 'history_sales', 'trace_id,product_id,payment_method,price,amount,sale_date', "'$trace_id','$productId','1','$productPrice','$productAmount','$date'");
        $update = updateAnySql($conn, 'products', 'product_stock = product_stock - '.$productAmount, 'product_id', $productId);
        if(!$result['status'] || !$update['status']){
            http_response_code(400);
            $res = array(
                'type' => 'error',
                'msg' => $result['error']
            );
            var_dump($result);
            exit();
        }
        else{
            http_response_code(200);
            $res = array(
                'type' => 'success',
                'msg' => 'สำเร็จ'
            );
            echo json_encode($res);
            exit();
        }
    }
}
?>