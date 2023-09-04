<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Popup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        <?php
        $delay = 3000;
        $content = "Discount 50% For All Members";
        $image = "https://images.unsplash.com/photo-1609017604163-e4ca9c619b9b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80";
        $paragraf = "Reprehenderit dolor irure in in incididunt eiusmod qui. Aliqua nisi laborum laboris adipisicing ea. Exercitation consequat ex fugiat magna esse aliqua.";

        global $wpdb;
        $id = $_GET['id'];
        $table_smt_img = $wpdb->prefix . 'smt_img';
        // $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ORDER BY id_img DESC LIMIT 1");
        $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id");

        ?>
        const type2 = false;

        jQuery(document).ready(function($) {
            if (type2) {
                $('.popup-content').css({
                    "background-image": "url('<?php echo wp_get_attachment_url($latest_data[0]->img); ?>')",
                    "background-size": "cover",
                    "background-position": "center center",
                    "height": "50vh",
                });

                $('.popup-image-container').css({
                    "flex": "0"
                });

                $('.popup-image').remove();
            }
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            let slideIndex = 0;
            showSlides(slideIndex);

            $(".prev-button").click(function() {
                plusSlides(-1);
            });

            $(".next-button").click(function() {
                plusSlides(1);
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

                if (n > slides.length) {
                    slideIndex = 1;
                }

                if (n < 1) {
                    slideIndex = slides.length;
                }

                for (i = 0; i < slides.length; i++) {
                    slides.eq(i).css("display", "none");
                    text.eq(i).css("display", "none");
                }

                slides.eq(slideIndex - 1).css("display", "block");
                text.eq(slideIndex - 1).css("display", "block");
            }
        });
    </script>

    <style>
        /* .custom-popup {
            position: none;
            top: 0;
            left: 0;
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
        } */
        .custom-popup {
            width: 85%;
            background-color: rgba(0, 0, 0, 0.5);
            margin-left: auto;
            margin-right: auto;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* .popup-content {
            background-color: #fff;
            padding: 20px;
            background-image: url("https://pbs.twimg.com/media/F2yG5s5bcAATtoc?format=jpg&name=large");
            background-size: cover;
            height: 500px;
            position: relative;
            margin-left: 25%;
            margin-right: 25%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-bottom: 20px;
            display: flex;

        } */
        .popup-content {
            background-color: #fff;
            padding: 10px;
            position: relative;
            /* margin-left: 25%;
            margin-right: 25%; */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            /* margin-bottom: 20px; */
            display: flex;
            flex-direction: row;
        }

        .popup-image {
            max-height: 100%;
            border-radius: 15px;
            object-fit: cover;
            height: 75vh;
            width: 100%;
            /* max-width: 100%; */

            transition: transform 0.5s ease-in-out;
        }



        .popup-image-container {
            flex: 1;
            padding: 5px;
            /* Add padding as needed */

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-text-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* padding: 10px; */

            overflow: hidden;
            position: rela;
        }

        .close-button {
            position: absolute;
            cursor: pointer;
            top: 5px;
            right: 5px;
            font-size: 30px;
            background: none;
            border: none;
            color: #000;
            padding: 0;
            box-sizing: border-box;
        }

        .next-button,
        .prev-button {
            background-color: #333;
            /* Background color */
            color: #fff;
            /* Text color */
            border: none;
            /* Remove border */
            padding: 8px 12px;
            /* Padding for the button */
            border-radius: 5px;
            /* Rounded corners */
            cursor: pointer;
            font-size: 20px;
            /* Font size */
        }

        .next-button {
            right: 0;
        }

        .prev-button {
            left: 0;
        }

        .close-button:hover {
            color: white;
            background: none;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .jarak {
            margin-right: 5%;
        }

        a {
            text-decoration: none;
        }

        .link {
            margin: 10px;
        }

        .popup-text h3 {
            margin-bottom: 10px;
        }

        .popup-text p {
            margin-bottom: 10px;
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
</head>

<body>
    <?php
    // check jika data dari table ada pada kondisi true
    if (!empty($latest_data)) { ?>
        <div class="row">
            <div class="col">
                <div class="custom-popup">
                    <div class="popup-content">
                        <?php foreach ($latest_data as $index => $data) : ?>
                            <div class="popup-image-container">
                                <img src="<?php echo wp_get_attachment_url($data->img) ?>" alt="inigambar" class="popup-image">
                            </div>
                        <?php endforeach; ?>
                        <div class="popup-text-container">
                            <button title="close" class="close-button">&times;</button>
                            <div class="popup-text">
                                <?php foreach ($latest_data as $index => $data) : ?>
                                    <div class="text">
                                        <h3><?php echo $data->title ?></h3>
                                        <p><?php echo $data->desc ?></p>
                                    </div>
                                <?php endforeach; ?>
                                <div class="link">
                                    <a href="<?php echo esc_url($latest_data[0]->link) ?>" target="_blank" rel="noopener noreferrer">
                                        <button type="button" class="jarak btn btn-dark">Click Me Now</button>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <button class="prev-button" onclick="plusSlides(-1)">&#8249;</button>
                                <button class="next-button" onclick="plusSlides(1)">&#8250;</button>
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
                        <div class="mySlides popup-image-container">
                            <img src="<?php echo $image ?>" alt="inigambar" class="popup-image">
                        </div>
                        <div class="popup-text-container">
                            <button title="close" class="close-button">&times;</button>
                            <div class="popup-text">
                                <h3><?php echo $content ?></h3>
                                <p><?php echo $paragraf ?></p>
                                <div class="link">
                                    <a href="https://google.com" target="_blank" rel="noopener noreferrer">
                                        <button type="button" class="jarak btn btn-dark">Click Me Now</button>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <button class="prev-button" onclick="plusSlides(-1)">&#8249;</button>
                                <button class="next-button" onclick="plusSlides(1)">&#8250;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>