<?php
    include_once '../conn.php';
    include_once '../function.php';

    if(isset($_POST['submitCreateUser'])){
        if(empty($_POST['EmpfirstName']) || empty($_POST['EmplastName']) || empty($_POST['Empemail']) || empty($_POST['Emppassword'])){
            header('Location: ../../views/employee_manager.php?error=emptyfields');
            exit();
        }
        else if(!filter_var($_POST['Empemail'],FILTER_VALIDATE_EMAIL)){
            header('Location: ../../views/employee_manager.php?error=invalidemail');
            exit();
        }
        else if(checkValueSQL($conn,'account_member','email',$_POST['Empemail'])){
            header('Location: ../../views/employee_manager.php?error=emailtaken');
            exit();
        }
        else{
            $firstName = $_POST['EmpfirstName'];
            $lastName = $_POST['EmplastName'];
            $email = $_POST['Empemail'];
            $password = $_POST['Emppassword'];
            if(insertAnySql($conn,'account_member','first_name,last_name,email,password',"'$firstName','$lastName','$email','$password'")){
                header('Location: ../../views/employee_manager.php?success=insert');
                exit();
            }
            else{
                header('Location: ../../views/employee_manager.php?error=insert');
                exit();
            }
        }
    }
?>