<?php
@session_start();

class database{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function getServername(){
        return $this->servername;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getDbname(){
        return $this->dbname;
    }
    public function setServername($servername){
        $this->servername = $servername;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setDbname($dbname){
        $this->dbname = $dbname;
    }
    public function getconn(){
        try{
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $_SESSION['conn'] = $conn;
                echo "Connected to MySQL server successfully!";
            }
        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
       
    }
}

$database = new database();
$database->setServername('db');
$database->setUsername('root');
$database->setPassword('1234');
$database->setDbname('project_sm');
$database->getconn();
?>