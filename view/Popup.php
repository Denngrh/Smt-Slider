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
        $content = "Isi dengan judul pada bagan ini";
        ?>
        // jQuery(document).ready(function($) {
        //     $('.custom-popup').hide(); // Hide the popup initially

        //     setTimeout(function() {
        //         let popupHTML = '<div class="custom-popup"><div class="popup-content"><?php //echo addslashes($content); 
                                                                                            ?></div></div>';
        //         $('body').append(popupHTML);

        //         $('.custom-popup').fadeIn();

        //         // Control the image size
        //         $('.popup-content img').css({
        //             'max-width': 'auto', // Adjust these values as needed
        //             'max-height': 'auto%',
        //             'height': 'auto'
        //         });
        //     }, <?php // echo intval($delay); 
                    ?>);

        //     $('.custom-popup .popup-content').on('click', function(e) {
        //         e.stopPropagation();
        //     });

        //     $(document).on('click', function() {
        //         if ($('.custom-popup').is(':visible')) {
        //             $('.custom-popup').fadeOut();
        //         }
        //     });


        // });
    </script>

    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        /* Styles for the custom popup within the popup-container */
        .custom-popup {
            display: none;
            position: fixed;
            width: 55%;
            height: 65%;
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
            /* Ensure images are responsive */
        }
    </style>
</head>

<body>

    <div class="custom-popup">
        <div class="popup-content">
            <img src="https://images.unsplash.com/photo-1689435210066-19ad40c54f4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" alt="inigambar">
            <h3><?php echo $content; ?></h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi voluptates qui quidem ipsa fugit sint quos tenetur ducimus asperiores minima. Magni, nisi? Minus a quod, iste aspernatur eligendi veritatis tempore.</p>
            <a href="https://google.com" target="_blank" rel="noopener noreferrer">
                <button type="button" class="btn btn-dark">Click Me</button>        
            </a>
        </div>
    </div>

</body>

</html>