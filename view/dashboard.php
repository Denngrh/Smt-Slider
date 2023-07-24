<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-5">
                    <h3 style="color:#F87474"> Welcome To SMT Banner</h3>
                </div>
                <div class="card col-md-11 ms-2 mt-3">
                   <h4> Description : </h4>
                   <p> Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search...">
                        <button><box-icon name='search' color='#000' class="search_icon" ></box-icon></button>
                    </div>
                </div>
                <div class="col-md-2 mt-3 offset-md-6">
                <button class="button-32" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New</button>
                </div>
                <div class="col-md-11 pt-4">
                    <table class="table table-bordered table-hover">
                    <thead class="table-light">
                            <tr>
                                <th scope="col"> No </th>
                                <th scope="col"> Title </th>
                                <th scope="col"> Type </th>
                                <th scope="col"> Shortcode</th>
                                <th scope="col" class="text-center"> Action</th>
                            </tr>
                        </thead>
                         <?php
                      global $wpdb;
                      $table_name = $wpdb->prefix . 'smt_slider'; 
                      $query = "SELECT * FROM $table_name";
                      $results = $wpdb->get_results($query);
                      if ($results) {
                      $no = 1 ;
                      ob_start();  
                      ?>
                        <tbody>
                        <?php foreach ($results as $result) { ?>
                            <tr scope="row">
                            <?php $id = $result->id;?>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $result->name; ?></td>
                                <td><?php echo $result->type; ?></td>
                                <td class="shortcode"><?php echo $result->short_code; ?></td>
                                <td class="text-center"> 
                                    <button class="copy-button" style="border: none; background: transparent;"><box-icon type='solid' name='copy' color="#3AB0FF"></box-icon></button>
                                    <box-icon type='solid' name='message-square-edit' color="#FFB562"></box-icon>
                                   <a href="<?php echo esc_url(admin_url('admin-post.php?action=delete_data&id=' . $result->id)); ?>" class="delete-link"> <box-icon type='solid' name='message-square-minus' color="#F87474"></box-icon></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                      <?php
                        $output = ob_get_clean();
                        echo $output;
                        } else {
                        echo 'Tidak ada data,Coba mulailah untuk menambahkan!!';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Banner</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <form action="" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title:&nbsp;</label>
            <input type="text" class="form-control" id="recipient-name" name="title" required placeholder="Title Slider"  autocomplete="off">
          </div>
          <div class="select d-flex">
          <label for="recipient-name" class="col-form-label">Title:&nbsp;</label>
            <select name="class" >
                <option value="">Choose Type</option>
                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'smt_type'; 
                $query = "SELECT * FROM $table_name";
                $results = $wpdb->get_results($query);
                if ($results) {
                ob_start();  
                ?>
                  <?php foreach ($results as $result) { ?>
                <option value="<?php echo $result->type; ?>">-- <?php echo $result->type; ?> -- </option> 
                <?php
                }
                ?>
            </select>
            </div>
            <?php
            $output = ob_get_clean();
            echo $output;
            } else {
            echo 'Tidak ada data,Coba mulailah untuk menambahkan!!';
            }
            ?>                    
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" id="simpan" name="simpan">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
<!-- sweet alert delete comfirm -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
  const deleteLinks = document.querySelectorAll(".delete-link");
  deleteLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const url = this.getAttribute("href");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          setTimeout(function () {
            window.location.href = url;
          }, 1000);
          // Show success alert immediately
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
        }
      });
    });
  });
});
</script>

<!-- toasts copy to clipboard -->
<script>
jQuery(document).ready(function($) {
    $('.copy-button').click(function() {
        var shortcodeText = $(this).closest('tr').find('.shortcode').text();
        copyToClipboard(shortcodeText);
        // Show colored toast SweetAlert2
        showColoredToast('success', 'Text successfully copied:' + shortcodeText);
    });
    // funcition copy to clipbord
    function copyToClipboard(text) {
        var tempInput = $('<input>');
           $('body').append(tempInput);
        tempInput.val(text).select();
        document.execCommand('copy');
        tempInput.remove();
    }

    // Fungsi untuk menampilkan colored toast dengan SweetAlert2
    function showColoredToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            width: 400,
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });

        Toast.fire({
            icon: type,
            title: message
        });
    }
});
</script>
</html>

<style>
body{
background-color:#F9F2ED;    
font-family:FUTURA MD BT;
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");
.search{
position: relative;
box-shadow: 0 0 40px rgba(51, 51, 51, .1);

}

.colored-toast.swal2-icon-success {
  background-color: #FFB562 !important;
}
.colored-toast {
    margin-top: 35px;
}

.search input{
 height: 40px;
 border : none;
 border-radius:15px;
 background-color:#FFB562;
}

.search input:focus{
 box-shadow: none;
 border : none;
 border-radius:15px;
 background-color:#FFB562;
}

.search_icon{
    margin-top:5px;
    width:18px;
    height: 18px;
    background-color:#FFB562;
    color: #F87474;
}

.search button{
 position: absolute;
 top: 5px;
 right: 5px;
 height: 30px;
 width: 30px;
 background: white;
 border:none;
 background-color:#FFB562;
}

/* CSS */
.button-32 {
  background-color: #F87474;
  border-radius: 12px;
  color: #ffffff;
  cursor: pointer;
  font-weight: bold;
  padding: 10px 15px;
  text-align: center;
  transition: 200ms;
  width: 100%;
  box-sizing: border-box;
  border: 0;
  font-size: 16px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-32:not(:disabled):hover,
.button-32:not(:disabled):focus {
  outline: 0;
  background: #FFB562;
  box-shadow: 0 0 0 2px rgba(0,0,0,.2), 0 3px 8px 0 rgba(0,0,0,.15);
}

.button-32:disabled {
  filter: saturate(0.2) opacity(0.5);
  -webkit-filter: saturate(0.2) opacity(0.5);
  cursor: not-allowed;
}
</style>