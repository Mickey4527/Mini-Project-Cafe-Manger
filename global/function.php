<?php
// import global config json file check file exists 
if(file_exists('../global/global.json') || file_exists('../global/config.json')){
    define('APP', json_decode(file_get_contents('../global/global.json'),true));
    // import config json file
    define('CONFIG', json_decode(file_get_contents('../global/config.json'),true));
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

function authLogin($conn,$email,$password){
    $stmt = $conn->prepare("SELECT user_id, email, first_name, last_name, roles  FROM employees_account WHERE email = '$email' AND password = ?");
    $stmt->bind_param("s",$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['roles'] = $row['roles'];
        return true;
    }

    return false;
}
// สำหรับการลงทะเบียน
function authRegister($conn,$email,$password,$firstName,$lastName){
    return $conn->query("INSERT INTO `employees_account` (`email`, `password`, `first_name`, `last_name`, `roles`) VALUES ('$email', '$password', '$firstName', '$lastName', 'employee')");
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
    if($val === null || $table === null || $val2 === null)
        return false;
    return $conn->query("INSERT INTO $table ($val) VALUES ($val2)");
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
    if($val === null || $table === null || $key === null || $keyVal === null)
        return false;
    return $conn->query("UPDATE $table SET $val WHERE $key = '$keyVal'");
}

// สำหรับการลบข้อมูลในตาราง
function deleteAnySql($conn,$table,$key,$keyVal){
    return $conn->query("DELETE FROM $table WHERE $key = '$keyVal'");
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
        $errors = $field ." ไม่สามารถเป็นค่าว่างได้";
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

