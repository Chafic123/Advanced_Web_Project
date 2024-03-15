<?php
include('../config.php');



function calcTotal($account)
{
    global $conn;
 
    $stmt = $conn->prepare("SELECT menuitem.Price, cart.Quantity FROM cart INNER JOIN menuitem ON menuitem.ItemNum = cart.ItemNum WHERE cart.AccountNum = ?");
    $stmt->bind_param("i", $account);
    if (!$stmt->execute()) {
        error_log("Error calculating total: " . $conn->error);
        return "Error";
    }
    $result = $stmt->get_result();

    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += doubleval($row['Price']) * intval($row['Quantity']);
    }
    $stmt->close();
    $result->free();
    echo "$" . strval(number_format($total, 2, '.', ""));
}

