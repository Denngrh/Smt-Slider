<?php
function ListMenu(){
    add_menu_page ('Plugin Slider', 'Smt Slider','','list', 'list_menu','dashicons-email');
    add_submenu_page('list','List_sub_menu','Dashboard','manage_options','dashboard','list_menu');
    add_submenu_page('','List_sub_menu','Setting','manage_options','setting','list_menu_2');
}

function list_menu() {
    include('view/dashboard.php');
}
function list_menu_2(){
    include_once 'view/setting.php';
}

add_action('admin_menu','ListMenu');
?>