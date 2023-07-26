<?php /* Template Name: Halaman Plugin Khusus */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="nav col-md-12 justify-content-center">
                    <button class="button-24 my-3 offset-md-3" role="button">Dekstop</button>
                    <button class="button-24 my-3 mx-3" role="button">Tablet</button>
                    <button class="button-24 my-3" role="button">Mobile</button>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-3 border-0">
                <div class="mt-3 ms-3">
                    <h4> Settings </h4>
                </div>
                <div class="card-body">
                    <!-- Form Style -->
                    <div class="form-group">
                        <input class="form-field" type="text" placeholder="Title">
                    </div>
                <div class="form-group my-3">
                    <div class="select">
                        <select name="format" id="format">
                           <option selected disabled>Choose Type</option>
                           <option value="pdf">Parallax</option>
                           <option value="txt">Square</option>
                        </select>
                     </div>
                </div>
                <div class="row">
                    <div class="form-group justify-content-between" style="width: 50%;">
                        <input class="form-field" type="text" placeholder="Width">
                        <span>px</span>
                    </div>
                    <div class="form-group" style="width:50%;">
                        <input class="form-field" type="text" placeholder="Height">
                        <span>px</span>
                    </div>
                </div>
                    <div class="col-md-2 offset-md-9 mt-3">
                        <button class="button-18" role="button">Add</button>
                    </div>
                <!-- Form Image -->
                <div class="col border my-3">
                        <div class="my-3 d-flex justify-content-center">
                            <img src="images.jpeg" alt="" srcset="" width="80%">
                        </div>
                        <div class="form-group mx-auto" style="width: 70%;">
                            <input class="form-field" type="text" placeholder="Title">
                        </div>
                        <div class="form-group justify-content-center my-2">
                            <textarea name="" id="" cols="21" rows="3" style="border: 1px solid #CDD9ED; color: #99A3BA;">Desc</textarea>
                        </div>
                        <div class="form-group mx-auto mb-3" style="width: 70%;">
                            <span>Https</span>
                            <input class="form-field" type="text" placeholder="Link">
                        </div>
                </div>
                <hr class="my-4">
                <div class="col justify-content-between d-flex">
                        <a href="" class="back">Back</a>
                        <button class="button-18" role="button">Save</button>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-8 offset-md-4" style="background-color:#fafafa;">

            </div>
        </div>
    </div>
</body>
</html>

<style>
    #adminmenuback, #adminmenuwrap {
        display: none;
    }
    #wpcontent {
        margin-left: -20px !important;
        width:100%;
    }
    #wpfooter{
        display:none;
    }
    body{
        background-color: white;

    }
    .nav{
        background-color:#F9F2ED ;
        width:100%;
        margin-left:20px;
    }
    .card{
        background-color:#F9F2ED ;
        font-family: Futura MD BT;
        margin-top: -65px;
        z-index: 1;
    }
    :root {
        --input-color: #99A3BA;
        --input-border: #CDD9ED;
        --input-background: #fff;
        --input-placeholder: #CBD1DC;

        --input-border-focus: #275EFE;

        --group-color: var(--input-color);
        --group-border: var(--input-border);
        --group-background: #EEF4FF;

        --group-color-focus: #fff;
        --group-border-focus: var(--input-border-focus);
        --group-background-focus: #678EFE;
    }

    .form-field {
        display: block;
        width: 100%;
        height: 100%;
        padding: 8px 16px;
        line-height: 25px;
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

    /* CSS */
    .button-18 {
        align-items: center;
        background-color: #0A66C2;
        border: 0;
        border-radius: 30px;
        box-sizing: border-box;
        color: #ffffff;
        cursor: pointer;
        font-family: Futura MD BT;
        font-size: 13px;
        font-weight: 550;
        line-height: 20px;
        max-width: 400px;
        min-height: 35px;
        overflow: hidden;
        padding: 0px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        touch-action: manipulation;
        transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
        user-select: none;
        -webkit-user-select: none;
        vertical-align: middle;
    }

    .button-18:hover,
    .button-18:focus { 
        background-color: #678EFE;
        color: #ffffff;
    }

    .button-18:active {
        background: #09223b;
        color: rgb(255, 255, 255, .7);
    }

    .button-18:disabled { 
        cursor: not-allowed;
        background: rgba(0, 0, 0, .08);
        color: rgba(0, 0, 0, .3);
    }

    .back{
        text-decoration: none;
        cursor: pointer;
    }
    select {
        -webkit-appearance:none;
        -moz-appearance:none;
        -ms-appearance:none;
        appearance:none;
        outline:0;
        box-shadow:none;
        border:0!important;
        background: #CBD1DC;
        background-image: none;
        padding-left: 10px;
        margin-top: -3px;
        flex: 1;
        color:#09223b;
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
        width: 20em;
        height: 40px;
        line-height: 3;
        background: #5c6664;
        overflow: hidden;
        border-radius: .25em;
    }
    .select::after {
        content: '\25BC';
        position: absolute;
        margin-top: -3px;
        right: 0;
        padding: 0 10px;
        background: #99A3BA;
        cursor:pointer;
        pointer-events:none;
        transition:.25s all ease;
    }
    .select:hover::after {
        color: #275EFE;
    }
    /* CSS */
    .button-24 {
        background: #678EFE;
        border: 1px solid #678EFE;
        border-radius: 6px;
        box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
        box-sizing: border-box;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
        font-size: 13px;
        font-weight: 600;
        line-height: 5px;
        min-height: 30px;
        outline: 0;
        padding: 12px 14px;
        text-align: center;
        text-rendering: geometricprecision;
        text-transform: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
    }

    .button-24:hover,
    .button-24:active {
        background-color: initial;
        background-position: 0 0;
        color: #678EFE;
    }

    .button-24:active {
     opacity: .5;
    }
</style>
