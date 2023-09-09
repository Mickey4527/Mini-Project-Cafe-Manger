<?php
/* Hight Level */
function checkMySqliExp(){
    return extension_loaded('mysqli') && class_exists('mysqli') ? true : "MySQLi extension is not available or disable.";
}

?>
