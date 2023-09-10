<?php
    if(!isset($_GET['report']) || !isset($_GET['header'])){
        header("Location: ../views/");
    }
    
    include_once('../pages/auth.php');
    $config_header = "<style>html, body{background-color: #f1f1f1; height: 100%;}</style>";
    include_once('../pages/header.php');
    include_once('../pages/modal/modal-box.php');
?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <?php
       echo form_setup($_GET['report'],"<h2>".$_GET['header']."</h2>");
    ?>
</body>