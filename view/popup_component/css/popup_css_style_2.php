<?php
global $wpdb;
$table_smt_css = $wpdb->prefix . 'smt_style';
$data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
$css_data = json_decode($data->style_data, true); {
?>

    <style>
        p {
            font-size: 16px !important;
        }
        .visibility {
            visibility: hidden;
            opacity: 0;
            transition: 0.3s ease;
        }

        .custom-popup {
            position: relative;
            top: 40%;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            background-image: url('https://img.freepik.com/free-photo/abstract-background-blue-wallpaper-image_53876-108341.jpg?w=996&t=st=1695195401~exp=1695196001~hmac=6b2b45ea90321eda78cd0215461948dbd8c2a85ef10d9ba4fe035c9c48245302');
            background-size: cover;
            background-position: center;
            padding: 20px;
            position: relative;
            /* margin-left: 25%;
                margin-right: 25%; */
            width: 460px;
            height: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: row;
            border-radius: <?php echo $css_data['border_radius'] ?>;
        }

        .percobaan {
            flex: 1;
            position: relative;
            display: inline-block;
            justify-content: center;
            align-items: center;

        }

        .popup-text-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: left;
            position: relative;
            /* top: 50px; */
            margin: 0;
        }

        .div_text {
            margin-top: 2%;
        }

        .close-button {
            position: absolute;
            cursor: pointer;
            top: 16px;
            left: 90%;
            /* height: 24px;
            width: 24px; */
            font-size: 24px;
            background: none;
            border: none;
            color: #000;
            padding: 0;
            transition: 0.3s ease;
            box-sizing: border-box;
            z-index: 10;
        }

        .close-button > svg {
            width: <?php echo $css_data['close_btn_size']?>;
            height: <?php echo $css_data['close_btn_size']?>;
        }

        .close-button>svg>path {
            fill: <?php echo $css_data['close_btn_color'] ?>;
        }

        .close-button:hover {
            color: black;
            background: none;
        }

        .tombol {
            font-family: <?php echo $css_data['btn_fam'] ?>;
            color: <?php echo $css_data['btn_color'] ?>;
            background-color: <?php echo $css_data['btn_bg'] ?>;
            /* width: 59px;
                height: 23px; */
            transition: 0.4s ease;
            font-weight: 400;
            border-radius: 4px;
            font-size: 11px;
            width: 20%;
            height: 10%;
            text-align: center;
            letter-spacing: normal;
            line-height: normal;
            gap: 10px;

            /* padding: 4px 12px;
            margin-top: 1px; */
            
            display: flex;
            justify-content: center;
            align-items: center;

            padding-top: <?php echo $css_data['pd_top_btn'] ?>;
            padding-bottom: <?php echo $css_data['pd_bottom_btn'] ?>;
            padding-right: <?php echo $css_data['pd_right_btn'] ?>;
            padding-left: <?php echo $css_data['pd_left_btn'] ?>;
            margin-top: <?php echo $css_data['mg_top_btn'] ?>;
            margin-bottom: <?php echo $css_data['mg_bottom_btn'] ?>;
            margin-right: <?php echo $css_data['mg_right_btn'] ?>;
            margin-left: <?php echo $css_data['mg_left_btn'] ?>;
        }

        .tombol:hover {
            color: <?php echo $css_data['btn_color_hvr'] ?>;
            background-color: <?php echo $css_data['btn_bg_hvr'] ?>;
        }

        .caret-right > svg > path {
            fill: <?php echo $css_data['control_color'] ?>;
        }

        .caret-left > svg > path {
            fill: <?php echo $css_data['control_color'] ?>;
        }

        .caret-right {
            z-index: 10;
            position: absolute;
            top: 230px;
            left: 98%;
            width: 40px;
            height: 40px;

            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .caret-left {
            z-index: 10;
            position: absolute;
            top: 230px;
            left: -45px;
            width: 40px;
            height: 40px;

            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .div-4 {
            display: inline-flex;
            align-items: flex-start;
            gap: 4px;
            position: absolute;
            top: 500px;
            left: 50%;
        }

        .ellipse {
            background-color: #5d5c5c;
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 4px;
        }

        .ellipse-2 {
            background-color: #eeeeee;
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 4px;
        }

        a {
            text-decoration: none !important;
        }

        .text {
            padding: 8px 0;
        }

        .text-wrapper-1 :first-child{
            font-family: <?php echo $css_data['title_fam'] ?> !important;
            color: <?php echo $css_data['title_color'] ?> !important;
            font-weight: 800;
            padding-top: <?php echo $css_data['pd_top_title'] ?>;
            padding-bottom: <?php echo $css_data['pd_bottom_title'] ?>;
            padding-right: <?php echo $css_data['pd_right_title'] ?>;
            padding-left: <?php echo $css_data['pd_left_title'] ?>;
            margin-top: <?php echo $css_data['mg_top_title'] ?>;
            margin-bottom: <?php echo $css_data['mg_bottom_title'] ?>;
            margin-right: <?php echo $css_data['mg_right_title'] ?>;
            margin-left: <?php echo $css_data['mg_left_title'] ?>;
            font-size: <?php if ($css_data['title_size'] == 'h1') {
                echo '32px';
            } else if ($css_data['title_size']  == 'h2') {
                echo '24px';
            } else if ($css_data['title_size'] == 'h3') {
                echo '18.72px';
            } else if ($css_data['title_size']  == 'h4') {
                echo '16px';
            } else if ($css_data['title_size']  == 'h5') {
                echo '13.28px';
            } else {
                echo '10.72px';
            }
            ?>;
        }

        .text-wrapper-2 :first-child{
            font-family: <?php echo $css_data['desc_fam'] ?> !important;
            color: <?php echo $css_data['desc_color'] ?> !important;
            line-height: normal;
            overflow: hidden;
            padding-top: <?php echo $css_data['pd_top_desc'] ?>;
            padding-bottom: <?php echo $css_data['pd_bottom_desc'] ?>;
            padding-right: <?php echo $css_data['pd_right_desc'] ?>;
            padding-left: <?php echo $css_data['pd_left_desc'] ?>;
            margin-top: <?php echo $css_data['mg_top_desc'] ?>;
            margin-bottom: <?php echo $css_data['mg_bottom_desc'] ?>;
            margin-right: <?php echo $css_data['mg_right_desc'] ?>;
            margin-left: <?php echo $css_data['mg_left_desc'] ?>;
        }

        .dot {
            cursor: pointer;
            background-color: #5d5c5c;
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
            background-color: <?php echo $css_data['dots_bg_active'] ?>;
        }

        @media (max-width: 850px) {
            .popup-content {
                margin-left: 10%;
                margin-right: 10%;
            }

            .popup-image {
                height: 55vh;
            }
        }

        /* Media query for mobile screens */
        @media (max-width: 480px) {
            .popup-content {
                width: 360px;
                height: 474px;
            }
            .div-4 {
                top: 98%;
            }
            .popup-text-container {
                text-align: center;
                top: 50%;
            }
            .tombol {
                position: relative;
                width: 25%;
                left: 30%;
            }

            .caret-right {
                top: 142px;
                width: 32px;
                height: 32px;
                left: 80%;
            }

            .caret-left {
                top: 142px;
                width: 32px;
                height: 32px;
            }

            .caret-right>svg {
                width: 12px;
                height: 22px;
            }

            .caret-left>svg {
                width: 12px;
                height: 22px;
            }


            .close-button {
                left: 85%;
                top: 16px;
            }

            .text-wrapper-1 {
                font-size: 24px;
                padding-bottom: 8px;
            }
            .text-wrapper-1 {
                padding-bottom: 8px;
            }
        }
    </style>
<?php } ?>