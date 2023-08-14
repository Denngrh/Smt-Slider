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
    $table_smt_img = $wpdb->prefix . 'smt_img';
    $data_images = $wpdb->get_results("SELECT * FROM $table_smt_img WHERE id_slider = $project_id ");
    if (!empty($data_images)) {?>
    <div class="sec container-fluid bg-container">
        <div class="container">
            <div class="row">
                <div class="col-md-1 my-auto">
                <div class="indicator-dots">
                    <?php foreach ($data_images as $index => $data): ?>
                        <div class="dot-wrapper" onclick="showSlide(<?= $index ?>)">
                            <span class="dot <?= $index === 0 ? 'active' : '' ?>"><span class="dot-number"><?= $index + 1 ?></span></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
                <div class="col-md-5 text-slider my-auto" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <h1 class="mt-5 pt-3 pt-md-0"> Judul Slider 1 </h1>
                    <p class="my-md-4"> Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan 
                        untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>
                        <button class="btn btn-primary"> Explore </button>
                </div>
                <div class="col-md-6 my-md-5 pt-md-5">
                    <div class="slider-wrap my-auto">
                        <div class="slider-pannel col-md-12">
                        <?php foreach ($data_images as $index => $data): ?>
                            <div class="slide col-md-4 <?= $index === 0 ? 'active' : '' ?>" onclick="showSlide(<?= $index ?>)">
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
                        <span class="carousel-control-prev-icon" 
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" onclick="moveSlide('next')">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
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
                        <div class="dot-wrapper" onclick="showSlide(2)">
                            <span class="dot"><span class="dot-number">3</span></span>
                        </div>
                        <div class="dot-wrapper" onclick="showSlide(3)">
                            <span class="dot"><span class="dot-number">4</span></span>
                        </div>
                        <div class="dot-wrapper" onclick="showSlide(4)">
                            <span class="dot"><span class="dot-number">5</span></span>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-5 text-slider my-auto" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <h1 class="mt-5 pt-3 pt-md-0"> Judul Slider 1 </h1>
                    <p class="my-md-4"> Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan 
                        untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>
                        <button class="btn btn-primary"> Explore </button>
                </div>
                <div class="col-md-6 my-md-5 pt-md-5">
                    <div class="slider-wrap my-auto">
                        <div class="slider-pannel col-md-12">
                            <!-- Slide 1 -->
                            <div class="slide slide1 col-md-4 active" onclick="showSlide(0)">
                                <img class="inner" src="https://asset.kompas.com/crops/Tg1rEfwv-5GiWpbSb5-RuaBlkjk=/0x0:1800x1200/750x500/data/photo/2022/08/07/62ef3f9c2846d.jpg">
                                <div class="slide-text">
                                    <h3>Gunung Prau</h3>
                                    <p>Deskripsi Gunung Prau.</p>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="slide slide2 col-md-4" onclick="showSlide(1)">
                                <img class="inner" src="https://asset.kompas.com/crops/SJBld7b2CtJC5zJMlFbu1zKopZY=/1x319:1024x1001/750x500/data/photo/2022/09/04/6314d47545313.jpg">
                                <div class="slide-text">
                                    <h3>Banda Neira</h3>
                                    <p>Deskripsi Banda Neira.</p>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="slide slide3 col-md-4" onclick="showSlide(2)">
                                <img class="inner" src="https://awsimages.detik.net.id/community/media/visual/2022/12/28/sunset-di-pantai-kuta-kabupaten-badung-bali_169.jpeg?w=1200">
                                <div class="slide-text">
                                    <h3>Sunset Pantai</h3>
                                    <p>Deskripsi Sunset Pantai.</p>
                                </div>
                            </div>

                            <!-- Slide 4 -->
                            <div class="slide slide4 col-md-4" onclick="showSlide(3)">
                                <img class="inner" src="https://www.nativeindonesia.com/foto/2022/06/gunung-slamet.jpg">
                                <div class="slide-text">
                                    <h3>Gunung Slamet</h3>
                                    <p>Deskripsi Gunung Slamet.</p>
                                </div>
                            </div>

                            <!-- Slide 5 -->
                            <div class="slide slide5 col-md-4" onclick="showSlide(4)">
                                <img class="inner" src="https://akcdn.detik.net.id/visual/2018/07/29/bc121b83-938b-4c7c-946c-1f6f22e75d6d_169.jpeg?w=650">
                                <div class="slide-text">
                                    <h3>Gunung Rinjani</h3>
                                    <p>Deskripsi Gunung Rinjani.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="carousel-control-prev ms-md-3" onclick="moveSlide('prev')">
                        <span class="carousel-control-prev-icon" 
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" onclick="moveSlide('next')">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
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
    overflow-x: hidden; /* Add overflow property to hide overflowing content */
    }

    .slider-pannel {
        display: flex;
        transform: translateX(0); /* Initialize the position of the slider to the first slide */
        transition: transform 0.5s ease; /* Add the transition property for smooth sliding */
        height: 430px;
        transition: transform 0.5s ease;
    }

    .slide {
        position: relative;
        overflow: hidden;
        width: 250px; /* Sesuaikan ukuran slide kotak */
        height: 350px; /* Sesuaikan ukuran slide kotak */
        margin: 0px;
        border: 1px solid rgba(179, 179, 179, 0.671);
        border-radius: 10px; /* Ubah nilai border-radius sesuai keinginan */
        cursor: pointer;
        background: transparent;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
    }

    .slide.active {
    /* ... properti lain ... */
    transform: scale(1.05);
    /* ... properti lain ... */
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
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
}

.dot-wrapper {
    position: relative;
    margin-bottom: 30px; /* Jarak yang lebih besar antara nomor-nomor */
}

.dot {
    width: 20px;
    height: 20px;
    background-color: aquamarine;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.dot.active {
    background-color: pink;
}

.dot-number {
    color: white;
    font-size: 14px;
    font-weight: bold;
}

.dot-wrapper::before {
    content: "";
    position: absolute;
    left: 50%;
    top: -50%;
    transform: translateY(-50%);
    width: 2px;
    height: calc(100% + 30px); /* Menyesuaikan tinggi garis vertikal */
    background-color: aquamarine;
    transform: translateX(-50%);
}

.slider-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        
    }

    .carousel-control-prev{
        width: 30px;
        height: 30px;
        background-color: aquamarine;
        border-radius: 50%;
        color: burlywood;
        font-size: 24px;
        transition: opacity 0.3s ease-in-out;
        cursor: pointer;
        top:70%;
        left: 50%;
    }
    
    .carousel-control-next {
        width: 30px;
        height: 30px;
        background-color: aquamarine;
        border-radius: 50%;
        color: burlywood;
        font-size: 24px;
        transition: opacity 0.3s ease-in-out;
        cursor: pointer;
        top:70%;
       
        left: 55%;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 0.7;
    }

    .bg-container {
        background-image: url(''); /* Kosongkan URL gambar latar belakang */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        transition: background-image 0.5s ease; /* Tambahkan efek transisi saat latar belakang berubah */
    }

    .slide.active {
        background-image: none; /* Hapus latar belakang pada slide yang aktif */
    }
    

    @media (max-width: 767px) {
       

        .col-md-6 {
            margin-top: 20px; /* Menambahkan jarak antara slider dan tombol prev/next pada perangkat handphone */
        }

        .slider-pannel {
            height: 100%;
            align-items: center;
            margin: auto; /* Mengatur lebar slider agar penuh pada perangkat handphone */
        }

        .slide {
        width: 100%; /* Lebar slide di tampilan mobile 100% */
        height: auto; /* Sesuaikan tinggi slide dengan konten */
        margin: 10px auto; /* Pusatkan slide */ /* Mengatur agar slide berada di tengah pada perangkat handphone */

        }

        .indicator-dots {
            flex-direction: row;
            justify-content: center;
            margin-top: 160px;
            align-items: center;
            margin-left: 30%; 
        }

        .dot-wrapper {
            margin-right: 10px; /* Mengatur jarak antara indicator dots pada perangkat handphone */
        }

        .dot-number {
            font-size: 10px; /* Mengatur ukuran nomor dot pada perangkat handphone */
        }

        .carousel-control-prev,
        .carousel-control-next {
            font-size: 18px;
            margin: auto;
            margin-bottom:55%;
        }
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
        bgContainer.style.backgroundImage = `url('${slides[index].querySelector('.inner').src}')`;
        currentSlide = index;

        const slideText = slides[index].querySelector('.slide-text');
        const title = slideText.querySelector('h3').textContent;
        const description = slideText.querySelector('p').textContent;

        const textSlider = document.querySelector('.text-slider');
        textSlider.querySelector('h1').textContent = title;
        textSlider.querySelector('p').textContent = description;

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
    }
}
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

    // Panggil showSlide() untuk memastikan latar belakang awal sesuai dengan slide pertama
    showSlide(currentSlide);
</script>