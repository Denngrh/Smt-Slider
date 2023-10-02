<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/d367ac3a48.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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
    $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $project_id");
    $table_name = $wpdb->prefix . 'smt_slider';
    $smt_slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $project_id");
    ?>
    <script>
        jQuery(document).ready(function($) {
            setTimeout(() => {
                $('.custom-popup').css({
                    "visibility": "visible",
                    "opacity": "1",
                    "transition": "0.3s ease"
                });
            }, <?php echo $smt_slider->delay_popup ?>);

            $('.close-button').click(function() {
                $('.custom-popup').css({
                    "visibility": "hidden",
                    "opacity": "0",
                    "transition": "0.3s ease"
                })
            });
        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            let slideIndex = 0;
            let delayPerPopup = <?php echo $smt_slider->delay_per_popup ?>;
            showSlides(slideIndex);

            $(".caret-left").click(function() {
                plusSlides(-1);

            });

            $(".caret-right").click(function() {
                plusSlides(1);

            });

            $(".dot").click(function() {
                let dot_num = $(this).index() + 1;
                console.log(dot_num);
                currentSlide(dot_num);
            });

            function autoSlide() {
                plusSlides(1);
            }

            if (delayPerPopup != 0 ) {
                setInterval(autoSlide, delayPerPopup);
            }


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
                $('.popup-content').css({
                    'background-image': `url(${img})`
                })


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
    $style1 = 'popup_component/css/popup_css_style_1.php';
    $style2 = 'popup_component/css/popup_css_style_2.php';
    $style3 = 'popup_component/css/popup_css_style_3.php';

    if (!empty($latest_data)){
        if ($smt_slider->popup_style == 2){
            include $style2;
        } else if ($smt_slider->popup_style == 3) {
            include $style3;
        } else {
            include 'popup_component/css/popup_css_style_1.php';
        }
    } else if ($smt_slider->popup_style == 2){
        include $style2;
    } else if ($smt_slider->popup_style == 3){
        include $style3;
    } else {
        include 'popup_component/css/popup_css_style_1.php';
    }
    ?>
</head>

<body>
    <?php         
    $html1 = 'popup_component/html/popup_html_style_1.php';
    $html2 = 'popup_component/html/popup_html_style_2.php';
    $html3 = 'popup_component/html/popup_html_style_3.php';

    if (!empty($latest_data)){
        if ($smt_slider->popup_style == 2){
            include $html2;
        } else if ($smt_slider->popup_style == 3) {
            include $html3;
        } else {
            include $html1;
        }
    } else if ($smt_slider->popup_style == 2) {
        include 'popup_component/default/style_2.php';
    } else if ($smt_slider->popup_style == 3){
        include 'popup_component/default/style_3.php';
    } else {
        include 'popup_component/default/style_1.php';
    }
    ?>
</body>

</html>