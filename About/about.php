<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="about-style.css">
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
    <main class="about-body transition-fade">
        <!-- Logo and Image part of about us -->
        <div class="logo-container">
            <div id="img-container">
                <img id="logo-about-us" , src="../Malaz Design/Malaz---icon cropped.png" alt="Logo">
            </div>
            <h1 id="h1-logo-text">Home Away From Home</h1>
        </div>
        <!-- Our Story Container -->
        <div class="our-story-container fade-in">
            <!-- Image slider -->
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img id="img1" src="../Malaz Design/Image for the slider.jpg">
                    </div>
                    <div class="item">
                        <img id="img2" src="../Malaz Design/Image slider 2.jpg">
                    </div>
                    <div class="item">
                        <img id="img3" src="../Malaz Design/Image slider 3.jpg">
                    </div>
                </div>
                <!-- dots -->
                <ul class="dots">
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="our-story-content">
                <h2 id="h1-story">Our Story</h2>
                <p class="our-story-p">Our restaurant founded by Layla in 1980, who learned to cook from her
                    grandmother.
                    Layla's passion for food is conveyed in every dish, made with fresh, high-quality ingredients.
                    The restaurant offers a warm and welcoming atmosphere where guests can enjoy delicious food and
                    good company.<br>
                    We invite you to join us for a taste of Lebanon!</p>
            </div>
        </div>
        <!-- Events Container -->
        <div class="event-container">
            <h2 id="h1-event" class="fade-in">Events</h2>
            <div class="event-img-container ">
                <div class="event-cont bd fade-in" id="ev1">
                    <img class="event-img im1" src="https://i.pinimg.com/564x/ed/d9/27/edd927f8337b1cecc1cfbc64e8c32024.jpg" alt="Birthday Party">
                    <div class="desc-content">
                        <h3 class="desc-h3">Birthday Parties</h3>
                        <p class="desc bd-desc">Our restaurant's lovely atmosphere makes it the ideal place to
                            celebrate birthdays. We can customize our main dining area to fit the theme and preferences
                            of your party, or you can reserve a special party area.</p>
                    </div>
                </div>
                <div class="event-cont fg fade-in" id="ev2">
                    <img class="event-img im2" src="https://i.pinimg.com/564x/ff/cd/98/ffcd98def707ee9458e81e08b383789d.jpg" alt="Family Gatherings">
                    <div class="desc-content fg-content">
                        <h3 class="desc-h3 fg-h3">Family Gatherings</h3>
                        <p class="desc fg-desc">Looking for a spot to bring the whole family together? At Malaz, we've
                            got the perfect place for your family gatherings. Our cozy space
                            is made for good times and great meals, where everyone can relax and enjoy.</p>
                    </div>
                </div>
                <div class="event-cont omn fade-in" id="ev3">
                    <img class="event-img im3" src="https://i.pinimg.com/564x/01/af/d2/01afd242b2465a8eb51249136a0c6e90.jpg" alt="Open Mic Nights">
                    <div class="desc-content">
                        <h3 class="desc-h3">Open Mic Nights</h3>
                        <p class="desc omn-desc">Ready to show off your talent? Join us in
                            our Open Mic Nights! It's your time to shine - whether you're a musician, poet, comedian, or
                            have any other talent, our stage is all yours.</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Our Food container -->
        <div class="our-food-container fade-in">
            <h2 id="h1-our-food">Our Food</h2>
            <marquee behavior="" direction="left">Unleash your taste buds on a world tour from your table! Authentic Lebanese & international flavors await at Malaz Restaurant.</marquee>
            <div id="our-food-img-cont">
                <img id="our-food-img" src="https://embed.widencdn.net/img/beef/sr17je3ewf/1120x560px/thai-burger-horizontal.tif?keep=c&u=7fueml">
                <div class="in-text">
                    <p>Offers on a Variety of International and Traditional Food</p>
                </div>
            </div>
            <br>
            <a href="../Menu/menu.php"><button id="visit-menu-btn">Visit Our Menu</button></a>
        </div>

        <!-- Quality Assurance container -->
        <div class="quality-assurance-container fade-in">
            <div id="quality-img-container">

                <img src="../Malaz Design/premium-certified-quality-stamp_78370-1800-removebg-preview.png" alt="" class="cert-img">
            </div>
            <div class="quality-certification">
                <h3>Quality Assurance:</h3>

                <p class="cert-text">Our restaurants adhere to strict international standards of hygiene and food
                    service. Furthermore, We abide by ISO 22 000 and local rules and legal requirements related to Food
                    Safety.</p>
            </div>
        </div>
    </main>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../main.js"></script>
    <script src="about.js"></script>
    <script src="../sign.js"></script>
</body>

</html>