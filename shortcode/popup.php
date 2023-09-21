<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortcode View</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/d367ac3a48.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        <?php
        $delay = 3000;

        $title = "Doloer Sit Amet!";
        $image = "https://img.freepik.com/premium-photo/backdrop-characterized-by-abstract-lines_931878-84467.jpg";
        $paragraf = "Kelola kehadiran, perjalanan bisnis, perizinan, sampai reimburse di satu aplikasi absensi cocok untuk UMKM di berbagai industri.";
        $link = "https://youtube.com";

        $title2 = "Insert title here";
        $image2 = "https://img.freepik.com/free-photo/black-empty-circle-wavy-layers-red-background_23-2148629466.jpg?size=626&ext=jpg";
        $paragraf2 = "Reprehenderit dolor irure in in incididunt eiusmod qui. Aliqua nisi laborum laboris adipisicing ea. Exercitation consequat ex fugiat magna esse aliqua.";
        $link2 = "https://google.com";

        global $wpdb;
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $table_name = $wpdb->prefix . 'smt_slider';
        $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $project_id");
        $data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $project_id");

        ?>
        jQuery(document).ready(function($) {
            setTimeout(() => {
                $('.row').css({
                    "visibility": "visible",
                    "opacity": "1"
                });

                // $('.popup-image').addClass('fade');
            }, <?php echo $data->delay_popup ?>);

            $('.close-button').click(function() {
                $('.row').css({
                    "visibility": "hidden",
                    "opacity": "0"
                })
            });

            // let img = $('.link');
            // img = img.eq(1).attr('data-image');
            // $('.popup-content').css({'background-image': `url(${img})`})

        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            let slideIndex = 0;
            showSlides(slideIndex);

            $(".caret-right").click(function() {
                plusSlides(-1);

            });

            $(".caret-left").click(function() {
                plusSlides(1);

            });

            $(".dot").click(function() {
                let dot_num = $(this).index() + 1; 
                console.log(dot_num);
                currentSlide(dot_num);
            });

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let i;
                let slides = $(".slides");
                let text = $(".text");
                let link = $(".link");
                let dots = $(".dot");

                if (n > slides.length) {
                    slideIndex = 1;
                }

                if (n < 1) {
                    slideIndex = slides.length;
                }

                let img = $('.link');
                img = img.eq(slideIndex - slides.length).attr('data-image');
                $('.popup-content').css({'background-image': `url(${img})`})


                for (i = 0; i < slides.length; i++) {
                    slides.eq(i).css("display", "none");
                    text.eq(i).css("display", "none");
                    link.eq(i).css("display", "none");
                }

                for (i = 0; i < dots.length; i++) {
                    dots.eq(i).removeClass("active");
                }

                slides.eq(slideIndex - slides.length).css("display", "block");
                text.eq(slideIndex - slides.length).css("display", "block");
                link.eq(slideIndex - slides.length).css("display", "block");
                dots.eq(slideIndex - slides.length).addClass("active");

            }
        });
    </script>

    <?php
    global $wpdb;
    $table_smt_css = $wpdb->prefix . 'smt_style';
    $data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $project_id ");
    $css_data = json_decode($data->style_data, true); {
    ?>

        <style>
            .row {
                visibility: hidden;
                opacity: 0;
                transition: 0.3s ease;
            }

            .custom-popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                margin-left: auto;
                margin-right: auto;
                z-index: 999;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .popup-content {
                background-color: #fff;
                background-image: url('https://img.freepik.com/free-photo/abstract-background-blue-wallpaper-image_53876-108341.jpg?w=996&t=st=1695195401~exp=1695196001~hmac=6b2b45ea90321eda78cd0215461948dbd8c2a85ef10d9ba4fe035c9c48245302');
                background-size: 100% 100%;
                padding: 20px;
                position: relative;
                /* margin-left: 25%;
                margin-right: 25%; */
                width: 500px;
                height: 500px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                display: flex;
                flex-direction: row;
            }

            .percobaan {
                flex: 1;
                position: relative;
                display: inline-block;
                justify-content: center;
                align-items: center;

            }

            .popup-text-container {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: left;
                position: relative;
                top: 50px;
                margin: 0;
            }

            .close-button {
                position: absolute;
                cursor: pointer;
                top: 20px;
                left: 490px;
                height: 30px;
                width: 30px;
                font-size: 24px;
                background: none;
                border: none;
                color: #000;
                padding: 0;
                transition: 0.3s ease;
                box-sizing: border-box;
                opacity: 1;
                z-index: 10;
            }

            .close-button > svg > path {
                fill: #000;
            }

            .close-button:hover {
                color: black;
                background: none;
                opacity: 1;
            }

            .tombol {
                font-family: <?php echo $css_data['btn_fam'] ?>;
                color: <?php echo $css_data['btn_color'] ?>;
                background-color: <?php echo $css_data['btn_bg'] ?>;
                /* width: 59px;
                height: 23px; */
                transition: 0.4s ease;
                font-weight: 400;
                padding: 4px 12px;
                border-radius: 4px;
                font-size: 11px;
                width: 10%;
                margin-top: 1px;
                text-align: center;
                letter-spacing: normal;
                line-height: normal;
                gap: 10px;
            }

            .tombol:hover {
                color: <?php echo $css_data['btn_color_hvr'] ?>;
                background-color: <?php echo $css_data['btn_bg_hvr'] ?>;
            }


            .caret-right {
                z-index: 10;
                position: absolute;
                top: 230px;
                left: 490px;
                width: 40px;
                height: 40px;

                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .caret-left {
                z-index: 10;
                position: absolute;
                top: 230px;
                left: 10px;
                width: 40px;
                height: 40px;

                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .div-4 {
                display: inline-flex;
                align-items: flex-start;
                gap: 4px;
                position: absolute;
                top: 500px;
                left: 50%;
            }

            .ellipse {
                background-color: #5d5c5c;
                position: relative;
                width: 8px;
                height: 8px;
                border-radius: 4px;
            }

            .ellipse-2 {
                background-color: #eeeeee;
                position: relative;
                width: 8px;
                height: 8px;
                border-radius: 4px;
            }

            a {
                text-decoration: none !important;
            }

            .text {
                padding: 8px 0;
            }

            .text-wrapper-1 {
                font-family: <?php echo $css_data['title_fam'] ?>;
                color: <?php echo $css_data['title_color'] ?>;
                font-size: 38px !important;
                font-weight: 800;
                padding: 8px 0;
            }

            .text-wrapper-2 {
                font-family: <?php echo $css_data['desc_fam'] ?>;
                color: <?php echo $css_data['desc_color'] ?>;
                line-height: normal;
                font-size: 11px;
                overflow: hidden;

            }

            .dot {
                cursor: pointer;
                background-color: #5d5c5c;
                transition: background-color 0.6s ease;
            }

            .dot-div {
                text-align: center;
                position: absolute;
                bottom: 10px;
                /* Adjust this value to control the vertical position */
                left: 50%;
                transform: translateX(-50%);
                z-index: 1;
                /* Ensure dots are in front of images */
            }

            .active,
            .dot:hover {
                background-color: <?php echo $css_data['dots_bg_active'] ?>;
            }

            @media (max-width: 850px) {
                .popup-content {
                    margin-left: 10%;
                    margin-right: 10%;
                }

                .popup-image {
                    height: 55vh;
                }
            }

            /* Media query for mobile screens */
            @media (max-width: 480px) {
                .popup-content {
                    margin: 5%;
                }

                .popup-text-container {
                    padding: 2px;
                    /* Adjust padding for smaller screens */
                    margin-right: 0;
                }

                .popup-image {
                    height: 50vh;
                }

                .next-button,
                .prev-button {
                    font-size: 20px;
                }

                .text p {
                    max-height: 30vh;
                    overflow: scroll;
                }

            }
        </style>
    <?php } ?>
</head>

<body>
    <?php
    // check jika data dari table ada pada kondisi true
    if (!empty($latest_data)) { ?>
        <div class="row">
            <div class="col">
                <div class="custom-popup">
                    <div class="popup-content">
                        <button title="close" class="close-button"><i class="fa-solid fa-x"></i></button>
                        <div class="percobaan">
                            <?php foreach ($latest_data as $index => $data) : ?>
                                <div class="popup-image-container">
                                    <div class="slider-buttons">
                                        <button class="prev-button">&#8249;</button>
                                        <button class="next-button">&#8250;</button>
                                    </div>
                                    <img src="<?php echo wp_get_attachment_url($data->img) ?>" data-background="<?php echo wp_get_attachment_url($data->img) ?>" alt="inigambar" class="popup-image">
                                </div>
                            <?php endforeach; ?>
                            <div class="dot-div" style="text-align:center">
                                <?php foreach ($latest_data as $index => $data) : ?>
                                    <span class="dot" onclick="currentSlide(<?php echo $index ?>)"></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="popup-text-container">
                            <div class="popup-text">
                                <?php foreach ($latest_data as $index => $data) : ?>
                                    <div class="text">
                                        <<?php echo $css_data['title_size']; ?>><?php echo $data->title ?></<?php echo $css_data['title_size']; ?>>
                                        <p><?php echo $data->desc ?></p>
                                    </div>
                                    <div class="link">
                                        <a href="<?php echo esc_url($data->link) ?>" target="_blank" rel="noopener noreferrer">
                                            <button type="button" class="tombol btn btn-dark">Click Me Now</button>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col">
                <div class="custom-popup">
                    <div class="popup-content">
                        <div class="popup-text-container">
                            <div class="popup-text">
                                <div class="text">
                                    <div class="text-wrapper-1"><?php echo $title ?></div>
                                    <div class="text-wrapper-2"><?php echo $paragraf ?></div>
                                </div>
                                <div class="link" data-id="0" data-image="https://img.freepik.com/premium-photo/backdrop-characterized-by-abstract-lines_931878-84467.jpg">
                                    <a href="<?php echo esc_url($link) ?>" target="_blank" rel="noopener noreferrer">
                                        <div type="button" class="tombol">Pelajari</div>
                                    </a>
                                </div>

                                <div class="text" >
                                    <div class="text-wrapper-1"><?php echo $title2 ?></div>
                                    <div class="text-wrapper-2"><?php echo $paragraf2 ?></div>
                                </div>
                                <div class="link" data-id="1" data-image="https://img.freepik.com/free-photo/black-empty-circle-wavy-layers-red-background_23-2148629466.jpg?size=626&ext=jpg">
                                    <a href="<?php echo esc_url($link2) ?>" target="_blank" rel="noopener noreferrer">
                                        <div type="button" class="tombol">Tekan</div>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <button title="close" class="close-button"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.2807 14.2193C15.3504 14.289 15.4056 14.3717 15.4433 14.4628C15.4811 14.5538 15.5005 14.6514 15.5005 14.7499C15.5005 14.8485 15.4811 14.9461 15.4433 15.0371C15.4056 15.1281 15.3504 15.2109 15.2807 15.2806C15.211 15.3502 15.1283 15.4055 15.0372 15.4432C14.9462 15.4809 14.8486 15.5003 14.7501 15.5003C14.6515 15.5003 14.5539 15.4809 14.4629 15.4432C14.3718 15.4055 14.2891 15.3502 14.2194 15.2806L8.00005 9.06024L1.78068 15.2806C1.63995 15.4213 1.44907 15.5003 1.25005 15.5003C1.05103 15.5003 0.860156 15.4213 0.719426 15.2806C0.578695 15.1398 0.499634 14.949 0.499634 14.7499C0.499634 14.5509 0.578695 14.36 0.719426 14.2193L6.93974 7.99993L0.719426 1.78055C0.578695 1.63982 0.499634 1.44895 0.499634 1.24993C0.499634 1.05091 0.578695 0.860034 0.719426 0.719304C0.860156 0.578573 1.05103 0.499512 1.25005 0.499512C1.44907 0.499512 1.63995 0.578573 1.78068 0.719304L8.00005 6.93962L14.2194 0.719304C14.3602 0.578573 14.551 0.499512 14.7501 0.499512C14.9491 0.499512 15.1399 0.578573 15.2807 0.719304C15.4214 0.860034 15.5005 1.05091 15.5005 1.24993C15.5005 1.44895 15.4214 1.63982 15.2807 1.78055L9.06036 7.99993L15.2807 14.2193Z" fill="white" />
                            </svg></button>

                        <div class="slides">
                            <div class="caret-right"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3843 14.8843L2.88434 27.3843C2.7682 27.5005 2.63032 27.5926 2.47858 27.6555C2.32684 27.7183 2.16421 27.7507 1.99996 27.7507C1.83572 27.7507 1.67308 27.7183 1.52134 27.6555C1.3696 27.5926 1.23172 27.5005 1.11559 27.3843C0.999449 27.2682 0.907324 27.1303 0.844471 26.9786C0.781617 26.8268 0.749268 26.6642 0.749268 26.5C0.749268 26.3357 0.781617 26.1731 0.844471 26.0213C0.907324 25.8696 0.999449 25.7317 1.11559 25.6156L12.7328 14L1.11559 2.38434C0.881036 2.14979 0.749268 1.83167 0.749268 1.49996C0.749268 1.16826 0.881036 0.850138 1.11559 0.615588C1.35014 0.381037 1.66826 0.249268 1.99996 0.249268C2.33167 0.249268 2.64979 0.381037 2.88434 0.615588L15.3843 13.1156C15.5006 13.2317 15.5928 13.3695 15.6557 13.5213C15.7186 13.673 15.7509 13.8357 15.7509 14C15.7509 14.1642 15.7186 14.3269 15.6557 14.4786C15.5928 14.6304 15.5006 14.7682 15.3843 14.8843Z" fill="white" fill-opacity="0.62" />
                                </svg></div>
                            <div class="caret-left"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8844 25.6156C15.0005 25.7317 15.0926 25.8696 15.1555 26.0213C15.2184 26.1731 15.2507 26.3357 15.2507 26.5C15.2507 26.6642 15.2184 26.8268 15.1555 26.9786C15.0926 27.1303 15.0005 27.2682 14.8844 27.3843C14.7682 27.5005 14.6304 27.5926 14.4786 27.6555C14.3269 27.7183 14.1643 27.7507 14 27.7507C13.8358 27.7507 13.6731 27.7183 13.5214 27.6555C13.3696 27.5926 13.2318 27.5005 13.1156 27.3843L0.615631 14.8843C0.499411 14.7682 0.407213 14.6304 0.344307 14.4786C0.281402 14.3269 0.249023 14.1642 0.249023 14C0.249023 13.8357 0.281402 13.673 0.344307 13.5213C0.407213 13.3695 0.499411 13.2317 0.615631 13.1156L13.1156 0.615588C13.3502 0.381037 13.6683 0.249268 14 0.249268C14.3317 0.249268 14.6498 0.381037 14.8844 0.615588C15.1189 0.850138 15.2507 1.16826 15.2507 1.49996C15.2507 1.83167 15.1189 2.14979 14.8844 2.38434L3.26719 14L14.8844 25.6156Z" fill="white" fill-opacity="0.62" />
                                </svg></div>
                        </div>

                        <div class="slides">
                            <div class="caret-right"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3843 14.8843L2.88434 27.3843C2.7682 27.5005 2.63032 27.5926 2.47858 27.6555C2.32684 27.7183 2.16421 27.7507 1.99996 27.7507C1.83572 27.7507 1.67308 27.7183 1.52134 27.6555C1.3696 27.5926 1.23172 27.5005 1.11559 27.3843C0.999449 27.2682 0.907324 27.1303 0.844471 26.9786C0.781617 26.8268 0.749268 26.6642 0.749268 26.5C0.749268 26.3357 0.781617 26.1731 0.844471 26.0213C0.907324 25.8696 0.999449 25.7317 1.11559 25.6156L12.7328 14L1.11559 2.38434C0.881036 2.14979 0.749268 1.83167 0.749268 1.49996C0.749268 1.16826 0.881036 0.850138 1.11559 0.615588C1.35014 0.381037 1.66826 0.249268 1.99996 0.249268C2.33167 0.249268 2.64979 0.381037 2.88434 0.615588L15.3843 13.1156C15.5006 13.2317 15.5928 13.3695 15.6557 13.5213C15.7186 13.673 15.7509 13.8357 15.7509 14C15.7509 14.1642 15.7186 14.3269 15.6557 14.4786C15.5928 14.6304 15.5006 14.7682 15.3843 14.8843Z" fill="white" fill-opacity="0.62" />
                                </svg></div>
                            <div class="caret-left"><svg width="16" height="28" viewBox="0 0 16 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8844 25.6156C15.0005 25.7317 15.0926 25.8696 15.1555 26.0213C15.2184 26.1731 15.2507 26.3357 15.2507 26.5C15.2507 26.6642 15.2184 26.8268 15.1555 26.9786C15.0926 27.1303 15.0005 27.2682 14.8844 27.3843C14.7682 27.5005 14.6304 27.5926 14.4786 27.6555C14.3269 27.7183 14.1643 27.7507 14 27.7507C13.8358 27.7507 13.6731 27.7183 13.5214 27.6555C13.3696 27.5926 13.2318 27.5005 13.1156 27.3843L0.615631 14.8843C0.499411 14.7682 0.407213 14.6304 0.344307 14.4786C0.281402 14.3269 0.249023 14.1642 0.249023 14C0.249023 13.8357 0.281402 13.673 0.344307 13.5213C0.407213 13.3695 0.499411 13.2317 0.615631 13.1156L13.1156 0.615588C13.3502 0.381037 13.6683 0.249268 14 0.249268C14.3317 0.249268 14.6498 0.381037 14.8844 0.615588C15.1189 0.850138 15.2507 1.16826 15.2507 1.49996C15.2507 1.83167 15.1189 2.14979 14.8844 2.38434L3.26719 14L14.8844 25.6156Z" fill="white" fill-opacity="0.62" />
                                </svg></div>
                        </div>


                        <div class="div-4">
                            <div class="ellipse dot" onclick="currentSlide(0); "></div>
                            <div class="ellipse dot" onclick="currentSlide(1); "></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>