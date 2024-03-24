<?php

if(isset($_POST['expirationDate'])&& $_POST['order']) {
    $expirationDate = $_POST['expirationDate'];

    setcookie('expirationDate', $expirationDate, time() + (86400 * 30), '/'); // 30 days expiration
    echo "Cookie set successfully.";
} else {
    echo "Expiration date not provided.";
}
?>
