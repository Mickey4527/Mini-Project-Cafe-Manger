<?php
// import global config json file check file exists 
if(file_exists('../global/global.json') || file_exists('../global/config.json')){
    define('APP', json_decode(file_get_contents('../global/global.json'),true));
    // import config json file
    define('CONFIG', json_decode(file_get_contents('../global/config.json'),true));
}
else{
    define('APP', json_decode(file_get_contents('../global.json'),true));
    define('CONFIG', json_decode(file_get_contents('../config.json'),true));
}
// function return CSS and JS path from assets folder
function cssOut($css){
    $output = '';
    foreach($css as $style){
        $output .= '<link rel="stylesheet" href="'.$style.'">';
    }
    return $output;
}

function jsOut($js){
    $output = '';
    foreach($js as $script){
        $output .= '<script src="../assets/'.$script.'"></script>';
    }
    return $output;
}

function checkLogin(){
    return isset($_SESSION['user_id']);
}

function checkRole($role){
    if(!checkLogin())
        return false;
    if($_SESSION['roles'] === $role)
        return true;
    return false;
}

//check roles manager
function checkManager(){
    if(!checkLogin())
        return false;
    if($_SESSION['roles'] === 'manager')
        return true;
    return false;
}

// สำหรับการเข้าสู่ระบบ
function authLogin($conn,$email,$password){
    $stmt = $conn->prepare("SELECT user_id, email, first_name, last_name, roles  FROM employees_account WHERE email = '$email' AND password = ?");
    $stmt->bind_param("s",$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return array(
            'status' => true,
            'user_id' => $row['user_id'],
            'email' => $row['email'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'roles' => $row['roles']
        );
    }

    return array(
        'status' => false
    );
}
// สำหรับการลงทะเบียน
function authRegister($conn,$email,$password,$firstName,$lastName){
    return $conn->query("INSERT INTO `employees_account` (`email`, `password`, `first_name`, `last_name`, `roles`) VALUES ('$email', '$password', '$firstName', '$lastName', 'employee')");
}

function querySql($conn,$sql){
    $result = $conn->query($sql);

    return $result;
}
// สำหรับการเข้าถึงข้อมูลในตาราง
function getAnySql($conn,$val,$table,$key,$KeyVal){
    if($val === null || $table === null || $key === null || $KeyVal === null)
        return false;
    return $conn->query("SELECT $val FROM $table WHERE $key = '$KeyVal'");
}

// สำหรับการเข้าถึงข้อมูลในตารางทั้งหมด
function getAllSql($conn,$val,$table){
    if($val === null || $table === null)
        return false;
    return $conn->query("SELECT $val FROM $table");
}

// สำหรับการแทรกข้อมูลในตาราง
function insertAnySql($conn,$table,$val,$val2){
    try{
        if($val === null || $table === null || $val2 === null)
            return (array(
                'status' => false,
                'error' => 'ไม่สามารถเพิ่มข้อมูลได้'
            ));
        return array(
            'status' => true,
            'result' => $conn->query("INSERT INTO $table ($val) VALUES ($val2)")
        );
    }
    catch(Exception $e){
        return array(
            'status' => false,
            'error' => $e->getCode()
        );
    }
}
// สำหรับการเชื่อมตาราง
function joinOnSql($conn,$val,$table,$table2,$key,$key2){
    if($val === null || $table === null || $table2 === null || $key === null || $key2 === null)
        return false;
    return $conn->query("SELECT $val FROM $table INNER JOIN $table2 ON $table.$key = $table2.$key2");
}

// เช็คการมีข้อมูลในตาราง
function checkValueSQL($conn,$table,$val,$val2){
    if($val === null || $table === null || $val2 === null)
        return false;
    if($conn->query("SELECT $val FROM $table WHERE $val = '$val2'")->num_rows > 0)
        return true;
    return false;
}

function updateAnySql($conn,$table,$val,$key,$keyVal)
{
    try{
        if($val === null || $table === null || $key === null || $keyVal === null)
            return (array(
                'status' => false,
                'error' => 'ไม่สามารถแก้ไขข้อมูลได้'
            ));
        return array(
            'status' => true,
            'result' => $conn->query("UPDATE $table SET $val WHERE $key = '$keyVal'")
        );
    }
    catch(Exception $e){
        return array(
            'status' => false,
            'error' => $e->getCode()
        );
    }
}

// สำหรับการลบข้อมูลในตาราง
function deleteAnySql($conn,$table,$key,$keyVal){
    try{
        if($key === null || $table === null || $keyVal === null)
            return (array(
                'status' => false,
                'error' => 'ไม่สามารถลบข้อมูลได้'
            ));
        return array(
            'status' => true,
            'result' => $conn->query("DELETE FROM $table WHERE $key = '$keyVal'")
        );
    }
    catch(Exception $e){
        return array(
            'status' => false,
            'error' => $e->getCode()
        );
    }
}

// ฟังก์ชั่นสำหรับลบอักขระ html toon--------------------------------------
function remove_junk($str){
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
  }

//ฟังก์ชั่นสำหรับตรวจสอบช่องป้อนข้อมูลไม่ว่างเปล่า
function validate_fields($var){
 global $errors;
    foreach ($var as $field) {
      $val = remove_junk($_POST[$field]);
      if(isset($val) && $val==''){
        $errors = $field ." ไม่ได้ระบุ";
        return true;
      }
    }
    return false;
  }

  //ฟังก์ชันสำหรับการเปลี่ยนเส้นทาง
function redirect($url, $permanent = false)
  {
      if (headers_sent() === false)
      {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
      }

      exit();
  }

function checkImgFile($file){
    $allowed = array('jpg','jpeg','png');
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if(in_array($ext,$allowed)){
        return false;
    }
    return true;
}

?>

