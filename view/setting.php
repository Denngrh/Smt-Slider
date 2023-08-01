<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<style>
     .carousel-indicators [data-bs-target] {
    width: 7px;
    height: 7px;
    border-radius: 100%;
    background-color: #E0E0E0 !important;
}
  .carousel-indicators .active {
        background-color: #0652f8 !important;
    }
    .custom-carousel-button {
    position: absolute;
    top: 160px;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
  }
  .custom-carousel-button.prev {
    left: 70px;
  }
  .custom-carousel-button.next {
    right: 70px;
  }
    #readMore{
   display:inline-block;
   color:blue;
}
#readLess{
   display:none;
   color:blue;
}
#readMore:hover,#readLess:hover{
   color:navy;
   cursor:pointer;
   text-decoration:underline;
}
#moreText{
   display:none;
}
@media (max-width: 767px) {
  .custom-carousel-button {
    position: absolute;
    top: 160px;
    transform: translateY(-50%);
  }

  .custom-carousel-button.prev {
    left: 20px;
  }
  .custom-carousel-button.next {
    right: 20px;
  }
}
    </style>
<body>
<?php
if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
    endif;
    wp_enqueue_media();
    ?><form method='post'>
         <div class="card col-md-5 mx-auto">
        <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"  aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="1000">
                <img  id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>'  class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                <div class="d-md-block text-center mb-5 mt-4">
                <h3>Buka fitur meet premium</h3>
                  <p>Nikmati panggilan video grup yang lebih lama, peredam bising<span id="dots">...</span><span id="readMore"> Read More »</span><span id="moreText">  dan fitur menarik lainnya dengan paket Google One Premium. </span><span id="readLess"> « Read Less</span></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img  id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>'  class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                <div class="d-md-block text-center mb-5 mt-4">
                  <h3>Dapatkan link yang bisa anda bagikan</h3>
                <p>Klik <strong>Rapat Baru</strong> untuk dapatkan link yang bisa dikirim kepada orang yang ingin diajak rapat</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="3000">
                <img src="https://www.gstatic.com/meet/user_edu_scheduling_light_b352efa017e4f8f1ffda43e847820322.svg"  class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                <div class="d-md-block text-center mb-5 mt-4">
                  <h3>Rencana ke depan</h3>
                  <p>Klik <strong>Rapat baru</strong> untuk menjadwalkan rapat di Google Kalender dan mengirimkan undangan kepada peserta</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="4000">
                <img src="https://www.gstatic.com/meet/user_edu_safety_light_e04a2bbb449524ef7e49ea36d5f25b65.svg"  class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                <div class="d-md-block text-center mb-5 mt-4">
                  <h3>Rapat Anda aman</h3>
                <p>Tidak ada yang dapat bergabung ke rapat kecuali diundang atau dizinkan oleh penyelenggara</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev custom-carousel-button prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon " aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-carousel-button next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
        <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
        <input type="submit" name="submit_image_selector" value="Save" class="button-primary">
    </form>
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
                    $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
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
</body>
</html>