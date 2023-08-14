<?php
// Include WordPress core


if (isset($_POST['submit_image_selector']) && isset($_POST['image_attachment_id'])) {
    update_option('media_selector_attachment_id', absint($_POST['image_attachment_id']));
}

$my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
?>

<div class="mt-3 ms-md-4 ms-4">
    <form method="post" enctype="multipart/form-data">
        <input type='file' name="image_attachment" id="image_attachment">
        <input type='hidden' name='image_attachment_id' value='<?php echo $my_saved_attachment_post_id; ?>'>
        <input type="submit" name="submit_image_selector" value="Upload and Save">
    </form>
</div>

<div class='image-preview-wrapper mt-3 ms-4 ms-md-4'>
    <?php
    $attachment_id = get_option('media_selector_attachment_id');
    $attachment_url = wp_get_attachment_url($attachment_id);
    if (!empty($attachment_url)) {
        echo '<img src="' . $attachment_url . '" style="border: 2px solid black;" width="200">';
    }
    ?>
</div>

<?php
if (isset($_POST['submit_image_selector'])) {
    $attachment_id = upload_image_and_get_id('image_attachment');

    if ($attachment_id !== false) {
        update_option('media_selector_attachment_id', $attachment_id);
    }
}

function upload_image_and_get_id($file_input_name) {
    if (isset($_FILES[$file_input_name])) {
        $file = $_FILES[$file_input_name];

        $upload_file = wp_upload_bits($file['name'], null, file_get_contents($file['tmp_name']));

        if (!$upload_file['error']) {
            $file_type = wp_check_filetype(basename($upload_file['file']), null);
            $attachment = array(
                'post_mime_type' => $file_type['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($upload_file['file'])),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attachment_id = wp_insert_attachment($attachment, $upload_file['file']);
          
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            return $attachment_id;
        }
    }
    return false;
}
?>
