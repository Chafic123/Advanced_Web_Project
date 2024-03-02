<?php
session_start();
include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaz</title>
    <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="cart-style.css">
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
    $defaultAccount=1;
    require("../navbar.php");
    NavBar();
    require("../sign-forms.php");
    signForms();

    if(isset($_SESSION["account"])){
        $account=$_SESSION["account"];
    }
    if($account!=3){
        $account=$defaultAccount;
    }
    $server="localhost";
    $username="root";
    $password="";
    $db_name="advwebproject";

    $conn=mysqli_connect($server,$username,$password,$db_name);
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
    $query="SELECT menuitem.ItemNum , menuitem.ItemName, menuitem.Photo, cart.Quantity, menuitem.Price
    From cart
    INNER JOIN menuitem ON cart.ItemNum = menuitem.ItemNum
    WHERE cart.AccountNum = $account";
    $result=mysqli_query($conn,$query);
    if (!$result) {
        die("Query failed: ". mysqli_error($conn));
    }
    
    if ($result->num_rows > 0) {
        // Display the cart items in a table
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Image</th>";
        echo "<th>Item Name</th>";
        echo "<th>Quantity</th>";
        echo "<th>Price</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // while ($row = mysqli_fetch_assoc($result)) {
        //     echo "<tr data-itemnum='" . $row['ItemNum'] . "' data-price='" . $row['Price'] . "'>";
        //     echo "<td><img src='" . $row['Photo'] . "' alt='" . $row['ItemName'] . "' style='width: 50px; height: 50px;'></td>";
        //     echo "<td>" . $row['ItemName'] . "</td>";
        //     echo "<td><input type='number' name='quantity' class='quantity-input' value='" . $row['Quantity'] . "' min='1'></td>";
        //     echo "<td class='price'>$" . $row['Price'] * $row['Quantity'] . "</td>";
        //     echo "<a href='delete.php?Id=" . $row["ItemNum"] . "'>Delete</a>";
        //     echo "</tr>";
        // }

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr data-itemnum='" . $row['ItemNum'] . "' data-price='" . $row['Price'] . "'>";
            echo "<td><img src='" . $row['Photo'] . "' alt='" . $row['ItemName'] . "' style='width: 50px; height: 50px;'></td>";
            echo "<td>" . $row['ItemName'] . "</td>";
            echo "<td>";
            echo "<input type='number' name='quantity' class='quantity-input' value='" . $row['Quantity'] . "' min='1'>";
            echo "</td>";
            echo "<td class='price'>$" . $row['Price'] * $row['Quantity'] . "</td>";
            echo "<td>";
            echo "<button class='update-btn' data-itemnum='" . $row['ItemNum'] . "'>Update </button> | ";
            echo "<a class='delete-link' href='delete.php?itemNum=" . $row['ItemNum'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        } 
    mysqli_close($conn);
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>  
    <!-- Body -->
    <!-- main -->
    <h1>Cart:</h1>
    <main class="cart-body transition-fade">
        <!-- Displayed when cart is empty -->
        <div id="empty-cart">
            <h2>Your Cart is Empty :(</h2>
        </div>
        <!-- displayed when there are items in the cart -->
        <table>
            <thead>
                <th id="title-item">Ordered Item</th>
                <th id="item-name">Item Name</th>
                <th id="title-heading">Quantity</th>
                <th id="title-price">Price</th>
                <td id="title-empty"></td>
            </thead>
            <tbody id="cart-items-body">

            </tbody>
        </table>
        <!-- displays total when there are items in the cart -->
        <div id="total-div">
            <b class="total-title">
                Total:
            </b>
            <p class="price-total">
                <?php include("../Menu/add_to_cart.php");
            calcTotal();
            ?>
            </p>
            <button class="checkout-btn">
                <svg id="checkout-icon" title="Checkout" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" style="fill:black;"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M64 0C46.3 0 32 14.3 32 32V96c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1C.4 368.8 0 373.6 0 378.4V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V378.4c0-4.8-.4-9.6-1.1-14.4L488.2 214.4C483.5 183.1 456.6 160 425 160H208V128h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zM96 48H256c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-168a24 24 0 1 1 0-48 24 24 0 1 1 0 48zm120-24a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM160 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM328 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM256 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48zM424 240a24 24 0 1 1 -48 0 24 24 0 1 1 48 0zM352 344a24 24 0 1 1 0-48 24 24 0 1 1 0 48z" />
                </svg>
                <h5>Checkout</h5>
            </button>
        </div>
    </main>

    <?php
    require('../footer.php');
    Footer();
    ?>
    <!-- Pop Up -->
    <div class="pop-up-container">
        <div class="pop-up">
            <button class="close-btn" id="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <p>Are you sure you want to remove this item?</p>
            <div class="popBtns">
                <button id="yes">Yes</button>
                <button id="no">No</button>
            </div>
        </div>
    </div>
    <script>let account=<?php echo $account?></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="../main.js"></script>
    <script src="cart.js"></script>
    <script src="../sign.js"></script>
</body>

</html>