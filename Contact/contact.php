<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="contact-style.css">
    <link rel="stylesheet" href="../sign-style.css">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
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
    <main class="contact-body transition-fade">
        <div class="contact-us-container">

            <div class="contact-info">
                <h1 id="h1-info">Get in touch</h1>

                <p id="p-info">Contact us to make an order or get more information about any food you are interested
                    in.
                    Our operators will provide you with all the inormation you need. Make sure to use the information
                    below to reach us
                </p>
                <section class="contact-sec sec1">
                    <h4 class="contact-h4 email-h4">Email:</h4>
                    <p class="contact-p email-p1">contact@yourcompany.com</p>
                </section>
                <section class="contact-sec sec2">
                    <h4 class="contact-h4 phone-h4">Phone:</h4>
                    <p class="contact-p phone-p1">(123) 456-7890</p>
                </section>
                <section class="contact-sec sec3">
                    <h4 class="contact-h4 address-h4">Address:</h4>
                    <p class="contact-p address p">Hamra, Main Road, Beirut, Lebanon</p>
                </section>
            </div>
            <form class="contact-form" method="post" id="contact-msg">
                <input type="name" name="name" class="contact-form-in in1" placeholder="Name" required>
                <input type="email" name="email" class="contact-form-in in2" placeholder="Email" required>
                <input type="text" name="subject" class="contact-form-in in3" placeholder="Subject">
                <input type="message" name="message" class="contact-form-in in4" placeholder="Type your Message here..." required>
                <button class="btn-send" type="submit">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <span>Send</span>
                </button>
            </form>
        </div>
        <!-- Visit us and Restaurant Hours -->
        <div class="visit-us-conatiner">
            <div class="visit-our-rest">
                <h1 id="visit-h1">Visit Our Restaurants</h1>
                <p id="visit-p">Step into our restaurant, where Lebanese tradition meets modern culinary delights!
                    We're excited to have you experience this mix of tradition and innovation in our dishes.</p>
                <button id="go-to-location">Get Directions <i class="fa-solid fa-location-crosshairs fa-xl" style="color: #f6f6f6;"></i></button>

            </div>

            <div class="visit-hours">
                <h4 id="upper-h4">Hours</h4>
                <div class="hour-div">
                    <div class="hour-sec sec1">
                        <h3 class="lower-h3">Monday - Friday</h3>
                        <p class="lower-p">8am - 10pm</p>
                    </div>

                    <div class="hour-sec sec1">
                        <h3 class="lower-h3">Saturday</h3>
                        <p class="lower-p">8am - 2pm</p>
                    </div>
                    <div class="hour-sec sec1">
                        <h3 class="lower-h3">Sunday</h3>
                        <p class="lower-p">9am - 6pm</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ section -->
        <div class="faq-container">
            <h1 id="h1-faq">Frequently Asked Questions</h1>
            <!-- </div> -->
            <div class="big-container">
                <div class="questions-container">
                    <div class="question-div">
                        <div class="question">
                            <h3>What do You Serve?</h3>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="answer ans1">
                            <p>
                                We serve a delightful mix of international flavors and traditional Lebanese dishes. From
                                mouthwatering kebabs to global favorites, there's something for everyone!
                            </p>
                        </div>
                    </div>
                    <div class="question-div">
                        <div class="question">
                            <h3>Do People Like the Restaurant?</h3>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="answer ans2">
                            <p>
                                Our customers love the diverse menu, and the warm atmosphere makes it a favorite spot
                                for many. If you don't believe us come try us. We're incredibly thankful for the support
                                and kind words that our guests
                                share, creating a sense of community and happiness within our restaurant.
                            </p>
                        </div>
                    </div>
                    <div class="question-div">
                        <div class="question">
                            <h3>What is your best traditional dish?</h3>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="answer ans3">
                            <p>
                                Our pride and joy when it comes to traditional Lebanese dishes is our Shish Taouk.
                                Grilled to
                                perfection, the flavorful marinated chicken is a true delight for the
                                taste buds. Served with a side of our special garlic sauce, it's a dish that captures
                                the essence of Lebanese cuisine, leaving our customers coming back for more.
                            </p>
                        </div>
                    </div>
                    <div class="question-div">
                        <div class="question">
                            <h3>How to apply for job at your restaurant?</h3>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="answer ans4">
                            <p>
                                We're thrilled you're interested! To join our family, simply drop by with your resume or
                                contact us through the phone number in the footer. We're always on the lookout for
                                passionate individuals
                                who share our love for food and hospitality. Your enthusiasm is the secret ingredient
                                we're looking for!
                            </p>
                        </div>
                    </div>
                    <div class="question-div">
                        <div class="question">
                            <h3>What are the requirements to work for your restaurant?</h3>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                        <div class="answer ans5">
                            <p>
                                We value enthusiasm, a positive attitude, and a love for good food. Experience is a
                                bonus, but a willingness to learn is essential. Bring your passion for hospitality, and
                                we'll provide the rest. Join us in creating a warm and inviting dining experience for
                                our guests!
                            </p>
                        </div>
                    </div>
                </div>
                <form class="ask-a-question" id='contact-question' method="post">
                    <h1 id="ask-h1">Ask A Different Question</h1>

                    <input type="name2" placeholder="Name" class="question-in input1" name="name">
                    <input type="email2" placeholder="Email" class="question-in input2" name="email">
                    <input type="question" placeholder="Type your question here..." class="question-in input3" name="question">
                    <button class="submitBtn">
                        Submit
                        <svg fill="white" viewBox="0 0 448 512" height="1em" class="arrow">
                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="toast-container">
            <div class="toast-text">
                <span class="material-symbols-outlined">
                    chat
                </span>
                <p>Thank You For Your Feedback :&rpar;</p>
                <i class="fa-solid fa-xmark close close1"></i>
            </div>
        </div>
        <div class="no-input">
            <div class="no-input-text">
                <span class="material-symbols-outlined">
                    sentiment_dissatisfied
                </span>
                <p>You Haven't Filled The Form Properly</p>
                <i class="fa-solid fa-xmark close close1"></i>
            </div>
        </div>
        <div class="toast-container2">
            <div class="toast-text2">
                <span class="material-symbols-outlined">
                    help
                </span>
                <p>We Will Make sure to answer your question :&rpar;</p>
                <i class="fa-solid fa-xmark close close2"></i>
            </div>
        </div>
        <div class="no-input2">
            <div class="no-input-text2">
                <span class="material-symbols-outlined">
                    sentiment_dissatisfied
                </span>
                <p>You Haven't Filled The Form Properly</p>
                <i class="fa-solid fa-xmark close close2"></i>
            </div>
        </div>
    </main>
    <?php
    require('../footer.php');
    Footer();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="../main.js"></script>
    <script src="contact.js"></script>
    <script src="../sign.js"></script>
</body>

</html>