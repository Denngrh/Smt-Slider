<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

    #readMore {
        display: inline-block;
        color: blue;
    }

    #readLess {
        display: none;
        color: blue;
    }

    #readMore:hover,
    #readLess:hover {
        color: navy;
        cursor: pointer;
        text-decoration: underline;
    }

    #moreText {
        display: none;
    }

    .link {
        margin: 10px;
    }

    .description {
        max-height: 2.5em;
        /* Batasi tinggi tampilan teks */
        overflow: hidden;
        /* Sembunyikan konten yang tidak muat */
        position: relative;
        /* Diperlukan untuk menampilkan teks tambahan */
    }

    .show-more {
        position: absolute;
        bottom: 0;
        right: 0;
        background: white;
        padding: 0 5px;
    }

    @media (width: 260px) and (height: 503px) {
        .custom-carousel-button {
            position: absolute;
            top: 160px;
            transform: translateY(-50%);
        }

        .custom-carousel-button.prev {
            left: 50px;
        }

        .custom-carousel-button.next {
            right: 50px;
        }
    }
</style>

<body>
    <form method='post'>
        <?php
        global $wpdb;
        $table_smt_img = $wpdb->prefix . 'smt_img';
        $id = $_GET['id'];
        $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ");
        if (!empty($data_images)) {
        ?>
            <div class="mx-auto">
                <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($data_images as $index => $data) : ?>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $index ?>" <?= $index === 0 ? 'class="active"' : '' ?> aria-label="Slide <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($data_images as $index => $data) : ?>
                            <div class="carousel-item<?= $index === 0 ? ' active' : '' ?>" data-bs-interval="1000">
                                <img id='image-preview' src='<?= wp_get_attachment_url($data->img) ?>' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                                <div class="d-md-block text-center mb-5 mt-4">
                                    <h3><?= $data->title; ?></h3>
                                    <div class="description col-md-5" style="margin: auto;">
                                        <p><?= $data->desc; ?></p>
                                        <?php if (str_word_count($data->desc) > 30) : ?>
                                            <div class="show-more">
                                                <a href="#" onclick="toggleDescription(this); return false;">Read More</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="link">
                                        <?php if (!empty($data->link)) : ?>
                                            <a href="<?= $data->link; ?>" target="_blank">
                                                <button type="button" class="btn btn-primary">Click Me Now</button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="carousel-control-prev custom-carousel-button prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next custom-carousel-button next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        <?php
        } else {
            //example else
        ?>
            <div class="mx-auto">
                <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="1000">
                            <img id='image-preview' src='https://www.gstatic.com/meet/meet_google_one_carousel_promo_icon_0f14bf8fc61484b019827c071ed8111d.svg' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                            <div class="d-md-block text-center mb-5 mt-4">
                                <h3>Example Title 1</h3>
                                <p>This is an example description for slide 1.</p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="1000">
                            <img id='image-preview' src='path_to_example_image2.jpg' class="img-fluid mx-auto d-block" style="border-radius: 50%; width: 330px; height: 330px;" alt="...">
                            <div class="d-md-block text-center mb-5 mt-4">
                                <h3>Example Title 2</h3>
                                <p>This is an example description for slide 2.</p>
                            </div>
                        </div>
                        <button class="carousel-control-prev custom-carousel-button prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next custom-carousel-button next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
    function toggleDescription(element) {
        var description = element.parentNode.parentNode;
        description.classList.toggle('expanded');
        if (description.classList.contains('expanded')) {
            element.innerHTML = 'Read Less';
            description.style.maxHeight = 'none';
        } else {
            element.innerHTML = 'Read More';
            description.style.maxHeight = '2.5em'; // Ubah sesuai dengan nilai max-height di CSS
        }
    }
</script>

</html>