<?php
function toast($message,$type,$icon = null){
    $icon = $icon === null ? '' : '<i class="bi bi-'.$icon.'"></i> ';
    echo '<div class="toast-container position-fixed top-0 end-0 p-3">
                <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body '.$type.'">
                            '.$icon.$message.'
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>';
}
//table แบบมีปุ่มแก้ไขและลบ
function table($result,$table_name,$table_id,$table_header,$table_body,$table_footer = null){
    if(!$result || $result->num_rows == 0){
        echo displayEmptyMsg($table_name);
        return;
    }

    $table_footer = $table_footer === null ? '' : $table_footer;
    $content = '';
    $content_header = '';

    //display header 
    $content_header .= '<tr>';
    foreach ($table_header as $name){
        $content_header .= '<th scope="col">'.$name.'</th>';
    }
    $content_header .= '<th scope="col">edit</th>';
    $content_header .= '</tr>';

    // display table data
    foreach ($result as $row){
        $content .= '<tr>';
        foreach ($table_body as $name){
            $content .= '<td>'.$row[$name].'</td>';
        }
        $content .= '<td><a class="btn small py-0 px-2" href="#" data-id="'.$row[$table_id].'"><i class="bi bi-pencil-square text-primary"></i>แก้ไขบัญชี</a><a class="btn small py-0 px-2" href="#" data-id="'.$row[$table_id].'" data-bs-toggle="modal" data-bs-target="#Delete"><i class="bi bi-trash-fill text-danger"></i>ลบบัญชี</a></td>';
        $content .= '</tr>';

    }
    echo '
            <table class="table align-middle">
                <thead>
                    '.$content_header.'
                </thead>
                <tbody>'.
                    $content
                .'</tbody>
                <tfoot>
                    '.$table_footer.'
                </tfoot>
            </table>
        ';
}

function displayEmptyMsg($table_name){
    return '<div class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 200px);">
                <div class="text-center text-secondary">
                    <i class="bi bi-emoji-frown" style="font-size: 56px"></i>
                    <h3>ไม่พบข้อมูล '.$table_name.'</h3>
                </div>
            </div>';
}

?>
