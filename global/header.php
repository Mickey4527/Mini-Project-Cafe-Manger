<?php
/**
 * 
 * @param string $title ไตเติ้ลของหน้า
 * @param string $style css ที่จะใช้ในหน้านั้นๆ
 * @param string $lang ภาษาของหน้านั้นๆ
 * @param string $BodyClass class ของ body ในหน้านั้นๆ
 */
// output header of the page
function htmlHeader($title, $style = null,$BodyClass = null, $lang = null){
    echo '<!DOCTYPE html><html lang="'.$lang.'" data-bs-theme="light"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$title.' - '.
    APP['app']['name'].'</title>'.cssOut(CONFIG['enqueue_style']).jsOut(CONFIG['enqueue_script']).'</head>'.$style.'<body class="'.$BodyClass.'">';
}

// output footer of the page
function htmlFooter($js = null){
    echo '<div id="notify"></div>'.$js.jsOut(CONFIG['enqueue_script_footer']).'</body></html>';
}

// เขียน css ในหน้าเดียว
function styleOnly($css){
    $output = '<style>'.$css.'</style>';
    return $output;
}

?>