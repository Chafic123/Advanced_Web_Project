<?php
include('../config.php');

$itemNum = isset($_POST['itemNum']) ? intval($_POST['itemNum']) : 0;
$newQuantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
$AccountNum=isset($_POST['AccountNum'])?intval($_POST['AccountNum']):0;

if ($itemNum <= 0 || $newQuantity <= 0) {
    echo "Invalid input.";
    exit;
}
$updateQuery = "UPDATE cart SET Quantity = ? WHERE ItemNum = ? AND AccountNum = ? ";
$updateStatement = mysqli_prepare($conn, $updateQuery);

if (!$updateStatement) {
    echo "Update query preparation failed: " . mysqli_error($conn);
    exit;
}
mysqli_stmt_bind_param($updateStatement, "iii", $newQuantity, $itemNum,$AccountNum);
$updateResult = mysqli_stmt_execute($updateStatement);

if ($updateResult) {
    header("Location: cart.php");
    exit;
} else {
    echo "Update query failed: " . mysqli_error($conn);
}
mysqli_stmt_close($updateStatement);
mysqli_close($conn);
?>
