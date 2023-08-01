<?php /* Template Name: Halaman Plugin Khusus */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="nav col-md-12 justify-content-center">
                    <button class="button-24 my-3 offset-md-3" role="button">Dekstop</button>
                    <button class="button-24 my-3 mx-3" role="button">Tablet</button>
                    <button class="button-24 my-3" role="button">Mobile</button>
            </div>
        </div>
        <div class="row">
            <?php
            // Ambil nilai ID dari permintaan
            $id = $_GET['id'];
            global $wpdb;
            $table_name = $wpdb->prefix . 'smt_slider';
            $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
            if ($data) {
            ?>
            <div class="card col-md-3 border-0">
                <div class="mt-3 ms-3">
                    <h4> Settings </h4>
                </div>
                <div class="card-body">
                    <!-- Form Style -->
                    <div class="form-group">
                        <input class="form-field" type="text" value="<?php echo $data->name; ?>" required="true">
                    </div>
                    <div class="form-group my-2">
                        <input class="form-field" type="text" value="<?php echo $data->type; ?>" required="true">
                    </div>
               
                <?php
                    }
                ?>
                <div class="row">
                    <div class="form-group justify-content-between" style="width: 50%;">
                        <input class="form-field" type="text" placeholder="Width">
                        <span>px</span>
                    </div>
                    <div class="form-group" style="width:50%;">
                        <input class="form-field" type="text" placeholder="Height">
                        <span>px</span>
                    </div>
                </div>
                <?php
                if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
                        update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
                    endif;
                    wp_enqueue_media();
                    ?><div class="mt-3 ">
                        <form method='post'>
                        
                        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                        <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
                        <input type="submit" name="submit_image_selector" value="Save" class="button-primary">
                    </form>
                    </div>
                <?php
                $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
                ?><script type='text/javascript'>
                    jQuery( document ).ready( function( $ ) {
                        // Uploading files
                        var file_frame;
                        var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                        var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
                        jQuery('#upload_image_button').on('click', function( event ){
                            event.preventDefault();
                            // If the media frame already exists, reopen it.
                            if ( file_frame ) {
                                // Set the post ID to what we want
                                file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                                // Open frame
                                file_frame.open();
                                return;
                            } else {
                                // Set the wp.media post id so the uploader grabs the ID we want when initialised
                                wp.media.model.settings.post.id = set_to_post_id;
                            }
                            // Create the media frame.
                            file_frame = wp.media.frames.file_frame = wp.media({
                                title: 'Select a image to upload',
                                button: {
                                    text: 'Use this image',
                                },
                                multiple: false // Set to true to allow multiple files to be selected
                            });
                            // When an image is selected, run a callback.
                            file_frame.on( 'select', function() {
                                // We set multiple to false so only get one image from the uploader
                                attachment = file_frame.state().get('selection').first().toJSON();
                                // Do something with attachment.id and/or attachment.url here
                                $('#image-preview').attr('src', attachment.url).css({
                                width: '',
                                opacity: '0.2' // Ubah nilai 0.5 sesuai dengan tingkat transparansi yang Anda inginkan (dari 0 hingga 1)
                                });
                                $( '#image_attachment_id' ).val( attachment.id );
                                // Restore the main post ID
                                wp.media.model.settings.post.id = wp_media_post_id;
                            });
                                // Finally, open the modal
                                file_frame.open();
                        });
                        // Restore the main ID when the add media button is pressed
                        jQuery( 'a.add_media' ).on( 'click', function() {
                            wp.media.model.settings.post.id = wp_media_post_id;
                        });
                    });
            </script>
                <!-- Form Image -->
                <div class="col border my-3">
                        <div class='image-preview-wrapper mt-3  offset-md-1'>
                            <img id='image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
                        </div>
                        <div class="my-3 d-flex justify-content-center">
                            <img src="images.jpeg" alt="" srcset="" width="80%">
                        </div>
                        <div class="form-group mx-auto" style="width: 70%;">
                            <input class="form-field" type="text" placeholder="Title">
                        </div>
                        <div class="form-group justify-content-center my-2">
                            <textarea name="" id="" cols="21" rows="3" style="border: 1px solid #CDD9ED; color: #99A3BA;">Desc</textarea>
                        </div>
                        <div class="form-group mx-auto mb-3" style="width: 70%;">
                            <span>Https</span>
                            <input class="form-field" type="text" placeholder="Link">
                        </div>
                </div>
                <hr class="my-4">
                <div class="col justify-content-between d-flex">
                        <a href="" class="back">Back</a>
                        <button class="button-18" role="button">Save</button>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="margin-top:-530px;">
            <?php include 'slider.php'?>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    #adminmenuback, #adminmenuwrap {
        display: none;
    }
    #wpcontent {
        margin-left: -20px !important;
        width:100%;
    }
    #wpfooter{
        display:none;
    }
    body{
        background-color: white;

    }
    .nav{
        background-color:#F9F2ED ;
        width:100%;
        margin-left:20px;
    }
    .card{
        background-color:#F9F2ED ;
        font-family: Futura MD BT;
        margin-top: -65px;
        z-index: 1;
    }
    :root {
        --input-color: #99A3BA;
        --input-border: #CDD9ED;
        --input-background: #fff;
        --input-placeholder: #CBD1DC;

        --input-border-focus: #275EFE;

        --group-color: var(--input-color);
        --group-border: var(--input-border);
        --group-background: #EEF4FF;

        --group-color-focus: #fff;
        --group-border-focus: var(--input-border-focus);
        --group-background-focus: #678EFE;
    }

    .form-field {
        display: block;
        width: 100%;
        height: 100%;
        padding: 8px 16px;
        line-height: 25px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        -webkit-appearance: none;
        color: var(--input-color);
        border: 1px solid var(--input-border);
        background: var(--input-background);
        transition: border .3s ease;
        &::placeholder {
            color: var(--input-placeholder);
        }
        &:focus {
            outline: none;
            border-color: var(--input-border-focus);
        }
    }

    .form-group {
        position: relative;
        display: flex;
        width: 100%;
        & > span,
        .form-field {
            white-space: nowrap;
            display: block;
            &:not(:first-child):not(:last-child) {
                border-radius: 0;
            }
            &:first-child {
                border-radius: 6px 0 0 6px;
            }
            &:last-child {
                border-radius: 0 6px 6px 0;
            }
            &:not(:first-child) {
                margin-left: -1px;
            }
        }
        .form-field {
            position: relative;
            z-index: 1;
            flex: 1 1 auto;
            width: 1%;
            margin-top: 0;
            margin-bottom: 0;
        }
        & > span {
            height: 35px;
            text-align: center;
            padding: 3px 10px;
            font-size: 14px;
            line-height: 25px;
            color: var(--group-color);
            background: var(--group-background);
            border: 1px solid var(--group-border);
            transition: background .3s ease, border .3s ease, color .3s ease;
        }
        &:focus-within {
            & > span {
                color: var(--group-color-focus);
                background: var(--group-background-focus);
                border-color: var(--group-border-focus);
            }
        }
    }

    /* CSS */
    .button-18 {
        align-items: center;
        background-color: #0A66C2;
        border: 0;
        border-radius: 30px;
        box-sizing: border-box;
        color: #ffffff;
        cursor: pointer;
        font-family: Futura MD BT;
        font-size: 13px;
        font-weight: 550;
        line-height: 20px;
        max-width: 400px;
        min-height: 35px;
        overflow: hidden;
        padding: 0px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        touch-action: manipulation;
        transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
        user-select: none;
        -webkit-user-select: none;
        vertical-align: middle;
    }

    .button-18:hover,
    .button-18:focus { 
        background-color: #678EFE;
        color: #ffffff;
    }

    .button-18:active {
        background: #09223b;
        color: rgb(255, 255, 255, .7);
    }

    .button-18:disabled { 
        cursor: not-allowed;
        background: rgba(0, 0, 0, .08);
        color: rgba(0, 0, 0, .3);
    }

    .back{
        text-decoration: none;
        cursor: pointer;
    }
    select {
        -webkit-appearance:none;
        -moz-appearance:none;
        -ms-appearance:none;
        appearance:none;
        outline:0;
        box-shadow:none;
        border:0!important;
        background: #CBD1DC;
        background-image: none;
        padding-left: 10px;
        margin-top: -3px;
        flex: 1;
        color:#09223b;
        cursor:pointer;
        font-size: 1em;
        font-family: Futura MD BT;
        font-weight: 500;
    }
    select::-ms-expand {
        display: none;
    }
    .select {
        position: relative;
        display: flex;
        width: 20em;
        height: 40px;
        line-height: 3;
        background: #5c6664;
        overflow: hidden;
        border-radius: .25em;
    }
    .select::after {
        content: '\25BC';
        position: absolute;
        margin-top: -3px;
        right: 0;
        padding: 0 10px;
        background: #99A3BA;
        cursor:pointer;
        pointer-events:none;
        transition:.25s all ease;
    }
    .select:hover::after {
        color: #275EFE;
    }
    /* CSS */
    .button-24 {
        background: #678EFE;
        border: 1px solid #678EFE;
        border-radius: 6px;
        box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
        box-sizing: border-box;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
        font-size: 13px;
        font-weight: 600;
        line-height: 5px;
        min-height: 30px;
        outline: 0;
        padding: 12px 14px;
        text-align: center;
        text-rendering: geometricprecision;
        text-transform: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
    }

    .button-24:hover,
    .button-24:active {
        background-color: initial;
        background-position: 0 0;
        color: #678EFE;
    }

    .button-24:active {
     opacity: .5;
    }
</style>
