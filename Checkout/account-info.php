<?php
require_once('../Cart/add_to_cart.php');
 $account = isset($_SESSION['id']) ? ($_SESSION['id']) : (3);
 $accInfo=findAccountInfo();
 $fname=$accInfo[0];
 $lname=$accInfo[1];
 $Add=$accInfo[2];
 $phone=$accInfo[3];
 $city=$accInfo[4];
 $total=calcTotal($account);
 function findAccountInfo()
 {
     global $account;
     global $conn;
     if ($account != 3) {
         $query = "SELECT * FROM account WHERE AccountNum = ?";
         $stmt = $conn->prepare($query);
         $stmt->bind_param("i", $account);
         $stmt->execute();
         $result = $stmt->get_result();
         $stmt->close();

         $accInfo = mysqli_fetch_array($result);
         return [$accInfo['FirstName'], $accInfo['LastName'], $accInfo['Address'],$accInfo['Phone'],$accInfo['City']];
     }
     return ['', '', '','','' ];
 }
?>