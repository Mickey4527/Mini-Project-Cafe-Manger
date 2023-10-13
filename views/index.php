<?php
    if(!$_SESSION['user_id']){
        header('Location: login.php');
    }
?>