<?php
    include_once '../conn.php';
    include_once '../function.php';
    include_once '../layout.php';



    // ถ้ามีการกดปุ่มแก้ไข
    if(isset($_POST['Catedit'])){
      if(empty($_POST['Catedit'])){
          toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
          exit();
      }
      else{
          $categoryId = $_POST['Catedit'];
          $result = getAnySql($conn,'cat_id,cat_name,cat_desc,color','categories','cat_id',$categoryId);
          $row = $result->fetch_assoc();
          echo modalForm('EditCategory','แก้ไขหมวดหมู่', formTemplate('edit',CONFIG['form']['categories']['fields'], $row),true,null,'EditCat');
          exit();
      }
    }   

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
    if(isset($_POST['saveCatedit']) && $_POST['saveCatedit'] === 'edit'){
        $req_fields = array('name','desc','color');
      
        if(validate_fields($req_fields)){
          //http_response_code(400);
          echo "Please fill all fields";
          exit();
        }
      
        $id = $_POST['id'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $color =  substr($_POST['color'],1);
      
        if(updateAnySql($conn,'categories',"cat_name = '$name',cat_desc = '$desc',color = '$color'","cat_id",$id)){
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


    //ลบข้อมูล

    if(isset($_POST['Catdelete'])){
        if(empty($_POST['Catdelete'])){
            toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
            exit();
        }
        else{
            $categoryId = $_POST['Catdelete'];
            $result = deleteAnySql($conn,'categories','cat_id',$categoryId);
            if($result['status']){
                toast('ลบข้อมูลเรียบร้อย','text-success','check-circle-fill');
                exit();
            }
            else{
              if($result['error'] === 1451){
                toast('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้งานอยู่','text-danger','exclamation-triangle-fill');
              }
              exit();
            }
        }
      }
      if(isset($_POST['search'])){
        $search = $_POST['search'];
        $result = querySql($conn,"SELECT * FROM categories WHERE cat_name LIKE '%$search%' OR cat_desc LIKE '%$search%' OR color LIKE '%$search%'");
        table($result,'หมวดหมู่สินค้า','cat_id',['รหัสหมวดหมู่','ชื่อหมวดหมู่','รายละเอียด','สี'],['cat_id','cat_name','cat_desc','color']);
    }
?>