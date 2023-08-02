<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid" id="container-fluid-background">
        <div class="container">
            <div class="row pt-5 mt-5">
                <div class="col-md-6">
                    <div class="text-wrap text-center">
                        <h3 id="slide-title">Slider Text 1</h3>
                        <p id="slide-description">Deskripsi slider 1.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="slider-wrap">
                        <div class="slider-pannel col-md-12">
                            <div class="slide slide1 col-md-4 active">
                                <img class="inner"
                                    src="<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>"
                                    class="col-12" alt="...">
                            </div>

                            <div class="slide slide2  col-md-4">
                                <img class="inner"
                                    src="https://i.pinimg.com/originals/db/ed/be/dbedbec4b91f26fa057532b86a28e91b.jpg"
                                    class="col-12" alt="...">
                            </div>

                            <div class="slide slide3 col-md-4">
                                <img class="inner"
                                    src="https://w0.peakpx.com/wallpaper/99/128/HD-wallpaper-sunset-indah-keindahan-matahari-terbenam-pantai.jpg"
                                    class="col-12" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="slide-indicators text-center">
                        <span class="indicator-dot active" onclick="showSlide(0)"></span>
                        <span class="indicator-dot" onclick="showSlide(1)"></span>
                        <span class="indicator-dot" onclick="showSlide(2)"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="carousel-control-prev" onclick="prevSlide()">
                            <span class="carousel-control-prev-icon" style="color: black;"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" onclick="nextSlide()">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
   body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        
    }

    .slider-wrap {
        display: flex;
    }

    .slider-pannel {
        display: flex;
    }

    .slide {
        position: relative;
        overflow: hidden;
        padding-bottom: 75%;
        margin: 20px;
        border: 1px solid rgba(179, 179, 179, 0.671);
        border-radius: 30px;
        box-shadow: 10px 30px 50px 0 rgba(179, 179, 179, 0.671);
        cursor: pointer;
        background: transparent;
        min-width: 230px;
        min-height: 130px ;
    }

    .slide:not(.active) {
        transform: scale(0.9);
    }

    .inner {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
    }
    .text-wrap {
        padding: 20px;
        text-align: center;
    }

    .active{
        height: 80%;
    }

    .carousel-control-prev,
    .carousel-control-next {
        top: 85%;
        z-index: 1;
        width: 30px;
        height: 30px;
        background-color: aquamarine;
        border-radius: 50%;
        color: burlywood;
        font-size: 24px;
        transition: opacity 0.3s ease-in-out;
        margin: 0 580px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 0.7;
    }

    .slide-indicators {
        margin-top: 20px;
    }

    .indicator-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: aquamarine;
        margin: 0 4px;
        cursor: pointer;
    }

    .indicator-dot.active {
        background-color: pink;
    }
    #container-fluid-background {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        min-height: 100vh; 
        background-image: url('https://i.pinimg.com/originals/1b/29/d4/1b29d447b384f9a568a7d2fa927e5655.jpg'); /* Mengatur gambar latar belakang awal di sini */
    }
</style>

<script>
    let activeSlide = 0;
    const slides = document.querySelectorAll(".slide");
    const slideTitle = document.getElementById("slide-title");
    const slideDescription = document.getElementById("slide-description");
    const slideIndicators = document.querySelectorAll(".indicator-dot");
    let isAnimating = false;

    function showSlide(index) {
        if (index >= 0 && index < slides.length && !isAnimating) {
            isAnimating = true;
            const previousSlide = activeSlide;
            activeSlide = index;

            slides[previousSlide].classList.add("previous");
            slides[activeSlide].classList.add("active");
            slideIndicators[previousSlide].classList.remove("active");
            slideIndicators[activeSlide].classList.add("active");

            setTimeout(() => {
                slides[previousSlide].classList.remove("previous");
                slides[previousSlide].classList.remove("active");
                isAnimating = false;
            }, 200); // Sesuaikan durasi transisi dengan kebutuhan Anda

            updateSlideContent();
            updateBackgroundImage();
        }
    }

    function updateSlideContent() {
        const slideTitles = ["Slider Text 1", "Slider Text 2", "Slider Text 3"];
        const slideDescriptions = [
            "Gunung Prau.",
            "Banda Neira.",
            "Sunset Pantai."
        ];
        slideTitle.innerText = slideTitles[activeSlide];
        slideDescription.innerText = slideDescriptions[activeSlide];
    }

    function updateBackgroundImage() {
        const backgroundImageUrls = [
            "url('https://i.pinimg.com/originals/1b/29/d4/1b29d447b384f9a568a7d2fa927e5655.jpg')",
            "url('https://i.pinimg.com/originals/db/ed/be/dbedbec4b91f26fa057532b86a28e91b.jpg')",
            "url('https://w0.peakpx.com/wallpaper/99/128/HD-wallpaper-sunset-indah-keindahan-matahari-terbenam-pantai.jpg')"
        ];
        const containerFluid = document.getElementById("container-fluid-background");
        containerFluid.style.backgroundImage = backgroundImageUrls[activeSlide];
    }

    function nextSlide() {
        let prevIndex = activeSlide + 1;
        if (prevIndex >= slides.length) {
            prevIndex = 0;
        }
        showSlide(prevIndex);
    }

    function prevSlide() {
        let nextIndex = activeSlide - 1;
        if (nextIndex < 0) {
            nextIndex = slides.length - 1;
        }
        showSlide(nextIndex);
    }

    // ... (existing code)

// Function to handle slide click
function onSlideClick(index) {
    showSlide(index);
}

// Function to handle indicator dot click
function onIndicatorDotClick(index) {
    showSlide(index);
}

// Add click event listeners to each slide and indicator dot
for (let i = 0; i < slides.length; i++) {
    slides[i].addEventListener("click", () => onSlideClick(i));
    slideIndicators[i].addEventListener("click", () => onIndicatorDotClick(i));
}

// ... (existing code)

    // Menambahkan event listener untuk tombol "prev" dan "next"
    const prevButton = document.querySelector(".carousel-control-prev");
    const nextButton = document.querySelector(".carousel-control-next");
    prevButton.addEventListener("click", prevSlide);
    nextButton.addEventListener("click", nextSlide);

    // Set slide awal
    updateSlideContent();
    updateBackgroundImage();
</script>

