<?php
function tambah_shortcode_form($atts = array(), $content = null) {
  // Connect to the database
  global $wpdb;

  // Get the type from the shortcode attributes
  $atts = shortcode_atts(array(
    'type' => 'square',
  ), $atts);

  // Get the type value from the attributes
  $type = $atts['type'];

  // Get the type from the database
  $type_from_db = $wpdb->get_var("SELECT type FROM smt_type WHERE type = '$type'");

  // Check if the type is valid
  if ($type_from_db === NULL) {
    echo 'Invalid type';
  } else {
    // Include the appropriate template file
    switch ($type) {
      case 'square':
        include('view/slider.php');
        break;
      case 'parallax':
        include('view/parallax.php');
        break;
      default:
        echo 'Invalid type';
    }
  }
}

// Add the shortcode
add_shortcode('smt_contact_form', 'tambah_shortcode_form');
?>
