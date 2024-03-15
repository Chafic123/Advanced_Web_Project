<?php
session_start();
include("config.php");

if(isset($_GET['itemNum']) && isset($_GET['accountNum'])) {
    $itemNum = intval($_GET['itemNum']);
    $accountNum = intval($_GET['accountNum']);

    $conn = mysqli_connect("localhost", "root", "", "advwebproject"); 

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("DELETE FROM cart WHERE ItemNum = ? AND AccountNum = ?");
    $stmt->bind_param("ii", $itemNum, $accountNum);

    if ($stmt->execute()) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ItemNum and AccountNum required";
}
?>
