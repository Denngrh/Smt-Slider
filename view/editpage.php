<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar  -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="col pb-md-4">
                <h4 class="title-navbar"> SMT Slider </h4>
            </div>
            <div class="col pb-md-4 d-flex me-5">
                <button id="dekstopbutton"  style="background:transparent;border:none;"><i class="icon fa-solid fa-desktop"></i></button>
                <button id="tabletbutton"  style="background:transparent;border:none;"><i class="icon fa-solid fa-tablet mx-3"></i></button>
                <button id="mobilebutton"  style="background:transparent;border:none;"><i class="icon fa-solid fa-mobile"></i></button>
            </div>
        </div>
    </nav>
    <div class="row">
        <!-- Sidebar -->
        <div class="sidebar col-md-3 shadow">
            <div class="col-md-12 d-flex justify-content-between pe-md-3 pt-2">
                <div class="setting-image-icon mx-md-auto text-center" onclick="toggleSettingImageForm()">
                    <i class=" fa-solid fa-image"></i> <h6> Advanced</h6>
                </div>
                <div class="custom-css-icon  text-center me-md-5" onclick="toggleCustomCSSForm()">
                    <i class=" fa-solid fa-border-top-left"></i> <h6>Style</h6> 
                </div>
            </div>
            <hr style="margin-top:-5px;">
            <div class="col">
                <?php
                // Ambil nilai ID dari permintaan
                $id = $_GET['id'];
                global $wpdb;
                $table_name = $wpdb->prefix . 'smt_slider';
                $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
                if ($data) {
                ?>
                <div class="setting-image-form" id="settingImageForm">
                    <h6 class="ms-md-4 ms-4 mb-3"> Slider </h6>
                    <div class="form-group px-4 col-md-8">
                        <span>Title</span>
                        <input class="form-field" type="text" value="<?php echo $data->name; ?>" readonly>
                    </div>
                    <div class="form-group px-4 col-md-8 mt-3">
                        <span>Type</span>
                        <input class="form-field" type="text" value="<?php echo $data->type; ?>" readonly>
                    </div>
                    <?php
                }
                    ?>
                    <div class="form-container">
                    <div class="form-item">
                        <div class="col d-flex justify-content-between px-md-4 mt-4 ms-4 ms-md-0">
                            <div>
                                <h6> Image </h6>
                            </div>
                            <div>
                                <button class="addform" name="add" style="background:transparent;border:none;"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div> 
                        <?php
                            if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
                                    update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
                                endif;
                                wp_enqueue_media();
                                ?><div class="mt-3 ms-md-4 ms-4">
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
                        <form>
                        <div class='image-preview-wrapper mt-3 ms-4 ms-md-4'>
                            <img id='image-preview' style="border: 2px solid black;" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
                        </div>
                        <div class="my-3 d-flex justify-content-center">
                            <img src="images.jpeg" alt="" srcset="" width="80%">
                        </div>
                        <div class="form-group px-md-4 px-4 d-flex justify-content-between" >
                            <label> Title </label>
                            <input class="form-control" type="text" name ="title"placeholder="Title" style="width:50%;height:5px;">
                        </div>
                        <div class="form-group px-md-4 px-4 d-flex justify-content-between mt-3" >
                            <label> Link </label>
                            <input class="form-control" type="text" name ="link"placeholder="Https" style="width:50%;height:5px;">
                        </div>
                        <div class="ms-md-4 mt-3 ms-4">
                            <label class="form-label" >Description : </label>
                            <textarea name="" id="" cols="21" rows="3" style="border: 1px solid #CDD9ED; color: #99A3BA;">Desc</textarea>
                        </div>
                        <hr class="my-3 ms-4" width="85%;">
                        
                        </div>
                    </div>
                    <div class="col justify-content-between d-flex px-md-5 px-4 mb-4">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=dashboard')); ?>" class="back">Back</a>
                    <button class="button-18" role="button">Save</button>
                </div>
                </form>
                </div>
               
                <div class="custom-css-form" id="customCSSForm">
                    <form>
                        <h4> Setting css</h4>
                    </form>
                </div>
            </div>
        </div>
        <!-- View Slider -->
        <div class="content card col-md-9 mt-3" style="background-color:#fafafa;">
            <?php global $wpdb;
                $table_slider = $wpdb->prefix . 'smt_slider';
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    $slider_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $id");
                    if ($slider_data) {
                        // Tampilkan data slider sesuai tipe yang disimpan di tabel
                        $type = $slider_data->type;
                        if ($type === 'Paralax') {
                            include 'parallax.php'; // Ganti 'paralax.php' dengan nama file sesuai tipe "paralax"
                        } elseif ($type === 'Square') {
                            include 'slider.php'; // Ganti 'square.php' dengan nama file sesuai tipe "square"
                        } else {
                            // Handle jika tipe tidak dikenali atau ada kesalahan
                            echo "Tipe tidak dikenali atau terjadi kesalahan.";
                        }
                    } else {
                        // Handle jika data slider dengan id yang diberikan tidak ditemukan
                        echo "Data slider tidak ditemukan.";
                    }
                } else {
                    // Handle jika parameter id tidak ada atau tidak valid
                    echo "Parameter id tidak valid.";
                }
            ?>
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
        overflow-x:hidden;
        overflow-y:hidden;
       
        
    }
    .navbar{
        background : #4fb359;
        width : 102%;
        height :40px;
    }
    .title-navbar{
        color:#ffffff;
        font-size : 20px;

    }
    .icon{
        height:30px;
        color:#ffffff;
        font-size : 20px;
    }
    h6{
        font-size:15px;
    }
    .sidebar{
        overflow-y: auto;
        height: 90vh; 
    }
    .setting-image-icon,
    .custom-css-icon {
    padding: 10px;
    cursor: pointer;
    }

    .setting-image-form,
    .custom-css-form {
    display: none; /* Sembunyikan form secara default */
    padding: 10px;
    }

    /* Gaya ikon menggunakan Font Awesome */
    .setting-image-icon i,
    .custom-css-icon i {
    font-size: 20px;
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
        height :10px ;
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
            height: 30px;
            text-align: center;
            padding: 0px 10px;
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
    .content{
        height:80vh;
    }
    /* Gaya untuk tampilan desktop */
.content.card {
    /* Gaya untuk card di tampilan desktop */
}


</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var settingImageForm = document.getElementById("settingImageForm");
  settingImageForm.style.display = "block";
});

function toggleSettingImageForm() {
  var settingImageForm = document.getElementById("settingImageForm");
  var customCSSForm = document.getElementById("customCSSForm");

  settingImageForm.style.display = "block";
  customCSSForm.style.display = "none";
}

function toggleCustomCSSForm() {
  var settingImageForm = document.getElementById("settingImageForm");
  var customCSSForm = document.getElementById("customCSSForm");

  settingImageForm.style.display = "none";
  customCSSForm.style.display = "block";
}
</script>

<script>
    jQuery(document).ready(function($) {
    // Fungsi untuk mengubah ukuran card
    function dekstopsize() {
        var card = $('.content.card');
        // Tambahkan logika untuk mengubah lebar dan tinggi card sesuai yang Anda inginkan
        // Misalnya, Anda dapat menggunakan metode .css() untuk mengubah properti CSS
        card.css('width', '925px');
        card.css('height', '526px');
        card.css('margin', 'auto');
    }

    // Panggil fungsi untuk mengatur ukuran card saat halaman dimuat
    dekstopsize();

    // Tindakan ketika tombol "Mobile" diklik
    $('#mobilebutton').on('click', function() {
        // Tambahkan logika untuk mengubah ukuran card sesuai tampilan mobile
        // Contoh:
        var card = $('.content.card');
        card.css('width', '260px');
        card.css('height', '503px');
        card.css('margin', 'auto');
    });

    // Tindakan ketika tombol "Tablet" diklik
    $('#tabletbutton').on('click', function() {
        // Tambahkan logika untuk mengubah ukuran card sesuai tampilan tablet
        // Contoh:
        var card = $('.content.card');
        card.css('width', '668px');
        card.css('height', '503px');
        card.css('margin', 'auto');
    });

    // Tindakan ketika tombol "Dekstop" diklik
    $('#dekstopbutton').on('click', function() {
        // Panggil fungsi dekstopsize() untuk mengubah ukuran card sesuai tampilan desktop
        dekstopsize();
    });
});
</script>

<script>
    jQuery(document).ready(function($) {
    // Fungsi untuk menambahkan form baru
    function addNewForm() {
        // Dapatkan form terakhir
        var lastForm = $('.form-container .form-item:last');
        // Salin form terakhir
        var newForm = lastForm.clone();

        // Hapus nilai input pada form baru (jika ada)
        newForm.find('input').val('');
        // Hapus nilai textarea pada form baru (jika ada)
        newForm.find('textarea').val('');

        // Ubah ID dan atribut lain pada form baru
        var uniqueId = Date.now();
        newForm.find('#upload_image_button').attr('id', 'upload_image_button_' + uniqueId);
        newForm.find('#image_attachment_id').attr('id', 'image_attachment_id_' + uniqueId);
        newForm.find('[name="image_attachment_id"]').attr('name', 'image_attachment_id_' + uniqueId);

        // Tambahkan form baru setelah form terakhir
        $('.form-container').append(newForm);
    }

    // Tindakan ketika tombol "addform" diklik
    $('.addform').on('click', function() {
        addNewForm();
    });
});

</script>

 



