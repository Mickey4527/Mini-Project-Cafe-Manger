<?php
    include_once '../conn.php';
    include_once '../function.php';
    include_once '../layout.php';

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
        else if(checkValueSQL($conn,'employees_account','email',$_POST['Empemail'])){
            header('Location: ../../views/employee_manager.php?error=emailtaken');
            exit();
        }
        else{
            $firstName = $_POST['EmpfirstName'];
            $lastName = $_POST['EmplastName'];
            $email = $_POST['Empemail'];
            $password = $_POST['Emppassword'];
            $telephone = $_POST['Emptelephone'];
            $date = $_POST['Empdate'];

            if(insertAnySql($conn,'employees_account','first_name,last_name,email,password,telephone',"'$firstName','$lastName','$email','$password','$telephone'")){
                header('Location: ../../views/employee_manager.php?success=insert');
                exit();
            }
            else{
                header('Location: ../../views/employee_manager.php?error=insert');
                exit();
            }
        }
    }
    // สำหรับการแก้ไขบัญชี
    if(isset($_POST['submitEditUser'])){
        if(empty($_POST['EmpfirstName']) || empty($_POST['EmplastName']) || empty($_POST['Empemail'])){
            header('Location: ../../views/employee_manager.php?error=emptyfields');
            exit();
        }
        else if(!filter_var($_POST['Empemail'],FILTER_VALIDATE_EMAIL)){
            header('Location: ../../views/employee_manager.php?error=invalidemail');
            exit();
        }
        // ตรวจสอบว่ามี email นี้ในระบบหรือยัง
        else if(checkValueSQL($conn,'employees_account','email',$_POST['Empemail'])){
            header('Location: ../../views/employee_manager.php?error=emailtaken');
            exit();
        }
        else{
            $firstName = $_POST['EmpfirstName'];
            $lastName = $_POST['EmplastName'];
            $email = $_POST['Empemail'];
            $telephone = $_POST['Emptelephone'];
            $user_id = $_POST['Empuser_id'];

            if(updateAnySql($conn,'employees_account',"first_name = '$firstName',last_name = '$lastName',email = '$email',telephone = '$telephone'","user_id",$user_id)){
                header('Location: ../../views/employee_manager.php?success=update');
                exit();
            }
            else{
                header('Location: ../../views/employee_manager.php?error=update');
                exit();
            }
        }
    }
    // สำหรับการลบบัญชี
    if(isset($_POST['Empdelete'])){
        if(empty($_POST['Empdelete'])){
            toast('ไม่มีค่าข้อมูล','text-success','check-circle-fill');
            exit();
        }
        else{
            $user_id = $_POST['Empdelete'];
            if($user_id == $_SESSION['user_id']){
                toast('ไม่สามารถลบบัญชีของคุณเองได้','text-danger','exclamation-triangle-fill');
                exit();
            }
            if(deleteAnySql($conn,'employees_account','user_id',$user_id)){
                toast('ลบข้อมูลเรียบร้อย','text-success','check-circle-fill');
                exit();
            }
            else{
                echo $user_id.'error';
                exit();
            }
        }
    }

    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $result = querySql($conn,"SELECT * FROM employees_account WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR telephone LIKE '%$search%'");
        table($result,'พนักงาน','user_id',['รหัสพนักงาน','ชื่อจริง','นามสกุล','อีเมล','เบอร์โทรศัพท์','วันที่สร้าง'],['user_id','first_name','last_name','email','telephone','creation_date']);
    }
    
?>	
	