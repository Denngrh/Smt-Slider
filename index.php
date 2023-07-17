<?php
/**
 * Plugin Name: Slider Smooets
 * Plugin URI: By Tim
 * Description: kiwwww
 * Version: 1.0.0
 * Author: Smkn 1 Katapang
 * Author URI:
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

//Prevent unauthorized access
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include file hook
require_once plugin_dir_path( __FILE__ ) . 'hook.php';

// Insert table slider
function smt_slider_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_slider';
    // check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Skema tabel
        $sql = "CREATE TABLE $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            icon_name VARCHAR(30) NOT NULL,
            type VARCHAR(30) NOT NULL,   
            short_code VARCHAR(30) NOT NULL,
            created_add datetime NOT NULL,
            created_modified datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        //Proses crete table
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

// Insert table img slider
function smt_img_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_img';
    // check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Skema tabel
        $sql = "CREATE TABLE $table_name (
            id_img INT(11) NOT NULL AUTO_INCREMENT,
            img VARCHAR(100) NOT NULL,
            PRIMARY KEY (id_img)
        ) $charset_collate;";
        //Proses crete table
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


// Insert table img slider
function smt_style_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_style';
    // check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Skema tabel
        $sql = "CREATE TABLE $table_name (
            id_style INT(11) NOT NULL AUTO_INCREMENT,
            button_color VARCHAR(30) NOT NULL,
            button_hover VARCHAR(30) NOT NULL,
            font_name VARCHAR(50) NOT NULL,
            font_color VARCHAR(30) NOT NULL,
            border_img VARCHAR(30) NOT NULL,
            shadow_img VARCHAR(30) NOT NULL,
            PRIMARY KEY (id_style)
        ) $charset_collate;";
        //Proses crete table
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


//delete table when uninstalled
function delete_smt_slider() {
    global $wpdb;
    $smt_slider = $wpdb->prefix . 'smt_slider'; //table smt_slider
    $smt_img = $wpdb->prefix . 'smt_img'; //table smt_img
    $smt_style = $wpdb->prefix . 'smt_style'; //table smt_style

    // delete table smt slider
    $wpdb->query("DROP TABLE IF EXISTS $smt_slider");
    // delete table smt img
    $wpdb->query("DROP TABLE IF EXISTS $smt_img");
     // delete table smt style
     $wpdb->query("DROP TABLE IF EXISTS $smt_style");
}

//crete table smt slider
register_activation_hook(__FILE__, "smt_slider_table");

//crete table smt img
register_activation_hook(__FILE__, "smt_img_table");

//crete table smt style
register_activation_hook(__FILE__, "smt_style_table");

//delete table
register_uninstall_hook(__FILE__, 'delete_smt_slider');
?>