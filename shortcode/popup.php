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
        $content = "lorem ipsum dolor sit amet, consectetur adip";
        ?>
        jQuery(document).ready(function($) {
            $('.custom-popup').hide(); // Hide the popup initially

            setTimeout(function() {
                let popupHTML = '<div class="custom-popup"><div class="popup-content"><?php echo addslashes($content); ?></div></div>';
                // isi dari variable custom harus 1 baris untuk tidak error
                let custom = `<div class="custom-popup"><div class="popup-content"><img src="https://images.unsplash.com/photo-1689435210066-19ad40c54f4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" alt="inigambar"><h3><?php echo $content; ?></h3><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi voluptates qui quidem ipsa fugit sint quos tenetur ducimus asperiores minima. Magni, nisi? Minus a quod, iste aspernatur eligendi veritatis tempore.</p><a href="https://google.com" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-dark">Click Me</button></a></div></div>`;
                $('body').append(custom);

                $('.custom-popup').fadeIn();

            }, <?php echo intval($delay); ?>);

            $('.custom-popup .popup-content').on('click', function(e) {
                e.stopPropagation();
            });

            $(document).on('click', function() {
                if ($('.custom-popup').is(':visible')) {
                    $('.custom-popup').fadeOut();
                }
            });


        });
    </script>

    <style>
        /* Styles for the custom popup */
        .custom-popup {
            display: none;
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
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            margin: 5%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }   

        .popup-content img {
            max-width: 30%;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        .popup-content h3 {
            margin-bottom: 20px;
        }
        .popup-content p {
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Halo Dunia</h1>
</body>

</html>