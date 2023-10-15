<?php
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php?callback='.$_SERVER['REQUEST_URI'].'');
    }
?>