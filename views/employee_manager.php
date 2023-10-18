<?php
    include_once '../global/conn.php';
    include_once '../global/header.php';
    include_once '../global/navbar.php';
    
    
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }
    htmlHeader('จัดการบัญชีพนักงาน',null,'d-flex');
    navbar();
?>
<div class="container p-5">
    <h1 class="h3">จัดการบัญชีพนักงาน</h1>
    <div class="row">
        <div class="col-12 mt-3">
            <a href="#">เพิ่มบัญชี</a>
            <a href="#">ลบบัญชี</a>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    htmlFooter();
?>