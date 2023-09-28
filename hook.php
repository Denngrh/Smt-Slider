<?php
function ListMenu()
{
    $icon_url = plugin_dir_url(__FILE__) . 'assets/icons/logo.png';
    add_menu_page('Plugin Slider', 'Smt Slider', '', 'list', 'list_menu',$icon_url, '20');
    add_submenu_page('list', 'Dashboard', 'Dashboard', 'manage_options', 'dashboard', 'list_menu');
    add_submenu_page('', 'Edit-Page', 'Edit2', 'manage_options', 'edit2', 'list_menu_1');
    add_submenu_page('', 'preview', 'preview', 'manage_options', 'preview', 'list_menu_2');
}

function list_menu()
{
    include('view/dashboard.php');
}
function list_menu_1()
{
    include_once 'view/editpage.php';
}
function list_menu_2()
{
    include_once 'view/preview.php';
}

// Insert Data
function insert_slide_callback()
{
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
                'title_size' => 'h1', // Ganti dengan nama gaya yang sesuai
                'title_fam' => 'sans-serif', // Ganti dengan nama gaya yang sesuai
                'title_color' => '#000000',
                'desc_fam' => 'sans-serif',
                'desc_color' => '#000000',
                'btn_fam' => 'fantasy',
                'btn_color' => '#ffffff',
                'btn_bg' => '#1d5595',
                'btn_color_hvr' => '#ffffff',
                'btn_bg_hvr' => '#79a1bc',
                'dots_color' => '#ffffff',
                'dots_bg' => '#b0b7d0',
                'dots_line' => '#b0b7d0',
                'dots_bg_active' => '#b0b7d0',
                'control_color' => '#000',
                'control_bg' => '#b0b7d0',
                'border' => '1px solid #d2d2d2',
                'pd_top_title' => '8px',
                'pd_bottom_title' => '8px',
                'pd_right_title' => '0',
                'pd_left_title' => '0',
                'mg_top_title' => '0',
                'mg_bottom_title' => '0',
                'mg_right_title' => '0',
                'mg_left_title' => '0',
                'pd_top_desc' => '0',
                'pd_bottom_desc' => '0',
                'pd_right_desc' => '0',
                'pd_left_desc' => '0',
                'mg_top_desc' => '0',
                'mg_bottom_desc' => '0',
                'mg_right_desc' => '0',
                'mg_left_desc' => '0',
                'pd_top_btn' => '0',
                'pd_bottom_btn' => '0',
                'pd_right_btn' => '0',
                'pd_left_btn' => '0',
                'mg_top_btn' => '0',
                'mg_bottom_btn' => '0',
                'mg_right_btn' => '0',
                'mg_left_btn' => '0',
                'border_radius' => '10px',
            );

            $json_style_data = json_encode($style_data);

            // Insert data ke tabel smt_style
            $result_style = $wpdb->insert(
                $table_css,
                array('style_data' => $json_style_data,
                'id_slider' => $inserted_id )
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
// Delete data
function delete_slide_callback()
{
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
function insert_img_callback() {
    global $wpdb;

    if (isset($_POST['submit'])) {
        $table_smt_slide = $wpdb->prefix . 'smt_slider';
        $slider_name = sanitize_text_field($_POST['slider_name']); // Ambil nama slider dari form
        $edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;
        if ($edit_id) {
            // Mode edit: Lakukan operasi UPDATE pada tabel smt_slider
            $wpdb->update(
                $table_smt_slide,
                array('name' => $slider_name), // Kolom yang akan diupdate
                array('id' => $edit_id), // Kondisi WHERE untuk data yang akan diupdate
                array('%s'), // Format data untuk kolom 'name'
                array('%d') // Format data untuk kolom 'id'
            );
        } else {
            // Mode insert: Lakukan operasi INSERT baru ke dalam tabel smt_slider
            $wpdb->insert(
                $table_smt_slide,
                array('name' => $slider_name), // Data yang akan diinsert
                array('%s') // Format data untuk kolom 'name'
            );

            // Dapatkan ID yang baru saja diinsert
            $inserted_id = $wpdb->insert_id;

            if ($inserted_id) {
                // Redirect ke halaman edit dengan ID yang baru saja diinsert
                wp_redirect(admin_url('admin.php?page=edit2&id=' . $inserted_id));
                exit;
            } else {
                wp_die('Terjadi kesalahan saat mengirim data slider.');
            }
        }


        // Proses form pertama (Gambar)
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $table_smt_slider = $wpdb->prefix . 'smt_slider';

        $titles = array_map('sanitize_text_field', $_POST['title']);
        $descs = array_map('sanitize_textarea_field', $_POST['desc']);
        $links = array_map('sanitize_textarea_field', $_POST['link']);
        $button_links = array_map('sanitize_textarea_field', $_POST['button_link']);
        $image_id = array_map('absint', $_POST['image_attachment_id']);
        $bg_image_id = array_map('absint', $_POST['bg_image_attachment_id']);
        $edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;
        $id_img = array_map('absint' ,$_POST['id_img']);
        $delay_popup = absint($_POST['delay_popup']);
        $popup_style = absint($_POST['popup_style']);
        
        // Proses form kedua (CSS)
        $table_smt_css = $wpdb->prefix . 'smt_style';
        $title_size= sanitize_text_field($_POST['title_size']);
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
        $border = sanitize_text_field($_POST['border_option']);
        
        // dibawah untuk padding dan margin
        $pd_top_title = sanitize_text_field($_POST['pd_top_title']);
        $pd_bottom_title = sanitize_text_field($_POST['pd_bottom_title']);
        $pd_right_title = sanitize_text_field($_POST['pd_right_title']);
        $pd_left_title = sanitize_text_field($_POST['pd_left_title']);
        $mg_top_title = sanitize_text_field($_POST['mg_top_title']);
        $mg_bottom_title = sanitize_text_field($_POST['mg_bottom_title']);
        $mg_right_title = sanitize_text_field($_POST['mg_right_title']);
        $mg_left_title = sanitize_text_field($_POST['mg_left_title']);

        $pd_top_desc = sanitize_text_field($_POST['pd_top_desc']);
        $pd_bottom_desc = sanitize_text_field($_POST['pd_bottom_desc']);
        $pd_right_desc = sanitize_text_field($_POST['pd_right_desc']);
        $pd_left_desc = sanitize_text_field($_POST['pd_left_desc']);
        $mg_top_desc = sanitize_text_field($_POST['mg_top_desc']);
        $mg_bottom_desc = sanitize_text_field($_POST['mg_bottom_desc']);
        $mg_right_desc = sanitize_text_field($_POST['mg_right_desc']);
        $mg_left_desc = sanitize_text_field($_POST['mg_left_desc']);

        $pd_top_btn = sanitize_text_field($_POST['pd_top_btn']);
        $pd_bottom_btn = sanitize_text_field($_POST['pd_bottom_btn']);
        $pd_right_btn = sanitize_text_field($_POST['pd_right_btn']);
        $pd_left_btn = sanitize_text_field($_POST['pd_left_btn']);
        $mg_top_btn = sanitize_text_field($_POST['mg_top_btn']);
        $mg_bottom_btn = sanitize_text_field($_POST['mg_bottom_btn']);
        $mg_right_btn = sanitize_text_field($_POST['mg_right_btn']);
        $mg_left_btn = sanitize_text_field($_POST['mg_left_btn']);

        $border_radius = sanitize_text_field($_POST['border_radius']);
        // ---

        $get_id_css = isset($_POST['get_id_css']) ? $_POST['get_id_css'] : null;

        // Format data sebagai array asosiatif untuk CSS
        $css_data = array(
            'title_size' => $title_size,
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
            'border' => $border,
            'pd_top_title' => $pd_top_title,
            'pd_bottom_title' => $pd_bottom_title,
            'pd_right_title' => $pd_right_title,
            'pd_left_title' => $pd_left_title,
            'mg_top_title' => $mg_top_title,
            'mg_bottom_title' => $mg_bottom_title,
            'mg_right_title' => $mg_right_title,
            'mg_left_title' => $mg_left_title,
            'pd_top_desc' => $pd_top_desc,
            'pd_bottom_desc' => $pd_bottom_desc,
            'pd_right_desc' => $pd_right_desc,
            'pd_left_desc' => $pd_left_desc,
            'mg_top_desc' => $mg_top_desc,
            'mg_bottom_desc' => $mg_bottom_desc,
            'mg_right_desc' => $mg_right_desc,
            'mg_left_desc' => $mg_left_desc,
            'pd_top_btn' => $pd_top_btn,
            'pd_bottom_btn' => $pd_bottom_btn,
            'pd_right_btn' => $pd_right_btn,
            'pd_left_btn' => $pd_left_btn,
            'mg_top_btn' => $mg_top_btn,
            'mg_bottom_btn' => $mg_bottom_btn,
            'mg_right_btn' => $mg_right_btn,
            'mg_left_btn' => $mg_left_btn,
            'border_radius' => $border_radius,
        );

        // Konversi data CSS menjadi JSON
        $json_data = json_encode($css_data);

        // Mulai transaksi database
        $wpdb->query('START TRANSACTION');

        // Lakukan operasi untuk setiap elemen dalam data gambar
        for ($i = 0; $i < count($titles); $i++) {

            if (empty($titles[$i])){
                break;
            } else {

                var_dump($edit_id);
                $custom_query = "
                    INSERT INTO $table_smt_img (id_img, img, bg_img, title, `desc`, link, button_link, id_slider)
                    VALUES ($id_img[$i], $image_id[$i], $bg_image_id[$i], '$titles[$i]', '$descs[$i]', '$links[$i]', '$button_links[$i]', $edit_id)
                    ON DUPLICATE KEY UPDATE
                        img = CASE WHEN VALUES(img) <> img THEN VALUES(img) ELSE img END,
                        bg_img = CASE WHEN VALUES(bg_img) <> bg_img THEN VALUES(bg_img) ELSE bg_img END,
                        title = CASE WHEN VALUES(title) <> title THEN VALUES(title) ELSE title END,
                        `desc` = CASE WHEN VALUES(`desc`) <> `desc` THEN VALUES(`desc`) ELSE `desc` END,
                        link = CASE WHEN VALUES(link) <> link THEN VALUES(link) ELSE link END,
                        button_link = CASE WHEN VALUES(button_link) <> button_link THEN VALUES(button_link) ELSE button_link END,
                        id_slider = CASE WHEN VALUES(id_slider) <> id_slider THEN VALUES(id_slider) ELSE id_slider END;
                ";
                
    
                $hasil = $wpdb->query($custom_query);

            }
        }

        $delay_query = "UPDATE $table_smt_slider
                            SET delay_popup = $delay_popup
                            WHERE id = $edit_id;
        ";
        $wpdb->query($delay_query);

        $popup_style = "UPDATE $table_smt_slider
                            SET popup_style = $popup_style
                            WHERE id = $edit_id;
        ";
        $wpdb->query($popup_style);

        $css_query = "UPDATE $table_smt_css SET style_data = %s WHERE id_slider = %d;";

        try {
            // Masukkan data gambar dan CSS ke database dalam satu transaksi
            $wpdb->query('BEGIN');

            foreach ($titles as $i => $title) {
                $wpdb->query($wpdb->prepare($hasil, $id_img[$i], $image_id[$i], $bg_image_id[$i], $title, $descs[$i], $links[$i], $edit_id));
            }

            $wpdb->query($wpdb->prepare($css_query, $json_data, $get_id_css));

            // Commit transaksi
            $wpdb->query('COMMIT');

            // Jika data berhasil diinsert, periksa apakah ada $edit_id
            if ($edit_id) {
                wp_redirect(admin_url('admin.php?page=edit2&id=' . $edit_id));
            } else {
                // Jika tidak ada $edit_id, maka perlu mencari id yang baru saja diinsert
                $inserted_id = $wpdb->insert_id;
                if ($inserted_id) {
                    wp_redirect(admin_url('admin.php?page=edit2&id=' . $inserted_id));
                } else {
                    global $wpdb;
                    wp_die($wpdb->last_query);
                }
            }
            exit;
        } catch (Exception $e) {
            wp_die('Terjadi kesalahan saat mengirim data: ' . $e->getMessage());
        }
    }
}

function delete_img_callback()
{
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

function shortcode_smt_slider($atts)
{
    if (isset($atts['slider'])) {
        $project_id = $atts['slider'];

        global $wpdb;
        $table_slider = $wpdb->prefix . 'smt_slider'; 
        $project_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $project_id");

        if ($project_data) {
            $project_type = $project_data->type;
            if ($project_type === 'Paralax') {
                include_once 'shortcode/paralax.php';
            } else if ($project_type === 'Square') {
                include_once 'shortcode/square.php';
            } else if ($project_type === 'Popup') {
                include_once 'shortcode/popup.php';
            } else {
                echo '<p> Slider Tidak di temukan </p>';
            }
            ob_start();
            return ob_get_clean();
        }
    }
}
function custom_admin_menu_styles() {
    echo '<style>
        #toplevel_page_list .wp-menu-image img {
            width: 25px;
            height: auto;
            filter: brightness(1.5);
            margin-top: -4px; 
        }
    </style>';
}

add_action('admin_head', 'custom_admin_menu_styles');

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
add_action('admin_post_delete_slide', 'delete_slide_callback');
// ADD MENU
add_action('admin_menu', 'ListMenu');
