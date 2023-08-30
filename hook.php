<?php
function ListMenu(){
    add_menu_page ('Plugin Slider', 'Smt Slider','','list', 'list_menu','dashicons-slides','20');
    add_submenu_page('list','Dashboard','Dashboard','manage_options','dashboard','list_menu');
    add_submenu_page('','Edit-Page','Edit2','manage_options','edit2','list_menu_1');
}

function list_menu() {
    include('view/dashboard.php');
}
function list_menu_1(){
    include_once 'view/editpage.php';
}

// Insert Data
function insert_slide_callback() {
    if (isset($_POST['submit'])) {
        global $wpdb;
        $table_slider = $wpdb->prefix . 'smt_slider';
        $table_type = $wpdb->prefix . 'smt_type';
        $table_css = $wpdb->prefix . 'smt_style';
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
        }
          // Select id where tabel smt_slider
        $id = $wpdb->get_var("SELECT id FROM $table_slider ORDER BY id DESC LIMIT 1");
        $id++; // Increment id insert id New
        // Generete short code automatic
        $generated_shortcode = "[smt_slider slider=$id]";
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
            // Gets the ID of the row that was just inserted
            $inserted_id = $wpdb->insert_id;
            $edit_url = admin_url("admin.php?page=edit2&id=$inserted_id");
            
            // Data yang ingin dimasukkan ke tabel smt_style
            $style_data = array(
                'title_fam' => 'sans-serif', // Ganti dengan nama gaya yang sesuai
                'title_color' => 'black',
                'desc_fam' => 'sans-serif',
                'desc_color' => 'black',
                'btn_fam' => 'fantasy',
                'btn_color' => 'white',
                'btn_bg' => 'blue',
                'btn_color_hvr' => 'white',
                'btn_bg_hvr' => 'cyan',
            );

            $json_style_data = json_encode($style_data);

            // Insert data ke tabel smt_style
            $result_style = $wpdb->insert(
                $table_css,
                array('style_data' => $json_style_data,
                'id_slider' => $id )
            );

            if ($result_style) {
                wp_redirect($edit_url);
                exit;
            } else {
                echo 'Terjadi kesalahan saat memasukkan data gaya.';
            }
        } else {
            echo 'Terjadi kesalahan saat insert data.';
        }
    }
}

function delete_data_callback() {
    global $wpdb;
    $table_slider = $wpdb->prefix . 'smt_slider';
    $table_style = $wpdb->prefix . 'smt_style';

    $id = $_GET['id'];

    // Hapus data dari tabel smt_slider
    $slider_result = $wpdb->delete($table_slider, array('id' => $id));

    // Hapus data terkait dari tabel smt_style
    $style_result = $wpdb->delete($table_style, array('id_slider' => $id));

    if ($slider_result && $style_result) {
        wp_redirect(admin_url('admin.php?page=dashboard'));
        exit;
    } else {
        echo 'Terjadi kesalahan saat menghapus data.';
    }
}

//Insert Image
function insert_img_callback()
{
    global $wpdb;

    if (isset($_POST['submit'])) {

        // Proses form kedua
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $titles = array_map('sanitize_text_field', $_POST['title']);
        $descs = array_map('sanitize_textarea_field', $_POST['desc']);
        $links = array_map('sanitize_textarea_field', $_POST['link']);
        $image_id = array_map('absint', $_POST['image_attachment_id']); // Gunakan ID gambar yang dipilih
        $bg_image_id = absint($_POST['bg_image_attachment_id']); // ID gambar latar belakang
        $edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;

        for ($i = 0; $i < count($titles); $i++) {
            $result = $wpdb->insert(
                $table_smt_img,
                array(
                    'title' => $titles[$i],
                    'desc' => $descs[$i],
                    'link' => $links[$i],
                    'img' => $image_id[$i],
                    'bg_img' => $bg_image_id, // Simpan ID gambar latar belakang
                    'id_slider' => $edit_id,
                )
            );
        }
    if ($result) {
        // Jika data berhasil diinsert, periksa apakah ada $edit_id
        if ($edit_id) {
            wp_redirect(admin_url('admin.php?page=edit2&id=' . $edit_id));
        } else {
            // Jika tidak ada $edit_id, maka perlu mencari id yang baru saja diinsert
            $inserted_id = $wpdb->insert_id;
            if ($inserted_id) {
                wp_redirect(admin_url('admin.php?page=edit2&id=' . $inserted_id));
            } else {
                wp_die('Terjadi kesalahan saat mengirim data gambar.');
            }
        }
        exit;
    } else {
        wp_die('Terjadi kesalahan saat mengirim data gambar.');
    }

    }
}

// Delete Image
function delete_img_callback() {
    global $wpdb;
    if (isset($_GET['action']) && $_GET['action'] === 'delete_img') {

        $selected_image_id = isset($_GET['selected_slider']) ? intval($_GET['selected_slider']) : 0;
        $result = $wpdb->delete($wpdb->prefix . 'smt_img', array('id_img' => $selected_image_id));
        $edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;

        if ($result) {
            wp_redirect(admin_url('admin.php?page=edit2&id=' . $edit_id));
            exit;
        } else {
            wp_die('Terjadi kesalahan saat menghapus data gambar.');
        }
    }
}

//Insert CSS
// Insert CSS
function insert_css_callback() {
    global $wpdb;
    $table_smt_css = $wpdb->prefix . 'smt_style';

    $title_fam = sanitize_text_field($_POST['title_fam']);
    $title_color = sanitize_text_field($_POST['title_color']);
    $desc_fam = sanitize_text_field($_POST['desc_fam']);
    $desc_color = sanitize_text_field($_POST['desc_color']);
    $btn_fam = sanitize_text_field($_POST['btn_fam']);
    $btn_color = sanitize_text_field($_POST['btn_color']);
    $btn_bg = sanitize_text_field($_POST['btn_bg']);
    $btn_color_hvr = sanitize_text_field($_POST['btn_color_hvr']);
    $btn_bg_hvr = sanitize_text_field($_POST['btn_bg_hvr']);
    $dots_color = sanitize_text_field($_POST['dots_color']);
    $dots_bg = sanitize_text_field($_POST['dots_bg']);
    $dots_line = sanitize_text_field($_POST['dots_line']);
    $dots_bg_active = sanitize_text_field($_POST['dots_bg_active']);
    $control_color = sanitize_text_field($_POST['control_color']);
    $control_bg = sanitize_text_field($_POST['control_bg']);
    $get_id_css = isset($_POST['get_id_css']) ? $_POST['get_id_css'] : null;

    // Format data sebagai array asosiatif
    $css_data = array(
        'title_fam' => $title_fam,
        'title_color' => $title_color,
        'desc_fam' => $desc_fam,
        'desc_color' => $desc_color,
        'btn_fam' => $btn_fam,
        'btn_color' => $btn_color,
        'btn_bg' => $btn_bg,
        'btn_color_hvr' => $btn_color_hvr,
        'btn_bg_hvr' => $btn_bg_hvr,
        'dots_color' => $dots_color,
        'dots_bg' => $dots_bg,
        'dots_line' => $dots_line,
        'dots_bg_active' => $dots_bg_active,
        'control_color' => $control_color,
        'control_bg' => $control_bg,
    );

    // Konversi data menjadi JSON
    $json_data = json_encode($css_data);

    $data = array(
        'style_data' => $json_data, // Simpan data sebagai JSON
    );

    $where = array(
        'id_slider' => $get_id_css
    );

    $css_result = $wpdb->update($table_smt_css, $data, $where);

    if ($css_result) {
        wp_redirect(admin_url('admin.php?page=edit2&id=' . $get_id_css));
    } else {
        wp_die('Terjadi kesalahan saat mengirim data CSS.');
    }
}


//shortcode
function shortcode_smt_slider($atts) {
    if (isset($atts['slider'])) {
        $project_id = $atts['slider'];

        global $wpdb;
        $table_slider = $wpdb->prefix . 'smt_slider'; 
        $project_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $project_id");

        if ($project_data) {
            $project_type = $project_data->type;
            if ($project_type === 'Paralax') {
                include_once 'shortcode/paralax.php';
            }
            else if ($project_type === 'Square') {
                include_once 'shortcode/square.php';
            }else if ($project_type === 'Popup') {
                include_once 'shortcode/popup.php';
            }else{
                echo '<p> Slider Tidak di temukan </p>';
            }
            ob_start();
            return ob_get_clean();
        }
    }
}

add_shortcode('smt_slider', 'shortcode_smt_slider');
// Tambahkan aksi ke dalam WordPress admin
add_action('admin_post_delete_img', 'delete_img_callback');
add_action('admin_post_nopriv_delete_img', 'delete_img_callback');
// Action Insert
add_action('admin_post_insert_img_callback', 'insert_img_callback');
add_action('admin_post_nopriv_insert_img_callback', 'insert_img_callback');
add_action('admin_post_insert_css_callback', 'insert_css_callback');
add_action('admin_post_nopriv_insert_css_callback', 'insert_css_callback');
// Action Insert
add_action('admin_post_insert_slide_callback', 'insert_slide_callback');
add_action('admin_post_nopriv_insert_slide_callback', 'insert_slide_callback');
// Action Delete
add_action('admin_post_delete_data', 'delete_data_callback');
// ADD MENU
add_action('admin_menu','ListMenu');
?>