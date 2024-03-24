
<?php session_start();

    require("../sign-forms.php");
    include('../config.php');
    signForms();
    $account = isset($_SESSION['id']) ? ($_SESSION['id']) : (3);

    

    $accInfo=findAccountInfo();
    $fname=$accInfo[0];
    $lname=$accInfo[1];
    $Add=$accInfo[2];
    $phone=$accInfo[3];
    $city=$accInfo[4];
    function findAccountInfo()
    {
        global $account;
        global $conn;
        if ($account != 3) {
            $query = "SELECT * FROM account WHERE AccountNum = ?";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("i", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
    
            $accInfo = mysqli_fetch_array($result);
            return [$accInfo['FirstName'], $accInfo['LastName'], $accInfo['Address'],$accInfo['Phone'],$accInfo['City']];
        }
        return ['', '', '','','' ];
    }
    require_once('../Cart/add_to_cart.php');
    // $totalPrice=calcTotal($account);

    if (isset($_POST['order'])) {
        // Insert the new order into the orders table
        $insertQuery = "INSERT INTO orders (AccountNum, TotalPrice) VALUES (?,  ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ii", $account, calcTotal($account));
        $stmt->execute();
        $selectmax="SELECT MAX(OrderNum) as OrderNum from orders";
        $res=mysqli_query($conn,$selectmax);
        $row=mysqli_fetch_assoc($res);
        $newOrderNum = $row["OrderNum"];
    
        $ItemArray = [];
        $selectQuery = "SELECT ItemNum, Quantity FROM Cart WHERE AccountNum = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $account);
        $stmt->execute();
        $stmt->bind_result($itemNum, $quantity); 
    
        while ($stmt->fetch()) {
            $ItemArray[] = ['ItemNum' => $itemNum, 'Quantity' => $quantity];
        }
    
        foreach ($ItemArray as $item) {
            $insertIncludesQuery = "INSERT INTO includes (OrderNum, ItemNum, Quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertIncludesQuery);
            $stmt->bind_param("iii", $newOrderNum, $item['ItemNum'], $item['Quantity']);
            $stmt->execute();
        }
          //delete all rows from thew cart items
        $deleteQuery = "DELETE FROM Cart WHERE AccountNum = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $account);
        $stmt->execute();
    }



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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
</head>

<body class="transition-fade">
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
        <form class="checkout-content">

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

                <script>
//update the inputs
    $(document).ready(function() {
        $('#order').click(function(e) {
            e.preventDefault(); 
            var fullname = $('#fullname').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var city = $('#city').val();
            let fname=fullname.split(' ');
            let f=fname[0];
            let lname=fname[1];
            $.ajax({
                type: 'POST',
                url: 'update_account.php',
                data: {
                    fname: f,
                    lname:lname,
                    phone: phone,
                    address: address,
                    city: city,
                    id:<?php echo $account;  ?>
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
    });
</script>

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
                            <p>*note that when Cash on Delivery is selected, you are not required to fill out card
                                details</p>
                        </div>
                        <div class="payment-element c">
                            <label for="" class="payment-lbl">Card Number:</label>
                            <input type="text" name="cart_number" class="payment-lbl" placeholder="0000 0000 0000 0000" >
                        </div>
                        <div class="final-payment-elements c">
                            <div class="payment-element">
                                <label for="" class="payment-lbl">Expiration Date:</label>
                                <input type="text" name="expiration" class="expiration" placeholder="dd/mm/yyyy" >
                            </div>
                            <div class="payment-element">
                                <label for="" class="payment-lbl">CVV:</label>
                                <input type="text" name="cvv" class="payment-lbl" placeholder="***" >
                            </div>

                        </div>
                        <div class="total-div">
                            <h3 class="total-title">Total:</h3>
                            <p class="total-price">
                        <?php 
                        calcTotal($account);?>
            </p>
                        </div>

                    </div>

                </div>
                <input name="order" id="order" type="submit" value="Order Now">

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
    <script src="checkout.js"></script>
</body>

</html>