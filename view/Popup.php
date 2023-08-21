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
        // $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ");
        $latest_data = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ORDER BY id_img DESC LIMIT 1;");
        ?>
        const type2 = true;

        jQuery(document).ready(function($) {
            if (type2) {
                $('.popup-content').css({
                    "background-image": "url('<?php echo wp_get_attachment_url($latest_data[0]->img); ?>')",
                    "background-size": "cover",
                    "height": "450"
                });

                $('.popup-content img').remove();
            }
        });
    </script>

    <style>
        .custom-popup {
            /* position: none; */
            /* top: 0;
            left: 0; */
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            /* height: 100%; */
            /* background-color: rgba(0, 0, 0, 0.5); */
            /* z-index: 9999; */
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            /* background-image: url("https://pbs.twimg.com/media/F2yG5s5bcAATtoc?format=jpg&name=large");
            background-size: cover;
            height: 500px; */
            position: relative;
            /* margin-left: 25%;
            margin-right: 25%; */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            /* margin-bottom: 20px; */
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

        .popup-image {
            border-radius: 15px;
            object-fit: cover;
            width: 350px;
            height: 450px;
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
    <?php
    if (!empty($latest_data)) { ?>
        <div class="custom-popup">
            <div class="popup-content">
                <?php foreach ($latest_data as $index => $data) : ?>
                    <button class="close-button btn btn-dark">&times;</button>
                    <img src="<?php echo wp_get_attachment_url($data->img) ?>" alt="inigambar" class="popup-image">
                    <div class="popup-text">
                        <h3><?php echo $data->title; ?></h3>
                        <p><?php echo $data->desc ?></p>
                        <div class="link">
                            <a href="https://google.com" target="_blank" rel="noopener noreferrer">
                                <button type="button" class="jarak btn btn-dark">Click Me Now</button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="custom-popup">
            <div class="popup-content">
                <button class="close-button btn btn-dark">&times;</button>
                <img src="<?php echo $image ?>" alt="inigambar" class="popup-image">
                <div class="popup-text">
                    <h3>Lorem Ipsum! Example</h3>
                    <p>Laboris excepteur adipisicing labore amet nulla sint Lorem quis. Anim ut eiusmod ullamco amet. Dolor tempor quis exercitation cupidatat elit.</p>
                    <div class="link">
                        <a href="https://google.com" target="_blank" rel="noopener noreferrer">
                            <button type="button" class="jarak btn btn-dark">Click Me Now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>