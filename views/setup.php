<?php
    include_once('../pages/auth.php');
    $config_header = "<style>html, body{background-color: #f1f1f1; height: 100%;}</style>";
    include_once('../pages/setup/setup.php');
    include_once('../pages/header.php');
    include_once('../pages/modal/modal-box.php');
?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <?php
       echo form_setup(form_welcome($config['appname']))
    ?>
</body>