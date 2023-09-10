<?php
$css = array(
    "../assets/bootstrap-5.3.1-dist/css/bootstrap.min.css",
    "../assets/css/style.css",
);
$js = array(
    "../assets/bootstrap-5.3.1-dist/js/bootstrap.min.js",
);

function loadCss($css){
    foreach($css as $style){
        echo "<link rel='stylesheet' href='$style'>\n";
    }
}
function loadJs($js){
    foreach($js as $script){
        echo "<script src='../assets/js/$script'></script>\n";
    }
}
function header_html($lang,$css,$config_header = null){
    $html = "<!DOCTYPE html>\n".'<html lang="'.$lang.'">';
    $html .= "\n<head>\n";
    $html .= "<title>test</title>\n";
    $html .= "<meta charset='utf-8'>\n";
    $html .= "<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    $html .= "<meta name='description' content=''>\n";
    $html .= loadCss($css);
    $html .= $config_header ? $config_header : "";
    $html .= "</head>\n";
    return $html;
}

echo header_html($config['sys']['lang'],$css,$config_header);
?>