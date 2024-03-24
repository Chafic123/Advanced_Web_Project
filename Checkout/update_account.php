<?php
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fname'];
    $lastname = $_POST["lname"];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $account = $_POST['id'];

    if ($conn) {

        // Update account information
        $updateQuery = "UPDATE account SET FirstName=?, LastName=?, Phone=?, Address=?, City=? WHERE AccountNum=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssi", $fullname, $lastname, $phone, $address, $city, $account);
        $stmt->execute();
        $stmt->close();

        // Calculate total price
        require_once('../Cart/add_to_cart.php');
        $totalPrice = calcTotal($account);

        // Insert order
        $insertOrderQuery = "INSERT INTO orders (AccountNum, TotalPrice) VALUES (?, ?)";
        $stmt = $conn->prepare($insertOrderQuery);
        $stmt->bind_param("id", $account, $totalPrice);
        $stmt->execute();
        $stmt->close();

        // Fetch the new order number
        $selectMaxOrderQuery = "SELECT MAX(OrderNum) as OrderNum FROM orders";
        $result = $conn->query($selectMaxOrderQuery);
        $row = $result->fetch_assoc();
        $newOrderNum = $row["OrderNum"];

        // Insert items into includes table
        $selectCartQuery = "SELECT ItemNum, Quantity FROM Cart WHERE AccountNum=?";
        $stmt = $conn->prepare($selectCartQuery);
        $stmt->bind_param("i", $account);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $itemNum = $row['ItemNum'];
            $quantity = $row['Quantity'];

            $insertIncludesQuery = "INSERT INTO includes (OrderNum, ItemNum, Quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertIncludesQuery);
            $stmt->bind_param("iii", $newOrderNum, $itemNum, $quantity);
            $stmt->execute();
            $stmt->close();
        }

        echo "Account information updated successfully.";
    } else {
        echo "Database connection error.";
    }
} else {
    echo "Invalid request method.";
}
?>