<?php
    include_once '../conn.php';
    include_once '../function.php';
    include_once '../layout.php';
    
    /*if(isset($_POST['submitCreateProduct'])){
        if(empty($_POST['ProductName']) || empty($_POST['Category']) || empty($_POST['Stock']) || empty($_POST['Quantityused']) || empty($_POST['Dateadded']) ){
            header('Location: ../../views/product_manager.php?error=emptyfields');
            exit();
        }*/
// ถ้ามีการกดปุ่มแก้ไข
if(isset($_POST['Proedit'])){
  if(empty($_POST['Proedit'])){
      toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
      exit();
  }
  else{
      $productId = $_POST['Proedit'];
      $result = getAnySql($conn,'product_id,product_name,product_desc,product_type,product_stock,product_price,date_added,product_img','products','product_id',$productId);
      $row = $result->fetch_assoc();
      echo modalForm('EditProduct','แก้ไขสินค้า', formTemplate('edit',CONFIG['form']['Product']['fields'], $row),true,null,'EditPro');
      exit();
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
// Add Product
if(isset($_POST['Proadd']) && $_POST['Proadd'] === 'add'){
  $req_fields = array('name','price','unit');

  if(validate_fields($req_fields)){
    http_response_code(400);
    $res = array(
      'type' => 'empty',
      'input' => 'name,price,unit',
      'msg' => 'โปรดกรอกข้อมูลให้ครบถ้วน'
    );
    echo json_encode($res);
    exit();
  }

  if(checkImgFile($_FILES['img']['name'])){
    http_response_code(400);
    $res = array(
      'type' => 'img',
      'msg' => 'โปรดเลือกไฟล์รูปภาพ'
    );
    echo json_encode($res);
    exit();
  }

  $name = $_POST['name'];
  $price = $_POST['price'];
  $stock = $_POST['unit'];
  $category = $_POST['category'];
  $detail = $_POST['detail'];
  $date = $_POST['date'];
  $img = $_FILES['img']['name'];
  $target = "../../source/img/product/".basename($img);

  if(move_uploaded_file($_FILES['img']['tmp_name'],$target)){
    if(insertAnySql($conn,'products','product_name,product_type,product_desc,product_stock,product_price,date_added,product_img',"'$name','$category','$detail','$stock','$price','$date','$img'")){
      http_response_code(200);
      toast('เพิ่มสินค้าเรียบร้อย','text-success','check-circle-fill');
      exit();
    }
    else{
      http_response_code(200);
      toast('เพิ่มสินค้าไม่สำเร็จ','text-danger','exclamation-triangle-fill');
      exit();
    }
  }
}

//Edit Product
if(isset($_POST['saveProedit']) && $_POST['saveProedit'] === 'edit'){
  $req_fields = array('name','price','unit');

  if(validate_fields($req_fields)){
    http_response_code(400);
    echo "Please fill all fields";
    exit();
  }

  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $stock = $_POST['unit'];
  $category = $_POST['category'];
  $detail = $_POST['detail'];
  $date = $_POST['date'];

  if(!isset($_FILES['img']['name'])){
    if(updateAnySql($conn,'products',"product_name = '$name',product_type = '$category',product_desc = '$detail',product_stock = '$stock',product_price = '$price',date_added = '$date'","product_id",$id)){
      http_response_code(200);
      toast('แก้ไขสินค้าเรียบร้อย','text-success','check-circle-fill');
      exit();
    }
    else{
      http_response_code(200);
      toast('แก้ไขสินค้าไม่สำเร็จ','text-danger','exclamation-triangle-fill');
      exit();
    }
  }
  else{
    $img = $_FILES['img']['name'];
    $target = "../../source/img/product/".basename($img);

    if(checkImgFile($_FILES['img']['name'])){
      http_response_code(400);
      $res = array(
        'type' => 'img',
        'msg' => 'โปรดเลือกไฟล์รูปภาพ'
      );
      echo json_encode($res);
      exit();
    }
    if(move_uploaded_file($_FILES['img']['tmp_name'],$target)){
      if(updateAnySql($conn,'products',"product_name = '$name',product_type = '$category',product_desc = '$detail',product_stock = '$stock',product_price = '$price',date_added = '$date',product_img = '$img'","product_id",$id)){
          http_response_code(200);
          toast('แก้ไขสินค้าเรียบร้อย','text-success','check-circle-fill');
          exit();
        }
        else{
          http_response_code(200);
          toast('แก้ไขสินค้าไม่สำเร็จ','text-danger','exclamation-triangle-fill');
          exit();
        }
      }
  }
}

?>
