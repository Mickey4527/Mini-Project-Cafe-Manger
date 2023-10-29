<?php
    include_once('../conn.php');
    include_once '../function.php';

    if(isset($_POST['submitCreateCat'])){
        if(empty($_POST['catName'])){
            header('Location: ../../views/category_manager.php?error=emptyfields');
            exit();
        }
        else{
            $catName = $_POST['catName'];
            $catDetail = $_POST['catDesc'];
            $catColor = substr($_POST['catColor'],1);

            if(insertAnySql($conn,'categories','cat_name,cat_desc,color',"'$catName','$catDetail','$catColor'")){
                header('Location: ../../views/category_manager.php?success=insert');
                exit();
            }
            else{
                header('Location: ../../views/category_manager.php?error=insert');
                exit();
            }
        }
    }
?>