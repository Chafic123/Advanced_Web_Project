<?php
include('../config.php');
$account;

function addToCart($item, $quantity){
    global $account;
    $query="insert into cart values ('$item', '$account','$quantity') ";
}

?>