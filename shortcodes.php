<?php
function shortcode_cc($attr, $content = null){
    $default = array(
        'case' => 'upper'
    );

    $data = shortcode_atts($default, $attr);
    switch($data['case']){
        case 'upper':
            $result = strtoupper(do_shortcode($content));
            break;
        case 'lower':
            $result = strtolower(do_shortcode($content));
            break;
        default:
            $result = strtoupper(do_shortcode($content));
            break;
    }
    return $result;
}

function shortcode_squaregallery($attr, $content = null){
    $default = array(
        'id' => ''
    );

    $data = shortcode_atts($default, $attr);
    $return = '';
    if(!empty($attr['id'])){
        $image_ids = explode(',', $attr['id']);
        if(!empty($image_ids)){
            foreach($image_ids as $key => $id){
                $img = '';
                $img = wp_get_attachment_image_src($id, 300, 300, true);
                $gallery = sprintf('<img src="%s">',$img[0]);
                $return = $return . $gallery;
            }
        }
    }

    return $return;
}
add_shortcode("cc", "shortcode_cc");
add_shortcode("squaregallery", "shortcode_squaregallery");