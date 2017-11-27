<?php
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf-json';

    // return
    return $path;

}


//    function p($var){
//        echo "<pre>".print_r($var,true)."</pre>";
//    }

?>
