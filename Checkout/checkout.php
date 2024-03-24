
<?php 

if(session_status()!=2){
    session_start();
}
include('../config.php');
?>


<!DOCTYPE html>
<html lang="en">
<title>Checkout</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="checkout-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
</head>

<body class="transition-fade">
    <?php
    require("../sign-forms.php");
    signForms();
    include "account-info.php";
    ?>

    <!-- Main Content -->
    <main>
        <a id="back-div" href="../Cart/cart.php">
            <svg style="fill: black; font-size: 1.2rem;" xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512">
                <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            <h3 id="back-to-cart">Back to Cart</h2>
        </a>
        
        <form class="checkout-content" id="formOrder">

            <div class="main-content">
                <div class="checkout-section sub-section">
                    <h2 class="section-title">Checkout</h2>
                    <div class="location-delivery">
                        <h4>Details</h4>
                        <div class="location-element">

                            <label for="">Full Name:</label>
                            <input type="text" name="fullname" id="fullname" placeholder="John Doe" class="required" value="<?php echo $fname." ".$lname; ?>">
                        </div>
                        <div class="location-element">
                            <label for="">Phone Number:</label>
                            <input type="tel" name="Phone" id="phone" placeholder="eg. +961 76 000 000" class="required" value="<?php echo $phone; ?>">
                        </div>
                        <div class="location-element address">
                            <label for="">Address:</label>
                            <input type="text" name="Address" id="address" placeholder="Street address, building, floor, etc" class="required" value="<?php echo $Add; ?>">
                        </div>
                        <div class="location-element">
                            <label for="city">City:</label>
                            <select name="city" id="city">
                                <option value="0" disabled selected>Select a City</option>
                                <option value="Beirut">Beirut</option>
                                <option value="Byblos">Byblos</option>
                                <option value="Batroun">Batroun</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="checkout-section sub-section">
                    <div class="payment-info">
                        <h4>Payment</h4>
                        <div class="payment-element">
                            <label for="" class="payment-lbl" id="">Payment Method:</label>
                            <select name="payment-method" id="payment-method">
                                <option value="">Select Payment Method</option>
                                <option value="Master Card">Master Card</option>
                                <option value="Visa Card">Visa Card</option>
                                <option value="American Express Card">American Express Card</option>
                                <option value="Cash on Delivery"> Cash on Delivery</option>
                            </select>
                            <small class="error"></small>
                            <p>*note that when Cash on Delivery is selected, you are not required to fill out card
                                details</p>
                        </div>
                        <div class="payment-element c">
                            <label for="" class="payment-lbl">Card Number:</label>
                            <input type="text" name="cart_number" class="payment-lbl" pattern="[0-9]*" placeholder="0000 0000 0000 0000" maxlength="16">
                        </div>
                        <div class="final-payment-elements c">
                            <div class="payment-element">
                                <label for="" class="payment-lbl">Expiration Date:</label>
                                <input type="date" name="expiration" class="expiration" placeholder="dd/mm/yyyy" >
                            </div>
                            <script>
     //expiration
    $(document).ready(function() {
        $('#expiration').change(function() {
            var expirationDate = $(this).val();
            $.ajax({
                url: 'set_expiration.php', 
                method: 'POST',
                data: { expirationDate: expirationDate },
                success: function(response) {
                    console.log(response); 
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
        });
    });
</script>
       <div class="payment-element">
                                <label for="" class="payment-lbl">CVV:</label>
                                <input type="text" name="cvv" class="payment-lbl" placeholder="***" pattern="[0-9]*" minlength="1" maxlength="3">
                            </div>

                        </div>
                        <div class="total-div">
                            <h3 class="total-title">Total:</h3>
                            <p class="total-price">
                        <?php 
                        echo "$" . strval(number_format($total, 2, '.', ""));
                        ?>
                        </p>
                        </div>

                    </div>

                </div>
                <script>
    function clearInputs() {
        // Clear CVV input
        $('.payment-lbl').val('');

        // Clear expiration date input
        $('.expiration').val('');
        //clear payment method
        $('#payment-method').val('');
    }
</script>
                <?php
                echo '<input name="order" id="order" type="submit" value="Order Now" onclick="clearInputs()" data-account="'.$account.'">';

                ?>
            </div>

        </form>
        </section>
        <!-- Pop-up when form is valid and submitted -->
        <div class="pop-up-container">
            <div class="pop-up">
                <button class="close-btn" id="close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 384 512">
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
                <h2>Order Complete!</h2>
                <p>Thank you for your Order.<br>Your Order is on its way...</p>
            </div>
        </div>
    </main>
    <script>
    var city = "<?php echo $city; ?>";
    </script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="checkout.js"></script>
</body>

</html>