<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<?php
global $wpdb;
$table_smt_css = $wpdb->prefix . 'smt_style';
$data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $project_id ");
$css_data = json_decode($data->style_data, true);{
?>
  <style>
        .title_slide {
            font-family: <?php echo $css_data['title_fam']; ?>;
            color: <?php echo $css_data['title_color']; ?>;
        }

        .description {
            font-family: <?php echo $css_data['desc_fam']; ?>;
            color: <?php echo $css_data['desc_color']; ?>;
            position: relative;
            margin: auto;
        }

        #dots {
            display: inline;
        }

        #more {
            display: none;
        }

        #readMoreLink {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        #readMoreLink:hover {
            color: navy;
        }

        .btn-custom {
            font-family: <?php echo $css_data['btn_fam']; ?>;
            color: <?php echo $css_data['btn_color']; ?>;
            background-color: <?php echo $css_data['btn_bg']; ?>;
            border: none;
            padding: 7px;
            border-radius: 10px;
        }

        .btn-custom:hover {
            color: <?php echo $css_data['btn_color_hvr']; ?>;
            background-color: <?php echo $css_data['btn_bg_hvr']; ?>;
        }

        .carousel-indicators [data-bs-target] {
            width: 7px;
            height: 7px;
            border-radius: 100%;
            background-color: <?php echo $css_data['dots_bg']; ?> !important;
        }

        .carousel-indicators .active {
            background-color: <?php echo $css_data['dots_bg_active']; ?> !important;
        }

        .custom-carousel-button {
            position: absolute;
            border: none;
            top: 160px;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
        }

        .custom-carousel-icon {
            color: <?php echo $css_data['control_color']; ?> !important;
            ;
            font-size: 28px;
        }

        .custom-carousel-button.prev {
            left: 70px;
        }

        .custom-carousel-button.next {
            right: 70px;
        }

        .link {
            margin: 10px;
        }

        .show-more {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            padding: 0 5px;
        }

        @media (max-width: 767px) {
            .custom-carousel-button {
                display: none;
            }
        }
    </style>
<?php
}
?>

<body>
    <form method='post'>
        <?php
        global $wpdb;
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $project_id ");
        if (!empty($data_images)) {
        ?>
            <div class="mx-auto">
                <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4">
                    <div class="carousel-indicators">
                        <?php foreach ($data_images as $index => $data) : ?>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $index ?>" <?= $index === 0 ? 'class="active"' : '' ?> aria-label="Slide <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($data_images as $index => $data) : ?>
                            <div class="carousel-item<?= $index === 0 ? ' active' : '' ?>" data-bs-interval="">
                                <img id='image-preview' src='<?= wp_get_attachment_url($data->img) ?>' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                                <div class="d-md-block text-center mb-5 mt-4">
                                    <h3 class="title_slide"><?= $data->title; ?></h3>
                                    <div class="description col-md-6">
                                    <?php
                                    $desc = $data->desc;
                                    $desc_words = explode(" ", $desc);
                                    if (count($desc_words) > 16) {
                                        $short_desc = implode(" ", array_slice($desc_words, 0, 16));
                                        $remaining_desc = implode(" ", array_slice($desc_words, 16));
                                        echo $short_desc;
                                    ?>
                                        <span id="dots">...</span>
                                        <span id="more" style="display: none;"><?php echo $remaining_desc; ?></span>
                                        <a id="readMoreLink" href="#" onclick="toggleDescription(); return false;">Read More</a>
                                    <?php
                                    } else {
                                        echo $desc;
                                    }
                                    ?>
                                </div>

                                    <div class="link">
                                        <?php if (!empty($data->link)) : ?>
                                            <a href="<?= $data->link; ?>" target="_blank">
                                                <button type="button" class="btn-custom">Click Me Now</button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev custom-carousel-button prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="custom-carousel-icon" aria-hidden="true">
                            < 
                        </span>
                                <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next custom-carousel-button next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="custom-carousel-icon" aria-hidden="true"> > </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        <?php
        } else {
            //example else
        ?>
            <div class="mx-auto">
                <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="">
                            <img id='image-preview' src='https://github.com/Denngrh/smt-slider/assets/112230212/6cf04d3c-c81f-4fcc-9174-5222e5265cf9' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="Logo Smooets">
                            <div class="d-md-block text-center mb-5 mt-4">
                                <h3>Example Title 1</h3>
                                <p>This is an example description for slide 1.</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="">
                            <img id='image-preview' src='path_to_example_image2.jpg' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                            <div class="d-md-block text-center mb-5 mt-4">
                                <h3>Example Title 2</h3>
                                <p>This is an example description for slide 2.</p>
                            </div>
                        </div>
                        <button class="carousel-control-prev custom-carousel-button prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon custom-carousel-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next custom-carousel-button next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon custom-carousel-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            <?php
        }
            ?>
    </form>
</body>
<script>
    function toggleDescription() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var readMoreLink = document.getElementById("readMoreLink");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            readMoreLink.innerHTML = "Read More";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            readMoreLink.innerHTML = "Read Less";
            moreText.style.display = "inline";
        }
    }
</script>
</html>