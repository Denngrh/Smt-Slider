<?php
/**
 * Plugin Name: Slider Smooets
 * Plugin URI: https://www.smooets.com/
 * Description: Smooets Slider is an easy-to-use slider plugin for WordPress, allowing you to create stunning image sliders that grab the attention of your website visitors. With this Smooth Slider, you can easily display images and other content in a responsive and customizable slider.
 * Version: 1.0.0
 * Author: Baden And Dafa
 * Author URI: https://github.com/Denngrh/smt-slider
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Include file hook
include('hook.php');


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
            type VARCHAR(30) NOT NULL,   
            short_code VARCHAR(30) NOT NULL,
            created_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
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
            img INT(11) NOT NULL,
            bg_img INT(11) NOT NULL,
            title VARCHAR(100) NOT NULL,
            `desc` LONGTEXT NOT NULL,
            link VARCHAR(100) NOT NULL,
            button_link VARCHAR(30) NOT NULL,
            id_slider INT(11) NOT NULL,
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
            style_data LONGTEXT NOT NULL,
            id_slider VARCHAR(50) NOT NULL,
            PRIMARY KEY (id_style)
        ) $charset_collate;";
        //Proses crete table
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

// Insert table type slider
function smt_type_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_type';
    // check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Skema tabel
        $sql = "CREATE TABLE $table_name (
            id_type INT(11) NOT NULL AUTO_INCREMENT,
            type VARCHAR(100) NOT NULL,
            PRIMARY KEY (id_type)
        ) $charset_collate;";
        //Proses crete table
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        // Fill in the fields in the table
        $type = array(
            array('type' => 'Paralax'),
            array('type' => 'Square'),
            array('type' => 'Popup'),
        );
        //Prosess insert
        foreach ($type as $icon) {
            $wpdb->insert(
                $table_name,
                $icon,
                array('%s', '%s')
            );
        }
    }
}


//delete table when uninstalled
function delete_smt_slider() {
    global $wpdb;
    $smt_slider = $wpdb->prefix . 'smt_slider'; //table smt_slider
    $smt_img = $wpdb->prefix . 'smt_img'; //table smt_img
    $smt_style = $wpdb->prefix . 'smt_style'; //table smt_style
    $smt_type = $wpdb->prefix . 'smt_type'; //table smt_style

    // delete table smt slider
    $wpdb->query("DROP TABLE IF EXISTS $smt_slider");
    // delete table smt img
    $wpdb->query("DROP TABLE IF EXISTS $smt_img");
     // delete table smt style
     $wpdb->query("DROP TABLE IF EXISTS $smt_style");
      // delete table smt type
     $wpdb->query("DROP TABLE IF EXISTS $smt_type");
}

//crete table smt type
register_activation_hook(__FILE__, "smt_type_table");

//crete table smt slider
register_activation_hook(__FILE__, "smt_slider_table");

//crete table smt img
register_activation_hook(__FILE__, "smt_img_table");

//crete table smt style
register_activation_hook(__FILE__, "smt_style_table");

//delete table
register_uninstall_hook(__FILE__, 'delete_smt_slider');
?>