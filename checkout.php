<?php session_start();

    require("../sign-forms.php");
    signForms();
    $account = isset($_SESSION['id']) ? ($_SESSION['id']) : (3);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="checkout-style.css">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
</head>

<body class="transition-fade">
    <!-- Main Content -->
    <main>
        <a id="back-div" href="../Cart/cart.php">
            <svg style="fill: black; font-size: 1.2rem;" xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            <h3 id="back-to-cart">Back to Cart</h2>
        </a>
        <form class="checkout-content">

            <div class="main-content">
                <div class="checkout-section sub-section">
                    <h2 class="section-title">Checkout</h2>
                    <div class="location-delivery">
                        <h4>Details</h4>
                        <div class="location-element">

                            <label for="">Full Name:</label>
                            <input type="text" name="fullname" id="fullname" placeholder="John Doe" class="required">
                        </div>
                        <div class="location-element">
                            <label for="">Phone Number:</label>
                            <input type="tel" name="" id="" placeholder="eg. +961 76 000 000" class="required">
                        </div>
                        <div class="location-element address">
                            <label for="">Address:</label>
                            <input type="text" name="" id="" placeholder="Street address, building, floor, etc"
                                class="required">
                        </div>
                        <div class="location-element">
                            <label for="">City:</label>
                            <select name="" id="">
                                <option value="0" disabled selected>Select a City</option>
                                <option value="1">Beirut</option>
                                <option value="2">Byblos</option>
                                <option value="3">Batroun</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="checkout-section sub-section">
                    <div class="payment-info">
                        <h4>Payment</h4>
                        <div class="payment-element">
                            <label for="" class="payment-lbl" id="payment-method">Payment Method:</label>
                            <select name="" id="">
                                <option value="">Select Payment Method</option>
                                <option value="Master Card">Master Card</option>
                                <option value="Visa Card">Visa Card</option>
                                <option value="American Express Card">American Express Card</option>
                                <option value="Cash on Delivery"> Cash on Delivery</option>
                            </select>
                            <p>*note that when Cash on Delivery is selected, you are not required to fill out card
                                details</p>
                        </div>
                        <!-- <div class="payment-name">
                            <div class="payment-element">
                                <label for="" class="payment-lbl">First Name:</label>
                                <input type="text"  name="" id="" placeholder="John"
                                    class="required name-inputs">
                            </div>
                            <div class="payment-element">
                                <label for="" class="payment-lbl">Last Name:</label>
                                <input type="text"  name="" id="" placeholder="Doe"
                                    class="required name-inputs">
                            </div>
                        </div> -->
                        <div class="payment-element">
                            <label for="" class="payment-lbl">Card Number:</label>
                            <input type="text" name="cart_number" class="payment-lbl" placeholder="0000 0000 0000 0000" class="card-related-inputs">
                        </div>
                        <div class="final-payment-elements">
                            <div class="payment-element">
                                <label for="" class="payment-lbl">Expiration Date:</label>
                                <input type="text" name="expiration" class="expiration" placeholder="dd/mm/yyyy" class="card-related-inputs">
                            </div>
                            <div class="payment-element">
                                <label for="" class="payment-lbl">CVV:</label>
                                <input type="text" name="cvv" class="payment-lbl" placeholder="***" class="card-related-inputs">
                            </div>

                        </div>
                        <div class="total-div">
                            <h3 class="total-title">Total:</h3>
                            <p class="total-price">
                        <?php 
                        require_once('../Cart/add_to_cart.php');
                        calcTotal($account);?>
            </p>
                        </div>

                    </div>

                </div>
                <button id="order" type="submit"> Order Now</button>
            </div>

        </form>
        </section>
        <!-- Pop-up when form is valid and submitted -->
        <div class="pop-up-container">
            <div class="pop-up">
                <button class="close-btn" id="close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
                <h2>Order Complete!</h2>
                <p>Thank you for your Order.<br>Your Order is on its way...</p>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="checkout.js"></script>
</body>

</html>