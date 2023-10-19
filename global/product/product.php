<?php
    include_once '../conn.php';
    include_once '../function.php';

    if(isset($_POST['submitCreateProduct'])){
        if(empty($_POST['ProductName']) || empty($_POST['Category']) || empty($_POST['Stock']) || empty($_POST['SellingPrice']) || empty($_POST['Dateadded']) ){
            header('Location: ../../views/product_manager.php?error=emptyfields');
            exit();
        }
        
        else{
            $ProductName = $_POST['ProductName'];
            $Category = $_POST['Category'];
            $Stock = $_POST['Stock'];
            $SellingPrice = $_POST['SellingPrice'];
            $Dateadded = $_POST['Dateadded'];
            if(insertAnySql($conn,'product_manager','product_name,product_category,product_stock,product_price,date_added',"'$ProductName','$Category','$Stock','$SellingPrice','$Dateadded'")){
                header('Location: ../../views/product_manager.php?success=insert');
                exit();
            }
            else{
                header('Location: ../../views/product_manager.php?error=insert');
                exit();
            }
        }
    }
?>