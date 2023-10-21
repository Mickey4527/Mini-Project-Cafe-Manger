<?php
    include_once '../conn.php';
    include_once '../function.php';

    
    if(isset($_POST['submitCreateProduct'])){
        if(empty($_POST['ProductName']) || empty($_POST['Category']) || empty($_POST['Stock']) || empty($_POST['Quantityused']) || empty($_POST['Dateadded']) ){
            header('Location: ../../views/product_manager.php?error=emptyfields');
            exit();
        }
    }
        

?>
