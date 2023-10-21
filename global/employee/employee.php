<?php
    include_once '../conn.php';
    include_once '../function.php';

    // สำหรับการสร้างบัญชี
    if(isset($_POST['submitCreateUser'])){
        if(empty($_POST['EmpfirstName']) || empty($_POST['EmplastName']) || empty($_POST['Empemail']) || empty($_POST['Emppassword'])){
            header('Location: ../../views/employee_manager.php?error=emptyfields');
            exit();
        }
        else if(!filter_var($_POST['Empemail'],FILTER_VALIDATE_EMAIL)){
            header('Location: ../../views/employee_manager.php?error=invalidemail');
            exit();
        }
        // ตรวจสอบว่ามี email นี้ในระบบหรือยัง
        else if(checkValueSQL($conn,'account_member','email',$_POST['Empemail'])){
            header('Location: ../../views/employee_manager.php?error=emailtaken');
            exit();
        }
        else{
            $firstName = $_POST['EmpfirstName'];
            $lastName = $_POST['EmplastName'];
            $email = $_POST['Empemail'];
            $password = $_POST['Emppassword'];
            $business_id = getAnySql($conn,'business_id','account_member','user_id',$_SESSION['user_id'])->fetch_assoc()['business_id'];
            if(insertAnySql($conn,'account_member','first_name,last_name,email,password,business_id',"'$firstName','$lastName','$email','$password','$business_id'")){
                header('Location: ../../views/employee_manager.php?success=insert');
                exit();
            }
            else{
                header('Location: ../../views/employee_manager.php?error=insert');
                exit();
            }
        }
    }
    // สำหรับการลบบัญชี
    if(isset($_POST['Empdelete'])){
        if(empty($_POST['Empdelete'])){
            header('Location: ../../views/employee_manager.php?error=emptyfields');
            exit();
        }
        else{
            $user_id = $_POST['Empdelete'];
            if(deleteAnySql($conn,'account_member','user_id',$user_id)){
                echo 'ลบข้อมูลเรียบร้อย';
                exit();
            }
            else{
                echo $user_id.'error';
                exit();
            }
        }
    }
    
?>	
	