<?php
function ListMenu(){
    add_menu_page ('Setting Plugin keren', 'Smt Slider','','list', 'list_menu','dashicons-email');
    add_submenu_page('list','List_sub_menu','Dashboard','manage_options','dashboard','list_menu');
    add_submenu_page('list','List_sub_menu','Setting','manage_options','setting','list_menu_2');
}

function list_menu() {
    include('view/dashboard.php');
}
function list_menu_2(){
    include('view/setting.php');
}
function add_bootstrap_css() {
   
    wp_enqueue_style('bootstrap', get_template_directory_uri() . 'vendor/bootstrap/css/bootstrap.min.css');
}
function add_bootstrap_js() {
  
    wp_enqueue_style('bootstrap', get_template_directory_uri() . 'vendor/bootstrap/js/bootstrap.min.js');
}

add_action('wp_enqueue_scripts', 'add_bootstrap_js');
add_action('wp_enqueue_scripts', 'add_bootstrap_css');


// ADD MENU
add_action('admin_menu','ListMenu');
?>

