<?php
include '../config.php';
$account = isset($_SESSION['account']) ? ($_SESSION['account']) : (3);

function calcNumberOfItems()
{
    global $conn;
    global $account;
    if ($account != 3) {
        $stmt = $conn->prepare("SELECT SUM(Quantity) FROM cart WHERE AccountNum = ?");
        $stmt->bind_param("i", $account);
        if (!$stmt->execute()) {
            error_log("Error calculating total: " . $conn->error);
            return "Error";
        }
        $result = $stmt->get_result();
        $stmt->close();
        echo $result->fetch_assoc()['SUM(Quantity)'];
    }
    else{
        echo strval(0);
    }
    
}
calcNumberOfItems();
