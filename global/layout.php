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
        $content .= '<td><button class="btn small py-0 px-2" data-id="'.$row[$table_id].'" id="Edit">
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

function modalForm($ModalId, $header, $content){
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>';
}

function formTemplate($form_id,$input, $inputVal = null, $submit = false , $submitId = null){
    $output = '<form id="'.$form_id.'"><div class="row g-3">';
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
                $inputForm .= '<select class="form-select" id="'.$col['id'].'">';
                $inputForm .= '<option selected>'.$col['placeholder'].'</option>';
                if(isset($col['pull_data'])){
                    $inputForm .= selectData($col['options'],null,$col['pull_data']);
                }
                else{
                    $inputForm .= selectData($col['options']);
                }
                $inputForm .= '</select>';
                break;
            case 'textarea':
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<textarea class="form-control" id="'.$col['id'].'" rows="'.$col['rows'].'">'.$inputVal[$col['id']].'</textarea>';
                break;
            case 'hidden':
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$col['id'].'" value="'.$inputVal[$col['id']].'">';
                break;
            default:
                $inputForm .= '<label for="'.$col['id'].'" class="form-label">'.$col['name'].'</label>';
                $inputForm .= '<input type="'.$col['type'].'" class="form-control" id="'.$col['id'].'" placeholder="'.$col['placeholder'].'" value="'.$inputVal[$col['id']].'">';
                break;
        }
        if(isset($col['description'])){
            $output .= '<div id="'.$col['id'].'_description" class="form-text">'.$col['description'].'</div>';
        }
        $output .= ($col['type'] == 'hidden') ? '' : '<div class="col-'.$col['size'].'"><div class="mb-3">'.$inputForm.'</div></div>';
    }
   
    if($submit){
        $output .= '<button type="submit" class="btn btn-primary" id="'.$submitId.'">Submit</button>';
    }
    $output .= '</div>';
    $output .= '</form>';
    return $output;
}

function selectData($options,$selected = null,$pull_data = null){
    global $conn;
    $output = '';
    if(isset($pull_data)){
        $val = $options[0]['value'];
        $text = $options[0]['text'];
        $result = getAllSql($conn,$val.','.$text,$pull_data)->fetch_all(MYSQLI_ASSOC);
        $options = [];
        foreach ($result as $row){
            $options[] = ['value' => $row[$val], 'text' => $row[$text]];
        }
    }
    foreach ($options as $option){
        $output .= '<option value="'.$option['value'].'">'.$option['text'].'</option>';
    }
    return $output;
}
?>

