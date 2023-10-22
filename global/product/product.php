<?php
    include_once '../conn.php';
    include_once '../function.php';

    
    /*if(isset($_POST['submitCreateProduct'])){
        if(empty($_POST['ProductName']) || empty($_POST['Category']) || empty($_POST['Stock']) || empty($_POST['Quantityused']) || empty($_POST['Dateadded']) ){
            header('Location: ../../views/product_manager.php?error=emptyfields');
            exit();
        }*/

        
// เพิ่ม product
if(isset($_POST['add_product'])){
   $req_fields = array('ProductName','Category','Stock','Price', 'Dateadded' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['ProductName']));
     $p_cat   = remove_junk($db->escape($_POST['Category']));
     $p_qty   = remove_junk($db->escape($_POST['Stock']));
     $p_buy   = remove_junk($db->escape($_POST['Price']));
     $p_date  = remove_junk($db->escape($_POST['Dateadded']));
     
     $query  = "INSERT INTO product_manager";
     $query .=" product_name,product_category,product_stock,product_price,date_added";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_cat}', '{$p_qty}', '{$p_buy}', '{$p_date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('product_manager.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product_manager.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('product_manager.php',false);
   }

 }

?>
