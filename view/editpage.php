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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>


    <body>
        <!-- Navbar  -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="col pb-md-4">
                    <h4 class="title-navbar"> SMT Slider </h4>
                </div>
                <div class="col pb-md-4 d-flex me-5">
                    <button id="dekstopbutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-desktop"></i></button>
                    <button id="tabletbutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-tablet mx-3"></i></button>
                    <button id="mobilebutton" style="background:transparent;border:none;"><i class="icon fa-solid fa-mobile"></i></button>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="sidebar col-md-3 shadow">
                <!-- sidebar -->
                <div class="menu col-md-12 d-flex justify-content-between pe-md-3 pt-2">
                    <div class="setting-image-icon mx-md-auto text-center" onclick="toggleSettingImageForm()">
                        <i class=" fa-solid fa-image"></i>
                        <h6> Advanced</h6>
                    </div>
                    <div class="custom-css-icon  text-center me-md-5" onclick="toggleCustomCSSForm()">
                        <i class=" fa-solid fa-border-top-left"></i>
                        <h6>Style</h6>
                    </div>
                </div>
                <hr style="margin-top:-5px;">
                <div class="col">
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="needs-validation">
                <input type="hidden" name="action" value="insert_img_callback">
                    <div class="setting-image-form mt-5 pt-5" id="settingImageForm">
                        <?php
                        $id = $_GET['id'];
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'smt_slider';
                        $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
                        if ($data) {
                        ?>
                        <h5 class="ms-md-2 ms-2 mb-3"> Slider </h5>
                        <div class="form-group mt-3 d-flex justify-content-between" >
                            <label class="ms-md-2"> Title </label>
                            <input class="form-control" type="text" name="slider_name" value="<?php echo $data->name; ?>" style="width:70%;height:5px;">
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-between" >
                            <label class="ms-md-2"> Type </label>
                            <input readonly class="form-control-plaintext" id="type_text" type="text" value="<?php echo $data->type; ?>" style="width:70%;height:5px;">
                        </div>
                        <div id="delay_popup_div" class="form-group mt-3 d-flex justify-content-between" >
                            <label class="ms-md-2" title="Delay popup when user enter the page" >Delay Popup Show</label>
                            <input class="form-control" type="text" name="delay_popup" value="1000" style="width:50%;height:5px;" title="Delay popup when user enter the page in milisecond">
                        </div>
                        <div id="delay_per_popup" class="form-group mt-3 d-flex justify-content-between" >
                            <label class="ms-md-2" title="Delay popup from each popup" >Delay Per Popup</label>
                            <input class="form-control" type="text" name="delay_per_popup" value="3000" style="width:50%;height:5px;" title="Delay popup from each popup in milisecond">
                        </div>
                        <div id="popup_style_div" class="form-group mt-3 d-flex justify-content-between" >
                            <label class="ms-md-2">Popup Style</label>
                            <select name="popup_style" style="width: 50%;">
                                <option value="1">Style Pertama</option>
                                <option value="2">Style Kedua</option>
                                <option value="3">Style Ketiga</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function(){
                                let slider_type = $('#settingImageForm').find("input[id='type_text']").val();
                                if (slider_type != 'Popup') {
                                    $('#delay_popup_div').remove();
                                    $('#popup_style_div').remove();
                                    $('#delay_per_popup').remove();
                                }

                                $('#settingImageForm').find("input[name='delay_popup']").val(<?php echo ($data->delay_popup == 0) ? 1000 : $data->delay_popup ?>);
                                $('#settingImageForm').find("input[name='delay_per_popup']").val(<?php echo $data->delay_per_popup ?>);
                                $('#settingImageForm').find("select[name='popup_style']").val(<?php echo ($data->popup_style == 0) ? 1 : $data->popup_style ?>);

                            });
                        </script>
                        <?php
                        }
                        ?>
                        <!-- Delete -->
                        <div class="col d-flex justify-content-between px-md-2 mt-4 ms-4 ms-md-0">
                                    <div>
                                        <h5> Image </h5>
                                    </div>
                                    <div>
                                        <button type="button" id="add_field" class="btn_add_field"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div> 
                                <!-- End Delete -->
                        <div class="form-container">
                            <div class="form-item">
                            <?php
                            $id_slider = $_GET['id']; 
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'smt_img'; 
                            $query = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE id_slider = %d", $id_slider);
                            $count = $wpdb->get_var($query);
                            $id_slider_exists = ($count > 0);
                            wp_enqueue_media();
                            ?>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const typeOfSlider = "<?php echo $data->type; ?>";
                                    if (typeOfSlider !== "Paralax") {
                                        // Mengambil elemen dengan ID tertentu
                                        var btn_bg = document.getElementById('upload_bg_image_button');
                                        var bg_img = document.getElementById('bg_image_attachment_id');
                                        var bg_img_wrap = document.getElementById('bg-image-preview');
                                    
                                        // Mengubah style elemen untuk menyembunyikannya
                                        btn_bg.style.display = 'none';
                                        bg_img.style.display = 'none';
                                        bg_img_wrap.style.display = 'none';
                                      
                                        // Menghapus nilai elemen (contoh untuk input teks)
                                        if (bg_img.tagName === 'INPUT' && (bg_img.type === 'hidden')) {
                                            bg_img.value = '';
                                        }
                                    }
                                });
                            </script>
                            <?php if ($id_slider_exists) { ?>
                                <div class="mt-3 ms-md-2 ms-2 mb-5">
                                        <!-- // start multiple_form -->
                                        <div id="multiple_form">
                                            <div class="accordion" id="accordionExample" >
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" >
                                                        <button class="accordion-button" style="background:#fafafa;" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_1" aria-expanded="false" aria-controls="accordion_1">
                                                            Image 1
                                                        </button>
                                                    </h2>
                                                    <div id="accordion_1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body" style="background:#fafafa;">
                                                            <!-- start form-container -->
                                                            <div class="form-container">
                                                                <!-- Upload Image  -->
                                                                <?php
                                                                if (isset($_POST['image_attachment_id'])) :
                                                                    update_option('media_selector_attachment_id', absint($_POST['image_attachment_id']));
                                                                endif;
                                                                ?>
                                                                <?php
                                                                $my_saved_attachment_post_id = get_option('media_selector_attachment_id');
                                                                ?>
                                                                <input id="upload_image_button" type="button" class="button_up_img" value="<?php _e('Upload image'); ?>" />
                                                                <input type='hidden' name='image_attachment_id[]' id='image_attachment_id' value='<?php echo get_option('media_selector_attachment_id'); ?>'>
                                                                <div class='image-preview-wrapper my-3 ms-4 ms-md-5 ps-md-3'>
                                                                    <img id='image-preview' style="border: 1px solid black;" src='<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id')); ?>' width='100' height='100'>
                                                                </div>
                                                                <!-- End Upload Image -->
                                                                <!-- Upload Background -->
                                                                <?php
                                                                if (isset($_POST['bg_image_attachment_id'])) {
                                                                    update_option('bg_media_selector_attachment_id', absint($_POST['bg_image_attachment_id']));
                                                                }
                                                                wp_enqueue_media();
                                                                $bg_saved_attachment_post_id = get_option('bg_media_selector_attachment_id');
                                                                ?>
                                                                <input id="upload_bg_image_button" type="button" class="button_up_bg_img" value="<?php _e('Upload Background Image'); ?>" />
                                                                <input type='hidden' name='bg_image_attachment_id[]' id='bg_image_attachment_id' value='<?php echo get_option('bg_media_selector_attachment_id'); ?>'>
                                                                <div class='bg-image-preview-wrapper mt-3 ms-4 ms-md-5 ps-md-3'>
                                                                    <img id='bg-image-preview' style="border: 1px solid black;" src='<?php echo wp_get_attachment_url(get_option('bg_media_selector_attachment_id')); ?>' width='100' height='100'>
                                                                </div>
                                                                <!-- End BG -->
                                                                <div class="form-group mt-3 d-flex justify-content-between">
                                                                    <label> Title </label>
                                                                    <input class="form-control" type="text" name="title[]" placeholder="Title" data-id="0" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="form-group d-flex justify-content-between mt-3">
                                                                    <label> Link </label>
                                                                    <input class="form-control" type="text" name="link[]" placeholder="Https" autocomplete="off" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="form-group d-flex justify-content-between mt-3">
                                                                    <label> Button Text </label>
                                                                    <input class="form-control" type="text" name="button_link[]" placeholder="Tautan Tombol" autocomplete="off" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="my-3">
                                                                    <label class="form-label">Description </label>
                                                                    <textarea name="desc[]" id=""  data-id="0" cols="25" rows="3" maxlength="400" style="border: 1px solid #CDD9ED; color: #000;" placeholder="Description"></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_img[]" value="">
                                                                <input type="hidden" name="edit_id" value="<?php echo esc_attr($id_slider); ?>">
                                                                <!-- end form-container -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="additional_fields">
                                            <!-- Konten hasil copy div field ke sini -->
                                        </div>
                                </div>
                                <?php }else{?>
                                    <?php
                                if (isset($_POST['image_attachment_id'])) :
                                    update_option('media_selector_attachment_id', absint($_POST['image_attachment_id']));
                                endif;
                                wp_enqueue_media();
                                ?>
                                <?php
                                $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
                                ?>
                                <div class="mt-3 ms-md-2 ms-2 mb-5">
                                        <!-- // start multiple_form -->
                                        <div id="multiple_form">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" style="background:#fafafa;" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_1" aria-expanded="false" aria-controls="accordion_1">
                                                            Image
                                                        </button>
                                                    </h2>
                                                    <div id="accordion_1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body" style="background:#fafafa;">
                                                            <!-- start form-container -->
                                                            <div class="form-container">
                                                                <!-- Upload Image  -->
                                                                <input id="upload_image_button" type="button" class="button_up_img" value="<?php _e('Upload image'); ?>" />
                                                                <div class="bungkus">
                                                                    <input type='hidden' name='image_attachment_id[]' id='image_attachment_id' value='<?php echo get_option('media_selector_attachment_id'); ?>'>
                                                                </div>
                                                                <div class='image-preview-wrapper my-3 ms-4 ms-md-5 ps-md-3'>
                                                                    <img id='image-preview' style="border: 1px solid black;" src='<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id')); ?>' width='100' height='100'>
                                                                </div>
                                                                <!-- End Upload Image -->
                                                                <!-- Upload Background -->
                                                                <?php
                                                                if (isset($_POST['bg_image_attachment_id'])) {
                                                                    update_option('bg_media_selector_attachment_id', absint($_POST['bg_image_attachment_id']));
                                                                }
                                                                wp_enqueue_media();
                                                                $bg_saved_attachment_post_id = get_option('bg_media_selector_attachment_id');
                                                                ?>
                                                                <input id="upload_bg_image_button" type="button" class="button_up_bg_img" value="<?php _e('Upload Background Image'); ?>" />
                                                                <input type='hidden' name='bg_image_attachment_id[]' id='bg_image_attachment_id' value='<?php echo get_option('bg_media_selector_attachment_id'); ?>'>
                                                                <div class='bg-image-preview-wrapper mt-3 ms-4 ms-md-5 ps-md-3'>
                                                                    <img id='bg-image-preview' style="border: 1px solid black;" src='<?php echo wp_get_attachment_url(get_option('bg_media_selector_attachment_id')); ?>' width='100' height='100'>
                                                                </div>
                                                                <!-- End BG -->
                                                                <div class="form-group mt-3 d-flex justify-content-between">
                                                                    <label> Title </label>
                                                                    <input class="form-control" type="text" name="title[]" placeholder="Title" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="form-group d-flex justify-content-between mt-3">
                                                                    <label> Link </label>
                                                                    <input class="form-control" type="text" name="link[]" placeholder="Https" autocomplete="off" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="form-group d-flex justify-content-between mt-3">
                                                                    <label> Button Text </label>
                                                                    <input class="form-control" type="text" name="button_link[]" placeholder="Tautan Tombol" autocomplete="off" style="width:70%;height:5px;">
                                                                </div>
                                                                <div class="my-3">
                                                                    <label class="form-label">Description </label>
                                                                    <textarea name="desc[]" id="" cols="25" rows="3" style="border: 1px solid #CDD9ED; color: #000;" placeholder="Description"></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_img[]" value="">
                                                                <input type="hidden" name="edit_id" value="<?php echo esc_attr($id_slider); ?>">
                                                                <!-- <input type="hidden" name="edit_id" value="0"> -->
                                                                <!-- end form-container -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="additional_fields">
                                            <!-- Konten hasil copy div field ke sini -->
                                        </div>
                                </div>
                                <?php } 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="custom-css-form mt-5 pt-5" id="customCSSForm">
                        <?php
                        global $wpdb;
                        $preview = admin_url('admin.php?page=preview&id=' . $id);
                        $table_smt_css = $wpdb->prefix . 'smt_style';
                        $data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
                        $css_data = json_decode($data->style_data, true);
                        {
                        ?>
                        <?php
                          $id = $_GET['id'];
                          global $wpdb;
                          $table_name = $wpdb->prefix . 'smt_slider';
                          $datas = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
                         if($datas){
                        ?>
                        <script>
                               document.addEventListener("DOMContentLoaded", function () {
                                const typeOfSlider = "<?php echo $datas->type; ?>";
                                if (typeOfSlider !== "Paralax") {
                                    // Mengambil elemen dengan ID tertentu
                                    var lineColorLabel = document.getElementById('line_color_label');
                                    var lineColorInput = document.getElementById('line_color_input');
                                    var dotsColorLabel = document.getElementById('dots_color_label');
                                    var dotsColorInput = document.getElementById('dots_color_input');
                                    var bgcontrolinput = document.getElementById('bg_control_input');
                                    var bgcontrollabel = document.getElementById('bg_control_label');

                                    // Mengubah style elemen untuk menyembunyikannya
                                    lineColorLabel.style.display = 'none';
                                    lineColorInput.style.display = 'none';
                                    dotsColorLabel.style.display = 'none';
                                    dotsColorInput.style.display = 'none';
                                    bgcontrolinput.style.display = 'block';
                                    bgcontrollabel.style.display = 'block';

                                    // Menghapus nilai elemen (contoh untuk input teks)
                                    if (lineColorInput.tagName === 'INPUT' && (lineColorInput.type === 'color')) {
                                        lineColorInput.value = '';
                                    }
                                    if (dotsColorInput.tagName === 'INPUT' && (dotsColorInput.type === 'color')) {
                                        dotsColorInput.value = '';
                                    }
                                     if (bgcontrolinput.tagName === 'INPUT' && (dotsColorInput.type === 'color')) {
                                        dotsColorInput.value = '';
                                    }
                                }
                                
                            });
                            document.addEventListener("DOMContentLoaded", function () {
                            const sliderType = "<?php echo $datas->type; ?>"; // Mengambil jenis slider dari PHP
                            const popupStyle = <?php echo $datas->popup_style; ?>;

                            // Mengambil elemen form border
                            var borderForm = document.getElementById("border_form");
                            var popupFrame = document.getElementById('accordionPanelsStayOpenExample6');
                            var indicatorDots = document.getElementById('accordionPanelsStayOpenExample4')
                            var buttonControl = document.getElementById('accordionPanelsStayOpenExample5');
                            var btn_ctrl_bg = document.getElementById('btn_ctrl_bg');
                            var bgcontrolinput = document.getElementById('bg_control_input');
                            var bgcontrollabel = document.getElementById('bg_control_label');


                            // Fungsi untuk menampilkan atau menyembunyikan elemen form border
                            function toggleBorderForm() {
                                if (sliderType === "Square") {
                                    borderForm.style.display = "block"; // Tampilkan elemen form border jika jenis slider adalah "square"
                                } else {
                                    borderForm.style.display = "none"; // Sembunyikan elemen form border jika jenis slider bukan "square"
                                }

                                // di bawah ini untuk type kondisi type popup
                                if (sliderType === "Popup") {
                                    borderForm.style.display = "none"; // sembunyikan elemen jika type popup
                                    bgcontrolinput.style.display = "none";
                                    bgcontrollabel.style.display = "none";
                                    btn_ctrl_bg.style.display = "none";
                                    popupFrame.style.display = "block";
                                    if (popupStyle !== 1){
                                        indicatorDots.style.display = "none";
                                        buttonControl.style.display = "none";
                                    }
                                } else {
                                    borderForm.style.display = "block"; // tamilkan jika selain type popup
                                    popupFrame.style.display = "none";
                                }
                            }

                            // Panggil fungsi toggleBorderForm saat halaman dimuat
                            toggleBorderForm();
                        });

                            </script>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample1">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-accordion_1" aria-expanded="false" aria-controls="panelsStayOpen-accordion_1">
                                    Title
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-accordion_1" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                    <div class="form-group px-md-4 px-2 mt-2 d-flex justify-content-between">
                                            <label>Title Size</label>
                                            <select name="title_size" id="title_size">
                                            <option value="<?php echo $css_data['title_size']; ?>"><?php echo $css_data['title_size']; ?></option>
                                                <option value="h1" style="font-size:40px;">h1</option>
                                                <option value="h2" style="font-size:34px;">h2</option>
                                                <option value="h3" style="font-size:28px;">h3</option>
                                                <option value="h4" style="font-size:24px;">h4</option>
                                                <option value="h5" style="font-size:20px;">h5</option>
                                                <option value="h6" style="font-size:16px;">h6</option>
                                            </select>
                                        </div>
                                        <div class="select px-md-4 px-4 mt-2 d-flex justify-content-between">
                                            <label>Font</label>
                                            <select name="title_fam" id="title_fam">
                                                <option value="<?php echo $css_data['title_fam']; ?>"><?php echo $css_data['title_fam']; ?></option>
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between" >
                                            <label> Color </label>
                                            <input class="form-control" type="color" name ="title_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['title_color']; ?>">
                                        </div>        
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Top </label>
                                            <input class="form-control" type="input" name="pd_top_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_top_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Bottom </label>
                                            <input class="form-control" type="input" name="pd_bottom_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_bottom_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Right </label>
                                            <input class="form-control" type="input" name="pd_right_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_right_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding left </label>
                                            <input class="form-control" type="input" name="pd_left_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_left_title']; ?>">
                                        </div>        
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Top</label>
                                            <input class="form-control" type="input" name="mg_top_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_top_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Bottom</label>
                                            <input class="form-control" type="input" name="mg_bottom_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_bottom_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Right</label>
                                            <input class="form-control" type="input" name="mg_right_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_right_title']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin left</label>
                                            <input class="form-control" type="input" name="mg_left_title" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_left_title']; ?>">
                                        </div>        

                                    </div> 
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample2">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse2" aria-expanded="false" aria-controls="panelsStayOpen-collapse2">
                                    Description
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="select px-md-4 px-4 d-flex justify-content-between">
                                            <label>Font</label>
                                            <select name="desc_fam" id="desc_fam">
                                                <option value="<?php echo $css_data['desc_fam']; ?>"><?php echo $css_data['desc_fam']; ?></option>
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label>  Color </label>
                                            <input class="form-control" type="color" name ="desc_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['desc_color']; ?>">
                                        </div>
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Top </label>
                                            <input class="form-control" type="input" name="pd_top_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_top_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Bottom </label>
                                            <input class="form-control" type="input" name="pd_bottom_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_bottom_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Right </label>
                                            <input class="form-control" type="input" name="pd_right_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_right_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding left </label>
                                            <input class="form-control" type="input" name="pd_left_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_left_desc']; ?>">
                                        </div>        
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Top</label>
                                            <input class="form-control" type="input" name="mg_top_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_top_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Bottom</label>
                                            <input class="form-control" type="input" name="mg_bottom_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_bottom_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Right</label>
                                            <input class="form-control" type="input" name="mg_right_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_right_desc']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin left</label>
                                            <input class="form-control" type="input" name="mg_left_desc" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_left_desc']; ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample3">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse3" aria-expanded="false" aria-controls="panelsStayOpen-collapse3">
                                    CTA Button
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="select px-md-4 px-4 d-flex justify-content-between">
                                            <label>Font</label>
                                            <select name="btn_fam" id="btn_fam">
                                                <option value="<?php echo $css_data['btn_fam']; ?>"><?php echo $css_data['btn_fam']; ?></option>
                                                <option value="sans-serif" style="font-family:sans-serif;">Sans Serif</option>
                                                <option value="serif" style="font-family:serif;">Serif</option>
                                                <option value="fantasy" style="font-family:fantasy;">Fantasy</option>
                                                <option value="Verdana" style="font-family:Verdana;">Verdana</option>
                                            </select>
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label>  Color </label>
                                            <input class="form-control" type="color" name ="btn_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['btn_color']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label> Background  </label>
                                            <input class="form-control" type="color" name ="btn_bg" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['btn_bg']; ?>">
                                        </div>
                                        <hr class="my-3 ms-4" width="75%;"> 
                                        <p class="ms-md-4"> Hover </p>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between" >
                                            <label> Font Color </label>
                                            <input class="form-control" type="color" name ="btn_color_hvr" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['btn_color_hvr']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between" >
                                            <label> Background </label>
                                            <input class="form-control" type="color" name ="btn_bg_hvr" placeholder="color" style="width:50%;height:25px;" value="  <?php echo $css_data['btn_bg_hvr']; ?>">
                                        </div>
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Top </label>
                                            <input class="form-control" type="input" name="pd_top_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_top_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Bottom </label>
                                            <input class="form-control" type="input" name="pd_bottom_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_bottom_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding Right </label>
                                            <input class="form-control" type="input" name="pd_right_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_right_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label> Padding left </label>
                                            <input class="form-control" type="input" name="pd_left_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['pd_left_btn']; ?>">
                                        </div>        
                                        <hr class="my-3 ms-4" width="75%;">
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Top</label>
                                            <input class="form-control" type="input" name="mg_top_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_top_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Bottom</label>
                                            <input class="form-control" type="input" name="mg_bottom_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_bottom_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin Right</label>
                                            <input class="form-control" type="input" name="mg_right_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_right_btn']; ?>">
                                        </div>        
                                        <div class="form-group px-md-2 px-2  mt-2 d-flex justify-content-between" >
                                            <label>Margin left</label>
                                            <input class="form-control" type="input" name="mg_left_btn" placeholder="e.g: 4px" style="width:40%;height:25px;" value="<?php echo $css_data['mg_left_btn']; ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample4">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse4" aria-expanded="false" aria-controls="panelsStayOpen-collapse4">
                                    Indicator Dots
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse4" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between">
                                            <label id="dots_color_label" > Color </label>
                                            <input class="form-control" type="color" name ="dots_color" id="dots_color_input"  placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['dots_color']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label> Background  </label>
                                            <input class="form-control" type="color" name ="dots_bg" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['dots_bg']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" id="line_color">
                                            <label id="line_color_label"> Line Color </label>
                                            <input class="form-control" type="color" name ="dots_line" id="line_color_input" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['dots_line']; ?>">
                                        </div>
                                        <hr class="my-3 ms-4" width="75%;"> 
                                        <p class="ms-md-4"> Active </p>
                                        <div class="form-group px-md-4 px-4 mt-2 d-flex justify-content-between" >
                                            <label> Background  </label>
                                            <input class="form-control" type="color" name ="dots_bg_active" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['dots_bg_active']; ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample5">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse5" aria-expanded="false" aria-controls="panelsStayOpen-collapse5">
                                    Button Control
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse5" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label> Color </label>
                                            <input class="form-control" type="color" name ="control_color" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['control_color']; ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" id="btn_ctrl_bg" >
                                            <label id="bg_control_label"> Background  </label>
                                            <input class="form-control" type="color" name ="control_bg" id="bg_control_input" placeholder="color" style="width:50%;height:25px;" value="<?php echo $css_data['control_bg']; ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample6">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse6" aria-expanded="false" aria-controls="panelsStayOpen-collapse6">
                                    Popup Frame
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse6" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label id="bg_control_label"> Border Radius  </label>
                                            <input class="form-control" type="input" name ="border_radius" id="bg_control_input" placeholder="color" style="width:40%;height:25px;" value="<?php echo $css_data['border_radius']; ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion my-3" id="accordionPanelsStayOpenExample7">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse7" aria-expanded="false" aria-controls="panelsStayOpen-collapse7">
                                    Close Button
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse7" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label> Color  </label>
                                            <input class="form-control" type="color" name="close_btn_color" placeholder="color" style="width:40%;height:25px;" value="<?php echo $css_data['close_btn_color'] ?>">
                                        </div>
                                        <div class="form-group px-md-4 px-4  mt-2 d-flex justify-content-between" >
                                            <label> Size </label>
                                            <input class="form-control" type="input" name="close_btn_size" placeholder="... px" style="width:40%;height:25px;" value="<?php echo $css_data['close_btn_size'] ?>">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div id="border_form" class="accordion my-3" id="accordionPanelsStayOpenExample5">
                                <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse6" aria-expanded="false" aria-controls="panelsStayOpen-collapse6">
                                    Border
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse6" class="accordion-collapse collapse show">
                                    <div class="accordion-body d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="border_option" id="border_none_input" value="none">
                                        <label class="form-check-label" for="border_none" id_="border_none_label" >
                                            None
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="border_option" id="border_show_input" value="1px solid #d2d2d2">
                                        <label class="form-check-label" for="border_show" id="border_show_label">
                                            Show
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="footer_sidebar col justify-content-between d-flex  px-4 ">
                        <input type="hidden" name="get_id_css" value="<?php echo esc_attr($id); ?>">
                        <a href="<?php echo esc_url(admin_url('admin.php?page=dashboard')); ?>" class="back_btn mt-1"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i></a>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=preview&id=' . $id)); ?>" class="preview_btn mt-1"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></i></a>
                        <button class="button-18" role="button" name="submit" id="submit">Publish</button>
                    </div>
                </form>
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
                            $type = $slider_data->type;
                            if ($type === 'Paralax') {
                                include 'Paralax.php'; 
                            } elseif ($type === 'Square') {
                                include 'Square.php';
                            } elseif ($type === 'Popup') {
                                include 'Popup.php'; 
                            } else {
                                echo "Tipe tidak dikenali atau terjadi kesalahan.";
                                echo var_dump($slider_data);
                            }
                        } else {
                            echo "Data slider tidak ditemukan.";
                        }
                    } else {
                        echo "Parameter id tidak valid.";
                    }
                ?>
            </div>       
        </div>

    </body>

    </html>

    <style>
        #adminmenuback,
        #adminmenuwrap {
            display: none;
        }

        #wpcontent {
            margin-left: -20px !important;
            width: 100%;
        }

        #wpfooter {
            display: none;
        }

        body {
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
        .active-button i {
            border-bottom : 4px solid #000;
            color : #1c2431;
            transition: all 0.7s ease;
        }
        h6{
            font-size:15px;
        }
        .sidebar{
            overflow-y: auto;
            overflow-x: hidden;
            height: 90vh;
            background: #FFF;
            box-shadow: 0px -2px 10px 0px rgba(0, 0, 0, 0.25);
        }
        .menu{
            position:fixed;
            width:24%;
            height:10%;
            background:#fafafa;
            z-index: 4;
        }
        .active-menu{
            border-bottom: 4px solid #4fb359;
            color:#4fb359;
            border-radius: 2px; 
            transition: all 0.4s ease; 
        }
        .setting-image-icon,
        .custom-css-icon {
            padding: 10px;
            cursor: pointer;
        }

        .setting-image-form,
        .custom-css-form {
            display: none;
            padding: 10px;
        }
        .setting-image-icon i,
        .custom-css-icon i {
            font-size: 20px;
        }

        /* CSS */
        .button-18 {
            align-items: center;
            background-color: #4fb359;
            border: 0;
            box-sizing: border-box;
            color: #ffffff;
            cursor: pointer;
            font-family: Futura MD BT;
            font-size: 13px;
            font-weight: 550;
            line-height: 20px;
            width: 140px;
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
            margin-right:-24px;
        }

        .button-18:hover,
        .button-18:focus {
            background-color: #aeded2;
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

        .back {
            text-decoration: none;
            cursor: pointer;
        }

        .content {
            height: 80vh;
        }
        .component {
        margin-bottom: 10px;
        }
        .arrow-down {
            cursor: pointer;
            margin-left: 10px;
        }
        .css-form {
            padding: 10px;
        }
        .btn_add_field{
            background:transparent;
            border-radius:20px;
        }
        .button_up_img{
            border: 2px solid green;
            border-radius:10px;
            width:230px;
            height:40px;
            color: green;
            background-color:#FFF;
        }
        .button_up_bg_img{
            border: 2px solid green;
            border-radius:10px;
            width:230px;
            height:40px;
            color: green;
            font-size:13px;
            background-color:#FFF;
        }
        ::-webkit-scrollbar {
        width: 20px;
        
        }
        ::-webkit-scrollbar-track {
        background-color: transparent;
        }
        ::-webkit-scrollbar-thumb {
        background-color: #d6dee1;
        border-radius: 20px;
        border: 6px solid transparent;
        background-clip: content-box; 
        }
        ::-webkit-scrollbar-thumb:hover {
        background-color: #a8bbbf;
        }
        .accordion{
            width:270px;
        }
        .footer_sidebar{
            background:#1c2431;
            width: 24.3vw;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            box-shadow: 0px -2px 10px 0px rgba(0, 0, 0, 0.25);
        }
        .delete-button{
            border: 2px solid red;
            border-radius:10px;
            width:230px;
            height:40px;
            color: red;
            background-color:#FFF;
        }
        .menu .setting-image-icon.active,
    .menu .custom-css-icon.active {
        background-color: #3498db; /* Ganti dengan warna latar belakang yang sesuai */
        color: #fff; /* Ganti dengan warna teks yang sesuai */
    }

    </style>

    <script>
        $(document).ready(function() {
    // Menutup semua accordion saat halaman dimuat pertama kali
    $('.collapse').collapse('hide');
    });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var settingImageForm = document.getElementById("settingImageForm");
            var customCSSForm = document.getElementById("customCSSForm");

            // Tampilkan menu "Advanced" secara default saat halaman dimuat
            settingImageForm.style.display = "block";
            customCSSForm.style.display = "none";

            // Tambahkan class "active-menu" ke menu "Advanced"
            document.querySelector(".setting-image-icon").classList.add("active-menu");
        });

        function toggleSettingImageForm() {
            var settingImageForm = document.getElementById("settingImageForm");
            var customCSSForm = document.getElementById("customCSSForm");

            settingImageForm.style.display = "block";
            customCSSForm.style.display = "none";

            // Tambahkan class "active-menu" pada menu "Advanced" dan hapus dari menu "Style"
            document.querySelector(".setting-image-icon").classList.add("active-menu");
            document.querySelector(".custom-css-icon").classList.remove("active-menu");
        }

        function toggleCustomCSSForm() {
            var settingImageForm = document.getElementById("settingImageForm");
            var customCSSForm = document.getElementById("customCSSForm");

            settingImageForm.style.display = "none";
            customCSSForm.style.display = "block";

            // Tambahkan class "active-menu" pada menu "Style" dan hapus dari menu "Advanced"
            document.querySelector(".setting-image-icon").classList.remove("active-menu");
            document.querySelector(".custom-css-icon").classList.add("active-menu");
        }
    </script>


    <script>
    jQuery(document).ready(function($) {
        function dekstopsize() {
            var card = $('.content.card');
            card.css('width', '925px');
            card.css('height', '670px');
            card.css('margin', 'auto');
        }
        dekstopsize();
        
        // Menghapus kelas 'active-button' dari semua tombol ikon
        $('#mobilebutton, #tabletbutton').removeClass('active-button');
        $('#dekstopbutton').addClass('active-button');

        $('#mobilebutton').on('click', function() {
            var card = $('.content.card');
            card.css('width', '360px');
            card.css('height', '670px');
            card.css('margin', 'auto');
            
            // Menghapus kelas 'active-button' dari semua tombol ikon
            $('#mobilebutton, #tabletbutton, #dekstopbutton').removeClass('active-button');
            // Menambahkan kelas 'active-button' pada tombol yang diklik
            $(this).addClass('active-button');
        });

        $('#tabletbutton').on('click', function() {
            var card = $('.content.card');
            card.css('width', '820px');
            card.css('height', '670px');
            card.css('margin', 'auto');
            
            // Menghapus kelas 'active-button' dari semua tombol ikon
            $('#mobilebutton, #tabletbutton, #dekstopbutton').removeClass('active-button');
            // Menambahkan kelas 'active-button' pada tombol yang diklik
            $(this).addClass('active-button');
        });

        $('#dekstopbutton').on('click', function() {
            dekstopsize();
            
            // Menghapus kelas 'active-button' dari semua tombol ikon
            $('#mobilebutton, #tabletbutton, #dekstopbutton').removeClass('active-button');
            // Menambahkan kelas 'active-button' pada tombol yang diklik
            $(this).addClass('active-button');
        });
    });

    </script>



    <script type="text/javascript">
        $('.form-container').on('click', '#upload_image_button', function(event) {
            event.preventDefault();

            var container = $(this).closest('.form-container');
            var file_frame = container.data('file_frame');

            if (!file_frame) {
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Pilih gambar',
                    button: {
                        text: 'Gunakan gambar ini'
                    },
                    multiple: false 
                });

                container.data('file_frame', file_frame);
            }

            file_frame.on('select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();
                container.find('#image-preview').attr('src', attachment.url);
                container.find('#image_attachment_id').val(attachment.id);
            });

            file_frame.open();
        });
    </script>

    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            $('.form-container').on('click', '#upload_bg_image_button', function(event) {
                event.preventDefault();

                var container = $(this).closest('.form-container');
                var bg_file_frame = container.data('bg_file_frame');

                if (!bg_file_frame) {
                    bg_file_frame = wp.media.frames.bg_file_frame = wp.media({
                        title: 'Pilih gambar latar belakang',
                        button: {
                            text: 'Gunakan gambar ini'
                        },
                        multiple: false
                    });

                    container.data('bg_file_frame', bg_file_frame);
                }

                bg_file_frame.on('select', function() {
                    var bg_attachment = bg_file_frame.state().get('selection').first().toJSON();
                    container.find('#bg-image-preview').attr('src', bg_attachment.url);
                    container.find('#bg_image_attachment_id').val(bg_attachment.id);
                });

            bg_file_frame.open();
            });
        });
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {
            var fieldCounter = 1; // To generate unique IDs for each field
            var accordionCounter = 1;
            // the function below is to foreach based on data in db
            function populateFormFields(savedData) {
                savedData.forEach(function(data) {
                    var additionalFields = $("#additional_fields");
                    var multiFormDiv = $("#multiple_form").clone();
                    var accordionId = "accordion_" + accordionCounter;
                    // Mengatur data-bs-target dan aria-controls untuk tombol accordion
                    multiFormDiv.find(".accordion-button").text("Image " + fieldCounter).attr({
                        "data-bs-target": "#" + accordionId,
                        "aria-controls": accordionId
                    });

                    multiFormDiv.find(".accordion-collapse").attr({
                        "id":  accordionId
                    });
                    
                    // Mengatur ID untuk accordion dan kontennya
                    multiFormDiv.find(".collapse").attr("id", accordionId);
                    

                    // Populate fields with saved data
                    multiFormDiv.find("input[name='title[]']").val(data.title);
                    multiFormDiv.find("textarea[name='desc[]']").val(data.desc);
                    multiFormDiv.find("input[name='link[]']").val(data.link);
                    multiFormDiv.find("input[name='button_link[]']").val(data.button_link);
                    multiFormDiv.find("input[name='image_attachment_id[]']").val(data.img);
                    multiFormDiv.find("input[name='bg_image_attachment_id[]']").val(data.bg_img);
                    multiFormDiv.find("input[name='id_img[]']").val(data.id_img);
                    // $('#settingImageForm').find("input[name='delay_popup']").val(data.delay_popup);

                    // Modify attributes and IDs of the cloned elements
                    multiFormDiv.find("input[name='title[]']").attr({
                        name: "title[]",
                        id: "field_title_" + fieldCounter
                    });

                    multiFormDiv.find("textarea[name='desc[]']").attr({
                        name: "desc[]",
                        id: "field_desc_" + fieldCounter
                    });

                    multiFormDiv.find("input[name='link[]']").attr({
                        name: "link[]",
                        id: "field_link_" + fieldCounter
                    });

                    multiFormDiv.find("input[name='button_link[]']").attr({
                        name: "button_link[]",
                        id: "field_button_link_" + fieldCounter
                    });

                    multiFormDiv.find("img[id='image-preview']").attr({
                        src: data.img_url
                    });

                    multiFormDiv.find("img[id='bg-image-preview']").attr({
                        src: data.bg_img_url
                    });

                    var br = $("<br>");
                    
                    var deleteButton = $("<button>")
                    .attr({
                        type: "submit",
                        id: "field_id_" + fieldCounter,
                        "data-id": data.id_img,
                        "data-title": data.title
                    })
                    .addClass("delete-button")
                    .text("Delete Field")
                    .click(function(event) {
                        // multiFormDiv.remove();
                        // br.remove();
                        event.preventDefault();

                        const id = $(this).data("id");
                        const title = $(this).data("title");
                        const url = `admin-post.php?action=delete_img&selected_slider=${id}&edit_id=<?php echo $_GET['id']; ?>`;

                        Swal.fire({
                            title: "Are you sure?",
                            text: `You won't be able to revert this for slider "${title}"!`,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "Cancel",
                            iconHtml: '<i class="fa fa-trash"></i>',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setTimeout(function() {
                                    window.location.href = url;
                                }, 1000);
                                // Show success alert immediately
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                            }
                        });
                    });

                    // Append the populated form fields
                    additionalFields.append(multiFormDiv);
                    multiFormDiv.find(".accordion-body").append(deleteButton);
                    additionalFields.append(br);
                    accordionCounter++; 
                
                    fieldCounter++;
                });
            }

            var savedData = [
                // Example saved data objects
                <?php foreach ($data_images as $key => $data) : ?>
                {   title: "<?php echo $data->title ?>",
                    desc: "<?php echo $string = trim(preg_replace('/\s+/', ' ', $data->desc)); ?>",
                    link: "<?php echo $data->link ?>", 
                    button_link: "<?php echo $data->button_link ?>", 
                    img: "<?php echo $data->img ?>", 
                    img_url: "<?php echo wp_get_attachment_url( $data->img ) ?>", 
                    bg_img_url: "<?php echo wp_get_attachment_url( $data->bg_img ) ?>", 
                    bg_img: "<?php echo $data->bg_img ?>",
                    id_img: "<?php echo $data->id_img ?>" },
                <?php endforeach; ?>
                // Add more saved data objects as needed
            ];

            <?php 
                $id_slider = $_GET['id']; 
                global $wpdb;
                $table_name = $wpdb->prefix . 'smt_img'; 
                $query = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE id_slider = %d", $id_slider);
                $count = $wpdb->get_var($query);
                $is_id_slider_exists = ($count > 0) ? $count : 0;
                
            ?>

            if (<?php echo $is_id_slider_exists ?>) {
                populateFormFields(savedData);
                $('#multiple_form').hide();
            } else {            
                $('#multiple_form').css('display', 'block');
            }

            
            let imageDiv = $("#multiple_form");

            imageDiv.find("img[id='image-preview']").attr({
                src: "https://lms.adhkediri.ac.id/resources/admin/uploads/default.jpg"
            });

            imageDiv.find("img[id='bg-image-preview']").attr({
                src: "https://lms.adhkediri.ac.id/resources/admin/uploads/default.jpg"
            });

            $("#add_field").click(function() {
                var additionalFields = $("#additional_fields");
                
                if (<?php echo $id_slider?>) {
                    $('#multiple_form').css('display', 'block');
                }
                
                var multiFormDiv = $("#multiple_form").clone(); // Clone the original div
                var accordionId = "accordion_" + accordionCounter;

                // Mengatur data-bs-target dan aria-controls untuk tombol accordion
                multiFormDiv.find(".accordion-button").text("Image " + fieldCounter).attr({
                        "data-bs-target": "#" + accordionId,
                        "aria-controls": accordionId
                    });

                // Mengatur ID untuk accordion dan kontennya
                multiFormDiv.find(".collapse").attr("id", accordionId);

                // Reset values of cloned input fields
                multiFormDiv.find("input[name='title[]']").val('');
                multiFormDiv.find("input[name='link[]']").val('');
                multiFormDiv.find("input[name='button_link[]']").val('');
                multiFormDiv.find("textarea[name='desc[]']").val('');
                multiFormDiv.find("img[name='image_attachment_id[]']").val('');

                // Modify attributes and IDs of the cloned elements
                multiFormDiv.find("input[name='title[]']").attr({
                    name: "title[]",
                    id: "field_title_" + fieldCounter
                });

                multiFormDiv.find("textarea[name='desc[]']").attr({
                    name: "desc[]",
                    id: "field_desc_" + fieldCounter
                });

                multiFormDiv.find("input[name='link[]']").attr({
                    name: "link[]",
                    id: "field_link_" + fieldCounter
                });

                multiFormDiv.find("input[name='button_link[]']").attr({
                    name: "button_link[]",
                    id: "field_button_link_" + fieldCounter
                });

                multiFormDiv.find("img[id='image-preview']").attr({
                    src: "https://lms.adhkediri.ac.id/resources/admin/uploads/default.jpg"
                });

                multiFormDiv.find("img[id='bg-image-preview']").attr({
                    src: "https://lms.adhkediri.ac.id/resources/admin/uploads/default.jpg"
                });

                var br = $("<br>");

                var deleteButton = $("<button>").attr({
                    type: "button"
                }).text("Delete Field").addClass("delete-button").click(function() {
                    multiFormDiv.remove(); // Remove the cloned div
                    br.remove();
                });
                
                additionalFields.append(multiFormDiv);
                multiFormDiv.find(".accordion-body").append(deleteButton);
                additionalFields.append(br);
                accordionCounter++; 

                fieldCounter++; // Increment the field counter for the next field

                if (<?php echo $id_slider?>) {
                    $('#multiple_form').css('display', 'none');
                }
            });

            // console.log(statusDiv);
            
            $('#submit').on('click', function() {
                let statusDiv = $('#multiple_form').css("display");
                if (statusDiv === "none"){
                    $('#multiple_form').remove();
                } 
            });


        
        });
    </script>

    <script>
    <?php
    // global $wpdb;
    // $table_smt_css = $wpdb->prefix . 'smt_style';
    // $data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
    // $css_data = json_decode($data->style_data, true);
    ?>

    document.addEventListener("DOMContentLoaded", function () {
        const borderOption = "<?php echo $css_data['border']; ?>";

        // Cari elemen radio button dengan ID yang sesuai
        var borderNoneInput = document.getElementById('border_none_input');
        var borderShowInput = document.getElementById('border_show_input');

        // Tentukan radio button mana yang harus dicentang berdasarkan nilai borderOption
        if (borderOption === 'none') {
            borderNoneInput.checked = true;
        } else if (borderOption === '1px solid #d2d2d2') {
            borderShowInput.checked = true;
        }
    });
</script>

<script>
/**
 *  Live preview for tpye popup
 *  
 */
$(document).ready(function() {
    let accordion = $('#additional_fields > #multiple_form');
    // console.log(accordion.length);  
    <?php
    $id = $_GET['id'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'smt_slider';
    $data_tipe_slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id"); 
    ?>
    let tipe_slider = "<?php echo $data_tipe_slider->type; ?>";
    
    for (let i=1; i <= accordion.length; i++){

        if(tipe_slider === "Popup"){
            $(`#field_title_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_title_${dynamicId} > :first-child`).text(newTitle);
            });
    
            $(`#field_desc_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_title_${dynamicId} > :nth-child(2)`).text(newTitle);
            });
    
            $(`#field_button_link_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_link_${dynamicId} > :first-child > :first-child`).text(newTitle);
            });

        } else if (tipe_slider === "Paralax") {
            $(`#field_title_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_title_${dynamicId} > :first-child`).text(newTitle);
            });
    
            $(`#field_desc_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_desc_${dynamicId} > :first-child`).text(newTitle);
            });
    
            $(`#field_button_link_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_desc_${dynamicId} > :nth-child(2)`).text(newTitle);
            });
        } else if (tipe_slider === "Square") {
            $(`#field_title_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_title_${dynamicId} > :first-child`).text(newTitle);
            });
    
            $(`#field_desc_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_desc_${dynamicId}`).text(newTitle);
            });
    
            $(`#field_button_link_${i}`).on("input", function() {
                var dynamicId = i;
                var newTitle = $(this).val();
        
                $(`#preview_link_${dynamicId} > :first-child :first-child`).text(newTitle);
            });

        }
        
    }

});

</script>

