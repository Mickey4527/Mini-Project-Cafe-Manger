<?php
    include_once '../conn.php';
    include_once '../function.php';
    include_once '../layout.php';
    
    /*if(isset($_POST['submitCreateProduct'])){
        if(empty($_POST['ProductName']) || empty($_POST['Category']) || empty($_POST['Stock']) || empty($_POST['Quantityused']) || empty($_POST['Dateadded']) ){
            header('Location: ../../views/product_manager.php?error=emptyfields');
            exit();
        }*/

if(isset($_POST['Proedit'])){
  if(empty($_POST['Proedit'])){
      toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
      exit();
  }
  else{
      $productId = $_POST['Proedit'];
      $result = getAnySql($conn,'product_id,product_name,product_category,product_stock,product_price,date_added,product_img','products','product_id',$productId);
      $row = $result->fetch_assoc();
      echo modalForm('EditProduct','2', formTemplate('test',CONFIG['form']['EditProduct']['fields'], $row));
      exit();
  }
}       
// เพิ่ม product
if(isset($_POST['add_product'])){
  $req_fields = array('ProductName','ProCat','Procount','ProPrice','Dateadded');

  if(validate_fields($req_fields)){
    echo "Please fill all fields";
    exit();
  }
  if(checkValueSQL($conn,'products','product_name',$_POST['ProductName'])){
    echo "This product name is already taken";
    exit();
  }
  if(checkImgFile($_FILES['ProImg']['name'])){
    echo "This file is not an image";
    exit();
  }

 
  $product_name = $_POST['ProductName'];
  $product_cat = $_POST['ProCat'];
  $product_count = $_POST['Procount'];
  $product_price = $_POST['ProPrice'];
  $product_date = $_POST['Dateadded'];
  $product_img = $_FILES['ProImg']['name'];
  $target = "../../source/img/product/".basename($product_img);

  if(move_uploaded_file($_FILES['ProImg']['tmp_name'],$target)){
    if(insertAnySql($conn,'products','product_name,product_category,product_stock,product_price,date_added,product_img',"'$product_name','$product_cat','$product_count','$product_price','$product_date','$product_img'")){
      echo "Product added successfully";
      exit();
    }
    else{
      echo "Something went wrong";
      exit();
    }
  }
}
 // สำหรับการลบ 
 if(isset($_POST['Prodelete'])){
  if(empty($_POST['Prodelete'])){
      toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
      exit();
  }
  else{
      $productId = $_POST['Prodelete'];
      if(deleteAnySql($conn,'products','product_id',$productId)){
          toast('ลบข้อมูลเรียบร้อย','text-success','check-circle-fill');
          exit();
      }
      else{
          echo $productId.'error';
          exit();
      }
  }
}

?>
