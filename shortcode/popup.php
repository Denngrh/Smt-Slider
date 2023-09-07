<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortcode View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d367ac3a48.js" crossorigin="anonymous"></script>
    <script>
        <?php
        $delay = 3000;

        $title = "Lorem Ipsum Doloer Sit Amet!";
        $image = "https://images.unsplash.com/photo-1609017604163-e4ca9c619b9b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80";
        $paragraf = "Reprehenderit dolor irure in in incididunt eiusmod qui. Aliqua nisi laborum laboris adipisicing ea. Exercitation consequat ex fugiat magna esse aliqua.";
        $link = "https://youtube.com";

        $title2 = "Insert title here";
        $image2 = "https://images.unsplash.com/photo-1414609245224-afa02bfb3fda?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1889&q=80";
        $paragraf2 = "Reprehenderit dolor irure in in incididunt eiusmod qui. Aliqua nisi laborum laboris adipisicing ea. Exercitation consequat ex fugiat magna esse aliqua.";
        $link2 = "https://google.com";

        global $wpdb;
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $project_id");
        ?>
        jQuery(document).ready(function($) {
            setTimeout(() => {
                $('.row').css({
                    "visibility": "visible",
                    "opacity": "1"
                });

                // $('.popup-image').addClass('fade');
            }, <?php echo $delay ?>);

            $('.close-button').click(function() {
                $('.row').css({
                    "visibility": "hidden",
                    "opacity": "0"
                })
            });




        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            let slideIndex = 0;
            showSlides(slideIndex);

            $(".prev-button").click(function() {
                plusSlides(-1);
            });

            $(".next-button").click(function() {
                plusSlides(1);
            });

            $(".dot").click(function() {
                currentSlide($(this).index() + 1);
            });

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let i;
                let slides = $(".popup-image-container");
                let text = $(".text");
                let link = $(".link");
                let dots = $(".dot");

                if (n > slides.length) {
                    slideIndex = 1;
                }

                if (n < 1) {
                    slideIndex = slides.length;
                }

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

                const type2 = true;

                if (type2) {
                    const slides = $('.popup-image-container');

                    const backgroundURL = slides.eq(slideIndex - slides.length).data('background');
                    $('.popup-content').css({
                        'background-image': `url('${backgroundURL}')`,
                        "background-size": "cover",
                        "background-position": "center center",
                        "height": "50vh",
                    });

                    $('.percobaan').css({
                        "flex": "0"
                    });

                    $('.popup-image').remove();


                }

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
                padding: 10px;
                position: relative;
                margin-left: 25%;
                margin-right: 25%;
                border-radius: 15px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                text-align: center;
                display: flex;
                flex-direction: row;
            }

            .popup-image {
                max-height: 100%;
                border-radius: 15px !important;
                object-fit: cover;
                height: 75vh !important;
                width: 100%;

            }

            .percobaan {
                flex: 1;
                position: relative;
                display: inline-block;
                justify-content: center;
                align-items: center;

            }

            .popup-image-container {
                padding: 5px;
            }

            .popup-text-container {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                overflow: hidden;
                position: relative;
            }

            .close-button {
                position: absolute;
                cursor: pointer;
                top: 5px;
                right: 5px;
                height: 30px;
                width: 30px;
                font-size: 25;
                background: none;
                border: none;
                color: #000;
                padding: 0;
                transition: 0.3s ease;
                box-sizing: border-box;
                opacity: 0.5;
                z-index: 2;
            }

            .slider-buttons {
                position: absolute;
                top: 45%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                z-index: 1;
                pointer-events: none;

            }

            .next-button,
            .prev-button {
                background-color: <?php echo $css_data['control_bg'] ?>;
                color: <?php echo $css_data['control_color'] ?>;
                border: none;
                opacity: 0.3;
                padding: 8px 12px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 30px;
                pointer-events: auto;
                transition: 0.4s ease;
            }

            .next-button {
                margin-right: 18px;
            }

            .prev-button {
                margin-left: 10px;
            }

            .next-button:hover {
                opacity: 1;
                background-color: <?php echo $css_data['control_bg'] ?>;
            }

            .prev-button:hover {
                opacity: 1;
                background-color: <?php echo $css_data['control_bg'] ?>;

            }

            .close-button:hover {
                color: #000;
                background: none;
                opacity: 1;
            }

            .fade {
                animation-name: fade;
                animation-duration: 1s;
            }

            @keyframes fade {
                0% {
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }

            }

            .tombol {
                font-family: <?php echo $css_data['btn_fam'] ?>;
                color: <?php echo $css_data['btn_color'] ?>;
                background-color: <?php echo $css_data['btn_bg'] ?>;
                opacity: 0.5;
                margin-right: 5%;
                transition: 0.4s ease;

            }

            .tombol:hover {
                opacity: 1;
                color: <?php echo $css_data['btn_color_hvr'] ?>;
                background-color: <?php echo $css_data['btn_bg_hvr'] ?>;
            }

            a {
                text-decoration: none;
            }

            .link {
                margin: 10px;
            }

            .text h3 {
                font-family: <?php echo $css_data['title_fam'] ?>;
                color: <?php echo $css_data['title_color'] ?>;

                margin-bottom: 10px;
            }

            .text p {
                font-family: <?php echo $css_data['desc_fam'] ?>;
                color: <?php echo $css_data['desc_color'] ?>;

                margin-bottom: 10px;
            }

            .dot {
                cursor: pointer;
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
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
                background-color: #717171;
            }

            @media (max-width: 850px) {
                .popup-content {
                    margin-left: 10%;
                    margin-right: 10%;
                    background-color: yellow;
                }

                .popup-image {
                    height: 55vh;
                }
            }

            /* Media query for mobile screens */
            @media (max-width: 480px) {
                .popup-content {
                    margin: 5%;
                    background-color: red;
                }

                .popup-text-container {
                    padding: 4px;
                    /* Adjust padding for smaller screens */
                    margin-right: 4vw;
                }

                .popup-image {
                    height: 50vh;
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
                                        <h3><?php echo $data->title ?></h3>
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
                        <div class="percobaan">
                            <div class="popup-image-container">
                                <div class="slider-buttons">
                                    <button class="prev-button" onclick="plusSlides(-1)">&#8249;</button>
                                    <button class="next-button" onclick="plusSlides(1)">&#8250;</button>
                                </div>
                                <img src="<?php echo $image ?>" alt="inigambar" class="popup-image">
                            </div>

                            <div class="popup-image-container">
                                <div class="slider-buttons">
                                    <button class="prev-button">&#8249;</button>
                                    <button class="next-button">&#8250;</button>
                                </div>
                                <img src="<?php echo $image2 ?>" alt="inigambar" class="popup-image">
                            </div>

                            <div class="dot-div" style="text-align:center">
                                <span class="dot" onclick="currentSlide(0)"></span>
                                <span class="dot" onclick="currentSlide(1)"></span>
                            </div>
                        </div>
                        <div class="popup-text-container">
                            <button title="close" class="close-button">&times;</button>
                            <div class="popup-text">
                                <div class="text">
                                    <h3><?php echo $title ?></h3>
                                    <p><?php echo $paragraf ?></p>
                                </div>
                                <div class="link">
                                    <a href="<?php echo esc_url($link) ?>" target="_blank" rel="noopener noreferrer">
                                        <button type="button" class="tombol btn btn-dark">Click Me Now</button>
                                    </a>
                                </div>

                                <div class="text">
                                    <h3><?php echo $title2 ?></h3>
                                    <p><?php echo $paragraf2 ?></p>
                                </div>
                                <div class="link">
                                    <a href="<?php echo esc_url($link2) ?>" target="_blank" rel="noopener noreferrer">
                                        <button type="button" class="tombol btn btn-dark">Click Me Now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>