<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        add_bootstrap_css(); 
    ?>
     <?php 
        add_bootstrap_js(); 
    ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-5">
                    <h3> Welcome To SMT Banner</h3>
                </div>
                <div class="card col-md-11 ms-2 mt-3">
                   <h4> Description : </h4>
                   <p> Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search">
                        <button><box-icon name='search' color='#000' class="search_icon" ></box-icon></button>
                    </div>
                </div>
                <div class="col-md-2 mt-3 offset-md-6">
                <button class="button-32" role="button">Add New</button>
                </div>
                <div class="col-md-11 pt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"> No </th>
                                <th scope="col"> Title </th>
                                <th scope="col"> Type </th>
                                <th scope="col"> Shortcode</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr scope="row">
                                <td> 1 </td>
                                <td> Projek 1 </td>
                                <td> Parallax </td>
                                <td> Parallax "1"</td>
                                <td> 
                                    <box-icon type='solid' name='copy'></box-icon> 
                                    <box-icon type='solid' name='message-square-edit'></box-icon>
                                    <box-icon type='solid' name='message-square-minus'></box-icon>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");
.search{
position: relative;
box-shadow: 0 0 40px rgba(51, 51, 51, .1);
  
}

.search input{

 height: 40px;
 border: 2px solid #d6d4d4;
}

.search input:focus{

 box-shadow: none;
 border: 2px solid blue;

}

.search_icon{
    width:15px;
    height: 15px;
}

.search button{

 position: absolute;
 top: 5px;
 right: 5px;
 height: 30px;
 width: 30px;
 background: white;
 border:none;

}

/* CSS */
.button-32 {
  background-color: #fff000;
  border-radius: 12px;
  color: #000;
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
  background: #f4e603;
  box-shadow: 0 0 0 2px rgba(0,0,0,.2), 0 3px 8px 0 rgba(0,0,0,.15);
}

.button-32:disabled {
  filter: saturate(0.2) opacity(0.5);
  -webkit-filter: saturate(0.2) opacity(0.5);
  cursor: not-allowed;
}
</style>