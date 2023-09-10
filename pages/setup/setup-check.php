<?php
/* Hight Level */
function checkMySqliExp(){
    return extension_loaded('mysqli') && class_exists('mysqli');
}
function checkPHP($reqphp){
    return !version_compare(PHP_VERSION, $reqphp, '<');
}
?>
