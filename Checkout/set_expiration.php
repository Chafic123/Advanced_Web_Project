<?php

if(isset($_POST['expirationDate'])) {
    $expirationDate = $_POST['expirationDate'];

    setcookie('expirationDate', $expirationDate, time() + (86400 * 30), '/'); // 30 days expiration
    echo "Cookie set successfully.";
} else {
    echo "Expiration date not provided.";
}
?>
