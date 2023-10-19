<?php
//
//  Navbar - แถบเมนูด้านซ้าย สำหรับเรียกใช้งานในหน้าต่างๆ
//

// สำหรับเรียกใช้ลิงค์ที่กำหนดไว้ในไฟล์ global/app.json
  function menuNavbar(){
    $list_menu = '';
    foreach(GLOBAL_APP['menu'] as $menu){
      // ถ้า $_SERVER['REQUEST_URI'] มี ? ให้ตัดเอาเฉพาะ url ไม่เอาค่าที่อยู่หลัง ?
      $url = explode('?',$_SERVER['REQUEST_URI']);
      if($menu['url'] == $url[0]){
          $list_menu .= '<li class="nav-item">
            <a href="'.$menu['url'].'" class="nav-link active" aria-current="page">
                <i class="'.$menu['icon'].'"></i>
                '.$menu['title'].'
            </a>
          </li>';
          continue;
      }
      $list_menu .= '<li class="nav-item">
        <a href="'.$menu['url'].'" class="nav-link text-white" aria-current="page">
            <i class="'.$menu['icon'].'"></i>
            '.$menu['title'].'
        </a>
      </li>';
    }
    return $list_menu;
  }

// โครงสร้างของ Navbar
  function layoutNavbar($nav = null){
    return '<main class="d-flex flex-nowrap">
              <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh;">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                  <span class="fs-4">'.GLOBAL_APP['app']['name'].'</span></a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                  '.$nav.'
                </ul>
                <hr>
                <div class="dropdown">
                  <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person user-icon"></i>
                    <strong>'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</strong>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="../views/settings.php">การตั้งค่า</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../global/auth/logout.php">ออกจากระบบ</a></li>
                  </ul>
                </div>
              </div>
            </main>';
  }
// เรียกใช้งาน Navbar
  function navbar(){
    echo layoutNavbar(menuNavbar());
  }
?>
