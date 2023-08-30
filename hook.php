<?php
function ListMenu()
{
    add_menu_page('Plugin Slider', 'Smt Slider', '', 'list', 'list_menu', 'dashicons-slides', '20');
    add_submenu_page('list', 'Dashboard', 'Dashboard', 'manage_options', 'dashboard', 'list_menu');
    add_submenu_page('', 'Edit-Page', 'Edit2', 'manage_options', 'edit2', 'list_menu_1');
}

function list_menu()
{
    include('view/dashboard.php');
}
function list_menu_1()
{
    include_once 'view/editpage.php';
}
// Insert Data
function insert_slide_callback()
{
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
            wp_redirect($edit_url);
            exit;
        } else {
            echo 'Terjadi kesalahan saat insert data.';
        }
    }
}
// Delete data
function delete_data_callback()
{
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
        $bg_image_id = array_map('absint', $_POST['bg_image_attachment_id']); // Gunakan ID gambar yang dipilih
        $edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;

        $id_img = array_map('absint' ,$_POST['id_img']);

        for ($i = 0; $i < count($titles); $i++) {

            $custom_query = "
                INSERT INTO $table_smt_img (id_img, img, bg_img, title, `desc`, link, id_slider)
                VALUES ($id_img[$i], $image_id[$i], $bg_image_id[$i], '$titles[$i]', '$descs[$i]', '$links[$i]', $edit_id)
                ON DUPLICATE KEY UPDATE
                    img = CASE WHEN VALUES(img) <> img THEN VALUES(img) ELSE img END,
                    bg_img = CASE WHEN VALUES(bg_img) <> bg_img THEN VALUES(bg_img) ELSE bg_img END,
                    title = CASE WHEN VALUES(title) <> title THEN VALUES(title) ELSE title END,
                    `desc` = CASE WHEN VALUES(`desc`) <> `desc` THEN VALUES(`desc`) ELSE `desc` END,
                    link = CASE WHEN VALUES(link) <> link THEN VALUES(link) ELSE link END,
                    id_slider = CASE WHEN VALUES(id_slider) <> id_slider THEN VALUES(id_slider) ELSE id_slider END;
            ";

            $hasil = $wpdb->query($custom_query);
        }

        if ($hasil !== false) {
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
            wp_die('Terjadi kesalahan saat mengirim data gambar. :( ');
        }

    }
}

function delete_img_callback()
{
    global $wpdb;

    // Pastikan aksi yang dipicu adalah delete_img
    if (isset($_GET['action']) && $_GET['action'] === 'delete_img') {
        $selected_image_id = isset($_GET['selected_slider']) ? intval($_GET['selected_slider']) : 0;

        // Delete data from smt_img table
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
//shortcode
function shortcode_smt_slider($atts)
{
    if (isset($atts['slider'])) {
        $project_id = $atts['slider'];

        // Get project information from the database
        global $wpdb;
        $table_slider = $wpdb->prefix . 'smt_slider'; // Replace with your table name
        $project_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $project_id");

        if ($project_data) {
            $project_type = $project_data->type;

            // Include the specific project file based on the type
            if ($project_type === 'Paralax') {
                include_once 'shortcode/paralax.php';
            } else if ($project_type === 'Square') {
                include_once 'shortcode/square.php';
            } else if ($project_type === 'Popup') {
                include_once 'shortcode/popup.php';
            } else {
                echo '<p> Slider Tidak di temukan </p>';
            }

            // Return an empty string or content from the included file
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

// Action Insert
add_action('admin_post_insert_slide_callback', 'insert_slide_callback');
add_action('admin_post_nopriv_insert_slide_callback', 'insert_slide_callback');
// Action Delete
add_action('admin_post_delete_data', 'delete_data_callback');
// ADD MENU
add_action('admin_menu', 'ListMenu');
