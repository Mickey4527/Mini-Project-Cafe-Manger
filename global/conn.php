<?php
@session_start();

class dbConn{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "cafe_buisness_system"; 

    public function connDB(){
        $conn = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
        mysqli_set_charset($conn,"utf8");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
            return false;
        }

        error_reporting(0);
        ini_set('display_errors', 0);
        return $conn;
    }
}
$conn = new dbConn();
$conn = $conn->connDB();
?>