<?php
//
//  Navbar - แถบเมนูด้านซ้าย สำหรับเรียกใช้งานในหน้าต่างๆ
//

// สำหรับเรียกใช้ลิงค์ที่กำหนดไว้ในไฟล์ global/app.json
  function menuList(){
    $list_menu = '';
    $url = explode('?',$_SERVER['REQUEST_URI']);
    $role = $_SESSION['roles'];

    foreach(APP['menu'] as $menu){
      if($role == 'manager' && $menu['isOwner']){
        $list_menu .= menu($menu,$url);
        continue;
      }
      else if($role == 'employee' && $menu['isEmployee']){
        $list_menu .= menu($menu,$url);
        continue;
      }
    }
    return $list_menu;
  }

function menu($menu,$url){
  $list_menu = '';
  $sub_menu = '';

  if(isset($menu['sub'])){
    $toggle = 'data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true"';
    $sub_menu .= '<div class="collapse show" id="dashboard-collapse"><ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">';
    foreach($menu['sub'] as $sub){
      $sub_menu .= ($sub['url'] == $url[0]) ? '<li><a class="nav-link text-cafe-dark ms-4 py-2 active" href="'.$sub['url'].'">'.$sub['title'].'</a></li>' : '<li><a class="nav-link text-cafe-dark ms-4 py-2" href="'.$sub['url'].'">'.$sub['title'].'</a></li>';
    }
    $sub_menu .= '</ul></li>';
    }

  // ถ้า $_SERVER['REQUEST_URI'] มี ? ให้ตัดเอาเฉพาะ url ไม่เอาค่าที่อยู่หลัง ?
    if($menu['url'] == $url[0]){
        $list_menu .= '<li class="nav-item">';
        $list_menu .= (isset($menu['sub'])) ? '<a href="'.$menu['url'].'" class="nav-link text-cafe-dark dropdown-toggle active" '.$toggle.'>' : '<a href="'.$menu['url'].'" class="nav-link text-cafe-dark active">';
        $list_menu .= '<i class="'.$menu['icon'].'"></i>
              '.$menu['title'].'
          </a>
          '.$sub_menu.'
        </li>';
        return $list_menu;
    }

  $list_menu .= '<li class="nav-item">';
  $list_menu .= (isset($menu['sub'])) ? '<a href="'.$menu['url'].'" class="nav-link text-cafe-dark " '.$toggle.'>' : '<a href="'.$menu['url'].'" class="nav-link text-cafe-dark-800">';
  $list_menu .= '<i class="'.$menu['icon'].'"></i>
        '.$menu['title'];
  $list_menu .= (isset($menu['sub'])) ? '<i class="bi bi-chevron-up" style="position: relative; right: -80px;"></i></a>' : '</a>';
  $list_menu .= $sub_menu.'</li>';
  return $list_menu;
}
// โครงสร้างของ Navbar
  function layoutNavbar($nav = null){
    return '<main class="d-flex flex-nowrap" id="side-open">
              <div class="d-flex flex-column flex-shrink-0 p-3 bg-cafe-body" style="width: 280px; height: 100vh;">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-cafe-dark text-decoration-none">
                  <span class="fs-4">'.APP['app']['name'].'</span></a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                  '.$nav.'
                </ul>
                <hr>
                <div class="dropdown">
                  <a href="#" class="d-flex align-items-center text-cafe-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
            </main>
            ';
  }
// เรียกใช้งาน Navbar
  function navbar(){
    echo layoutNavbar(menuList());
  }
?>