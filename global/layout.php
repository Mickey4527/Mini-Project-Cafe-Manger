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
function table($result,$table_name,$table_id,$table_header,$table_body,$table_footer = null,$picture = false,$picture_col = null,$picture_target = null){
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
    $content_header .= '<th scope="col"></th>';
    $content_header .= '</tr>';

    // display table data
    foreach ($result as $row){
        $content .= '<tr>';
        foreach ($table_body as $name){
            if($picture && $name == $picture_col){
                $content .= '<td><img src="'.$picture_target.$row[$name].'" class="img-thumbnail" style="width: 75px;"></td>';
                continue;
            }
            $content .= '<td>'.$row[$name].'</td>';
        }
        $content .= '<td><button class="btn small py-0 px-2" data-id="'.$row[$table_id].'" id="Edit-'.$row[$table_id].'">
        <i class="bi bi-pencil-square text-cafe-brown-800"></i>แก้ไข</button>
        <button class="btn small py-0 px-2" data-id="'.$row[$table_id].'" data-bs-toggle="modal" data-bs-target="#Delete">
        <i class="bi bi-trash-fill text-danger"></i>ลบ</button></td>';
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

function modalForm($ModalId, $header, $content,$footer = false,$content_footer = null,$save_id = null){
    $button = '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
               <button name="save'.$save_id.'" type="submit" id="save'.$save_id.'" class="btn btn-primary">บันทึก</button>';
    $content_footer = $content_footer === null ? $button : $content_footer;
    $footer = $footer === false ? '' : '<div class="modal-footer">'.$content_footer.'</div>';

    echo '<div class="modal fade" id="'.$ModalId.'" tabindex="-1" aria-labelledby="'.$ModalId.'Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="'.$ModalId.'Label">'.$header.'</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          '.$content.'
        </div>
        '.$footer.'
      </div>
    </div>
  </div>';
}

function formTemplate($formId,$input, $inputVal = null){
    $output = '<form id="'.$formId.'"><div class="row g-3">';
    foreach ($input as $col){
        $inputForm = '';
        // กรณีที่ไม่ได้กำหนดค่าให้กับ inputVal
        if(!isset($inputVal[$col['id']])){
            $inputVal[$col['id']] = '';
        }
        // กรณีของ input ที่มี type เป็นแบบต่างๆ
        switch ($col['type']){
            case 'select':
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<select class="form-select" id="'.$formId.'-'.$col['id'].'">';
                if(isset($col['pull_data'])){
                    $inputForm .= selectData($col['options'],null,$col['pull_data'],$inputVal[$col['id']]);
                }
                else{
                    $inputForm .= selectData($col['options']);
                }
                $inputForm .= '</select>';
                $inputForm .= '<div class="invalid-feedback" id="invalid_'.$col['id'].'"></div>';
                break;
            case 'textarea':
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<textarea class="form-control" id="'.$formId.'-'.$col['id'].'" rows="'.$col['rows'].'">'.$inputVal[$col['id']].'</textarea>';
                break;
            case 'hidden':
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$formId.'-'.$col['id'].'" value="'.$inputVal[$col['id']].'">';
                break;
            case 'file':
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$formId.'-'.$col['id'].'" value="'.$inputVal[$col['id']].'">';
                $inputForm .= '<div class="invalid-feedback" id="invalid_'.$col['id'].'"></div>';
                break;
            case 'date':
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$formId.'-'.$col['id'].'" value="'.$inputVal[$col['id']].'">';
                $inputForm .= '<div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    ตั้งเป็นวันที่ปัจจุบัน
                                    </label>
                                </div>';
                $inputForm .= '<div class="invalid-feedback" id="invalid_'.$col['id'].'"></div>';
                break;
            default:
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$formId.'-'.$col['id'].'" placeholder="'.$col['placeholder'].'" value="'.$inputVal[$col['id']].'">';
                $inputForm .= '<div class="invalid-feedback" id="invalid_'.$col['id'].'"></div>';
                break;
        }
        if(isset($col['description'])){
            $output .= '<div id="'.$col['id'].'_description" class="form-text">'.$col['description'].'</div>';
        }
        $output .= ($col['type'] == 'hidden') ? $inputForm : '<div class="col-'.$col['size'].'"><div class="mb-3">'.$inputForm.'</div></div>';
    }
   
    $output .= '</div></form>';

    return $output;
}

function selectData($options,$selected = null,$pull_data = null,$data_selected = null){
    global $conn;
    $output = '<option value="">เลือกรายการ</option>';
    if(isset($pull_data)){
        $val = $options[0]['value'];
        $text = $options[0]['text'];
        $result = getAllSql($conn,$val.','.$text,$pull_data)->fetch_all(MYSQLI_ASSOC);
        $options = [];
        foreach ($result as $row){
            $options[] = ['value' => $row[$val],'text' => $row[$text]];
        }
    }
    foreach ($options as $option){
        $output .= '<option value="'.$option['value'].'"';
        if($selected == $option['value'] || $data_selected == $option['value']){
            $output .= ' selected';
        }
        $output .= '>'.$option['text'].'</option>';
    }
    
    return $output;
}
?>

