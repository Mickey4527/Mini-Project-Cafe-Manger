<?php
@session_start();

class dbConn{
    private $host = "";
    private $user = "";
    private $pass = "";
    private $db = ""; 
    private $caf = "";

    public function connDB(){
        $conn = mysqli_init();
        
        mysqli_ssl_set($conn,NULL,NULL, $this->caf, NULL, NULL);
        mysqli_real_connect($conn, $this->host, $this->user, $this->pass, $this->db, 3306, MYSQLI_CLIENT_SSL);
        mysqli_set_charset($conn,"utf8");
        
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
            return false;
        }

        //error_reporting(0);
        //ini_set('display_errors', 0);
        return $conn;
    }

    public function closeDB($conn){
        mysqli_close($conn);
    }
}
$conn = new dbConn();
$conn = $conn->connDB();

?>
