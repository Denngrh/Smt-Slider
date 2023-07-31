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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-5">
                    <h3 style="color:#4fb359"> Welcome To SMT Banner</h3>
                </div>
                <div class="card col-md-11 ms-2 mt-3">
                   <h4> Description : </h4>
                   <p> Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                </div>
                <div class="col-md-2 mt-3 ">
                  <button class="button-32" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New</button>
                </div>
                <div class="col-md-11 pt-4">
                    <table class="table table-bordered table-hover" id="example">
                    <thead class="table-light">
                            <tr>
                                <th scope="col" style="padding:3px;" class="text-center"> No </th>
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
                        <?php foreach ($results as $result) {
                          $id = $result->id;
                          $update_url = admin_url('admin.php?page=edit&id=' . $id); ?>
                            <tr scope="row">
                            <?php $id = $result->id;?>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $result->name; ?></td>
                                <td><?php echo $result->type; ?></td>
                                <td class="shortcode"><?php echo $result->short_code; ?></td>
                                <td class="text-center"> 
                                    <button class="copy-button" style="border: none; background: transparent;"><i class="fa-solid fa-copy" style="color: white;background-color:blue; padding:5px;border-radius:5px;"></i></button>
                                    <a href="<?php echo esc_url($update_url); ?>"target="_blank"><i class="fa-solid fa-pen-to-square" style="color: white;background-color:#c9dd00; padding:5px;border-radius:5px;"></i></a>
                                     <a href="<?php echo esc_url(admin_url('admin-post.php?action=delete_data&id=' . $result->id)); ?>" class="delete-link"><i class="fa-solid fa-trash-can" style="color: white;background-color:red; padding:5px;border-radius:5px;"></i></a>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  role="document">
    <div class="modal-content" style="background:#ffffff;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Banner</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
      <input type="hidden" name="action" value="insert_slide_callback">
     <div class="form-group " style="width: 70%;">
          <span>Title</span>
          <input class="form-field" type="text" name="title" placeholder="..." required style="border:1px solid #c9dd00;background-color:#F5F5F5;">
      </div>
          <div class="select my-3">
            <select id="type" name="type" style="background:#F5F5F5;" required>
                <option selected disabled>Choose Type</option>
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
            <?php
            $output = ob_get_clean();
            echo $output;
            } else {
            echo 'Tidak ada data,Coba mulailah untuk menambahkan!!';
            }
            ?>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal" style="background:white;border:2px solid #4fb359;color:#4fb359;">Back</button>
        <button type="submit" class="btn" id="submit" name="submit" style="background:#4fb359;color:white;">Create</button>
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
<script>
  new DataTable('#example');
</script>
</html>
<style>
    .colored-toast.swal2-icon-success {
  background-color: #c9dd00 !important;
}
.colored-toast {
    margin-top: 35px;
}
body{
background-color:#ffffff;    
font-family:FUTURA MD BT;
}
/* CSS */
.button-32 {
  background-color:#c9dd00;
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
  background: #4fb359;
  box-shadow: 0 0 0 2px rgba(0,0,0,.2), 0 3px 8px 0 rgba(0,0,0,.15);
}

.button-32:disabled {
  filter: saturate(0.2) opacity(0.5);
  -webkit-filter: saturate(0.2) opacity(0.5);
  cursor: not-allowed;
}

  select {
    -webkit-appearance:none;
    -moz-appearance:none;
    -ms-appearance:none;
    appearance:none;
    outline:0;
    box-shadow:none;
    border:0!important;
    background-image: none;
    padding-left: 10px;
    margin-top: -3px;
    flex: 1;
    color:#ffffff;
    cursor:pointer;
    font-size: 1em;
    font-family: Futura MD BT;
    font-weight: 500;
  }
  select::-ms-expand {
    display: none;
  }
  .select {
    position: relative;
    display: flex;
    width: 15em;
    height: 40px;
    line-height: 3;
    background-color: #4fb359;
    overflow: hidden;
    border-radius: .25em;
    border : 1px solid #c9dd00;
  }
  .select::after {
    content: '\25BC';
    position: absolute;
    margin-top: -3px;
    right: 0;
    padding: 0 10px;
    background:#4fb359;
    color:#c9dd00;
    cursor:pointer;
    pointer-events:none;
    transition:.25s all ease;
  }
  .select:hover::after {
    color: #F5F5F5;
  }
.form-field {
        display: block;
        width: 100%;
        height: 35px;
        padding: 8px 16px;
        line-height: 35px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        -webkit-appearance: none;
        color: var(--input-color);
        border: 1px solid var(--input-border);
        background: var(--input-background);
        transition: border .3s ease;
        &::placeholder {
            color: var(--input-placeholder);
        }
        &:focus {
            outline: none;
            border-color: var(--input-border-focus);
        }
    }

    .form-group {
        position: relative;
        display: flex;
        width: 100%;
        & > span,
        .form-field {
            white-space: nowrap;
            display: block;
            &:not(:first-child):not(:last-child) {
                border-radius: 0;
            }
            &:first-child {
                border-radius: 6px 0 0 6px;
            }
            &:last-child {
                border-radius: 0 6px 6px 0;
            }
            &:not(:first-child) {
                margin-left: -1px;
            }
        }
        .form-field {
            position: relative;
            z-index: 1;
            flex: 1 1 auto;
            width: 1%;
            margin-top: 0;
            margin-bottom: 0;
        }
        & > span {
            height: 35px;
            text-align: center;
            padding: 3px 10px;
            font-size: 14px;
            line-height: 25px;
            color: var(--group-color);
            background: var(--group-background);
            border: 1px solid var(--group-border);
            transition: background .3s ease, border .3s ease, color .3s ease;
        }
        &:focus-within {
            & > span {
                color: var(--group-color-focus);
                background: var(--group-background-focus);
                border-color: var(--group-border-focus);
            }
        }
    }
    :root {
        --input-color: #c9dd00;
        --input-border: #c9dd00 ;
        --input-placeholder: #c9dd00;

        --input-border-focus: #c9dd00;

        --group-color: var(--input-color);
        --group-border: var(--input-border);
        --group-background: #4fb359;

        --group-color-focus: #4fb359;
        --group-border-focus: var(--input-border-focus);
        --group-background-focus: #c9dd00;
    }
    table.dataTable thead th {
      background-color: #f2f2f2;
      border-bottom: 1px solid #ddd;
      padding: 10px;
    }
    table.dataTable tbody td {
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    table.dataTable tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
    }
    table.dataTable tbody tr:nth-child(even) {
      background-color: #fff;
    }
    table.dataTable tbody tr:hover {
      background-color: #f5f5f5;
    }
    div.dataTables_length {
    margin-bottom: -35px; 
    }
    div.dataTables_length label {
      font-weight: bold;
    }
    div.dataTables_length select {
      font-size: 14px;
      border-radius: 5px;
      border :2px solid #4fb359 !important;
      background-color:transparent;
    }
    div.dataTables_length select:hover {
      background-color: #fafafa;
    }
    div.dataTables_length select:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .dataTables_filter input {
      font-size: 14px;
      padding: 6px 12px;
      border-radius: 5px;
      border: 1px solid #000;
      margin-bottom:10px;
      height : 10px;
    }
    .dataTables_filter input:hover {
      background-color: #f2f2f2;
    }
    .dataTables_filter input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    /* Gaya untuk tombol "Prev" dan "Next" */
      .dataTables_paginate .paginate_button {
        padding: 6px 12px;
        margin: 2px;
        background-color: #4fb359;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        margin-top: -20px !important;
        
      }

      /* Gaya untuk tombol "Prev" dan "Next" ketika dihover */
      .dataTables_paginate .paginate_button:hover {
        background-color: #c9dd00;
      }

      /* Gaya untuk tombol "Prev" dan "Next" ketika sedang aktif (current) */
      .dataTables_paginate .paginate_button.current {
        background-color: #c9dd00;
      }


</style>