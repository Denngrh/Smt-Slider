<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Popup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script>
        <?php
        $delay = 2000;
        $content = "Discount 50% For All Members";
        $image = "https://images.unsplash.com/photo-1609017604163-e4ca9c619b9b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80";
        $paragraf = "Reprehenderit dolor irure in in incididunt eiusmod qui. Aliqua nisi laborum laboris adipisicing ea. Exercitation consequat ex fugiat magna esse aliqua.";
        $link = "";

        global $wpdb;
        $id = $_GET['id'];
        $table_smt_img = $wpdb->prefix . 'smt_img';
        // $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ");
        $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ORDER BY id_img DESC LIMIT 1;");
        ?>
        jQuery(document).ready(function($) {
            $('.custom-popup').hide(); // Hide the popup initially

            setTimeout(function() {

                const popupContent = `
                    <div class="popup-content">
                        <button class="close-button btn btn-dark">&times;</button>
                        <img src="<?php echo $image; ?>" alt="inigambar" class="popup-image">
                        <div class="popup-text">
                            <h3><?php echo $content; ?></h3>
                            <p><?php echo $paragraf; ?></p>
                            <div class="link">
                                <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
                                    <button type="button" class="jarak btn btn-dark">Click Me Now</button>
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                const design = `
                    <div class="custom-popup">
                        ${popupContent}
                    </div>
                `;

                $('body').append(design);

                $('.custom-popup').fadeIn();

                $('.close-button').on('click', function() {
                    $('.custom-popup').fadeOut();
                });

            }, <?php echo intval($delay); ?>);

            $('.custom-popup .popup-content').on('click', function(e) {
                e.stopPropagation();
            });

        });
    </script>

    <style>
        .custom-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            position: relative;
            margin-left: 25%;
            margin-right: 25%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-bottom: 20px;
            display: flex;
        }

        .close-button {
            position: absolute;
            cursor: pointer;
            top: 10px;
            right: 10px;
            font-size: 30px;
            background: none;
            border: none;
            color: #000;
            padding: 0;
        }

        .close-button:hover {
            position: absolute;
            cursor: pointer;
            top: 10px;
            right: 10px;
            font-size: 30px;
            background: none;
            border: none;
            color: #000;
            padding: 0;
        }

        .popup-content img {
            border-radius: 15px;
            object-fit: cover;
            width: 350px;
            height: 450px;
            /* max-width: 40%; */
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

        .popup-text {
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .popup-text h3 {
            margin-bottom: 20px;
        }

        .popup-text p {
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Halo Dunia</h1>
</body>

</html>