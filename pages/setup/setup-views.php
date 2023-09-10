<?php
function language_setup($config){
    $language = $config['language'];
    $language_setup = null;
    foreach($language as $key => $value){
        $language_setup .= "<option value=".$key.">".$value."</option>";
    }
    return $language_setup;
}

function form_welcome($app_name = null){
    return "
                <h2 class=\"my-3\">ยินดีต้อนรับ</h2>
                <p class=\"mb-5\">ก่อนที่จะเริ่มใช้งาน ".$app_name." ,เรามีสิ่งที่คุณต้องทำสองถึงสามขั้นตอนก่อน</p>
                <button class=\"btn btn-primary mt-5\" onclick=\"setup('db')\">เริ่มตั้งค่า</button>
            ";
}

function form_input_db(){
    return "
                <h2 class=\"my-3\">ตั้งค่าฐานข้อมูล</h2>
                <p class=\"mb-5\">กรุณากรอกข้อมูลฐานข้อมูล</p>
                <div class=\"mb-3\">
                    <label for=\"server\" class=\"form-label\">Server</label>
                    <input type=\"text\" class=\"form-control\" id=\"server\" placeholder=\"localhost\">
                </div>
                <div class=\"mb-3\">
                    <label for=\"username\" class=\"form-label\">Username</label>
                    <input type=\"text\" class=\"form-control\" id=\"username\" placeholder=\"root\">
                </div>
                <div class=\"mb-3\">
                    <label for=\"password\" class=\"form-label\">Password</label>
                    <input type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"password\">
                </div>
                <div class=\"mb-3\">
                    <label for=\"database\" class=\"form-label\">Database</label>
                    <input type=\"text\" class=\"form-control\" id=\"database\" placeholder=\"database\">
                </div>
                <button class=\"btn btn-primary mt-5\" onclick=\"setup('db')\">ต่อไป</button>
            ";
}
?>