<?php
include "../config.php";
include "account-info.php";
if (session_status() != 2) {
    session_start();
}
$account = isset($_SESSION['id']) ? ($_SESSION['id']) : (3);

if (isset($_POST['fname']) && isset($_POST["lname"]) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['city'])) {

    $fullname = $_POST['fname'];
    $lastname = $_POST["lname"];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    require_once('../Cart/add_to_cart.php');
    $total = calcTotal($account);
    if ($conn) {
        // Update account information
        $updateQuery = "UPDATE account SET FirstName=?, LastName=?, Phone=?, Address=?, City=? WHERE AccountNum=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssi", $fullname, $lastname, $phone, $address, $city, $account);
        $stmt->execute();
        $stmt->close();

        echo "Account information updated successfully.";
    } else {
        echo "Database connection error.";
    }
} else {
    echo "Invalid request method.";
}

// Insert the new order into the orders table
$now=date('Y-m-d H:i:s');
$insertQuery = "INSERT INTO orders (AccountNum, DateTime, TotalPrice) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("isi", $account, $now, $total);
$stmt->execute();
$selectmax = "SELECT MAX(OrderNum) as OrderNum from orders";
$res = mysqli_query($conn, $selectmax);
$row = mysqli_fetch_assoc($res);
$newOrderNum = $row["OrderNum"];

$ItemArray = [];
$selectQuery = "SELECT ItemNum, Quantity FROM Cart WHERE AccountNum = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $account);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ItemArray[] = ['ItemNum' => $row['ItemNum'], 'Quantity' => $row['Quantity']];
    }
}

foreach ($ItemArray as $item) {
    $insertIncludesQuery = "INSERT INTO includes (OrderNum, ItemNum, Quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertIncludesQuery);
    $stmt->bind_param("iii", $newOrderNum, $item['ItemNum'], $item['Quantity']);
    $stmt->execute();
}
//delete all rows from thew cart items
$deleteQuery = "DELETE FROM Cart WHERE AccountNum = ?";
if ($stmt = $conn->prepare($deleteQuery)) {
    $stmt->bind_param("i", $account);
    $stmt->execute();
} else {
    echo "error";
}
