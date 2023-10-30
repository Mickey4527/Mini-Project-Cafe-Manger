<?php
    include_once('../conn.php');
    include_once '../function.php';
    include_once '../layout.php';

    // เพิ่มข้อมูล 
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

    //แก้ไขข้อมูล
    if(isset($_POST['saveProedit']) && $_POST['saveProedit'] === 'edit'){
        $req_fields = array('name','price','unit');
      
        if(validate_fields($req_fields)){
          //http_response_code(400);
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


    //ลบข้อมูล

    if(isset($_POST['Catdelete'])){
        if(empty($_POST['Catdelete'])){
            toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
            exit();
        }
        else{
            $categoryId = $_POST['Catdelete'];
            if(deleteAnySql($conn,'categories','cat_id',$categoryId)){
                toast('ลบข้อมูลเรียบร้อย','text-success','check-circle-fill');
                exit();
            }
            else{
                echo $categoryId.'error';
                exit();
            }
        }
      }
?>