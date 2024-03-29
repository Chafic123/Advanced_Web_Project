<?php
include('../config.php');
if(session_status()!=2){
    session_start();
}
//gets the account number (if no account it give them the account 3 which is just used as a foreign key in the review table so for guest reviewers)
$account = isset($_SESSION['id'])?($_SESSION['id']):(3);
//used to check if the item is already in the cart
function isItemInCart($item)
{
    global $account;
    global $conn;
    $checkingQuery = "SELECT * FROM cart WHERE AccountNum = ? AND ItemNum= ?";
    $stmt = $conn->prepare($checkingQuery);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("ii", $account, $item);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->num_rows > 0;
}
//adds the item to cart or just increase its quantity in the cart depending if its already there or not
function addToCart($item, $quantity)
{
    global $account;
    global $conn;
    if ($account!=3) {
        if (isItemInCart($item)) {
            $getCurQuantity = "SELECT Quantity FROM cart WHERE cart.AccountNum =? AND cart.ItemNum=?";
            $stmt1 = $conn->prepare($getCurQuantity);
            if (!$stmt1) {
                return false;
            }
            $stmt1->bind_param("ii", $account, $item);
            $stmt1->execute();
            $stmt1->bind_result($curQ);
            $stmt1->fetch();
            $stmt1->close();
            $newQ = intval($curQ) + $quantity;

            $updateQuery = "UPDATE cart SET Quantity = ? WHERE AccountNum =? AND ItemNum=?";
            $stmt2 = $conn->prepare($updateQuery);
            if (!$stmt2) {
                return false;
            }
            $stmt2->bind_param("iii", $newQ, $account, $item);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $stmt2->close();
        } else {
            $query = "INSERT into cart values (?,?,?) ";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param("iii", $item, $account, $quantity);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                return false;
            }
            $stmt->close();
        }
    }
}
//used to calculate the total price of the order
function calcTotal()
{
    global $conn;
    global $account;
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT menuitem.Price, cart.Quantity FROM menuitem INNER JOIN cart ON menuitem.ItemNum = cart.ItemNum WHERE cart.AccountNum = ?");
    $stmt->bind_param("i", $account);
    if (!$stmt->execute()) {
        error_log("Error calculating total: " . $conn->error);
        return "Error";
    }
    $result = $stmt->get_result();
    // Use mysqli_fetch_assoc for better performance and type safety
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += doubleval($row['Price']) * intval($row['Quantity']);
    }
    $stmt->close();
    $result->free();
    // Format and return the total price
    echo "$" . strval(number_format($total, 2, '.', ""));
}
//this occurs when the user presses the add button on any menu item
if (isset($_POST['item_id']) && isset($_POST['quantity']) && intval($_POST['quantity']) > 0) {
    $item = intval($_POST['item_id']);
    $quantity = intval($_POST['quantity']);
    addToCart($item, $quantity); 
}

calcTotal();
