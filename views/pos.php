<?php
    include_once('../global/conn.php');
    include_once('../global/function.php');
    include_once('../global/header.php');

    htmlHeader('POS');
?>
<div class="border-bottom py-3">
    <ul class="nav col-12 col-lg-auto my-md-0 text-small mx-5">
         <li>
            <a href="../views/index.php" class="nav-link text-secondary border">
                ออกจากระบบ
              </a>
            </li>
          </ul>
</div>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-7 border p-5 mx-3">

        </div>
        <div class="col-4 border p-5 mx-3">

        </div>
    </div>
</div>
<?php
    htmlFooter(jsOut(['../assets/js/pos.js']));
?>