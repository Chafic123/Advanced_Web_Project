<?php
include('../config.php');
if (isset($_GET['itemNum']) && isset($_GET['quantity'])) {
    $itemNum = $_GET['itemNum'];
    $newQuantity = $_GET['quantity'];

    $updateQuery = "UPDATE cart SET Quantity = $newQuantity WHERE ItemNum = $itemNum AND AccountNum = $account";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Redirect back to the cart page after updating
        header("Location: cart.php");
        exit();
    } else {
        die("Update query failed: " . mysqli_error($conn));
    }
} else {
    // Redirect to the cart page if 'itemNum' or 'quantity' is not set
    header("Location: cart.php");
    exit();
}
?>
