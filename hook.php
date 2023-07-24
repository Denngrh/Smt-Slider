<?php
function ListMenu(){
    add_menu_page ('Plugin Slider', 'Smt Slider','','list', 'list_menu','dashicons-email');
    add_submenu_page('list','Dashboard','Dashboard','manage_options','dashboard','list_menu');
    add_submenu_page('list','List_sub_menu','Setting','manage_options','setting','list_menu_2');
}

function list_menu() {
    include('view/dashboard.php');
}
function list_menu_2(){
    include_once 'view/setting.php';
}

// Delete data
function delete_data_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_slider';
    $id = $_GET['id'];
    // Delete by id
    $result = $wpdb->delete($table_name, array('id' => $id));
    if ($result) {
        wp_redirect(admin_url('admin.php?page=dashboard'));
        exit;
    } else {
        echo 'Terjadi kesalahan saat menghapus data.';
    }
}

// action delete
add_action('admin_post_delete_data', 'delete_data_callback');
// ADD MENU
add_action('admin_menu','ListMenu');
?>

