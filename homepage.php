<?php
    include_once("header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty & Wellness</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Bring The well being & beauty naturally!!!</h1>
                <p>Your body does a lot for you, and our caring therapists can help you restore the many natural benefits both physically and mentally.</p>
            </div>
            <div class="header-image">
                <img src="images/IMG_4365.jpg" alt="Beauty Image">
            </div>
        </div>
    </header>

    <section class="services">
    <div class="container">
        <div class="service">
            <img src="images/cream.png" alt="cream">
            <h3>Browser</h3>
            <p>Experience and relaxation.</p>
            <a href="#">Read More</a>
        </div>
        <div class="service">
            <img src="images/kos.png" alt="product">
            <h3>Products</h3>
            <p>Bringing balance to your style and spirit.</p>
            <a href="#">Read More</a>
        </div>
        <div class="service">
            <img src="images/foundation.png" alt="Body Treatments">
            <h3>Foundation</h3>
            <p>Nourishing care for your body and skin.</p>
            <a href="#">Read More</a>
        </div>
    </div>
</section>

<section class="new" id="new">
        <div class="heading">
            <i>Our serum</i>
        </div>

        <div class="swiper new-serum">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <img src="images/se1.webp" alt="">
                </div>

                <div class="swiper-slide box">
                    <img src="images/se2.webp" alt="">

                </div>

                <div class="swiper-slide box">
                    <img src="images/se3.webp" alt="">

                </div>

                <div class="swiper-slide box">
                    <img src="images/se4.webp" alt="">
                </div>

                <div class="swiper-slide box">
                    <img src="images/se5.webp" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="lifestyle">
        <div class="container">
            <div class="lifestyle-content">
                <h2>Elevate Your Lifestyle by Bringing Balance and Well Being Into Your Life</h2>
                <p>Take the time to care for your body and mind. Our experts are here to provide the highest quality service to bring balance and wellness to your lifestyle.</p>
                <div class="icons">
                    <div class="icon-item">
                        <img src="images/Capture.PNG" alt="Experts">
                        <p>Beauty Experts</p>
                    </div>
                    <div class="icon-item">
                        <img src="images/Capture2.PNG" alt="Quality Services">
                        <p>Quality Services</p>
                    </div>
                    <div class="icon-item">
                        <img src="images/Capture3.PNG" alt="More">
                        <p>And More...</p>
                    </div>
                </div>
            </div>
            <div class="lifestyle-image">
                <img src="images/images.jpg" alt="Lifestyle Image">
            </div>
        </div>
    </section>
<?php
    include_once("footer.php")
?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="homepage.js"></script>
</body>
</html>
