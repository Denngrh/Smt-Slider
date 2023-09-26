<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page View</title>
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
        $id = $_GET['id'];
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id");

        $table_name = $wpdb->prefix . 'smt_slider';
        $smt_slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    
        ?>
    </script>

<script>
        jQuery(document).ready(function($) {
            let slideIndex = 0;
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
    if ($smt_slider->popup_style == 1){
        include 'popup_component/css/popup_css_style_1.php';
    } else if ($smt_slider->popup_style == 2){
        include 'popup_component/css/popup_css_style_2.php';
    } else if ($smt_slider->popup_style == 3) {
        include 'popup_component/css/popup_css_style_3.php';
    } else {
        include 'popup_component/css/popup_css_style_1.php';
    }

    ?>
</head>

<body>
    <?php 
    if ($smt_slider->popup_style == 1){
        include 'popup_component/html/popup_html_style_1.php';
    } else if ($smt_slider->popup_style == 2){
        include 'popup_component/html/popup_html_style_2.php';
    } else if ($smt_slider->popup_style == 3) {
        include 'popup_component/html/popup_html_style_3php';
    } else {
        include 'popup_component/html/popup_html_style_default.php';
    }
    ?>

</body>

</html>