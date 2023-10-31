<?php
    include_once '../conn.php';
    include_once '../function.php';
    include_once '../layout.php';


    if(isset($_POST['Saledelete'])){
        if(empty($_POST['Saledelete'])){
            toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
            exit();
        }
        else{
            $reportId = $_POST['Saledelete'];
            $result = deleteAnySql($conn,'history_sales','trace_id',$reportId);
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
?>