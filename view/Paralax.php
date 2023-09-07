<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php
    global $wpdb;
    $id = $_GET['id'];
    $table_smt_img = $wpdb->prefix . 'smt_img';
    $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $id ");
    if (!empty($data_images)) {
       ?>
    <div class="sec container-fluid bg-container">
        <div class="container">
            <div class="row">
                <div class="col-md-1 my-auto">
                <div class="indicator-dots">
                    <?php foreach ($data_images as $index => $data): ?>
                        <div class="dot-wrapper" onclick="showSlide(<?= $index ?>)">
                            <span class="dot <?= $index === 0 ? 'active' : '' ?>"><span class="dot-number"><?= $index + 1 ?></span></span>
                        </div>
                        <div class="dot-connector"></div>
                    <?php endforeach; ?>
                </div>
                </div>
                <?php
                global $wpdb;
                $table_smt_css = $wpdb->prefix . 'smt_style';
                $data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
                $css_data = json_decode($data->style_data, true);
                {
                ?>
                <div class="col-md-5 text-slider my-auto" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <div class="title_slide mt-5 pt-3 pt-md-0"><<?php echo $css_data['title_size']; ?>> Judul Slider 1 </<?php echo $css_data['title_size']; ?>></div>
                    <div class="desc_slide"><p class="my-md-4" class="desc_slide"> Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan 
                        untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>
                            <button class="btn-custom"> Explore </button>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="col-md-6 my-md-5 pt-md-5">
                    <div class="slider-wrap my-auto">
                        <div class="slider-pannel col-md-12">
                        <?php foreach ($data_images as $index => $data): ?>
                            <div class="slide col-md-4 <?= $index === 0 ? 'active' : '' ?>" onclick="showSlide(<?= $index ?>)" data-background="<?= wp_get_attachment_url($data->bg_img) ?>" data-text="<?= $data->button_link ?>">
                                <img class="inner" src="<?= wp_get_attachment_url($data->img) ?>">
                                <div class="slide-text">
                                    <h3><?= $data->title ?></h3>
                                    <p><?= $data->desc ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="carousel-control-prev ms-md-3" onclick="moveSlide('prev')">
                        <i class="fa-solid fa-arrow-left" style="color: #13161b;"></i>
                    </button>
                    <button class="carousel-control-next" onclick="moveSlide('next')">
                        <i class="fa-solid fa-arrow-right" style="color: #13161b;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    }else{
    ?>
    <!-- Tes -->
    <div class="sec container-fluid bg-container">
        <div class="container">
            <div class="row">
                <div class="col-md-1 my-auto">
                    <div class="indicator-dots">
                        <div class="dot-wrapper" onclick="showSlide(0)">
                            <span class="dot"><span class="dot-number">1</span></span>
                        </div>
                        <div class="dot-wrapper" onclick="showSlide(1)">
                            <span class="dot"><span class="dot-number">2</span></span>
                        </div>
                        <div class="dot-connector"></div>
                    </div>
                    
                </div>
                <?php
                global $wpdb;
                $table_smt_css = $wpdb->prefix . 'smt_style';
                $data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
                $css_data = json_decode($data->style_data, true);{
                ?>
                <div class="col-md-5 text-slider my-auto" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <div class="title_slide mt-5 pt-3 pt-md-0"><<?php echo $css_data['title_size']; ?>> Judul Slider 1 </<?php echo $css_data['title_size']; ?>></div>
                    <div class="desc_slide"><p class="my-md-4" class="desc_slide"> Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan 
                        untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>
                        <button class="btn-custom"> Explore </button>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="col-md-6 my-md-5 pt-md-5">
                    <div class="slider-wrap my-auto">
                        <div class="slider-pannel col-md-12">
                            <!-- Slide 1 -->
                            <div class="slide col-md-4 active" onclick="showSlide(0)" data-background="https://www.pinhome.id/info-area/wp-content/uploads/2022/07/Gunung-Prau-1.jpg" data-text="Explore 1">
                                <img class="inner" src="https://www.carrierstory.com/wp-content/uploads/2021/09/Jalur-Pendakian-Via-Patak-Banteng.jpg">
                                <div class="slide-text">
                                    <h3 >Example 1</h3>
                                    <p >Deskripsi Exapmle1.</p>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="slide slide2 col-md-4" onclick="showSlide(1)"  data-background="https://sikidang.com/wp-content/uploads/Gunung-Prau-Wonosobo.jpg" data-text="Explore 2" >
                                <img class="inner" src="https://asset.kompas.com/crops/SJBld7b2CtJC5zJMlFbu1zKopZY=/1x319:1024x1001/750x500/data/photo/2022/09/04/6314d47545313.jpg">
                                <div class="slide-text">
                                    <h3 >Banda Neira</h3>
                                    <p >Deskripsi Banda Neira.</p>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="carousel-control-prev ms-md-3" onclick="moveSlide('prev')">
                        <i class="fa-solid fa-arrow-left" ></i>
                    </button>
                    <button class="carousel-control-next" onclick="moveSlide('next')">
                        <i class="fa-solid fa-arrow-right" ></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>
<?php
global $wpdb;
$id = $_GET['id'];
$table_smt_css = $wpdb->prefix . 'smt_style';
$data = $wpdb->get_row("SELECT * FROM $table_smt_css WHERE id_slider = $id ");
$css_data = json_decode($data->style_data, true);{
?>
<style>
     .sec {
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow-x: hidden;
        overflow-y: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .slider-wrap {
    display: flex;
    overflow-x: hidden;
    }

    .slider-pannel {
        display: flex;
        transform: translateX(0);
        transition: transform 0.5s ease; 
        height: 430px;
        transition: transform 0.5s ease;
    }

    .slide {
        position: relative;
        overflow: hidden;
        width: 250px; 
        height: 350px; 
        margin: 0px;
        border: 1px solid rgba(179, 179, 179, 0.671);
        border-radius: 10px; 
        cursor: pointer;
        background: transparent;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
    }

    .slide.active {
    transform: scale(1.05);
    }

    .slide:not(.active) {
        transform: scale(0.8);
    }

    .inner {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
    }

    .indicator-dots {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: absolute;
        left: 50px;
        top: 55%;
        transform: translateY(-50%);
    
    }

    .dot-wrapper {
        position: relative;
        margin-bottom: 100px; 
        z-index: 3;
    }

    .dot {
        width: 10px; 
        height: 10px; 
        background-color: <?php echo $css_data['dots_bg']; ?>;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease; 
    }

    .dot.active {
        background-color: <?php echo $css_data['dots_bg_active']; ?>;
        width: 25px; 
        height: 25px;
    }


    .dot:not(.active) .dot-number {
        display: none;
    }

    .dot-number {
        color:  <?php echo $css_data['dots_color']; ?>;
        font-size: 14px;
        font-weight: bold;
    }

    .dot-connector {
        position: absolute;
        width: 1px; 
        height: calc(100% - 100px);
        background-color: <?php echo $css_data['dots_line']; ?>;
        left: 50%; 
        top: 0; 
        transform: translateX(-50%);
    }

    .slider-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }

    .carousel-control-prev{
        width: 35px;
        height: 35px;
        background-color:  <?php echo $css_data['control_bg']; ?>;
        border-radius: 50%;
        color:  <?php echo $css_data['control_color']; ?>;
        font-size: 24px;
        transition: opacity 0.1s ease-in-out;
        cursor: pointer;
        top:70%;
        left: 50%;
    }
    
    .carousel-control-next {
        width: 35px;
        height: 35px;
        background-color:  <?php echo $css_data['control_bg']; ?>;
        border-radius: 50%;
        color:  <?php echo $css_data['control_color']; ?>;
        font-size: 24px;
        transition: opacity 0.1s ease-in-out;
        cursor: pointer;
        top:70%;
       
        left: 55%;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 0.7;
    }

    .bg-container {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    transition: background-image 0.5s ease;
    }
    .slide.active {
        background-image: none;
    }
    .slide_title{
        font-family:Futura MD BT;
        color:red;
    }
    .slide_desc{
        font-family:Berlin Sans FB;
        color:palevioletred;
    }
    .btn-custom{
        background-color: brown;
        padding: 7px;
        width: 100px;
    }
    .slide_title {
        transform: translateY(30px); 
        opacity: 0; 
        transition: transform 0.5s ease, opacity 0.5s ease; 
    }
    .slide_desc {
        transform: translateY(30px); 
        opacity: 0; 
        transition: transform 0.5s ease, opacity 0.5s ease; 
    }
    .btn-custom {
        transform: translateY(10px); 
        opacity: 1;
        transition: transform 0.5s ease, opacity 0.5s ease; 
    }
    .slide.active .slide_title,
    .slide.active .slide_desc,
    .slide.active .btn-custom {
        transform: translateY(0); 
        opacity: 1;
    }
    .text-slider {
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .slide.active .text-slider {
        opacity: 1;
        transform: translateY(0);
    }
    

    @media (max-width: 767px) {
       .col-md-6 {
           margin-top: 20px;
       }

       .slider-pannel {
           height: 100%;
           align-items: center;
           margin: auto; 
       }

       .slide {
       width: 100%; 
       height: auto;
       margin: 10px auto; 

       }
       .indicator-dots {
           flex-direction: row;
           justify-content: center;
           margin-top: 160px;
           align-items: center;
           margin-left: 23%; 
       }

       .dot-wrapper {
           margin-right: 10px; 
       }

       .dot-number {
           font-size: 10px; 
       }

       .dot-connector{
           display: none;
       }

       .carousel-control-prev{
           font-size: 18px;
           margin-top:10%;
           margin-left: -50px;
           
         
       }
       .carousel-control-next{
           margin-right: 200px;
           display: flex;
           font-size: 18px;
           margin-top:10%;
       }
       
   }
   @media (min-width: 768px) and (max-width: 1023px){
       .indicator-dots {
           left: 10px;
           transform: translateY(-65%);
          
       }
       .dot-wrapper {
           position: relative;
           margin-bottom: 80px; /* Jarak yang lebih besar antara nomor-nomor */
           z-index: 3;
       }
       .slider-pannel{
           margin-top: 200px ;
           display: flex;
       }
       .carousel-control-prev{
           font-size: 25px;
           margin-top: -10%;
       }
       .carousel-control-next{
           margin-left: 30px;
           display: flex;
           font-size: 25px;
           margin-top: -10%;
       }
   }
    .title_slide {
        font-family: <?php echo $css_data['title_fam']; ?>;
        color: <?php echo $css_data['title_color']; ?>;
    }

    .desc_slide {
        font-family: <?php echo $css_data['desc_fam']; ?>;
        color: <?php echo $css_data['desc_color']; ?>;
    }

    .btn-custom {
        font-family: <?php echo $css_data['btn_fam']; ?>;
        color: <?php echo $css_data['btn_color']; ?>;
        background-color: <?php echo $css_data['btn_bg']; ?>;
        border: none;
        padding: 7px;
        border-radius: 10px;
    }

    .btn-custom:hover {
        color: <?php echo $css_data['btn_color_hvr']; ?>;
        background-color: <?php echo $css_data['btn_bg_hvr']; ?>;
    }

</style>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const bgContainer = document.querySelector('.bg-container');

    function showSlide(index) {
    if (index >= 0 && index < slides.length) {
        slides[currentSlide].classList.remove('active');
        slides[index].classList.add('active');
        const backgroundURL = slides[index].getAttribute('data-background');
        bgContainer.style.backgroundImage = `url('${backgroundURL}')`;
        currentSlide = index;

        const slideText = slides[index].querySelector('.slide-text');
        const title = slideText.querySelector('h3').textContent;
        const description = slideText.querySelector('p').textContent;

        const textSlider = document.querySelector('.text-slider');
        const buttonText = slides[index].getAttribute('data-text');
        const btnCustom = document.querySelector('.btn-custom');
        btnCustom.textContent = buttonText;
        // Apply sliding and fading animation
        textSlider.querySelector('<?php echo $css_data['title_size']; ?>').style.transform = 'translateY(-10px)';
        textSlider.querySelector('p').style.transform = 'translateY(-10px)';
        textSlider.querySelector('.btn-custom').style.transform = 'translateY(-5px)';
        textSlider.style.opacity = 0;

        setTimeout(() => {
            textSlider.querySelector('<?php echo $css_data['title_size']; ?>').textContent = title;
            textSlider.querySelector('p').textContent = description;
            textSlider.querySelector('<?php echo $css_data['title_size']; ?>').style.transform = 'translateY(0)';
            textSlider.querySelector('p').style.transform = 'translateY(0)';
            textSlider.querySelector('.btn-custom').style.transform = 'translateY(0)';
            textSlider.style.opacity = 1;
        }, 300); // Adjust the duration as needed

        const slideWidth = slides[0].offsetWidth; // Lebar slide
        const shift = -slideWidth * index; // Pergeseran

        const sliderPanel = document.querySelector('.slider-pannel');
        sliderPanel.style.transform = `translateX(${shift}px)`;

        // Mengatur status aktif atau tidak aktif pada indikator dot
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, dotIndex) => {
            if (dotIndex === index) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
        updateIndicatorDots();
        updateSlideEffects();
    }}
function moveSlide(direction) {
    if (direction === 'prev') {
        const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    } else if (direction === 'next') {
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }
}
function updateIndicatorDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, dotIndex) => {
        if (dotIndex === currentSlide) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function updateSlideEffects() {
    const activeSlide = slides[currentSlide];
    const inactiveSlides = Array.from(slides).filter((slide, index) => index !== currentSlide);
    
    // Mengatur efek pada slide aktif
    activeSlide.style.transform = 'scale(1)';
    
    // Mengatur efek pada slide yang tidak aktif
    inactiveSlides.forEach(slide => {
        slide.style.transform = 'scale(0.8)';
    });
}

    function prevSlide() {
        const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    showSlide(currentSlide);
</script>

<?php
}
?>