<?php
    include_once('../pages/setup/setup-check.php');
    include_once('../pages/auth.php');

    if(checkMySqliExp() === true){
        echo "mysqli extension is available and enable.";
    } else {
        echo checkMySqliExp();
    }

?>