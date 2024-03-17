<?php 

session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="locations-style.css">
    <link rel="stylesheet" href="../sign-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>

<body>
    <?php
    require("../navbar.php");
    NavBar();
    require("../sign-forms.php");
    signForms();
    ?>
    <!-- Body -->
    <!-- main -->
    <main class="locations-body transition-fade">
        <div class="beginning">
            <div class="info">
                <!-- Welcome Info for Locations page -->
                <h2 class="title">Visit Our Locations</h2>
                <p>Welcome to Malaz, where culinary delights meet simplicity. Nestled in the diverse cities of Lebanon, our restaurant offers a cozy escape for those seeking exceptional flavors.
                    .</p>
                <!-- Go to About Us Page -->
                <button> <a href="about.html"> Learn more about us </a></button>
            </div>
            <!-- Images slider -->
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <!-- Picture 1 -->
                        <img src="pexels-gül-ik-4009464.jpg">
                    </div>
                    <div class="item">
                        <!-- Picture 2 -->
                        <img src="christelle-hayek-VwxEMRuem0w-unsplash.jpg">
                    </div>
                    <div class="item">
                        <!-- Picture 3 -->
                        <img src="alex-harmuth-bOICdD-Gulk-unsplash.jpg">
                    </div>
                </div>
                <!-- Dots-->
                <ul class="dots">
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

        </div>
        <!-- Locations -->
        <section class="locations-container">
            <h5 id="title"> Maps</h5>

            <!-- Beirut -->
            <div class="locations-lebanon Beirut">

                <div class="information">
                    <!-- Info about location -->
                    <h5>Beirut - Headquarters </h5>

                    <p>In the heart of the vibrant Lebanese capital, our Beirut location serves as the headquarters,
                        blending the rich culinary heritage of the region with modern innovation to create a destination
                        rich in flavors.
                    </p>
                    <!-- Map -->
                    <iframe class="location-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52992.23057524542!2d35.46308258172096!3d33.88928269489302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f17215880a78f%3A0x729182bae99836b4!2sBeirut!5e0!3m2!1sen!2slb!4v1699707471984!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
                <!-- Go to contact us page -->
                <button class="go-to-contactus"> <a href="../Contact/contact.php">Contact us for more information </a></button>
            </div>
            <!-- Byblos -->

            <div class="locations-lebanon Byblos">

                <div class="information">
                    <!-- Info about location -->
                    <h5>Byblos - Origin</h5>

                    <p>In the historical city of Byblos, our culinary journey began. Here, we honor the roots of our
                        culinary adventure, offering an experience that reflects ancient traditions and flavors that
                        inspired our foundation</p>
                </div>

                <!-- Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13211.648146110054!2d35.6519282!3d34.123001599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f5ca814ab769b%3A0xbe47735b265d616e!2sByblos!5e0!3m2!1sen!2slb!4v1699819145682!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- Go to contact us page -->
                <button class="go-to-contactus"> <a href="../Contact/contact.php">Contact us for more information </a></button>
            </div>
            <!-- Batroun -->

            <div class="locations-lebanon Batroun">


                <div class="information">
                    <!-- Info about location -->
                    <h5>Batroun - Our Newest Location</h5>

                    <p>Overlooking the tranquil shores of Batroun, our new location brings a breath of sea air to our
                        culinary repertoire. Drawing inspiration from coastal influences, it presents a unique and
                        contemporary take on traditional Lebanese cuisine. </p>
                </div>
                <!-- Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13191.798112702681!2d35.664290400000006!3d34.2498315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f58b24cc6e709%3A0xfd68c47a5405dcad!2sBatroun!5e0!3m2!1sen!2slb!4v1699819207852!5m2!1sen!2slb" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- Go to contact us page -->
                <button class="go-to-contactus"> <a href="../Contact/contact.php">Contact us for more information </a></button>
            </div>
        </section>


        </div>

    </main>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
    <script src="../main.js"></script>
    <script src="locations.js"></script>
    <script src="../sign.js"></script>
</body>

</html>