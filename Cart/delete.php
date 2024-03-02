<?php
include('../config.php');
if (isset($_GET['itemNum'])) {
    $itemNum = $_GET['itemNum'];

    // Prepare and execute the delete query
    $deleteQuery = "DELETE FROM cart WHERE ItemNum = $itemNum AND AccountNum = $account";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Redirect back to the cart page after deletion
        header("Location: cart.php");
        exit();
    } else {
        die("Delete query failed: " . mysqli_error($conn));
    }
} else {
    // Redirect to the cart page if 'itemNum' is not set
    header("Location: cart.php");
    exit();
}
?>
