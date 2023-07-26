<?php
function ListMenu(){
    add_menu_page ('Plugin Slider', 'Smt Slider','','list', 'list_menu','dashicons-slides','20');
    add_submenu_page('list','Dashboard','Dashboard','manage_options','dashboard','list_menu');
    add_submenu_page('list','List_sub_menu','Setting','manage_options','setting','list_menu_2');
    add_submenu_page('','List_sub_menu','Edit','manage_options','edit','list_menu_3');
}

function list_menu() {
    include('view/dashboard.php');
}
function list_menu_2(){
    include_once 'view/setting.php';
}
function list_menu_3(){
    include_once 'view/edit.php';
}
// Insert Data
function insert_slide_callback() {
    if (isset($_POST['submit'])) {
        global $wpdb;
        $table_slider = $wpdb->prefix . 'smt_slider';
        $table_type = $wpdb->prefix . 'smt_type';
        $nama = $_POST['title'];
        $type = $_POST['type'];
        // Validasi type
        $valid_type = $wpdb->get_var("SELECT COUNT(*) FROM $table_type WHERE type = '$type'");
        if (!$valid_type) {
            echo "
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Try to choose the correct type',
                    timer: 2000,
                }).then(function() {
                    window.location.href = '" . admin_url('admin.php?page=dashboard') . "';
                });
            </script>";
            exit;
          exit;
        }
          // Select id where tabel smt_slider
        $id = $wpdb->get_var("SELECT id FROM $table_slider ORDER BY id DESC LIMIT 1");
        $id++; // Increment id insert id New
        // Generete short code automatic
        $generated_shortcode = "[$type'$id']";
        // Insert data to smt_slider
        $result = $wpdb->insert(
          $table_slider,
          array(
            'name' => $nama,
            'type' => $type,
            'short_code' => $generated_shortcode,
          )
        );
            if ($result) {
                wp_redirect(admin_url('admin.php?page=dashboard'));
                exit;
            } else {
                echo 'Terjadi kesalahan saat insert data.';
            }
    }
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
// Action Insert
add_action('admin_post_insert_slide_callback', 'insert_slide_callback');
add_action('admin_post_nopriv_insert_slide_callback', 'insert_slide_callback');
// Action Delete
add_action('admin_post_delete_data', 'delete_data_callback');
// ADD MENU
add_action('admin_menu','ListMenu');
?>