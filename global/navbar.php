<?php
  function navbar(){
    $list_menu = '';
    foreach(GLOBAL_APP['app']['menu'] as $menu){
      if($_SESSION['roles'] == 'admin')
      $list_menu .= '<li class="nav-item">
        <a href="'.$menu['link'].'" class="nav-link active" aria-current="page">
            <i class="'.$menu['icon'].'"></i>
            '.$menu['name'].'
        </a>
      </li>';
    }
  }
?>

<main class="d-flex flex-nowrap">
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4"><?php echo GLOBAL_APP['app']['name'];?></span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="../views/index.php" class="nav-link active" aria-current="page">
            <i class="bi bi-house-fill"></i>
            หน้าแรก
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bi bi-person user-icon"></i>
        <strong><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="../views/settings.php">การตั้งค่า</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../global/auth/logout.php">ออกจากระบบ</a></li>
      </ul>
    </div>
  </div>
</main>