<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
            <div class="row">
                <?php
                $id = $_GET['id'];
                ?>
                <div class="col-md-12 text-center mt-3">
                    <h3> Your Slider</h3>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=edit2&id=' . $id)); ?>" class="back_btn mt-1">Back To Edit Page<i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i></a>
                </div>
                <div class="col-md-12 mt-3">
                <?php global $wpdb;
                $table_slider = $wpdb->prefix . 'smt_slider';
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    $slider_data = $wpdb->get_row("SELECT * FROM $table_slider WHERE id = $id");
                    if ($slider_data) {
                        $type = $slider_data->type;
                        if ($type === 'Paralax') {
                            include 'Paralax.php'; 
                        } elseif ($type === 'Square') {
                            include 'Square.php'; // Ganti 'square.php' dengan nama file sesuai tipe "square"
                        } elseif ($type === 'Popup') {
                            include 'Popup.php'; // Ganti 'Popup.php' dengan nama file sesuai tipe "popup"
                        } else {
                            echo "Tipe tidak dikenali atau terjadi kesalahan.";
                        }
                    } else {
                        echo "Data slider tidak ditemukan.";
                    }
                } else {
                    echo "Parameter id tidak valid.";
                }
            ?>
                </div>
           
            </div>
    </div>
</body>
</html>

<style>
    #adminmenuback,
    #adminmenuwrap {
        display: none;
    }

    #wpcontent {
        margin-left: -20px !important;
        width: 102%;
    }

    #wpfooter {
        display: none;
    }
    body{
        overflow-x:hidden;
    }
    .back_btn{
        text-decoration:none;
        font-size:15px;
    }
</style>