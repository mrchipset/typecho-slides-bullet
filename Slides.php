<style>
    * {box-sizing:border-box}

    /* Slideshow container */
    .slideshow-container {
        min-width: 240px;
        min-height: 180px;
        max-height: 180px;
        overflow: hidden;
        position: relative;
        margin: auto;
    }

    /* Hide the images by default */
    .fade-slides {
        position: absolute;
        display: block;
        opacity: 0;
        transition: opacity 2s ease-in-out;
    }


    /* Next & previous buttons */
    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        z-index: 9;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
        background-color: rgba(0,0,0,0.8);
    }

    /* Caption text */
    .bullet-text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 8px;
        position: absolute;
        bottom: 4px;
        width: 100%;
        text-align: center;
        z-index: 9;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
        background-color: #71717150;
        border-radius: 6px;
        z-index: 9;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active, .dot:hover {
        background-color: #717171;
    }

</style>


<div id="slides-div">
    <div id="slideshow-container" class="slideshow-container">
        <?php
        // 轮播图图片路径数组
         
        $id = 1;
        $length = count($contents);
        foreach ($contents as $content) {
            $url = $content['url'];
            $image = $content['image'];
            $text = $content['text'];
            if (empty($url)) {
                echo <<<HTML
                <div class="fade-slides">
                    <div class="numbertext">$id/$length</div>
                        <a href="#"><img src="$image" style="width:100%"></a>
                    <div class="bullet-text">$text</div>
                </div>
                HTML;
            } else {
                echo <<<HTML
                <div class="fade-slides">
                    <div class="numbertext">$id/$length</div>
                        <a href="$url"><img src="$image" style="width:100%"></a>
                    <div class="bullet-text">$text</div>
                </div>
                HTML;
            }

            $id += 1;
        }
        ?>

        <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <!-- The dots/circles -->
    <div style="text-align:center;margin-top:2px">
        <?php
            $length = count($contents);
            for ($i = 0; $i < $length; $i++) {
                echo <<<HTML
                <span class="dot" onclick="currentSlide($i+1)"></span>
                HTML;
            }
        ?>
      
    </div>
</div>




<script>
    const slides = document.getElementById("slides-div");
    const container = document.getElementById("bulletin");
    if (container == null) {
        slides.style.display = "none";
    }
    container.appendChild(slides);
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("fade-slides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.opacity = "0";
            slides[slideIndex-1].style.zIndex = "0";

            // slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].classList.remove("active");
        }
        slides[slideIndex-1].style.opacity = "1";
        slides[slideIndex-1].style.zIndex = "1";
        // slides[slideIndex-1].style.display = "block";

        dots[slideIndex-1].classList.add("active");
    }

    setInterval(() => {
        plusSlides(1);
    }, 3000);
</script>
