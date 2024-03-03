<?php
include '../config.php';
if(session_status()!=2){
    session_start();
}
$account = isset($_SESSION['id']) ? ($_SESSION['id']) : (3);

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
        $qt=$result->fetch_assoc()['SUM(Quantity)'];
        if($qt>0){
            echo $qt;
        }
        else{
            echo strval(0);
        }
    }
    else{
        echo strval(0);
    }
}
calcNumberOfItems();
