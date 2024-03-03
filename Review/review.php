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
    <link rel="stylesheet" href="../sign-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="review-style.css">
</head>

<body id="main">
    <?php
    require("../navbar.php");
    NavBar();
    require("../sign-forms.php");
    signForms();
    require('review-repository.php');
    $accInfo=findAccountInfo();
    $fname=$accInfo[0];
    $lname=$accInfo[1];
    $email=$accInfo[2];
    ?>
    <!-- Body -->

    <!-- main -->
    <!-- Page title  -->
    <section class="main-section transition-fade">
        <div class="image">
            <img src="../Malaz Design/Malaz---Brand-Pattern-2.png">
        </div>
        <main class="review-body">
            <div class="Title">
                <section class="title-text">
                    <h1 class="first-part">Share Your Experience</h1>
                </section>
                <section class="title-img">
                    <img src="../Malaz Design\Malaz---icon cropped.png">
                </section>
            </div>
            <div class="main-container">
                <!-- General information  -->
                <div class="wrapper">
                    <form name="feedback-form" method="post" >
                        <!-- Full Name -->
                        <section class="general-information">
                            <section class="overflow">
                                <section class="section">
                                    <h5>Name</h5>
                                    <section class="names">
                                        <!-- first name -->
                                        <section id="first-name" class="required-feedback">
                                            <div class="label">
                                                <label for="firstname">First Name</label>
                                                <span class="required">*</span>
                                            </div>
                                            <input type="text" placeholder="Your Name" class="input" id="firstname" name="firstname" value="<?php echo $fname; ?>">
                                            <small>Error Message</small>
                                        </section>
                                        <!-- last-name -->
                                        <section id="last-name" class="required-feedback">
                                            <div class="label other">
                                                <label>Last Name</label>
                                                <span class="required">*</span>
                                            </div>
                                            <input type="text" placeholder="Your Name" class="input other" id="lastname" name="lastname" value="<?php echo $lname; ?>">
                                            <small>Error Message</small>
                                        </section>
                                    </section>
                                </section>
                                <section class="section contact-info">
                                    <h5> Contact Information</h5>
                                    <section class="information">
                                        <!-- Email number -->
                                        <section class="email-or-phone required-feedback">
                                            <div class="label other">
                                                <label>Email</label>
                                                <span class="required">*</span>
                                            </div>
                                            <input type="email" placeholder="Email" class="input other" name="email" id="email-phone" value="<?php echo $email; ?>">
                                            <small>Error Message</small>
                                        </section>
                                    </section>
                                </section>
                            </section>
                        </section>
                        <section class="order">
                            <h5>Service </h5>
                            <!-- order type: delivery or in house -->
                            <section class="order-type required-feedback">
                                <section class="delivery-InHouse">
                                    <div class="service-type delivery">
                                        <input type="radio" name="type-of-order" value="0" id="DeliveryRadio" class="type-check">
                                        <label for="DeliveryRadio" class="order-name">Delivery</label>
                                    </div>

                                    <div class="service-type in-house">
                                        <input type="radio" name="type-of-order" value="1" id="InHouseRadio" class="type-check">
                                        <label for="InHouseRadio" class="order-name"> In House</label>
                                    </div>
                                </section>
                                <small id="order">Error Message</small>
                            </section>
                            <!-- Delivery if Active  -->
                            <section class="hidden Experience Delivery-Active" id="#del">
                                <!-- Rating - Delivery -->
                                <section class="rating">
                                    <!-- Delivery Time -->
                                    <div class="rating-item">

                                        <label>Delivery Time</label>
                                        <!-- star rating -->
                                        <div class="rate Delivery">

                                            <input type="radio" id="star5-deliverytime" name="rate-deliverytime" value="5" data-category="delivery" />
                                            <label for="star5-deliverytime"></label>
                                            <input type="radio" id="star4-deliverytime" name="rate-deliverytime" value="4" data-category="delivery" />
                                            <label for="star4-deliverytime"></label>
                                            <input type="radio" id="star3-deliverytime" name="rate-deliverytime" value="3" data-category="delivery" />
                                            <label for="star3-deliverytime"></label>
                                            <input type="radio" id="star2-deliverytime" name="rate-deliverytime" value="2" data-category="delivery" />
                                            <label for="star2-deliverytime"></label>
                                            <input type="radio" id="star1-deliverytime" name="rate-deliverytime" value="1" data-category="delivery" />
                                            <label for="star1-deliverytime"></label>
                                        </div>
                                    </div>
                                    <!-- Food Quality -->
                                    <div class="rating-item">
                                        <label>Food Quality</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-foodquality" name="rate-foodquality" value="5" data-category="delivery" />
                                            <label for="star5-foodquality"></label>
                                            <input type="radio" id="star4-foodquality" name="rate-foodquality" value="4" data-category="delivery" />
                                            <label for="star4-foodquality"></label>
                                            <input type="radio" id="star3-foodquality" name="rate-foodquality" value="3" data-category="delivery" />
                                            <label for="star3-foodquality"></label>
                                            <input type="radio" id="star2-foodquality" name="rate-foodquality" value="2" data-category="delivery" />
                                            <label for="star2-foodquality"></label>
                                            <input type="radio" id="star1-foodquality" name="rate-foodquality" value="1" data-category="delivery" />
                                            <label for="star1-foodquality"></label>
                                        </div>
                                    </div>
                                    <!-- Cleanliness of the Restaurant -->
                                    <div class="rating-item">
                                        <label>Cleanliness</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-cleanliness" name="rate-cleanliness" value="5" data-category="delivery" />
                                            <label for="star5-cleanliness"></label>
                                            <input type="radio" id="star4-cleanliness" name="rate-cleanliness" value="4" data-category="delivery" />
                                            <label for="star4-cleanliness"></label>
                                            <input type="radio" id="star3-cleanliness" name="rate-cleanliness" value="3" data-category="delivery" />
                                            <label for="star3-cleanliness"></label>
                                            <input type="radio" id="star2-cleanliness" name="rate-cleanliness" value="2" data-category="delivery" />
                                            <label for="star2-cleanliness"></label>
                                            <input type="radio" id="star1-cleanliness" name="rate-cleanliness" value="1" data-category="delivery" />
                                            <label for="star1-cleanliness"></label>
                                        </div>
                                    </div>
                                    <!-- Packaging -->
                                    <div class="rating-item">
                                        <label>Packaging</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-packaging" name="rate-packaging" value="5" data-category="delivery" />
                                            <label for="star5-packaging"></label>
                                            <input type="radio" id="star4-packaging" name="rate-packaging" value="4" data-category="delivery" />
                                            <label for="star4-packaging"></label>
                                            <input type="radio" id="star3-packaging" name="rate-packaging" value="3" data-category="delivery" />
                                            <label for="star3-packaging"></label>
                                            <input type="radio" id="star2-packaging" name="rate-packaging" value="2" data-category="delivery" />
                                            <label for="star2-packaging"></label>
                                            <input type="radio" id="star1-packaging" name="rate-packaging" value="1" data-category="delivery" />
                                            <label for="star1-packaging"></label>
                                        </div>
                                    </div>
                                    <!-- Customer Service -->
                                    <div class="rating-item">
                                        <label>Customer Service</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-customerservice" name="rate-customerservice" value="5" data-category="delivery" />
                                            <label for="star5-customerservice"></label>
                                            <input type="radio" id="star4-customerservice" name="rate-customerservice" value="4" data-category="delivery" />
                                            <label for="star4-customerservice"></label>
                                            <input type="radio" id="star3-customerservice" name="rate-customerservice" value="3" data-category="delivery" />
                                            <label for="star3-customerservice"></label>
                                            <input type="radio" id="star2-customerservice" name="rate-customerservice" value="2" data-category="delivery" />
                                            <label for="star2-customerservice"></label>
                                            <input type="radio" id="star1-customerservice" name="rate-customerservice" value="1" data-category="delivery" />
                                            <label for="star1-customerservice"></label>
                                        </div>
                                    </div>
                                </section>
                                <!-- Extra Feedback - Recommended Changes -->
                                <section class="extra-feedback">
                                    <label>What can we do to improve your experience?</label>
                                    <textarea rows="5" cols="40" class="text-area" id="improve" placeholder=" Enter your text here" name="del-msg"></textarea>
                                </section>
                            </section>

                            <!-- In House: if Active -->
                            <section class="hidden Experience InHouse-Active" id="#in">
                                <!-- locations -->
                                <select value="locations" id="Select" name="location">
                                    <option class="options" value="" disabled selected> Select Restaurant</option>
                                    <option class="options" value="Beirut">Beirut</option>
                                    <option class="options" value="Tripoli">Tripoli</option>
                                    <option class="options" value="Tyre">Tyre</option>
                                </select>
                                <!-- Rating- In Houuse -->
                                <section class="rating">
                                    <!-- Service -->
                                    <div class="rating-item">
                                        <label>Service</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-service" name="rate-service" class='service-house' value="5" data-category="house" />
                                            <label for="star5-service"></label>
                                            <input type="radio" id="star4-service" name="rate-service" class='service-house' value="4" data-category="house" />
                                            <label for="star4-service"></label>
                                            <input type="radio" id="star3-service" name="rate-service" class='service-house' value="3" data-category="house" />
                                            <label for="star3-service"></label>
                                            <input type="radio" id="star2-service" name="rate-service" class='service-house' value="2" data-category="house" />
                                            <label for="star2-service"></label>
                                            <input type="radio" id="star1-service" name="rate-service" class='service-house' value="1" data-category="house" />
                                            <label for="star1-service"></label>
                                        </div>
                                    </div>
                                    <!-- Food Quality -->
                                    <div class="rating-item">
                                        <label>Food Quality</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-foodquality2" name="rate-foodquality2" value="5" data-category="house" />
                                            <label for="star5-foodquality2"></label>
                                            <input type="radio" id="star4-foodquality2" name="rate-foodquality2" value="4" data-category="house" />
                                            <label for="star4-foodquality2"></label>
                                            <input type="radio" id="star3-foodquality2" name="rate-foodquality2" value="3" data-category="house" />
                                            <label for="star3-foodquality2"></label>
                                            <input type="radio" id="star2-foodquality2" name="rate-foodquality2" value="2" data-category="house" />
                                            <label for="star2-foodquality2"></label>
                                            <input type="radio" id="star1-foodquality2" name="rate-foodquality2" value="1" data-category="house" />
                                            <label for="star1-foodquality2"></label>
                                        </div>
                                    </div>
                                    <!-- Cleanliness -->
                                    <div class="rating-item">
                                        <label>Cleanliness</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-cleanliness2" name="rate-cleanliness2" value="5" data-category="house" />
                                            <label for="star5-cleanliness2"></label>
                                            <input type="radio" id="star4-cleanliness2" name="rate-cleanliness2" value="4" data-category="house" />
                                            <label for="star4-cleanliness2"></label>
                                            <input type="radio" id="star3-cleanliness2" name="rate-cleanliness2" value="3" data-category="house" />
                                            <label for="star3-cleanliness2"></label>
                                            <input type="radio" id="star2-cleanliness2" name="rate-cleanliness2" value="2" data-category="house" />
                                            <label for="star2-cleanliness2"></label>
                                            <input type="radio" id="star1-cleanliness2" name="rate-cleanliness2" value="1" data-category="house" />
                                            <label for="star1-cleanliness2"></label>
                                        </div>
                                    </div>
                                    <!-- Atmosphere -->
                                    <div class="rating-item">
                                        <label>Atmosphere</label>
                                        <!-- star rating -->
                                        <div class="rate">
                                            <input type="radio" id="star5-atmosphere" name="rate-atmosphere" value="5" data-category="house" />
                                            <label for="star5-atmosphere"></label>
                                            <input type="radio" id="star4-atmosphere" name="rate-atmosphere" value="4" data-category="house" />
                                            <label for="star4-atmosphere"></label>
                                            <input type="radio" id="star3-atmosphere" name="rate-atmosphere" value="3" data-category="house" />
                                            <label for="star3-atmosphere"></label>
                                            <input type="radio" id="star2-atmosphere" name="rate-atmosphere" value="2" data-category="house" />
                                            <label for="star2-atmosphere"></label>
                                            <input type="radio" id="star1-atmosphere" name="rate-atmosphere" value="1" data-category="house" />
                                            <label for="star1-atmosphere"></label>
                                        </div>
                                    </div>
                                </section>
                                <!-- Extra Feedback - Recommended Changes -->
                                <section class="extra-feedback">
                                    <label>What can we do to improve your experience?</label>
                                    <textarea rows="5" cols="40" class="text-area" id="improve2" placeholder=" Enter your text here" name="in-msg"></textarea>
                                </section>
                            </section>
                        </section>
                        <!-- Submit Button -->
                        <button type="submit" class="show-popup" id="btn-review">Submit</button>
                        <p class="success"></p>
                    </form>
                </div>
        </main>
        <div class="image">
            <img src="../Malaz Design/Malaz---Brand-Pattern-2.png">
        </div>
    </section>

    <div class="pop-up-container">
        <div class="pop-up">
            <button class="close-btn" id="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <h2>Submitted</h2>
            <p>Thank you for your feedback!</p>
        </div>
    </div>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="../main.js"></script>
    <script src="review.js" id="#src"></script>
    <script src="../sign.js"></script>
</body>

</html>